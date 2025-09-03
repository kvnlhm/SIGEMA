@extends('master')
@section('judul', 'Panduan')
@section('breadcrumb')
    <div class="page-title d-flex flex-column me-5 py-2">
        <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Halaman Panduan</h1>
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{ url('dashboard') }}" class="text-muted text-hover-primary"><i class="ki-duotone ki-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-200 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-dark">Panduan</li>
        </ul>
    </div>
@endsection

@section('konten')
@if (Auth::user()->id_priv == 1)
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Tabel</span>
                <span class="text-muted mt-1 fw-semibold fs-7">Daftar Panduan</span>
            </h3>
            <div class="card-toolbar">
                <a href="#" data-bs-toggle="modal" data-bs-target="#modal_form_tambah"
                    class="btn btn-sm btn-light-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Panduan</a>
            </div>
        </div>
        <div class="card-body py-3">
            <div class="table-responsive">
                <table id="kt_datatable_dom_positioning"
                    class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-40px rounded-start">No.</th>
                            <th class="min-w-100px">Tipe</th>
                            <th class="min-w-100px">Pertanyaan</th>
                            <th class="min-w-100px">Jawaban</th>
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
                                    {{ $dt->tipe }}
                                </td>
                                <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                    {{ $dt->pertanyaan }}
                                </td>
                                <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                    {{ $dt->jawaban }}
                                </td>
                                <td class="text-center">
                                    <button
                                        onclick="edit({{ $dt->id_panduan }},'{{ $dt->pertanyaan }}','{{ $dt->jawaban }}','{{ $dt->tipe }}')"
                                        title="Edit Panduan"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="ki-duotone ki-pencil fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                    <button onclick="hapus({{ $dt->id_panduan }},'{{ $dt->pertanyaan }}')" title="Hapus Panduan"
                                        class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
                                        <i class="ki-duotone ki-trash fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                        </i>
                                    </button>
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
@endif

<div class="card card-flush">
    <div class="card-body">
        <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-15">
            <li class="nav-item">
                <a class="nav-link text-active-primary d-flex align-items-center pb-5 active" data-bs-toggle="tab" href="#tab_variabel">
                <i class="ki-duotone ki-element-8 fs-2 me-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                    <span class="path6"></span>
                </i>Variabel</a>
            </li>
            <li class="nav-item">
                <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab" href="#tab_clustering">
                <i class="ki-duotone ki-graph fs-2 me-2">
                    <span class="path1"></span>
                    <span class="path2"></span>
                    <span class="path3"></span>
                    <span class="path4"></span>
                    <span class="path5"></span>
                    <span class="path6"></span>
                </i>Clustering</a>
            </li>
        </ul>
        <div class="tab-content" id="myTabContent">
            <div class="tab-pane fade show active" id="tab_variabel" role="tabpanel">
                <div class="mb-13">
                    <div class="mb-15">
                        <h4 class="fs-2x text-gray-800 w-bolder mb-6">Variabel</h4>
                        <p class="fw-semibold fs-4 text-gray-600 mb-2">Panduan cara penggunaan Variabel.</p>
                    </div>
                    <div class="row mb-12">
                        <div class="col-md-12 pe-md-10 mb-10 mb-md-0">
                            <h2 class="text-gray-800 fw-bold mb-4">Pertanyaan:</h2>
                            @foreach ($data as $i => $dt)
                                @if ( $dt->tipe == 'variabel')
                                    <div class="m-0">
                                        <div class="d-flex align-items-center collapsible py-3 toggle mb-0 {{ $i != 0 ? 'collapsed' : '' }}" data-bs-toggle="collapse" data-bs-target="#pertanyaanVariabel{{ $i }}">
                                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <i class="ki-duotone ki-plus-square toggle-off fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </div>
                                            <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">{!! $dt->pertanyaan !!}</h4>
                                        </div>
                                        <div id="pertanyaanVariabel{{ $i }}" class="collapse {{ $i == 0 ? 'show' : '' }} fs-6 ms-1">
                                            <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">{!! $dt->jawaban !!}</div>
                                        </div>
                                        <div class="separator separator-dashed"></div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="tab-pane fade" id="tab_clustering" role="tabpanel">
                <div class="mb-13">
                    <div class="mb-15">
                        <h4 class="fs-2x text-gray-800 w-bolder mb-6">Clustering</h4>
                        <p class="fw-semibold fs-4 text-gray-600 mb-2">Panduan cara penggunaan Clustering.</p>
                    </div>
                    <div class="row mb-12">
                        <div class="col-md-12 pe-md-10 mb-10 mb-md-0">
                            <h2 class="text-gray-800 fw-bold mb-4">Pertanyaan:</h2>
                            @foreach ($data as $i => $dt)
                                @if ( $dt->tipe == 'clustering')
                                    <div class="m-0">
                                        <div class="d-flex align-items-center collapsible py-3 toggle mb-0 {{ $i != 0 ? 'collapsed' : '' }}" data-bs-toggle="collapse" data-bs-target="#pertanyaanClustering{{ $i }}">
                                            <div class="btn btn-sm btn-icon mw-20px btn-active-color-primary me-5">
                                                <i class="ki-duotone ki-minus-square toggle-on text-primary fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                                <i class="ki-duotone ki-plus-square toggle-off fs-1">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                </i>
                                            </div>
                                            <h4 class="text-gray-700 fw-bold cursor-pointer mb-0">{!! $dt->pertanyaan !!}</h4>
                                        </div>
                                        <div id="pertanyaanClustering{{ $i }}" class="collapse {{ $i == 0 ? 'show' : '' }} fs-6 ms-1">
                                            <div class="mb-4 text-gray-600 fw-semibold fs-6 ps-10">{!! $dt->jawaban !!}</div>
                                        </div>
                                        <div class="separator separator-dashed"></div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('modal')
    <div class="modal fade" id="modal_form_tambah" tabindex="-1" aria-hidden="true">
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
                    <form action="{{ url('panduan') }}" method="POST" class="form" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Form Tambah Panduan</h1>
                            <div class="text-muted fw-semibold fs-5">Silahkan isikan data dengan sesuai.</div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row" id="pilih_tipe">
                                <label class="required fs-6 fw-semibold mb-2">Tipe</label>
                                <select id="tipe" name="tipe" data-control="select2"
                                    data-dropdown-parent="#pilih_tipe" data-placeholder="Pilih Tipe"
                                    class="form-select form-select-solid" required>
                                    <option></option>
                                    <option value="variabel">Variabel</option>
                                    <option value="clustering">Clustering</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row">
                                <label for="pertanyaan" class="required fs-6 fw-semibold mb-2">Pertanyaan</label>
                                <input type="text" id="pertanyaan" name="pertanyaan" class="form-control form-control-solid"
                                    placeholder="Pertanyaan" required />
                            </div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row">
                                <label for="jawaban" class="required fs-6 fw-semibold mb-2">Jawaban</label>
                                <input type="text" id="jawaban" name="jawaban" class="form-control form-control-solid"
                                    placeholder="Jawaban" required />
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="reset" class="btn btn-light me-3">Reset</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Simpan</span>
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

    <div class="modal fade" id="modal_form_update" tabindex="-1" aria-hidden="true">
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
                    <form id="updateform" method="POST" action="{{ url('panduan/update') }}" class="form"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id_panduan" name="id_panduan">
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Form Update Panduan</h1>
                            <div class="text-muted fw-semibold fs-5">Silahkan isikan data dengan sesuai.</div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row" id="pilih_tipe_ubah">
                                <label class="required fs-6 fw-semibold mb-2">Tipe</label>
                                <select id="tipe_ubah" name="tipe" data-control="select2"
                                    data-dropdown-parent="#pilih_tipe_ubah" data-placeholder="Pilih Tipe"
                                    class="form-select form-select-solid" required>
                                    <option></option>
                                    <option value="variabel">Variabel</option>
                                    <option value="clustering">Clustering</option>
                                </select>
                            </div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row">
                                <label for="pertanyaan_ubah" class="required fs-6 fw-semibold mb-2">Pertanyaan</label>
                                <input type="text" id="pertanyaan_ubah" name="pertanyaan"
                                    class="form-control form-control-solid" placeholder="Pertanyaan" required />
                            </div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row">
                                <label for="jawaban_ubah" class="required fs-6 fw-semibold mb-2">Jawaban</label>
                                <input type="text" id="jawaban_ubah" name="jawaban"
                                    class="form-control form-control-solid" placeholder="Jawaban" required />
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="reset" class="btn btn-light me-3">Reset</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Simpan</span>
                                <span class="indicator-progress">Mohon menunggu...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

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
                            <h1 class="mb-3">Hapus Panduan</h1>
                            <div class="text-muted fw-semibold fs-5">
                                Apakah anda yakin untuk menghapus Panduan <strong><span id="namadelete"></strong></span>?
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

@section('css')
@endsection

@section('script')
    <script>
        function edit(id_panduan, pertanyaan, jawaban, tipe) {
            $('#id_panduan').val(id_panduan);
            $('#pertanyaan_ubah').val(pertanyaan);
            $('#jawaban_ubah').val(jawaban);
            $('#tipe_ubah').val(tipe).change();
            $('#modal_form_update').modal('show');
        }

        function hapus(id_panduan, pertanyaan) {
            $('#form_hapus').attr('action', {!! json_encode(url('panduan/hapus/')) !!} + '/' + id_panduan);
            $('#namadelete').text(pertanyaan);
            $('#modal_form_hapus').modal('show');
        }
    </script>

    @include('my_components.toastr')
    @include('my_components.datatables')
@endsection
