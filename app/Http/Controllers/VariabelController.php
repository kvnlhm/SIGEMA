<?php

namespace App\Http\Controllers;

use App\Models\Log;
use App\Models\Variabel;
use App\Models\IsiVariabel;
use Illuminate\Http\Request;
use \Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Response;

class VariabelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        if (Auth::user()->id_priv == 1) {
            $data = Variabel::with('isiVariabel')->get();
            
            $log = new Log;
            $log->id_user = Auth::user()->id;
            $log->aktivitas = 'Mengakses halaman Variabel';
            $log->save();

            return view('variabel.index', compact('data'));
        } else {
            return redirect()->back()->with('error', 'Maaf, anda tidak memiliki akses.');
        }
    }

    public function tambah(Request $request)
    {
        if (Auth::user()->id_priv == 1) {

            $variabel = new Variabel;
            $variabel->nama = $request->nama;
            $variabel->deskripsi = $request->deskripsi;
            $variabel->save();

            foreach ($request->values as $index => $value) {
                $isiVariabel = new IsiVariabel;
                $isiVariabel->id_variabel = $variabel->id_variabel;
                $isiVariabel->keterangan = $request->value_names[$index];
                $isiVariabel->inisial = $value;
                $isiVariabel->save();
            }

            $log = new Log;
            $log->id_user = Auth::user()->id;
            $log->aktivitas = 'Menambahkan variabel';
            $log->save();

            return redirect()->back()->with('success', 'Variabel berhasil ditambahkan.');
        } else {
            return redirect()->back()->with('error', 'Maaf, anda tidak memiliki akses.');
        }
    }

    public function update(Request $request)
    {
        if (Auth::user()->id_priv == 1) {

            $variabel = Variabel::find($request->id_variabel);
            $variabel->nama = $request->nama;
            $variabel->deskripsi = $request->deskripsi;
            $variabel->save();

            // Update or add new values
            IsiVariabel::where('id_variabel', $variabel->id_variabel)->delete();
            foreach ($request->values as $index => $value) {
                $isiVariabel = new IsiVariabel;
                $isiVariabel->id_variabel = $variabel->id_variabel;
                $isiVariabel->keterangan = $request->value_names[$index];
                $isiVariabel->inisial = $value;
                $isiVariabel->save();
            }

            $log = new Log;
            $log->id_user = Auth::user()->id;
            $log->aktivitas = 'Memperbarui variabel '.$request->nama;
            $log->save();

            return redirect()->back()->with('success', 'Variabel berhasil diperbarui.');
        } else {
            return redirect()->back()->with('error', 'Maaf, anda tidak memiliki akses.');
        }
    }

    public function hapus($id)
    {
        if (Auth::user()->id_priv == 1) {
            $variabel = Variabel::where('id_variabel', $id)->first();

            $log = new Log;
            $log->id_user = Auth::user()->id;
            $log->aktivitas = 'Menghapus variabel '.$variabel->nama;
            $log->save();
            
            IsiVariabel::where('id_variabel', $variabel->id_variabel)->delete();
            $variabel->delete();

            return redirect()->back()->with('success', 'Variabel berhasil dihapus.');
        } else {
            return redirect()->back()->with('error', 'Maaf, anda tidak memiliki akses.');
        }
    }
}
