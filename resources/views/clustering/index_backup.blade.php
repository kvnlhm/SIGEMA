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
            <div class="card-toolbar">
                <button type="button" class="btn btn-sm btn-light-primary me-2" onclick="addRow()">
                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Baris</button>
                <button type="button" class="btn btn-sm btn-light-primary me-2" onclick="addColumn()">
                    <i class="ki-duotone ki-plus fs-2"></i>Tambah Kolom</button>
                <button type="button" class="btn btn-sm btn-light-danger me-2" onclick="removeRow()">
                    <i class="ki-duotone ki-minus fs-2"></i>Hapus Baris</button>
                <button type="button" class="btn btn-sm btn-light-danger me-2" onclick="removeColumn()">
                    <i class="ki-duotone ki-minus fs-2"></i>Hapus Kolom</button>
            </div>
        </div>
        <div class="card-body py-3">
            <div class="table-responsive">
                <table id="kt_datatable_dom_positioning"
                    class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bold text-muted bg-light" id="table-header">
                            <th class="ps-4 min-w-40px rounded-start" contenteditable="false">No.</th>
                            <th class="min-w-200px" contenteditable="true">Karir</th>
                            <th class="min-w-200px" contenteditable="true">Preferensi Lokasi Magang</th>
                            <th class="min-w-200px" contenteditable="true">Nilai P1</th>
                            <th class="min-w-200px" contenteditable="true">Nilai P2</th>
                            <th class="min-w-200px" contenteditable="true">Nilai P3</th>
                            <th class="min-w-100px" contenteditable="false">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        <tr>
                            <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                1.
                            </td>
                            <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                <input type="text" name="karir[]" class="form-control form-control-transparent" onfocus="this.style.backgroundColor='#e7f5ff'" onblur="this.style.backgroundColor='transparent'">
                            </td>
                            <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                <input type="text" name="lokasi_magang[]" class="form-control form-control-transparent" onfocus="this.style.backgroundColor='#e7f5ff'" onblur="this.style.backgroundColor='transparent'">
                            </td>
                            <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                <input type="text" name="nilai_p1[]" class="form-control form-control-transparent" onfocus="this.style.backgroundColor='#e7f5ff'" onblur="this.style.backgroundColor='transparent'">
                            </td>
                            <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                <input type="text" name="nilai_p2[]" class="form-control form-control-transparent" onfocus="this.style.backgroundColor='#e7f5ff'" onblur="this.style.backgroundColor='transparent'">
                            </td>
                            <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                <input type="text" name="nilai_p3[]" class="form-control form-control-transparent" onfocus="this.style.backgroundColor='#e7f5ff'" onblur="this.style.backgroundColor='transparent'">
                            </td>
                            <td>
                                <button type="button" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm">
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
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        function addRow() {
            const tableBody = document.getElementById('table-body');
            const newRow = tableBody.insertRow(-1);
            const rowCount = tableBody.rows.length;
            newRow.innerHTML = `
            <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">${rowCount}.</td>
            <td><input type="text" name="karir[]" class="form-control form-control-transparent"></td>
            <td><input type="text" name="lokasi_magang[]" class="form-control form-control-transparent"></td>
            <td><input type="text" name="nilai_p1[]" class="form-control form-control-transparent"></td>
            <td><input type="text" name="nilai_p2[]" class="form-control form-control-transparent"></td>
            <td><input type="text" name="nilai_p3[]" class="form-control form-control-transparent"></td>
            <td><button type="button" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm" onclick="removeThisRow(this)">
                <span class="svg-icon svg-icon-3">
                    <i class="ki-duotone ki-close"></i>
                </span>
            </button></td>
        `;
        }

        function addColumn() {
            const headerRow = document.getElementById('table-header');
            const newHeader = document.createElement('th');
            newHeader.textContent = 'New Column';
            newHeader.setAttribute('contenteditable', 'true');
            headerRow.appendChild(newHeader);

            const rows = document.getElementById('table-body').rows;
            for (let i = 0; i < rows.length; i++) {
                const newCell = rows[i].insertCell(-1);
                newCell.innerHTML = `<input type="text" name="new_column[]" class="form-control form-control-transparent">`;
            }
        }

        function removeRow() {
            const tableBody = document.getElementById('table-body');
            if (tableBody.rows.length > 1) {
                tableBody.deleteRow(-1);
            }
        }

        function removeColumn() {
            const headerRow = document.getElementById('table-header');
            if (headerRow.cells.length > 7) { // Adjust the number based on initial columns + action column
                headerRow.deleteCell(-1);

                const rows = document.getElementById('table-body').rows;
                for (let i = 0; i < rows.length; i++) {
                    rows[i].deleteCell(-1);
                }
            }
        }

        function removeThisRow(element) {
            const row = element.parentNode.parentNode;
            row.parentNode.removeChild(row);
        }
    </script>
@endsection
