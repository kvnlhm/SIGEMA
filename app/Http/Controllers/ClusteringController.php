<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Variabel;
use App\Models\Clustering;
use Illuminate\Http\Request;
use App\Models\Pengelompokan;
use App\Imports\ClusteringImport;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Excel as ExcelType;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Barryvdh\DomPDF\Facade\Pdf;

class ClusteringController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {
        $log = new Log;
        $log->id_user = Auth::user()->id;
        $log->aktivitas = 'Mengakses halaman Clustering';
        $log->save();

        $data = Pengelompokan::select('id_pengelompokan', 'judul', 'jumlah_cluster', 'pembobot', 'nilai_error', 'maksimal_iterasi', 'created_at')->get();

        return view('clustering.list', compact('data'));
    }

    public function index()
    {
        $log = new Log;
        $log->id_user = Auth::user()->id;
        $log->aktivitas = 'Mengakses halaman proses Clustering';
        $log->save();

        return view('clustering.index');
    }

    public function inisialisasi($id)
    {
        $log = new Log;
        $log->id_user = Auth::user()->id;
        $log->aktivitas = 'Mengakses halaman proses Clustering';
        $log->save();

        $kelompok = Pengelompokan::find(decrypt($id));
        return view('clustering.inisialisasi', compact('kelompok'));
    }

    public function index2()
    {
        return view('clustering.index2');
    }

    // Untuk tampilan update
    public function inisialisasi2($id)
    {
        $kelompok = Pengelompokan::find(decrypt($id));
        return view('clustering.inisialisasi2', compact('kelompok'));
    }

    public function downloadExcel($jumlah)
    {
        $variabels = Variabel::all('nama')->pluck('nama')->toArray();
        array_unshift($variabels, "No."); // Menambahkan "No." di awal array

        $data = [];
        for ($i = 1; $i <= $jumlah; $i++) {
            $row = array_fill(0, count($variabels), null); // Memastikan array diisi dengan null
            $row[0] = $i; // Mengisi kolom "No." dengan nomor urut
            $data[] = $row;
        }

        return Excel::download(new class($data, $variabels) implements FromCollection, WithHeadings {
            private $data;
            private $headings;

            public function __construct($data, $headings)
            {
                $this->data = $data;
                $this->headings = $headings;
            }

            public function collection()
            {
                return collect($this->data);
            }

            public function headings(): array
            {
                return $this->headings;
            }
        }, 'clustering_data.xlsx');
    }

    public function showScale(Request $request)
    {
        $jumlahData = $request->input('jumlah_data');
        $variabels = Variabel::all();

        // Menghitung frekuensi setiap variabel
        $frequencies = [];
        foreach ($variabels as $variabel) {
            $frequencies[$variabel->nama] = DB::table('tabel_data')
                ->where('variabel_id', $variabel->id)
                ->count();
        }

        // Menentukan nilai minimum dan maksimum
        $minFreq = min($frequencies);
        $maxFreq = max($frequencies);

        // Menghitung skala
        $scales = [];
        foreach ($frequencies as $key => $freq) {
            $scales[$key] = ($freq - $minFreq) / ($maxFreq - $minFreq);
        }

        return view('clustering.scale', compact('scales', 'jumlahData'));
    }

    public function processUploadedFile(Request $request)
    {
        // dd($request->all());
        // $variabels = Variabel::all();
        $variabels = Variabel::with('isiVariabel')->get();
        $file = $request->file('file');
        $jumlahCluster = $request->input('jumlah_cluster'); // Ambil jumlah cluster dari input

        // Ambil data input dari request
        // $pembobot = $request->input('pembobot');
        $pembobot = 1.9;
        // $nilaiError = $request->input('nilai_error');
        $nilaiError = 0.01;
        // $maksimalIterasi = $request->input('maksimal_iterasi');
        $maksimalIterasi = 100;
        // $judul = $request->input('judul');
        $judul = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Ambil nama file tanpa ekstensi
        // $periode = $request->input('periode');
        $periode = date('Y');
        $conditions = $request->input('conditions', []);

        $data = Excel::toArray(new class implements ToModel {
            use Importable;
            public function model(array $row)
            {
                return $row; // Mengembalikan baris sebagai array
            }
        }, $file);

        $header = array_shift($data[0]); // Menghapus header

        // Menghitung frekuensi, mengabaikan kolom "No."
        $frequencies = [];
        $order = []; // Menyimpan urutan kemunculan
        foreach ($data[0] as $row) {
            foreach ($row as $index => $value) {
                if ($header[$index] == "No.") continue; // Mengabaikan kolom "No."
                if (!isset($frequencies[$header[$index]])) {
                    $frequencies[$header[$index]] = [];
                    $order[$header[$index]] = [];
                }
                if (!isset($frequencies[$header[$index]][$value])) {
                    $frequencies[$header[$index]][$value] = 0;
                    $order[$header[$index]][$value] = count($order[$header[$index]]) + 1; // Menyimpan urutan kemunculan
                }
                $frequencies[$header[$index]][$value]++;
            }
        }

        // Menghitung skala dengan penyesuaian berdasarkan urutan
        $scales = [];
        foreach ($frequencies as $column => $values) {
            $min = min($values);
            $max = max($values);
            $total = count($values);
            $maxAdjustment = ($total - 1) / $total * 0.01; // Maksimum penyesuaian yang mungkin

            if ($max == $min) {
                foreach ($values as $value => $freq) {
                    $scales[$column][$value] = 1;
                }
            } else {
                foreach ($values as $value => $freq) {
                    $adjustment = ($order[$column][$value] - 1) / $total * 0.01; // Penyesuaian kecil berdasarkan urutan
                    $scaledValue = ($freq - $min) / ($max - $min);
                    $scales[$column][$value] = min($scaledValue + $adjustment, 1); // Pastikan tidak melebihi 1
                }
            }
        }
        $scales = $this->applyConditionsToScales($scales, $conditions);
        // dd($scales);

        // Override scales with inisial values from isiVariabel if applicable
        foreach ($variabels as $variabel) {
            if (in_array($variabel->nama, $header)) {
                $columnIndex = array_search($variabel->nama, $header);
                foreach ($variabel->isiVariabel as $isi) {
                    if (isset($scales[$variabel->nama][$isi->keterangan])) {
                        $scales[$variabel->nama][$isi->keterangan] = $isi->inisial;
                    } else {
                        // Parse and apply range conditions
                        if (preg_match('/([<>]?=?)(\d+)-?(\d+)?=([\d\.]+)/', $isi->keterangan, $matches)) {
                            $operator = $matches[1];
                            $start = $matches[2];
                            $end = $matches[3] ?? null;
                            $result = floatval($matches[4]);

                            foreach ($frequencies[$variabel->nama] as $value => $freq) {
                                if ($this->valueMatchesCondition($value, $operator, $start, $end)) {
                                    $scales[$variabel->nama][$value] = $result;
                                }
                            }
                        }
                    }
                }
            }
        }

        // Membuat data UIK Random
        $uikRandom1 = [];
        foreach ($data[0] as $row) {
            $randomValues = [];
            $sum = 0;
            for ($i = 0; $i < $jumlahCluster; $i++) {
                $randomValue = rand(1, 100); // Menghasilkan nilai antara 1 dan 100
                $randomValues[] = $randomValue;
                $sum += $randomValue;
            }
            // Normalisasi nilai agar totalnya menjadi 1
            foreach ($randomValues as &$value) {
                $value /= $sum;
            }
            unset($value); // Penting: memutus referensi setelah loop selesai
            $uikRandom1[] = $randomValues;
        }

        // // Menghitung UIK^w
        // $uikSquared1 = [];
        // $columnTotals1 = array_fill(0, count($data[0][0]) - 1, 0); // Inisialisasi array untuk menyimpan total per kolom
        // foreach ($uikRandom1 as $row) {
        //     $squaredValues = [];
        //     foreach ($row as $index => $value) {
        //         $squaredValue = pow($value, $pembobot);
        //         $squaredValues[] = $squaredValue;
        //         $columnTotals1[$index] += $squaredValue; // Menambahkan nilai ke total kolom
        //     }
        //     $uikSquared1[] = $squaredValues;
        // }

        // Menghitung UIK^w
        $uikSquared1 = [];
        $columnTotals1 = array_fill(0, $jumlahCluster, 0); // Inisialisasi array untuk menyimpan total per kolom
        foreach ($uikRandom1 as $row) {
            $squaredValues = [];
            foreach ($row as $index => $value) {
                if (isset($columnTotals1[$index])) { // Pastikan indeks ada dalam $columnTotals1
                    $squaredValue = pow($value, $pembobot);
                    $squaredValues[] = $squaredValue;
                    $columnTotals1[$index] += $squaredValue; // Menambahkan nilai ke total kolom
                }
            }
            $uikSquared1[] = $squaredValues;
        }

        // Menghitung UIK Cluster
        $uikClusters1 = [];
        $columnTotalsClusters1 = [];
        for ($i = 0; $i < $jumlahCluster; $i++) {
            $clusterData = [];
            $columnTotals1 = array_fill(0, count($data[0][0]) - 1, 0); // Inisialisasi array untuk menyimpan total per kolom
            foreach ($data[0] as $rowIndex => $dataRow) {
                $clusterRow = [];
                foreach ($dataRow as $dataIndex => $value) {
                    if ($dataIndex > 0) { // Mengabaikan kolom "No."
                        $scaledValue = $scales[$header[$dataIndex]][$value] ?? 0;
                        $clusterValue = $scaledValue * $uikSquared1[$rowIndex][$i];
                        $clusterRow[] = $clusterValue;
                        $columnTotals1[$dataIndex - 1] += $clusterValue; // Menghitung total per kolom
                    }
                }
                $clusterData[] = $clusterRow;
            }
            $uikClusters1[] = $clusterData;
            $columnTotalsClusters1[] = $columnTotals1;
        }
        
        $columnTotalsSquared = array_fill(0, $jumlahCluster, 0);
        foreach ($uikSquared1 as $row) {
            foreach ($row as $index => $value) {
                $columnTotalsSquared[$index] += $value;
            }
        }
        
        $uikBaru = []; // Inisialisasi array untuk menyimpan hasil perhitungan
        foreach ($data[0] as $rowIndex => $row) {
            $totalUikBaru = 0;
            $uikBaru[$rowIndex] = [];
    
            foreach ($uikClusters1 as $clusterIndex => $clusterData) {
                $totalObjective = 0;
                foreach ($row as $dataIndex => $value) {
                    if ($dataIndex > 0) { // Ignore "No." column
                        $centerValue = $columnTotalsClusters1[$clusterIndex][$dataIndex - 1] / $columnTotalsSquared[$clusterIndex];
                        $diffSquared = pow(($scales[$header[$dataIndex]][$value] ?? 0) - $centerValue, 2);
                        $totalObjective += $diffSquared;
                    }
                }
                $uikBaru[$rowIndex][$clusterIndex] = $totalObjective;
                $totalUikBaru += $totalObjective;
            }
    
            // Normalisasi nilai untuk setiap cluster pada baris ini
            foreach ($uikBaru[$rowIndex] as $clusterIndex => $clusterTotal) {
                $uikBaru[$rowIndex][$clusterIndex] = $clusterTotal / $totalUikBaru;
            }
        }

        // Untuk data iterasi selanjutnya
        $allData = []; // Array untuk menyimpan data setiap iterasi
        $allData[1] = [
            'uikRandom' => $uikBaru,
            'uikSquared' => $uikSquared1,
            'columnTotals' => $columnTotals1,
            'uikClusters' => $uikClusters1,
            'columnTotalsClusters' => $columnTotalsClusters1
        ];
        for ($x = 2; $x <= $maksimalIterasi; $x++) {
            // Proses data untuk iterasi ke-$x
            // Misalnya, menghitung ulang $uikRandom, $uikSquared, dll. berdasarkan hasil iterasi sebelumnya
            if ($x == 2) {
                $uikRandom[$x] = $uikBaru; // Untuk iterasi kedua, gunakan $uikBaru dari hasil iterasi pertama
            } else {
                $uikRandom[$x] = $uikBaru[$x - 1]; // Ambil $uikBaru dari iterasi sebelumnya
            }

            // // Menghitung UIK^w untuk iterasi ke-$x
            // $uikSquared[$x] = [];
            // $columnTotals[$x] = array_fill(0, count($data[0][0]) - 1, 0); // Inisialisasi array untuk menyimpan total per kolom
            // foreach ($uikRandom[$x] as $row) {
            //     $squaredValues = [];
            //     foreach ($row as $index => $value) {
            //         $squaredValue = pow($value, $pembobot);
            //         $squaredValues[] = $squaredValue;
            //         $columnTotals[$x][$index] += $squaredValue; // Menambahkan nilai ke total kolom
            //     }
            //     $uikSquared[$x][] = $squaredValues;
            // }

            // Menghitung UIK^w untuk iterasi ke-$x
            $uikSquared[$x] = [];
            $columnTotals[$x] = array_fill(0, $jumlahCluster, 0); // Inisialisasi array untuk menyimpan total per kolom
            foreach ($uikRandom[$x] as $row) {
                $squaredValues = [];
                foreach ($row as $index => $value) {
                    if (isset($columnTotals[$x][$index])) { // Pastikan indeks ada dalam $columnTotals[$x]
                        $squaredValue = pow($value, $pembobot);
                        $squaredValues[] = $squaredValue;
                        $columnTotals[$x][$index] += $squaredValue; // Menambahkan nilai ke total kolom
                    }
                }
                $uikSquared[$x][] = $squaredValues;
            }

            // Menghitung UIK Cluster untuk iterasi ke-$x
            $uikClusters[$x] = [];
            $columnTotalsClusters[$x] = [];
            for ($i = 0; $i < $jumlahCluster; $i++) {
                $clusterData = [];
                $columnTotals[$x] = array_fill(0, count($data[0][0]) - 1, 0); // Inisialisasi array untuk menyimpan total per kolom
                foreach ($data[0] as $rowIndex => $dataRow) {
                    $clusterRow = [];
                    foreach ($dataRow as $dataIndex => $value) {
                        if ($dataIndex > 0) { // Mengabaikan kolom "No."
                            $scaledValue = $scales[$header[$dataIndex]][$value] ?? 0;
                            $clusterValue = $scaledValue * $uikSquared[$x][$rowIndex][$i];
                            $clusterRow[] = $clusterValue;
                            $columnTotals[$x][$dataIndex - 1] += $clusterValue; // Menghitung total per kolom
                        }
                    }
                    $clusterData[] = $clusterRow;
                }
                $uikClusters[$x][] = $clusterData;
                $columnTotalsClusters[$x][] = $columnTotals[$x];
            }

            $columnTotalsSquared[$x] = array_fill(0, $jumlahCluster, 0);
            foreach ($uikSquared[$x] as $row) {
                foreach ($row as $index => $value) {
                    $columnTotalsSquared[$x][$index] += $value;
                }
            }
            
            $uikBaru[$x] = []; // Inisialisasi array untuk menyimpan hasil perhitungan
            foreach ($data[0] as $rowIndex => $row) {
                $totalUikBaru = 0;
                $uikBaru[$x][$rowIndex] = [];
        
                foreach ($uikClusters[$x] as $clusterIndex => $clusterData) {
                    $totalObjective = 0;
                    foreach ($row as $dataIndex => $value) {
                        if ($dataIndex > 0) { // Ignore "No." column
                            $centerValue = $columnTotalsClusters[$x][$clusterIndex][$dataIndex - 1] / $columnTotalsSquared[$x][$clusterIndex];
                            $diffSquared = pow(($scales[$header[$dataIndex]][$value] ?? 0) - $centerValue, 2);
                            $totalObjective += $diffSquared;
                        }
                    }
                    $uikBaru[$x][$rowIndex][$clusterIndex] = $totalObjective;
                    $totalUikBaru += $totalObjective;
                }
        
                // Normalisasi nilai untuk setiap cluster pada baris ini
                foreach ($uikBaru[$x][$rowIndex] as $clusterIndex => $clusterTotal) {
                    $uikBaru[$x][$rowIndex][$clusterIndex] = $clusterTotal / $totalUikBaru;
                }
            }
    
            // Simpan hasil iterasi ke dalam array
            $allData[$x] = [
                'uikRandom' => $uikRandom[$x],
                'uikSquared' => $uikSquared[$x],
                'columnTotals' => $columnTotals[$x],
                'uikClusters' => $uikClusters[$x],
                'columnTotalsClusters' => $columnTotalsClusters[$x]
            ];
        }
        // dd($allData, $uikRandom1, $uikBaru);
        $finalIterationValue = session('finalIterationValue');

        $viewContent = view('clustering.results', compact('allData', 'finalIterationValue', 'variabels', 'header', 'data', 'scales', 'uikRandom1', 'uikSquared1', 'columnTotals1', 'uikClusters1', 'columnTotalsClusters1', 'jumlahCluster', 'pembobot', 'nilaiError', 'maksimalIterasi', 'judul', 'periode', 'finalIterationValue'))->render();

        $log = new Log;
        $log->id_user = Auth::user()->id;
        $log->aktivitas = 'Menghasilkan hasil clustering';
        $log->save();
        
        $kelompok = new Pengelompokan;
        $kelompok->id_user = Auth::user()->id;
        $kelompok->judul = $judul;
        $kelompok->periode = $periode;
        $kelompok->jumlah_cluster = $jumlahCluster;
        $kelompok->pembobot = $pembobot;
        $kelompok->nilai_error = $nilaiError;
        $kelompok->maksimal_iterasi = $maksimalIterasi;
        $kelompok->conditions = json_encode($conditions);
        $kelompok->html_konten = $viewContent;
        $kelompok->save();

        return view('clustering.results', compact('allData', 'finalIterationValue', 'variabels', 'header', 'data', 'scales', 'uikRandom1', 'uikSquared1', 'columnTotals1', 'uikClusters1', 'columnTotalsClusters1', 'jumlahCluster', 'pembobot', 'nilaiError', 'maksimalIterasi', 'judul', 'periode', 'finalIterationValue'));
    }

    // Untuk proses update
    public function processUploadedFile2(Request $request)
    {
        $variabels = Variabel::with('isiVariabel')->get();
        $file = $request->file('file');
        $jumlahCluster = $request->input('jumlah_cluster'); // Ambil jumlah cluster dari input

        // Ambil data input dari request
        // $pembobot = $request->input('pembobot');
        // $nilaiError = $request->input('nilai_error');
        // $maksimalIterasi = $request->input('maksimal_iterasi');
        // $judul = $request->input('judul');
        // $periode = $request->input('periode');
        $pembobot = 1.9;
        $nilaiError = 0.01;
        $maksimalIterasi = 100;
        $judul = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // Ambil nama file tanpa ekstensi
        $periode = date('Y');
        $conditions = $request->input('conditions', []);
        $id_pengelompokan = decrypt($request->input('id_kelompok'));

        $data = Excel::toArray(new class implements ToModel {
            use Importable;
            public function model(array $row)
            {
                return $row; // Mengembalikan baris sebagai array
            }
        }, $file);

        $header = array_shift($data[0]); // Menghapus header

        // Menghitung frekuensi, mengabaikan kolom "No."
        $frequencies = [];
        $order = []; // Menyimpan urutan kemunculan
        foreach ($data[0] as $row) {
            foreach ($row as $index => $value) {
                if ($header[$index] == "No.") continue; // Mengabaikan kolom "No."
                if (!isset($frequencies[$header[$index]])) {
                    $frequencies[$header[$index]] = [];
                    $order[$header[$index]] = [];
                }
                if (!isset($frequencies[$header[$index]][$value])) {
                    $frequencies[$header[$index]][$value] = 0;
                    $order[$header[$index]][$value] = count($order[$header[$index]]) + 1; // Menyimpan urutan kemunculan
                }
                $frequencies[$header[$index]][$value]++;
            }
        }

        // Menghitung skala dengan penyesuaian berdasarkan urutan
        $scales = [];
        foreach ($frequencies as $column => $values) {
            $min = min($values);
            $max = max($values);
            $total = count($values);
            $maxAdjustment = ($total - 1) / $total * 0.01; // Maksimum penyesuaian yang mungkin

            if ($max == $min) {
                foreach ($values as $value => $freq) {
                    $scales[$column][$value] = 1;
                }
            } else {
                foreach ($values as $value => $freq) {
                    $adjustment = ($order[$column][$value] - 1) / $total * 0.01; // Penyesuaian kecil berdasarkan urutan
                    $scaledValue = ($freq - $min) / ($max - $min);
                    $scales[$column][$value] = min($scaledValue + $adjustment, 1); // Pastikan tidak melebihi 1
                }
            }
        }
        $scales = $this->applyConditionsToScales($scales, $conditions);
        // dd($scales);

        // Override scales with inisial values from isiVariabel if applicable
        foreach ($variabels as $variabel) {
            if (in_array($variabel->nama, $header)) {
                $columnIndex = array_search($variabel->nama, $header);
                foreach ($variabel->isiVariabel as $isi) {
                    if (isset($scales[$variabel->nama][$isi->keterangan])) {
                        $scales[$variabel->nama][$isi->keterangan] = $isi->inisial;
                    } else {
                        // Parse and apply range conditions
                        if (preg_match('/([<>]?=?)(\d+)-?(\d+)?=([\d\.]+)/', $isi->keterangan, $matches)) {
                            $operator = $matches[1];
                            $start = $matches[2];
                            $end = $matches[3] ?? null;
                            $result = floatval($matches[4]);
                            // dd($result);

                            foreach ($frequencies[$variabel->nama] as $value => $freq) {
                                if ($this->valueMatchesCondition($value, $operator, $start, $end)) {
                                    $scales[$variabel->nama][$value] = $result;
                                }
                            }
                        }
                    }
                }
            }
        }
        // dd($scales);

        // Membuat data UIK Random
        $uikRandom1 = [];
        foreach ($data[0] as $row) {
            $randomValues = [];
            $sum = 0;
            for ($i = 0; $i < $jumlahCluster; $i++) {
                $randomValue = rand(1, 100); // Menghasilkan nilai antara 1 dan 100
                $randomValues[] = $randomValue;
                $sum += $randomValue;
            }
            // Normalisasi nilai agar totalnya menjadi 1
            foreach ($randomValues as &$value) {
                $value /= $sum;
            }
            unset($value); // Penting: memutus referensi setelah loop selesai
            $uikRandom1[] = $randomValues;
        }

        // // Menghitung UIK^w
        // $uikSquared1 = [];
        // $columnTotals1 = array_fill(0, count($data[0][0]) - 1, 0); // Inisialisasi array untuk menyimpan total per kolom
        // foreach ($uikRandom1 as $row) {
        //     $squaredValues = [];
        //     foreach ($row as $index => $value) {
        //         $squaredValue = pow($value, $pembobot);
        //         $squaredValues[] = $squaredValue;
        //         $columnTotals1[$index] += $squaredValue; // Menambahkan nilai ke total kolom
        //     }
        //     $uikSquared1[] = $squaredValues;
        // }

        // Menghitung UIK^w
        $uikSquared1 = [];
        $columnTotals1 = array_fill(0, $jumlahCluster, 0); // Inisialisasi array untuk menyimpan total per kolom
        foreach ($uikRandom1 as $row) {
            $squaredValues = [];
            foreach ($row as $index => $value) {
                if (isset($columnTotals1[$index])) { // Pastikan indeks ada dalam $columnTotals1
                    $squaredValue = pow($value, $pembobot);
                    $squaredValues[] = $squaredValue;
                    $columnTotals1[$index] += $squaredValue; // Menambahkan nilai ke total kolom
                }
            }
            $uikSquared1[] = $squaredValues;
        }

        // Menghitung UIK Cluster
        $uikClusters1 = [];
        $columnTotalsClusters1 = [];
        for ($i = 0; $i < $jumlahCluster; $i++) {
            $clusterData = [];
            $columnTotals1 = array_fill(0, count($data[0][0]) - 1, 0); // Inisialisasi array untuk menyimpan total per kolom
            foreach ($data[0] as $rowIndex => $dataRow) {
                $clusterRow = [];
                foreach ($dataRow as $dataIndex => $value) {
                    if ($dataIndex > 0) { // Mengabaikan kolom "No."
                        $scaledValue = $scales[$header[$dataIndex]][$value] ?? 0;
                        $clusterValue = $scaledValue * $uikSquared1[$rowIndex][$i];
                        $clusterRow[] = $clusterValue;
                        $columnTotals1[$dataIndex - 1] += $clusterValue; // Menghitung total per kolom
                    }
                }
                $clusterData[] = $clusterRow;
            }
            $uikClusters1[] = $clusterData;
            $columnTotalsClusters1[] = $columnTotals1;
        }
        
        $columnTotalsSquared = array_fill(0, $jumlahCluster, 0);
        foreach ($uikSquared1 as $row) {
            foreach ($row as $index => $value) {
                $columnTotalsSquared[$index] += $value;
            }
        }
        
        $uikBaru = []; // Inisialisasi array untuk menyimpan hasil perhitungan
        foreach ($data[0] as $rowIndex => $row) {
            $totalUikBaru = 0;
            $uikBaru[$rowIndex] = [];
    
            foreach ($uikClusters1 as $clusterIndex => $clusterData) {
                $totalObjective = 0;
                foreach ($row as $dataIndex => $value) {
                    if ($dataIndex > 0) { // Ignore "No." column
                        $centerValue = $columnTotalsClusters1[$clusterIndex][$dataIndex - 1] / $columnTotalsSquared[$clusterIndex];
                        $diffSquared = pow(($scales[$header[$dataIndex]][$value] ?? 0) - $centerValue, 2);
                        $totalObjective += $diffSquared;
                    }
                }
                $uikBaru[$rowIndex][$clusterIndex] = $totalObjective;
                $totalUikBaru += $totalObjective;
            }
    
            // Normalisasi nilai untuk setiap cluster pada baris ini
            foreach ($uikBaru[$rowIndex] as $clusterIndex => $clusterTotal) {
                $uikBaru[$rowIndex][$clusterIndex] = $clusterTotal / $totalUikBaru;
            }
        }

        // Untuk data iterasi selanjutnya
        $allData = []; // Array untuk menyimpan data setiap iterasi
        $allData[1] = [
            'uikRandom' => $uikBaru,
            'uikSquared' => $uikSquared1,
            'columnTotals' => $columnTotals1,
            'uikClusters' => $uikClusters1,
            'columnTotalsClusters' => $columnTotalsClusters1
        ];
        for ($x = 2; $x <= $maksimalIterasi; $x++) {
            // Proses data untuk iterasi ke-$x
            // Misalnya, menghitung ulang $uikRandom, $uikSquared, dll. berdasarkan hasil iterasi sebelumnya
            if ($x == 2) {
                $uikRandom[$x] = $uikBaru; // Untuk iterasi kedua, gunakan $uikBaru dari hasil iterasi pertama
            } else {
                $uikRandom[$x] = $uikBaru[$x - 1]; // Ambil $uikBaru dari iterasi sebelumnya
            }

            // // Menghitung UIK^w untuk iterasi ke-$x
            // $uikSquared[$x] = [];
            // $columnTotals[$x] = array_fill(0, count($data[0][0]) - 1, 0); // Inisialisasi array untuk menyimpan total per kolom
            // foreach ($uikRandom[$x] as $row) {
            //     $squaredValues = [];
            //     foreach ($row as $index => $value) {
            //         $squaredValue = pow($value, $pembobot);
            //         $squaredValues[] = $squaredValue;
            //         $columnTotals[$x][$index] += $squaredValue; // Menambahkan nilai ke total kolom
            //     }
            //     $uikSquared[$x][] = $squaredValues;
            // }

            // Menghitung UIK^w untuk iterasi ke-$x
            $uikSquared[$x] = [];
            $columnTotals[$x] = array_fill(0, $jumlahCluster, 0); // Inisialisasi array untuk menyimpan total per kolom
            foreach ($uikRandom[$x] as $row) {
                $squaredValues = [];
                foreach ($row as $index => $value) {
                    if (isset($columnTotals[$x][$index])) { // Pastikan indeks ada dalam $columnTotals[$x]
                        $squaredValue = pow($value, $pembobot);
                        $squaredValues[] = $squaredValue;
                        $columnTotals[$x][$index] += $squaredValue; // Menambahkan nilai ke total kolom
                    }
                }
                $uikSquared[$x][] = $squaredValues;
            }

            // // Menghitung UIK Cluster untuk iterasi ke-$x
            // $uikClusters[$x] = [];
            // $columnTotalsClusters[$x] = [];
            // for ($i = 0; $i < $jumlahCluster; $i++) {
            //     $clusterData = [];
            //     $columnTotals[$x] = array_fill(0, count($data[0][0]) - 1, 0); // Inisialisasi array untuk menyimpan total per kolom
            //     foreach ($data[0] as $rowIndex => $dataRow) {
            //         $clusterRow = [];
            //         foreach ($dataRow as $dataIndex => $value) {
            //             if ($dataIndex > 0) { // Mengabaikan kolom "No."
            //                 $scaledValue = $scales[$header[$dataIndex]][$value] ?? 0;
            //                 $clusterValue = $scaledValue * $uikSquared[$x][$rowIndex][$i];
            //                 $clusterRow[] = $clusterValue;
            //                 $columnTotals[$x][$dataIndex - 1] += $clusterValue; // Menghitung total per kolom
            //             }
            //         }
            //         $clusterData[] = $clusterRow;
            //     }
            //     $uikClusters[$x][] = $clusterData;
            //     $columnTotalsClusters[$x][] = $columnTotals[$x];
            // }

            // Menghitung UIK Cluster untuk iterasi ke-$x
            $uikClusters[$x] = [];
            $columnTotalsClusters[$x] = [];
            for ($i = 0; $i < $jumlahCluster; $i++) {
                $clusterData = [];
                $columnTotals[$x] = array_fill(0, count($data[0][0]) - 1, 0); // Inisialisasi array untuk menyimpan total per kolom
                foreach ($data[0] as $rowIndex => $dataRow) {
                    $clusterRow = [];
                    foreach ($dataRow as $dataIndex => $value) {
                        if ($dataIndex > 0) { // Mengabaikan kolom "No."
                            $scaledValue = $scales[$header[$dataIndex]][$value] ?? 0;
                            $clusterValue = $scaledValue * $uikSquared[$x][$rowIndex][$i];
                            $clusterRow[] = $clusterValue;
                            $columnTotals[$x][$dataIndex - 1] += $clusterValue; // Menghitung total per kolom
                        }
                    }
                    $clusterData[] = $clusterRow;
                }
                $uikClusters[$x][] = $clusterData;
                $columnTotalsClusters[$x][] = $columnTotals[$x];
            }

            $columnTotalsSquared[$x] = array_fill(0, $jumlahCluster, 0);
            foreach ($uikSquared[$x] as $row) {
                foreach ($row as $index => $value) {
                    $columnTotalsSquared[$x][$index] += $value;
                }
            }
            
            $uikBaru[$x] = []; // Inisialisasi array untuk menyimpan hasil perhitungan
            foreach ($data[0] as $rowIndex => $row) {
                $totalUikBaru = 0;
                $uikBaru[$x][$rowIndex] = [];
        
                foreach ($uikClusters[$x] as $clusterIndex => $clusterData) {
                    $totalObjective = 0;
                    foreach ($row as $dataIndex => $value) {
                        if ($dataIndex > 0) { // Ignore "No." column
                            $centerValue = $columnTotalsClusters[$x][$clusterIndex][$dataIndex - 1] / $columnTotalsSquared[$x][$clusterIndex];
                            $diffSquared = pow(($scales[$header[$dataIndex]][$value] ?? 0) - $centerValue, 2);
                            $totalObjective += $diffSquared;
                        }
                    }
                    $uikBaru[$x][$rowIndex][$clusterIndex] = $totalObjective;
                    $totalUikBaru += $totalObjective;
                }
        
                // Normalisasi nilai untuk setiap cluster pada baris ini
                foreach ($uikBaru[$x][$rowIndex] as $clusterIndex => $clusterTotal) {
                    $uikBaru[$x][$rowIndex][$clusterIndex] = $clusterTotal / $totalUikBaru;
                }
            }
    
            // Simpan hasil iterasi ke dalam array
            $allData[$x] = [
                'uikRandom' => $uikRandom[$x],
                'uikSquared' => $uikSquared[$x],
                'columnTotals' => $columnTotals[$x],
                'uikClusters' => $uikClusters[$x],
                'columnTotalsClusters' => $columnTotalsClusters[$x]
            ];
        }
        // dd($allData, $uikRandom1, $uikBaru);
        $finalIterationValue = session('finalIterationValue');

        $viewContent = view('clustering.results', compact('id_pengelompokan', 'allData', 'finalIterationValue', 'variabels', 'header', 'data', 'scales', 'uikRandom1', 'uikSquared1', 'columnTotals1', 'uikClusters1', 'columnTotalsClusters1', 'jumlahCluster', 'pembobot', 'nilaiError', 'maksimalIterasi', 'judul', 'periode', 'finalIterationValue'))->render();

        $log = new Log;
        $log->id_user = Auth::user()->id;
        $log->aktivitas = 'Memperbarui hasil clustering '.$judul;
        $log->save();

        $kelompok = Pengelompokan::find($id_pengelompokan);
        $kelompok->id_user = Auth::user()->id;
        $kelompok->judul = $judul;
        $kelompok->periode = $periode;
        $kelompok->jumlah_cluster = $jumlahCluster;
        $kelompok->pembobot = $pembobot;
        $kelompok->nilai_error = $nilaiError;
        $kelompok->maksimal_iterasi = $maksimalIterasi;
        $kelompok->conditions = json_encode($conditions);
        $kelompok->html_konten = $viewContent;
        $kelompok->save();

        return view('clustering.results', compact('id_pengelompokan', 'allData', 'finalIterationValue', 'variabels', 'header', 'data', 'scales', 'uikRandom1', 'uikSquared1', 'columnTotals1', 'uikClusters1', 'columnTotalsClusters1', 'jumlahCluster', 'pembobot', 'nilaiError', 'maksimalIterasi', 'judul', 'periode', 'finalIterationValue'));
    }

    private function applyConditionsToScales($scales, $conditions)
    {
        $parsedConditions = $this->parseConditions($conditions);

        foreach ($scales as $key => &$values) {
            if (strpos($key, 'Nilai') === 0) { // Check if the column name starts with 'Nilai'
                foreach ($values as $valueKey => &$value) {
                    foreach ($parsedConditions as $condition) {
                        if ($this->valueMatchesCondition($valueKey, $condition['range'])) {
                            $value = $condition['result'];
                            break; // Stop checking once the first matching condition is applied
                        }
                    }
                }
            }
        }

        return $scales;
    }

    private function parseConditions($conditions)
    {
        $parsed = [];
        foreach ($conditions as $condition) {
            if (preg_match('/([<>]?=?)(\d+)-?(\d+)?=([\d\.]+)/', $condition, $matches)) {
                $parsed[] = [
                    'range' => ['operator' => $matches[1], 'start' => $matches[2], 'end' => $matches[3] ?? null],
                    'result' => floatval($matches[4])
                ];
            }
        }
        return $parsed;
    }

    // private function valueMatchesCondition($value, $range)
    // {
    //     $value = floatval($value);
    //     switch ($range['operator']) {
    //         case '>':
    //             return $value > $range['start'];
    //         case '<':
    //             return $value < $range['start'];
    //         case '>=':
    //             return $value >= $range['start'];
    //         case '<=':
    //             return $value <= $range['start'];
    //         case '':
    //             return $value >= $range['start'] && $value <= $range['end'];
    //         default:
    //             return false;
    //     }
    // }

    private function valueMatchesCondition($value, $operator, $start, $end = null)
    {
        $value = floatval($value);
        switch ($operator) {
            case '>':
                return $value > $start;
            case '<':
                return $value < $start;
            case '>=':
                return $value >= $start;
            case '<=':
                return $value <= $start;
            case '':
                return $value >= $start && $value <= $end;
            default:
                return false;
        }
    }

    public function store(Request $request)
    {
        $value = $request->input('value');

        // Simpan nilai ke dalam session atau database
        session(['finalIterationValue' => $value]);

        return response()->json(['success' => true, 'value' => $value]);
    }

    public function saveProcessedResults(Request $request)
    {
        $htmlContent = $request->input('htmlContent');
        $idPengelompokan = $request->input('id_pengelompokan', null);

        // Determine if this is a new entry or an update
        if (is_null($idPengelompokan)) {
            // New entry, create a new unique ID
            $idPengelompokan = DB::table('results_cache')->max('id_pengelompokan') + 1;
        }

        // Simpan HTML ke dalam database
        DB::table('results_cache')->insert([
            'view_name' => 'clustering_processed_results',
            'id_pengelompokan' => $idPengelompokan,
            'html_content' => $htmlContent,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        return response()->json(['message' => 'Hasil berhasil disimpan', 'id_pengelompokan' => $idPengelompokan]);
    }

    public function loadPreviousResults($idPengelompokan)
    {
        $htmlContent = DB::table('results_cache')
                        ->where('id_pengelompokan', $idPengelompokan)
                        ->value('html_content');

        if ($htmlContent) {
            return response()->json(['html_content' => $htmlContent]);
        } else {
            return response()->json(['message' => 'Tidak ada hasil yang tersimpan.'], 404);
        }
    }

    public function hasilProses($id)
    {
        $data = Pengelompokan::find(decrypt($id));
        // dd($data);
        return view('clustering.hasilProses', compact('data'));
    }

    public function hapus($id)
    {
        if (Auth::user()->id_priv == 1) {
            $cluster = Pengelompokan::where('id_pengelompokan', decrypt($id))->first();

            $log = new Log;
            $log->id_user = Auth::user()->id;
            $log->aktivitas = 'Menghapus pengelompokan '.$cluster->judul;
            $log->save();
            
            $cluster->delete();

            return redirect()->back()->with('success', 'Clustering berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Maaf, anda tidak memiliki akses.');
        }
    }

    public function cetakPDF($id)
    {
        $data = Pengelompokan::findOrFail(decrypt($id));
        $allData = json_decode($data->html_konten, true);
        
        $pdf = PDF::loadView('clustering.pdf', compact('data', 'allData'));
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream($data->judul . '.pdf');
    }
}