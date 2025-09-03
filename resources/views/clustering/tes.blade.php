@extends('master')
@section('judul', 'Hasil Pengelompokan dan Skala')

@section('breadcrumb')
<div class="page-title d-flex flex-column me-5 py-2">
    <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Halaman Hasil Clustering</h1>
    <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('dashboard') }}" class="text-muted text-hover-primary"><i class="ki-duotone ki-home"></i></a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-muted">
            <a href="{{ url('clustering') }}" class="text-muted text-hover-primary">Clustering</a>
        </li>
        <li class="breadcrumb-item">
            <span class="bullet bg-gray-200 w-5px h-2px"></span>
        </li>
        <li class="breadcrumb-item text-dark">Hasil Clustering</li>
    </ul>
</div>
@endsection

@section('konten')
<div class="card card-flush">
    <div class="card-body">
        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-15">
            @for ($i = 1; $i <= $maksimalIterasi; $i++)
            <li class="nav-item">
                <a class="nav-link text-active-primary d-flex align-items-center pb-5 {{ $i == 1 ? 'active' : '' }}" data-bs-toggle="tab"
                    href="#iterasi{{ $i }}">
                    Iterasi {{ $i }}</a>
            </li>
            @endfor
        </ul>
        <div class="tab-content" id="myTabContent">
            @foreach ($iterasiResults as $iterasi => $result)
            <div class="tab-pane fade {{ $iterasi == 1 ? 'show active' : '' }}" id="iterasi{{ $iterasi }}" role="tabpanel">
                <div class="card mb-5 mb-xl-8">
                    <div class="card-header border-0 pt-5">
                        <h1 class="card-title align-items-start flex-column">
                            <span class="card-label fw-bold fs-3 mb-1">{{ $judul }}</span>
                            <span class="text-muted mt-1 fw-semibold fs-7">Periode: {{ $periode }}</span>
                        </h1>
                    </div>
                    <div class="card-body py-3">
                        <div class="table-responsive">
                            <h3 style="text-align: center;">Tabel Dataset</h3>
                            <table class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        @foreach ($header as $column)
                                        <th class="ps-4 min-w-40px rounded-start align-middle">{{ $column }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data[0] as $row)
                                    <tr>
                                        @foreach ($row as $value)
                                        <td class="ps-4 text-dark text-hover-primary mb-1 fs-6">{{ $value }}</td>
                                        @endforeach
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                <div class="card mb-5 mb-xl-8">
                    <div class="card-body py-3">
                        <div class="row">
                            <div class="col-6">
                                <div class="table-responsive">
                                    <h3 style="text-align: center;">Tabel UIK Random</h3>
                                    <table class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                        <thead>
                                            <tr class="fw-bold text-muted bg-light">
                                                <th class="ps-4 min-w-40px rounded-start">Data Ke-</th>
                                                @for ($i = 1; $i <= $jumlahCluster; $i++)
                                                <th>C{{ $i }}</th>
                                                @endfor
                                                <th class="min-w-100px">Jumlah</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result['uikRandom'] as $index => $row)
                                            <tr>
                                                <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $index + 1 }}</td>
                                                @foreach ($row as $value)
                                                <td class="text-dark text-hover-primary mb-1 fs-6">{{ number_format($value, 4) }}</td>
                                                @endforeach
                                                <td class="text-dark text-hover-primary mb-1 fs-6">1</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="table-responsive">
                                    <h3 style="text-align: center;">Tabel UIK^{{ $pembobot }}</h3>
                                    <table class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                        <thead>
                                            <tr class="fw-bold text-muted bg-light">
                                                <th class="ps-4 min-w-40px rounded-start">Data Ke-</th>
                                                @for ($i = 1; $i <= $jumlahCluster; $i++)
                                                <th>C{{ $i }}^{{ $pembobot }}</th>
                                                @endfor
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($result['uikSquared'] as $index => $row)
                                            <tr>
                                                <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">{{ $index + 1 }}</td>
                                                @foreach ($row as $value)
                                                <td class="text-dark text-hover-primary mb-1 fs-6">{{ number_format($value, 4) }}</td>
                                                @endforeach
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @foreach ($result['uikClusters'] as $clusterIndex => $clusterData)
                <div class="card mb-5 mb-xl-8">
                    <div class="card-body py-3">
                        <div class="table-responsive">
                            <h3 style="text-align: center;">Tabel UIK Cluster {{ $clusterIndex + 1 }}</h3>
                            <table class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="ps-4 min-w-40px rounded-start">Data Ke-</th>
                                        @foreach (array_slice($header, 1) as $xIndex => $xName)
                                            <th>(u{{ $clusterIndex + 1 }}^{{ $pembobot }})X{{ $xIndex + 1 }}</th>
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($clusterData as $rowIndex => $row)
                                        <tr>
                                            <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                {{ $rowIndex + 1 }}
                                            </td>
                                            @if (is_array($row))
                                                @foreach ($row as $value)
                                                    <td class="text-dark text-hover-primary mb-1 fs-6">
                                                        {{ number_format($value, 4) }}
                                                    </td>
                                                @endforeach
                                            @endif
                                        </tr>
                                    @endforeach
                                    <tr>
                                        <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                            <strong>Total</strong>
                                        </td>
                                        @foreach ($columnTotalsClusters[$clusterIndex] as $total)
                                            <td><strong>{{ number_format($total, 4) }}</strong></td>
                                        @endforeach
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
                @endforeach

                <div class="card mb-5 mb-xl-8">
                    <div class="card-body py-3">
                        <div class="table-responsive">
                            <h3 style="text-align: center;">Tabel Pusat Cluster Baru</h3>
                            <table class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="ps-4 min-w-40px rounded-start">Cluster Ke-</th>
                                        @foreach ($header as $i => $column)
                                            @if ($i < count($header) - 1)
                                                <th class="min-w-100px">Vkj{{ $i + 1 }}</th>
                                            @endif
                                        @endforeach
                                    </tr>
                                </thead>
                                <tbody>
                                    @for ($i = 0; $i < $jumlahCluster; $i++)
                                        <tr>
                                            <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                {{ $i + 1 }}</td>
                                            @for ($j = 0; $j < count($header) - 1; $j++)
                                                <td>
                                                    @if ($i < count($columnTotalsClusters) && $i < count($columnTotalsSquared))
                                                        {{ number_format($columnTotalsClusters[$i][$j] / $columnTotalsSquared[$i], 4) }}
                                                    @endif
                                                </td>
                                            @endfor
                                        </tr>
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                @foreach ($uikClusters as $clusterIndex => $clusterData)
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-body py-3">
                            <div class="table-responsive">
                                <h3 style="text-align: center;">Tabel Fungsi Objektif Cluster {{ $clusterIndex + 1 }}</h3>
                                <table class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                    <thead>
                                        <tr class="fw-bold text-muted bg-light">
                                            <th class="ps-4 min-w-40px rounded-start">Data Ke-</th>
                                            @for ($i = 1; $i <= count($header) - 1; $i++)
                                                <th class="min-w-100px">
                                                    (X{{ $i }}-Vkj{{ $i }})^2</th>
                                            @endfor
                                            <th class="min-w-100px"><strong>Total</strong></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data[0] as $rowIndex => $row)
                                            <tr>
                                                <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                    {{ $rowIndex + 1 }}
                                                </td>
                                                @php $rowTotal = 0; @endphp
                                                @foreach ($row as $dataIndex => $value)
                                                    @if ($dataIndex > 0)
                                                        {{-- Mengabaikan kolom "No." --}}
                                                        @php
                                                            $centerValue = number_format(
                                                                $columnTotalsClusters[$clusterIndex][
                                                                    $dataIndex - 1
                                                                ] / $columnTotalsSquared[$clusterIndex],
                                                                4,
                                                            );
                                                            $diffSquared = pow(
                                                                ($scales[$header[$dataIndex]][$value] ?? 0) -
                                                                    $centerValue,
                                                                2,
                                                            );
                                                            $rowTotal += $diffSquared;
                                                        @endphp
                                                        <td class="text-dark text-hover-primary mb-1 fs-6">
                                                            {{ number_format($diffSquared, 4) }}</td>
                                                    @endif
                                                @endforeach
                                                <td class="text-dark text-hover-primary mb-1 fs-6">
                                                    <strong>{{ number_format($rowTotal, 4) }}</strong>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="card mb-5 mb-xl-8">
                    <div class="card-body py-3">
                        <div class="row">
                            @foreach ($uikClusters as $clusterIndex => $clusterData)
                                <div class="col-3">
                                    <div class="table-responsive">
                                        <h3 style="text-align: center;">Tabel Cluster {{ $clusterIndex + 1 }}</h3>
                                        <table class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                            <thead>
                                                <tr class="fw-bold text-muted bg-light">
                                                    <th class="ps-4 min-w-100px rounded-start">Total
                                                        C{{ $clusterIndex + 1 }}
                                                    </th>
                                                    <th class="min-w-100px">
                                                        C{{ $clusterIndex + 1 }}^{{ $pembobot }}</th>
                                                    <th class="min-w-100px">P0</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data[0] as $rowIndex => $row)
                                                    <tr>
                                                        @php
                                                            $totalObjective = 0; // Initialize total objective function value
                                                            $uikW = $uikSquared[$rowIndex][$clusterIndex]; // Get Uik^w from uikSquared
                                                            // Calculate total objective function value for this cluster
                                                            foreach ($row as $dataIndex => $value) {
                                                                if ($dataIndex > 0) {
                                                                    // Ignore "No." column
                                                                    $centerValue = number_format(
                                                                        $columnTotalsClusters[$clusterIndex][
                                                                            $dataIndex - 1
                                                                        ] / $columnTotalsSquared[$clusterIndex],
                                                                        2,
                                                                    );
                                                                    $diffSquared = pow(
                                                                        ($scales[$header[$dataIndex]][$value] ??
                                                                            0) -
                                                                            $centerValue,
                                                                        2,
                                                                    );
                                                                    $totalObjective += $diffSquared;
                                                                }
                                                            }
                                                            $p0 = $totalObjective * $uikW;
                                                            $p0Totals[$rowIndex] =
                                                                ($p0Totals[$rowIndex] ?? 0) + $p0;
                                                        @endphp
                                                        <td class="ps-4 text-dark text-hover-primary mb-1 fs-6">
                                                            {{ number_format($totalObjective, 4) }}</td>
                                                        <td class="text-dark text-hover-primary mb-1 fs-6">
                                                            {{ number_format($uikW, 4) }}</td>
                                                        <td class="text-dark text-hover-primary mb-1 fs-6">
                                                            <strong>{{ number_format($p0, 4) }}</strong>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endforeach
                            <div class="col-3">
                                <div class="table-responsive">
                                    <h3 style="text-align: center;">Total P0</h3>
                                    <table class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                        <thead>
                                            <tr class="fw-bold text-muted bg-light text-center">
                                                <th class="min-w-100px rounded-start">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($p0Totals as $total)
                                                <tr>
                                                    <td class="text-dark text-hover-primary mb-1 fs-6 text-center">
                                                        {{ number_format($total, 4) }}</td>
                                                </tr>
                                            @endforeach
                                            <tr>
                                                <td class="text-dark text-hover-primary mb-1 fs-6 text-center">
                                                    <strong>{{ number_format(array_sum($p0Totals), 4) }}</strong>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card mb-5 mb-xl-8">
                    <div class="card-body py-3">
                        <div class="table-responsive">
                            <h3 style="text-align: center;">Tabel Nilai Uik Baru</h3>
                            <table class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                <thead>
                                    <tr class="fw-bold text-muted bg-light">
                                        <th class="ps-4 min-w-40px rounded-start">Data Ke-</th>
                                        <th class="min-w-100px">Jumlah Uik Baru</th>
                                        @for ($i = 1; $i <= $jumlahCluster; $i++)
                                            <th class="min-w-100px">C{{ $i }}</th>
                                        @endfor
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data[0] as $rowIndex => $row)
                                        @php
                                            $totalUikBaru = 0;
                                            $uikBaru = [];
                                        @endphp
                                        <tr>
                                            <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                {{ $rowIndex + 1 }}</td>
                                            @foreach ($uikClusters as $clusterIndex => $clusterData)
                                                @php
                                                    $totalObjective = 0;
                                                    foreach ($row as $dataIndex => $value) {
                                                        if ($dataIndex > 0) {
                                                            // Ignore "No." column
                                                            $centerValue = number_format(
                                                                $columnTotalsClusters[$clusterIndex][
                                                                    $dataIndex - 1
                                                                ] / $columnTotalsSquared[$clusterIndex],
                                                                2,
                                                            );
                                                            $diffSquared = pow(
                                                                ($scales[$header[$dataIndex]][$value] ?? 0) -
                                                                    $centerValue,
                                                                2,
                                                            );
                                                            $totalObjective += $diffSquared;
                                                        }
                                                    }
                                                    $uikBaru[$clusterIndex] = $totalObjective;
                                                    $totalUikBaru += $totalObjective;
                                                @endphp
                                            @endforeach
                                            <td class="text-dark text-hover-primary mb-1 fs-6">
                                                {{ number_format($totalUikBaru, 4) }}</td>
                                            @foreach ($uikBaru as $clusterTotal)
                                                <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                    <strong>{{ number_format($clusterTotal / $totalUikBaru, 4) }}</strong>
                                                </td>
                                            @endforeach
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</div>
@endsection

@section('script')
    @include('my_components.toastr')
    @include('my_components.datatables')
@endsection

<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Variabel;
use App\Models\Clustering;
use Illuminate\Http\Request;
use App\Imports\ClusteringImport;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;
use Maatwebsite\Excel\Excel as ExcelType;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\Importable;

class ClusteringController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $log = new Log;
        $log->id_user = Auth::user()->id;
        $log->aktivitas = 'Mengakses halaman Clustering';
        $log->save();

        return view('clustering.index');
    }

    public function index2()
    {
        return view('clustering.index2');
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
        $file = $request->file('file');
        $jumlahCluster = $request->input('jumlah_cluster');
        $pembobot = $request->input('pembobot');
        $nilaiError = $request->input('nilai_error');
        $maksimalIterasi = $request->input('maksimal_iterasi');
        $judul = $request->input('judul');
        $periode = $request->input('periode');

        $data = Excel::toArray(new class implements ToModel {
            use Importable;
            public function model(array $row)
            {
                return $row; // Mengembalikan baris sebagai array
            }
        }, $file);

        $header = array_shift($data[0]); // Menghapus header

        $iterasiResults = [];
        $uikRandom = $this->initializeUIKRandom($data[0], $jumlahCluster);

        for ($iterasi = 1; $iterasi <= $maksimalIterasi; $iterasi++) {
            $uikSquared = $this->calculateUIKSquared($uikRandom, $pembobot);
            $uikClusters = $this->calculateUIKClusters($data[0], $uikSquared, $header);

            $iterasiResults[$iterasi] = [
                'uikRandom' => $uikRandom,
                'uikSquared' => $uikSquared,
                'uikClusters' => $uikClusters
            ];

            if ($iterasi < $maksimalIterasi) {
                $uikRandom = $this->updateUIKRandomForNextIteration($uikClusters);
            }
        }

        return view('clustering.results', compact('header', 'data', 'iterasiResults', 'jumlahCluster', 'pembobot', 'nilaiError', 'maksimalIterasi', 'judul', 'periode'));
    }

    private function initializeUIKRandom($dataRows, $jumlahCluster)
    {
        $uikRandom = [];
        foreach ($dataRows as $row) {
            $randomValues = [];
            $sum = 0;
            for ($i = 0; $i < $jumlahCluster; $i++) {
                $randomValue = rand(1, 100);
                $randomValues[] = $randomValue;
                $sum += $randomValue;
            }
            foreach ($randomValues as &$value) {
                $value /= $sum;
            }
            $uikRandom[] = $randomValues;
        }
        return $uikRandom;
    }

    private function calculateUIKSquared($uikRandom, $pembobot)
    {
        $uikSquared = [];
        foreach ($uikRandom as $row) {
            $squaredValues = [];
            foreach ($row as $value) {
                $squaredValues[] = pow($value, $pembobot);
            }
            $uikSquared[] = $squaredValues;
        }
        return $uikSquared;
    }

    private function calculateUIKClusters($dataRows, $uikSquared, $header)
    {
        $uikClusters = [];
        foreach ($dataRows as $rowIndex => $dataRow) {
            $clusterRow = [];
            foreach ($dataRow as $dataIndex => $value) {
                if ($dataIndex > 0) { // Mengabaikan kolom "No."
                    // Pastikan $value adalah float
                    $numericValue = floatval($value);
                    // Cek apakah indeks ada dalam array $uikSquared
                    if (isset($uikSquared[$rowIndex]) && isset($uikSquared[$rowIndex][$dataIndex - 1])) {
                        $uikValue = floatval($uikSquared[$rowIndex][$dataIndex - 1]);
                        $clusterValue = $numericValue * $uikValue;
                        $clusterRow[] = $clusterValue;
                    } else {
                        // Jika indeks tidak ada, gunakan nilai default atau handle error
                        $clusterRow[] = 0; // Misalnya, gunakan 0 sebagai nilai default
                    }
                }
            }
            $uikClusters[] = $clusterRow;
        }
        return $uikClusters;
    }

    private function updateUIKRandomForNextIteration($uikClusters)
    {
        $newUIKRandom = [];
        foreach ($uikClusters as $cluster) {
            $sum = array_sum($cluster);
            $newRandomValues = [];
            foreach ($cluster as $value) {
                $newRandomValues[] = $value / $sum;
            }
            $newUIKRandom[] = $newRandomValues;
        }
        return $newUIKRandom;
    }
}