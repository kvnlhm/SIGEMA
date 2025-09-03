@extends('master')
@section('judul', 'Beranda')
@section('breadcrumb')
    <div class="page-title d-flex flex-column me-5 py-2">
        <h1 class="d-flex flex-column text-dark fw-bold fs-3 mb-0">Halaman Beranda</h1>
        <ul class="breadcrumb breadcrumb-separatorless fw-semibold fs-7 pt-1">
            <li class="breadcrumb-item text-muted">
                <a href="{{ url('dashboard') }}" class="text-muted text-hover-primary"><i class="ki-duotone ki-home"></i>
                </a>
            </li>
            <li class="breadcrumb-item">
                <span class="bullet bg-gray-200 w-5px h-2px"></span>
            </li>
            <li class="breadcrumb-item text-dark">Beranda</li>
        </ul>
    </div>
@endsection

@section('konten')
    <h2 class="fs-2x fw-bold mb-10">Selamat Datang, {{ Auth::user()->name }}!</h2>
    <p class="text-gray-400 fs-4 fw-semibold">Berikut hasil pengelompokan terbaru:</p>
    <div class="row g-5 g-xl-8">
        @foreach ($data as $dt)
            <div class="col-xl-4">
                {{-- <a href="{{ url('clustering/inisialisasi/'.encrypt($dt->id_pengelompokan)) }}" class="card {{ ['bg-danger', 'bg-primary', 'bg-success', 'bg-warning', 'bg-info'][$loop->index % 5] }} hoverable card-xl-stretch mb-xl-8"> --}}
                {{-- <a onclick="loadPreviousResults({{ $dt->id_pengelompokan }})" class="card {{ ['bg-danger', 'bg-primary', 'bg-success', 'bg-warning', 'bg-info'][$loop->index % 5] }} hoverable card-xl-stretch mb-xl-8"> --}}
                <a href="{{ url('clustering/hasil-proses/'.encrypt($dt->id_pengelompokan)) }}" class="card {{ ['bg-danger', 'bg-primary', 'bg-success', 'bg-warning', 'bg-info'][$loop->index % 5] }} hoverable card-xl-stretch mb-xl-8">
                    <div class="card-body">
                        <i class="ki-duotone ki-home-1 text-white fs-2x ms-n1">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                        </i>
                        <div class="text-white fw-bold fs-2 mb-2 mt-5">{{ $dt->judul }}</div>
                        <div class="fw-semibold text-white">{{ $dt->periode }}</div>
                    </div>
                </a>
            </div>
        @endforeach
        {{-- <div class="col-xl-4">
            <a href="#" class="card bg-primary hoverable card-xl-stretch mb-xl-8">
                <div class="card-body">
                    <i class="ki-duotone ki-home-1 text-white fs-2x ms-n1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                        <span class="path5"></span>
                        <span class="path6"></span>
                        <span class="path7"></span>
                    </i>
                    <div class="text-white fw-bold fs-2 mb-2 mt-5">Perhotelan XII2</div>
                    <div class="fw-semibold text-white">2023-2024</div>
                </div>
            </a>
        </div>
        <div class="col-xl-4">
            <a href="#" class="card bg-success hoverable card-xl-stretch mb-5 mb-xl-8">
                <div class="card-body">
                    <i class="ki-duotone ki-home-1 text-white fs-2x ms-n1">
                        <span class="path1"></span>
                        <span class="path2"></span>
                        <span class="path3"></span>
                        <span class="path4"></span>
                    </i>
                    <div class="text-white fw-bold fs-2 mb-2 mt-5">Perhotelan XII3</div>
                    <div class="fw-semibold text-white">2023-2024</div>
                </div>
            </a>
        </div> --}}
    </div>
@endsection

@section('css')

@endsection
@section('script')
    @include('my_components.toastr')
    <script>
        function loadPreviousResults(idPengelompokan) {
            $.ajax({
                url: '{{ url("load-previous-results") }}/' + idPengelompokan,
                type: 'GET',
                success: function(response) {
                    // Anda bisa memutuskan untuk langsung menampilkan data atau melakukan navigasi
                    $('body').html(response.html_content); // Contoh sederhana untuk menampilkan hasil
                },
                error: function(xhr) {
                    alert('Tidak dapat memuat hasil.');
                }
            });
        }
    </script>
@endsection
