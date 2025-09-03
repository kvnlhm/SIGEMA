@extends('master')
@section('judul', 'Clustering')
@section('breadcrumb')
    <div class="page-title d-flex flex-column me-5 py-2">
        <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Halaman Clustering</h1>
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{ url('dashboard') }}" class="text-muted text-hover-primary"><i class="ki-duotone ki-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-200 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-dark">Clustering</li>
        </ul>
    </div>
@endsection

@section('konten')
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Tabel</span>
                <span class="text-muted mt-1 fw-semibold fs-7">Daftar Clustering</span>
            </h3>
            @if (Auth::user()->id_priv == 1)
                <div class="card-toolbar">
                    <a href="{{ url('clustering2')}}" class="btn btn-sm btn-light-primary">
                        <i class="ki-duotone ki-plus fs-2"></i>Tambah Clustering</a>
                </div>
            @endif
        </div>
        <div class="card-body py-3">
            <div class="table-responsive">
                <table id="kt_datatable_dom_positioning"
                    class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-40px rounded-start">No.</th>
                            <th class="min-w-100px">Judul</th>
                            {{-- <th class="min-w-100px">Periode</th> --}}
                            <th class="min-w-100px">Jumlah Cluster</th>
                            <th class="min-w-100px">Pembobot</th>
                            <th class="min-w-100px">Nilai Error</th>
                            <th class="min-w-100px">Maksimal Iterasi</th>
                            {{-- <th class="min-w-100px">Kondisi</th> --}}
                            <th class="min-w-100px">Tanggal Proses</th>
                            <th class="min-w-100px text-center rounded-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                        @endphp
                        @foreach ($data as $dt)
                            <tr>
                                <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                    {{ $i }}
                                </td>
                                <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                    {{ $dt->judul }}
                                </td>
                                {{-- <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                    {{ $dt->periode }}
                                </td> --}}
                                <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                    {{ $dt->jumlah_cluster }}
                                </td>
                                <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                    {{ $dt->pembobot }}
                                </td>
                                <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                    {{ $dt->nilai_error }}
                                </td>
                                <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                    {{ $dt->maksimal_iterasi }}
                                </td>
                                {{-- <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                    @foreach(explode(',', str_replace(['[', ']', '"'], '', $dt->conditions)) as $k)
                                        <span>- {{ $k }}</span><br>
                                    @endforeach
                                </td> --}}
                                <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                    {{ $dt->created_at }}
                                </td>
                                <td class="text-center">
                                    <a
                                        href="{{ url('clustering/hasil-proses/'.encrypt($dt->id_pengelompokan)) }}"
                                        title="Hasil Clustering"
                                        class="btn btn-icon btn-bg-light btn-active-color-warning btn-sm me-1">
                                        <i class="ki-duotone ki-eye fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                        </i>
                                    </a>
                                    {{-- <a
                                        href="{{ url('clustering/cetak-pdf/'.encrypt($dt->id_pengelompokan)) }}"
                                        title="Cetak PDF"
                                        class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm me-1">
                                        <i class="ki-duotone ki-document fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </a> --}}
                                    @if (Auth::user()->id_priv == 1)
                                        <a
                                            href="{{ url('clustering/inisialisasi2/'.encrypt($dt->id_pengelompokan)) }}"
                                            title="Edit Clustering"
                                            class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                            <i class="ki-duotone ki-pencil fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </a>
                                    @endif
                                    @if (Auth::user()->id_priv == 1)
                                        <button
                                            onclick="hapus('{{ encrypt($dt->id_pengelompokan) }}','{{ $dt->judul }}')"
                                            title="Hapus Clustering"
                                            class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                            <i class="ki-duotone ki-trash fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                            </i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                            @php
                                $i++;
                            @endphp
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="modal_form_hapus" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered mw-650px">
            <div class="modal-content rounded">
                <div class="modal-header pb-0 border-0 justify-content-end">
                    <div class="btn btn-sm btn-icon btn-active-color-primary" data-bs-dismiss="modal">
                        <i class="ki-duotone ki-cross fs-1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                        </i>
                    </div>
                </div>
                <div class="modal-body scroll-y px-10 px-lg-15 pt-0 pb-15">
                    <form id="form_hapus" class="form" enctype="multipart/form-data">
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Hapus Clustering</h1>
                            <div class="text-muted fw-semibold fs-5">
                                Apakah anda yakin untuk menghapus Clustering <strong><span id="namadelete"></strong></span>?
                            </div>
                        </div>
                        <div class="text-center">
                            <div data-bs-dismiss="modal" class="btn btn-light me-3">Batal</div>
                            <button type="submit" class="btn btn-danger">
                                <span class="indicator-label">Ya, saya yakin</span>
                                <span class="indicator-progress">Mohon menunggu...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                </span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function hapus(id_pengelompokan, judul) {
            $('#form_hapus').attr('action', {!! json_encode(url('clustering/hapus/')) !!} + '/' + id_pengelompokan);
            $('#namadelete').text(judul);
            $('#modal_form_hapus').modal('show');
        }
    </script>
    
    @include('my_components.toastr')
    @include('my_components.datatables')
@endsection