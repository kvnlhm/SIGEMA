{{-- @extends('master')
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
                <a href="#" data-bs-toggle="modal" data-bs-target="#modal_upload"
                    class="btn btn-sm btn-light-primary">
                    <i class="ki-duotone ki-plus fs-2"></i>Upload File
                </a>
            </div>
        </div>
        <div class="card-body py-3">
            <div class="table-responsive">
                <table id="kt_datatable_dom_positioning"
                    class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                    <thead>
                        <tr class="fw-bold text-muted bg-light" id="table-header">
                            <th class="ps-4 min-w-40px rounded-start" contenteditable="false">No.</th>
                            <th class="min-w-100px" contenteditable="false">Karir</th>
                            <th class="min-w-100px" contenteditable="false">Preferensi Lokasi Magang</th>
                            <th class="min-w-100px" contenteditable="false">Nilai P1</th>
                            <th class="min-w-100px" contenteditable="false">Nilai P2</th>
                            <th class="min-w-100px" contenteditable="false">Nilai P3</th>
                            <th class="min-w-100px" contenteditable="false">Nilai P4</th>
                            <th class="min-w-100px" contenteditable="false">Nilai P5</th>
                            <th class="min-w-100px" contenteditable="false">Nilai P6</th>
                            <th class="min-w-100px" contenteditable="false">Aksi</th>
                        </tr>
                    </thead>
                    <tbody id="table-body">
                        @foreach ($data as $dt)
                            <tr data-id="{{ $dt->id }}">
                                <td class="ps-4 text-dark text-hover-primary mb-1 fs-6">{{ $loop->iteration }}</td>
                                <td contenteditable="true" data-column="karir">{{ $dt->karir }}</td>
                                <td contenteditable="true" data-column="preferensi">{{ $dt->preferensi }}</td>
                                <td contenteditable="true" data-column="p1">{{ number_format($dt->p1, 1) }}</td>
                                <td contenteditable="true" data-column="p2">{{ number_format($dt->p2, 1) }}</td>
                                <td contenteditable="true" data-column="p3">{{ number_format($dt->p3, 1) }}</td>
                                <td contenteditable="true" data-column="p4">{{ number_format($dt->p4, 1) }}</td>
                                <td contenteditable="true" data-column="p5">{{ number_format($dt->p5, 1) }}</td>
                                <td contenteditable="true" data-column="p6">{{ number_format($dt->p6, 1) }}</td>
                                <td>
                                    <button onclick="deleteRow(this)" title="Hapus Baris"
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

@section('modal')
    <div class="modal fade" id="modal_upload" tabindex="-1" aria-hidden="true">
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
                    <form action="{{ route('clustering.upload') }}" method="POST" class="form"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="mb-13 text-center">
                            <h1 class="mb-3">Form Upload</h1>
                            <div class="text-muted fw-semibold fs-5">Silahkan upload file dengan format excel.</div>
                        </div>
                        <div class="row g-9 mb-8">
                            <div class="col-md-12 fv-row">
                                <label for="file" class="required fs-6 fw-semibold mb-2">File Excel</label>
                                <input type="file" id="file" name="file"
                                    class="form-control form-control-solid" placeholder="Upload Excel File"
                                    accept=".xlsx,.xls" required />
                            </div>
                        </div>
                        <div class="text-center">
                            <button type="reset" class="btn btn-light me-3">Reset</button>
                            <button type="submit" class="btn btn-primary">
                                <span class="indicator-label">Upload</span>
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
        function deleteRow(btn) {
            var row = btn.parentNode.parentNode;
            row.parentNode.removeChild(row);
            updateAddButton();
        }

        function updateData(cell, column, id) {
            $.ajax({
                url: "{{ url('clustering/update') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    id: id,
                    column: column,
                    value: cell.innerText
                },
                success: function(response) {
                    console.log('Update successful');
                },
                error: function(xhr, status, error) {
                    console.error('Update failed');
                }
            });
        }

        function addRow() {
            var table = document.getElementById('table-body');
            var lastRow = table.rows[table.rows.length - 1];
            var lastCell = lastRow.cells[lastRow.cells.length - 1];
            lastCell.innerHTML =
                '<button onclick="deleteRow(this)" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm"><i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i></button>'; // Add delete button to last row

            var newRow = table.insertRow(-1);
            var rowCount = table.rows.length;

            var cell1 = newRow.insertCell(0);
            var cell2 = newRow.insertCell(1);
            var cell3 = newRow.insertCell(2);
            var cell4 = newRow.insertCell(3);
            var cell5 = newRow.insertCell(4);
            var cell6 = newRow.insertCell(5);
            var cell7 = newRow.insertCell(6);
            var cell8 = newRow.insertCell(7);
            var cell9 = newRow.insertCell(8);
            var cell10 = newRow.insertCell(9);

            cell1.innerHTML = rowCount;
            cell2.setAttribute('contenteditable', 'true');
            cell3.setAttribute('contenteditable', 'true');
            cell4.setAttribute('contenteditable', 'true');
            cell5.setAttribute('contenteditable', 'true');
            cell6.setAttribute('contenteditable', 'true');
            cell7.setAttribute('contenteditable', 'true');
            cell8.setAttribute('contenteditable', 'true');
            cell9.setAttribute('contenteditable', 'true');
            cell10.innerHTML =
                '<button onclick="deleteRow(this)" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm"><i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i></button><button onclick="addRow()" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"><i class="ki-duotone ki-plus fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i></button>';

            updateAddButton();
        }

        function updateAddButton() {
            var table = document.getElementById('table-body');
            var rows = table.rows;
            var lastRow = rows[rows.length - 1];
            var lastCell = lastRow.cells[lastRow.cells.length - 1];
            lastCell.innerHTML =
                '<button onclick="deleteRow(this)" class="btn btn-icon btn-bg-light btn-active-color-danger btn-sm"><i class="ki-duotone ki-trash fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i></button><button onclick="addRow()" class="btn btn-icon btn-bg-light btn-active-color-primary btn-sm"><i class="ki-duotone ki-plus fs-2"><span class="path1"></span><span class="path2"></span><span class="path3"></span><span class="path4"></span><span class="path5"></span></i></button>';
        }

        // Initialize the add button on the last row on page load
        document.addEventListener('DOMContentLoaded', function() {
            const editableCells = document.querySelectorAll('[contenteditable="true"]');
            editableCells.forEach(cell => {
                cell.addEventListener('blur', function() {
                    const id = this.closest('tr').getAttribute('data-id');
                    const column = this.getAttribute('data-column');
                    updateData(this, column, id);
                });
            });
            updateAddButton();
        });
    </script>
@endsection --}}

@section('name')
    <p>
        tambahkan tabel fungsi objektif cluster ke- (tergantung banyaknya jumlah_cluster yang diinputkan, sebelumnya yang
        diinputkan adalah 3 maka akan ada 3 tabel). Terdiri dari 10 kolom, kolom pertama Data ke-(sebagai penanda baris
        keberapa), kolom kedua sampai sembilan(karena menyesuaikan tabel inisialisasi sebelumnya yang sebanyak 8 kolom),
        lalu kolom terakhir total jumlah per baris. Di tabel fungsi objektif cluster ke-1 kolom kedua((X1-Vkj1)^2) baris
        pertama merupakan hasil dari kolom pertama(X1) baris pertama dari tabel inisialisasi dikurangi dengan kolom
        pertama(Vkj1) baris pertama dari tabel pusat cluster baru lalu hasilnya dipangakatkan dengan pembobot. Lanjut ke
        kolom ketiga((X2-Vkj2)^2) masih baris pertama merupakan hasil dari kolom kedua(X2) baris pertama dari tabel
        inisialisasi dikurangi dengan kolom kedua(Vkj2) baris pertama dari tabel pusat cluster baru lalu hasilnya
        dipangakatkan dengan pembobot, dst. Lanjut ke baris kedua kolom kedua((X1-Vkj1)^2) merupakan hasil dari kolom
        pertama(X1) baris kedua dari tabel inisialisasi dikurangi dengan kolom pertama(Vkj1) baris pertama dari tabel pusat
        cluster baru lalu hasilnya dipangakatkan dengan pembobot. Lanjut ke kolom ketiga((X2-Vkj2)^2) masih baris kedua
        merupakan hasil dari kolom kedua(X2) baris kedua dari tabel inisialisasi dikurangi dengan kolom kedua(Vkj2) baris
        pertama dari tabel pusat cluster baru lalu hasilnya dipangakatkan dengan pembobot, dst. Di tabel fungsi objektif
        cluster ke-2 kolom kedua((X1-Vkj1)^2) baris pertama merupakan hasil dari kolom pertama(X1) baris pertama dari tabel
        inisialisasi dikurangi dengan kolom pertama(Vkj1) baris kedua dari tabel pusat cluster baru lalu hasilnya
        dipangakatkan dengan pembobot. Lanjut ke kolom ketiga((X2-Vkj2)^2) masih baris pertama merupakan hasil dari kolom
        kedua(X2) baris pertama dari tabel inisialisasi dikurangi dengan kolom kedua(Vkj2) baris kedua dari tabel pusat
        cluster baru lalu hasilnya dipangakatkan dengan pembobot, dst. Lanjut ke baris kedua kolom kedua((X1-Vkj1)^2)
        merupakan hasil dari kolom pertama(X1) baris kedua dari tabel inisialisasi dikurangi dengan kolom pertama(Vkj1)
        baris kedua dari tabel pusat cluster baru lalu hasilnya dipangakatkan dengan pembobot. Lanjut ke kolom
        ketiga((X2-Vkj2)^2) masih baris kedua merupakan hasil dari kolom kedua(X2) baris kedua dari tabel inisialisasi
        dikurangi dengan kolom kedua(Vkj2) baris kedua dari tabel pusat cluster baru lalu hasilnya dipangakatkan dengan
        pembobot, dst.
    </p>
@endsection

@extends('master')
@section('judul', 'Hasil Pengelompokan dan Skala')
@section('breadcrumb')
    <div class="page-title d-flex flex-column me-5 py-2">
        <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Halaman Hasil Clustering</h1>
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{ url('dashboard') }}" class="text-muted text-hover-primary"><i class="ki-duotone ki-home"></i>
                </a>
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
                        <a class="nav-link text-active-primary d-flex align-items-center pb-5 {{ $i == 1 ? 'active' : '' }}"
                            data-bs-toggle="tab" href="#iterasi{{ $i }}">
                            <i class="ki-duotone ki-arrows-loop fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>Iterasi {{ $i }}</a>
                    </li>
                @endfor
                <li class="nav-item">
                    <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab"
                        href="#cek">
                        <i class="ki-duotone ki-check-square fs-2 me-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                            <span class="path6"></span>
                        </i>Cek</a>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                @for ($x = 1; $x <= $maksimalIterasi; $x++)
                    <div class="tab-pane fade {{ $x == 1 ? 'show active' : '' }}" id="iterasi{{ $x }}" role="tabpanel">
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
                                                    <th class="ps-4 min-w-40px rounded-start align-middle">{{ $column }}
                                                    </th>
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data[0] as $row)
                                                <tr>
                                                    @foreach ($row as $value)
                                                        <td class="ps-4 text-dark text-hover-primary mb-1 fs-6">
                                                            {{ $value }}</td>
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="card-body py-3">
                                <div class="table-responsive">
                                    <h3 style="text-align: center;">Tabel Inisialisasi</h3>
                                    <table class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                        <thead>
                                            <tr class="fw-bold text-muted bg-light">
                                                <th class="ps-4 min-w-40px rounded-start align-middle">No.</th>
                                                @foreach ($header as $i => $column)
                                                    @if ($i < count($header) - 1)
                                                        <th class="min-w-100px">X{{ $i + 1 }}</th>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($data[0] as $row)
                                                <tr>
                                                    @foreach ($row as $key => $value)
                                                        @if ($key == 0)
                                                            {{-- Asumsi kolom "No." adalah di indeks 0 --}}
                                                            <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                                {{ $value }}
                                                            </td>
                                                        @else
                                                            @php
                                                                $formattedValue = number_format(
                                                                    $scales[$header[$key]][$value] ?? 0,
                                                                    6,
                                                                );
                                                                $formattedValue = rtrim($formattedValue, '0');
                                                                $formattedValue = rtrim($formattedValue, '.');
                                                            @endphp
                                                            <td class="text-dark text-hover-primary mb-1 fs-6">
                                                                {{ $formattedValue }}
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="mt-4">
                                    <h4>Keterangan:</h4>
                                    <p>Jumlah Cluster (c) = {{ $jumlahCluster }}</p>
                                    <p>Pembobot (w) = {{ $pembobot }}</p>
                                    <p>Nilai error (e) = {{ number_format($nilaiError, 2) }}</p>
                                    <p>Maksimal Iterasi (maxiter) = {{ $maksimalIterasi }}</p>
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
                                                    @foreach ($uikRandom as $index => $row)
                                                        <tr>
                                                            <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                                {{ $index + 1 }}
                                                            </td>
                                                            @foreach ($row as $value)
                                                                <td class="text-dark text-hover-primary mb-1 fs-6">
                                                                    {{ number_format($value, 4) }}</td>
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
                                                    @foreach ($uikSquared as $index => $row)
                                                        <tr>
                                                            <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                                {{ $index + 1 }}
                                                            </td>
                                                            @foreach ($row as $value)
                                                                <td class="text-dark text-hover-primary mb-1 fs-6">
                                                                    {{ number_format($value, 4) }}</td>
                                                            @endforeach
                                                        </tr>
                                                    @endforeach
                                                    <tr>
                                                        <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                            <strong>Total</strong>
                                                        </td>
                                                        @php
                                                            $columnTotalsSquared = array_fill(0, $jumlahCluster, 0);
                                                            foreach ($uikSquared as $row) {
                                                                foreach ($row as $index => $value) {
                                                                    $columnTotalsSquared[$index] += $value;
                                                                }
                                                            }
                                                        @endphp
                                                        @foreach ($columnTotalsSquared as $total)
                                                            <td><strong>{{ number_format($total, 4) }}</strong></td>
                                                        @endforeach
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @foreach ($uikClusters as $clusterIndex => $clusterData)
                            <div class="card mb-5 mb-xl-8">
                                <div class="card-body py-3">
                                    <div class="table-responsive">
                                        <h3 style="text-align: center;">Tabel UIK Cluster {{ $clusterIndex + 1 }}</h3>
                                        <table class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                            <thead>
                                                <tr class="fw-bold text-muted bg-light">
                                                    <th class="ps-4 min-w-40px rounded-start">Data Ke-</th>
                                                    @foreach (array_slice($header, 1) as $xIndex => $xName)
                                                        <th>(u{{ $clusterIndex + 1 }}^{{ $pembobot }})X{{ $xIndex + 1 }}
                                                        </th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clusterData as $rowIndex => $row)
                                                    <tr>
                                                        <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                            {{ $rowIndex + 1 }}
                                                        </td>
                                                        @foreach ($row as $value)
                                                            <td class="text-dark text-hover-primary mb-1 fs-6">
                                                                {{ number_format($value, 4) }}
                                                            </td>
                                                        @endforeach
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
                                        <h3 style="text-align: center;">Tabel Fungsi Objektif Cluster {{ $clusterIndex + 1 }}
                                        </h3>
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
                @endfor
                <div class="tab-pane fade" id="cek" role="tabpanel">
                    Ini adalah hasil finalisasi.
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    @include('my_components.toastr')
    @include('my_components.datatables')
@endsection
