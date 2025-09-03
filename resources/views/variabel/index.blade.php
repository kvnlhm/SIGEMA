@extends('master')
@section('judul', 'Variabel')
@section('breadcrumb')
    <div class="page-title d-flex flex-column me-5 py-2">
        <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Halaman Variabel</h1>
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{ url('dashboard') }}" class="text-muted text-hover-primary"><i class="ki-duotone ki-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-200 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-dark">Variabel</li>
        </ul>
    </div>
@endsection

@section('konten')
    <div class="card mb-5 mb-xl-8">
        <div class="card-header border-0 pt-5">
            <h3 class="card-title align-items-start flex-column">
                <span class="card-label fw-bold fs-3 mb-1">Tabel</span>
                <span class="text-muted mt-1 fw-semibold fs-7">Daftar Variabel</span>
            </h3>
            <div class="card-toolbar">
                <a href="#" data-bs-toggle="modal" data-bs-target="#modal_form_tambah"
                    class="btn btn-sm btn-light-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Variabel</a>
            </div>
        </div>
        <div class="card-body py-3">
            <div class="table-responsive">
                <table id="kt_datatable_dom_positioning"
                    class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bold text-muted bg-light">
                            <th class="ps-4 min-w-40px rounded-start">No.</th>
                            <th class="min-w-200px">Nama Variabel</th>
                            <th class="min-w-200px">Deskripsi</th>
                            <th class="min-w-200px">Daftar Keterangan (Inisial)</th>
                            <th class="min-w-200px text-center rounded-center">Aksi</th>
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
                                    {{ $dt->nama }}
                                </td>
                                <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                    {{ $dt->deskripsi }}
                                </td>
                                <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                    @forelse ($dt->isiVariabel as $isi)
                                        <div>- {{ $isi->keterangan }}= {{ $isi->inisial }}</div>
                                    @empty
                                        <div>Belum ditentukan</div>
                                    @endforelse
                                </td>
                                <td class="text-center">
                                    <button
                                        onclick="edit({{ $dt->id_variabel }},'{{ $dt->nama }}','{{ $dt->deskripsi }}', {{ json_encode($dt->isiVariabel) }})"
                                        title="Edit Variabel"
                                        class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm me-1">
                                        <i class="ki-duotone ki-pencil fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                    </button>
                                    <button onclick="hapus({{ $dt->id_variabel }},'{{ $dt->nama }}')"
                                        title="Hapus Variabel"
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
                    <form action="{{ url('variabel') }}" method="POST" class="form" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Form Tambah Variabel</h1>
                            <div class="text-muted fw-semibold fs-5">Silahkan isikan data dengan sesuai.</div>
                        </div>
                        <div class="d-flex flex-column mb-8">
                            <label for="nama" class="required fs-6 fw-semibold mb-2">Nama Variabel</label>
                            <input type="text" id="nama" name="nama" class="form-control form-control-solid"
                                placeholder="Nama Variabel" required />
                            <div class="text-muted fs-7">Tambahkan "Nilai" di bagian depan nama jika variabel yang ingin
                                diinputkan sebuah nilai.</div>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label for="deskripsi" class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Deskripsi</span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                </i>
                                </span>
                            </label>
                            <textarea class="form-control form-control-solid" name="deskripsi" id="deskripsi" cols="30" rows="5"></textarea>
                        </div>
                        <div id="variable-values">
                            <div class="d-flex flex-column mb-8">
                                <label for="value_name_1" class="required fs-6 fw-semibold mb-2">Nama Nilai Variabel
                                    1</label>
                                <input type="text" id="value_name_1" name="value_names[]"
                                    class="form-control form-control-solid" placeholder="Nama Nilai Variabel" required />
                                <label for="value_1" class="required fs-6 fw-semibold mb-2">Nilai Variabel 1</label>
                                <input type="number" step="any" id="value_1" name="values[]"
                                    class="form-control form-control-solid" placeholder="Nilai Variabel" required />
                            </div>
                        </div>
                        <button type="button" class="btn btn-sm btn-light-primary" onclick="addVariableValue()">Tambah
                            Nilai Variabel</button>
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
                    <form id="updateform" method="POST" action="{{ url('variabel/update') }}" class="form"
                        enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" id="id_variabel" name="id_variabel">
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Form Update Variabel</h1>
                            <div class="text-muted fw-semibold fs-5">Silahkan isikan data dengan sesuai.</div>
                        </div>
                        <div class="d-flex flex-column mb-8">
                            <label for="nama_ubah" class="required fs-6 fw-semibold mb-2">Nama Variabel</label>
                            <input type="text" id="nama_ubah" name="nama" class="form-control form-control-solid"
                                placeholder="Nama Variabel" required />
                            <div class="text-muted fs-7">Tambahkan "Nilai" di bagian depan nama jika variabel yang ingin
                                diinputkan sebuah nilai.</div>
                        </div>
                        <div class="d-flex flex-column mb-8 fv-row">
                            <label for="deskripsi_ubah" class="d-flex align-items-center fs-6 fw-semibold mb-2">
                                <span class="required">Deskripsi</span>
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                </i>
                                </span>
                            </label>
                            <textarea class="form-control form-control-solid" id="deskripsi_ubah" name="deskripsi" cols="30"
                                rows="5"></textarea>
                        </div>
                        <div id="variable-values-update">
                            <!-- Existing values will be populated here by JavaScript -->
                        </div>
                        <button type="button" class="btn btn-sm btn-light-primary"
                            onclick="addVariableValueUpdate()">Tambah Nilai Variabel</button>
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
                            <h1 class="mb-3">Hapus Variabel</h1>
                            <div class="text-muted fw-semibold fs-5">
                                Apakah anda yakin untuk menghapus Variabel <strong><span id="namadelete"></strong></span>?
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
        let valueCount = 1;

        function addVariableValue() {
            valueCount++;
            const newValueInput = `
                <div class="d-flex flex-column mb-8">
                    <label for="value_name_${valueCount}" class="required fs-6 fw-semibold mb-2">Nama Nilai Variabel ${valueCount}</label>
                    <input type="text" id="value_name_${valueCount}" name="value_names[]" class="form-control form-control-solid" placeholder="Nama Nilai Variabel" required />
                    <label for="value_${valueCount}" class="required fs-6 fw-semibold mb-2">Nilai Variabel ${valueCount}</label>
                    <input type="number" step="any" id="value_${valueCount}" name="values[]" class="form-control form-control-solid" placeholder="Nilai Variabel" required />
                </div>
            `;
            document.getElementById('variable-values').insertAdjacentHTML('beforeend', newValueInput);
        }

        let valueCountUpdate = 0;

        function addVariableValueUpdate() {
            valueCountUpdate++;
            const newValueInput = `
                <div class="d-flex flex-column mb-8">
                    <label for="value_name_update_${valueCountUpdate}" class="required fs-6 fw-semibold mb-2">Nama Nilai Variabel ${valueCountUpdate}</label>
                    <input type="text" id="value_name_update_${valueCountUpdate}" name="value_names[]" class="form-control form-control-solid" placeholder="Nama Nilai Variabel" required />
                    <label for="value_update_${valueCountUpdate}" class="required fs-6 fw-semibold mb-2">Nilai Variabel ${valueCountUpdate}</label>
                    <input type="number" step="any" id="value_update_${valueCountUpdate}" name="values[]" class="form-control form-control-solid" placeholder="Nilai Variabel" required />
                </div>
            `;
            document.getElementById('variable-values-update').insertAdjacentHTML('beforeend', newValueInput);
        }

        function edit(id_variabel, nama, deskripsi, values) {
            $('#id_variabel').val(id_variabel);
            $('#nama_ubah').val(nama);
            $('#deskripsi_ubah').val(deskripsi);
            $('#variable-values-update').empty();
            valueCountUpdate = 0;
            values.forEach(value => {
                valueCountUpdate++;
                const valueInput = `
                    <div class="d-flex flex-column mb-8">
                        <label for="value_name_update_${valueCountUpdate}" class="required fs-6 fw-semibold mb-2">Nama Nilai Variabel ${valueCountUpdate}</label>
                        <input type="text" id="value_name_update_${valueCountUpdate}" name="value_names[]" class="form-control form-control-solid" placeholder="Nama Nilai Variabel" value="${value.keterangan}" required />
                        <label for="value_update_${valueCountUpdate}" class="required fs-6 fw-semibold mb-2">Nilai Variabel ${valueCountUpdate}</label>
                        <input type="number" step="any" id="value_update_${valueCountUpdate}" name="values[]" class="form-control form-control-solid" placeholder="Nilai Variabel" value="${value.inisial}" required />
                    </div>
                `;
                $('#variable-values-update').append(valueInput);
            });
            $('#modal_form_update').modal('show');
        }

        function hapus(id_variabel, nama) {
            $('#form_hapus').attr('action', {!! json_encode(url('variabel/hapus/')) !!} + '/' + id_variabel);
            $('#namadelete').text(nama);
            $('#modal_form_hapus').modal('show');
        }
    </script>

    @include('my_components.toastr')
    @include('my_components.datatables')
@endsection
