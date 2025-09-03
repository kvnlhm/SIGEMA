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
            <li class="breadcrumb-item text-muted">
                <a href="{{ url('cluster') }}" class="text-muted text-hover-primary">Clustering</a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-200 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-muted">Inisialisasi Update</li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-200 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-dark">Langkah 1</li>
        </ul>
    </div>
@endsection

@section('konten')
    <div class="card">
        <div class="card-body">
            <div class="stepper stepper-links d-flex flex-column pt-15" id="kt_create_account_stepper">
                <div class="stepper-nav mb-5">
                    <div class="stepper-item current" data-kt-stepper-element="nav">
                        <h3 class="stepper-title">Langkah 1</h3>
                    </div>
                    <div class="stepper-item pending" data-kt-stepper-element="nav">
                        <h3 class="stepper-title">Langkah 2</h3>
                    </div>
                </div>
                <form class="mx-auto mw-600px w-100 pt-15 pb-10" novalidate="novalidate" id="kt_create_account_form">
                    <div class="current" data-kt-stepper-element="content">
                        <div class="w-100">
                            <div class="pb-10 pb-lg-15">
                                <h2 class="fw-bold text-dark">Pengelompokan PKL Siswa</h2>
                                <div class="text-muted fw-semibold fs-6">Jika Anda memerlukan info lebih lanjut, silakan
                                    periksa
                                    <a href="{{ url('panduan') }}" class="link-primary fw-bold">Halaman Panduan</a>.
                                </div>
                            </div>
                            <div class="mb-10 fv-row">
                                <label class="form-label mb-3 required">Masukkan jumlah data yang akan dikelompokkan</label>
                                <input type="number" class="form-control form-control-lg form-control-solid"
                                    name="jumlah_data" id="jumlah_data" placeholder="" oninput="toggleDownloadButton()" />
                                <div class="form-text">Inputkan jumlah data terlebih dahulu sebelum mendownload file excel
                                </div>
                            </div>
                            <button type="button" class="btn btn-sm btn-light-success" id="downloadButton"
                                onclick="downloadExcel()" disabled>
                                <i class="ki-duotone ki-cloud-download fs-2">
                                    <span class="path1"></span>
                                    <span the="path2"></span>
                                </i>Download Excel
                            </button>
                        </div>
                    </div>
                    {{-- <div data-kt-stepper-element="content">
                        <div class="w-100">
                            <div class="pb-10 pb-lg-12">
                                <h2 class="fw-bold text-dark">Silahkan inputkan data dengan sesuai.</h2>
                                <div class="text-muted fw-semibold fs-6">Jika Anda memerlukan info lebih lanjut, silakan
                                    periksa
                                    <a href="{{ url('panduan') }}" class="link-primary fw-bold">Halaman Panduan</a>.
                                </div>
                            </div>
                            <div class="fv-row mb-10">
                                <label class="form-label required">Judul</label>
                                <input name="judul" class="form-control form-control-lg form-control-solid"
                                    placeholder="Masukkan judul pengelompokan" required />
                                <div class="form-text">Tentukan judul untuk pengelompokan</div>
                            </div>
                            <div class="fv-row mb-10">
                                <label class="form-label required">Periode</label>
                                <select name="periode" class="form-select form-select-lg form-select-solid"
                                    data-control="select2" data-placeholder="Pilih Periode" data-allow-clear="true"
                                    data-hide-search="true" required>
                                    <option></option>
                                    <option value="2024">2024</option>
                                    <option value="2023">2023</option>
                                    <option value="2022">2022</option>
                                    <option value="2021">2021</option>
                                    <option value="2020">2020</option>
                                    <option value="2019">2019</option>
                                    <option value="2018">2018</option>
                                    <option value="2017">2017</option>
                                    <option value="2016">2016</option>
                                    <option value="2015">2015</option>
                                    <option value="2014">2014</option>
                                    <option value="2013">2013</option>
                                    <option value="2012">2012</option>
                                    <option value="2011">2011</option>
                                    <option value="2010">2010</option>
                                </select>
                            </div>
                            <div class="fv-row mb-10">
                                <label class="fs-6 fw-semibold form-label required">File Data</label>
                                <label class="form-control form-control-lg form-control-solid">
                                    <input type="file" name="file" style="display: none;"
                                        accept=".xlsx, .xls" onchange="document.getElementById('fileName').innerHTML = this.files[0].name" required />
                                    <span id="fileName">Pilih file...</span>
                                </label>
                                <div class="form-text">Inputkan file excel yang akan dikelompokkan</div>
                            </div>
                            <div class="fv-row mb-10">
                                <label class="fs-6 fw-semibold form-label required">Jumlah Cluster (c)</label>
                                <input type="number" name="jumlah_cluster"
                                    class="form-control form-control-lg form-control-solid" placeholder="Masukkan jumlah cluster" required />
                            </div>
                            <div class="fv-row mb-10">
                                <label class="fs-6 fw-semibold form-label required">Pembobot (w)</label>
                                <input type="number" name="pembobot"
                                    class="form-control form-control-lg form-control-solid" placeholder="Masukkan pembobot" required />
                            </div>
                            <div class="fv-row mb-10">
                                <label class="fs-6 fw-semibold form-label required">Nilai error (e)</label>
                                <input type="number" name="nilai_error" step="any"
                                    class="form-control form-control-lg form-control-solid" placeholder="Masukkan nilai error seperti 0.01" required />
                            </div>
                            <div class="fv-row mb-10">
                                <label class="fs-6 fw-semibold form-label required">Maksimal Iterasi (maxiter)</label>
                                <input type="number" name="maksimal_iterasi"
                                    class="form-control form-control-lg form-control-solid" placeholder="Masukkan maksimal iterasi" required />
                            </div>
                        </div>
                    </div> --}}
                    <div class="d-flex flex-stack pt-15">
                        <div class="mr-2">
                            <button type="button" class="btn btn-lg btn-light-primary me-3"
                                data-kt-stepper-action="previous">
                                <i class="ki-duotone ki-arrow-left fs-4 me-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>Kembali</button>
                        </div>
                        <div>
                            <button type="submit" class="btn btn-lg btn-primary me-3" data-kt-stepper-action="submit">
                                <span class="indicator-label">Proses
                                    <i class="ki-duotone ki-arrow-right fs-3 ms-2 me-0">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i></span>
                                <span class="indicator-progress">Mohon menunggu...
                                    <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                            </button>
                            <a href="{{ url('clustering/inisialisasi2/'.encrypt($kelompok->id_pengelompokan)) }}" class="btn btn-lg btn-primary"
                                >Berikutnya
                                <i class="ki-duotone ki-arrow-right fs-4 ms-1 me-0">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i></a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('modal')
@endsection

@section('script')
    <script>
        function toggleDownloadButton() {
            const jumlahData = document.getElementById('jumlah_data').value;
            const downloadButton = document.getElementById('downloadButton');
            downloadButton.disabled = jumlahData === '' || jumlahData <= 0;
        }

        function downloadExcel() {
            var jumlahData = document.getElementById('jumlah_data').value;
            window.location.href = "{{ url('clustering/download-excel') }}/" + jumlahData;
        }
    </script>
@endsection
