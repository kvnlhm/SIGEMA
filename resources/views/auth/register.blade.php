<!DOCTYPE html>
<html lang="en">
<head>
    <base href="../../../" />
    <title>Daftar | SIGEMA 45</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="SIGEMA 45" />
    <meta name="keywords"
        content="SIGEMA 45" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title"
        content="SIGEMA 45" />
    <meta property="og:url" content="https://sisenep.com/queensi2020/daftar" />
    <meta property="og:site_name" content="Daftar | SIGEMA 45" />
    <link rel="canonical" href="https://sisenep.com/queensi2020/login" />
    <link rel="shortcut icon" href="{{ asset('public/logo3.png') }}" />
    <!--begin::Fonts(mandatory for all pages)-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(mandatory for all pages)-->
    <link href="{{ asset('public/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>
<!--end::Head-->
<!--begin::Body-->

<body id="kt_body" class="auth-bg">
    <!--begin::Theme mode setup on page load-->
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <!--end::Theme mode setup on page load-->
    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Authentication - Sign-up -->
        <div class="d-flex flex-column flex-lg-row flex-column-fluid">
            <!--begin::Body-->
            <div class="d-flex flex-column flex-lg-row-fluid w-lg-50 p-10 order-2 order-lg-1">
                <!--begin::Form-->
                <div class="d-flex flex-center flex-column flex-lg-row-fluid">
                    <!--begin::Wrapper-->
                    <div class="w-lg-500px p-10">
                        <!--begin::Form-->
                        <form class="form w-100" novalidate="novalidate" id="kt_sign_up_form"
                            action="{{ route('store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <!--begin::Heading-->
                            <div class="text-center mb-11">
                                <!--begin::Title-->
                                <h1 class="text-dark fw-bolder mb-3">Daftar</h1>
                                <!--end::Title-->
                                <!--begin::Subtitle-->
                                <div class="text-gray-500 fw-semibold fs-6">Silahkan masukkan data dengan sesuai.</div>
                                <!--end::Subtitle=-->
                            </div>
                            <!--begin::Heading-->
                            <!--begin::Input group=-->
                            <div class="fv-row mb-8">
                                <!--begin::Email-->
                                <input type="email" placeholder="Email" name="email" id="email"
                                    value="{{ old('email') }}" autocomplete="off"
                                    class="form-control bg-transparent @error('email') is-invalid @enderror" />
                                <!--end::Email-->
                                @if ($errors->has('email'))
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        <div data-field="email" data-validator="regexp">{{ $errors->first('email') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Username" name="name" id="name"
                                    value="{{ old('name') }}" autocomplete="off"
                                    class="form-control bg-transparent @error('name') is-invalid @enderror" />
                                @if ($errors->has('name'))
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        <div data-field="name" data-validator="regexp">{{ $errors->first('name') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Nama Lengkap" name="nama_lengkap" id="nama_lengkap"
                                    value="{{ old('nama_lengkap') }}" autocomplete="off"
                                    class="form-control bg-transparent @error('nama_lengkap') is-invalid @enderror" />
                                @if ($errors->has('nama_lengkap'))
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        <div data-field="nama_lengkap" data-validator="regexp">
                                            {{ $errors->first('nama_lengkap') }}</div>
                                    </div>
                                @endif
                            </div>
                            <div class="fv-row mb-8">
                                <input type="number" placeholder="No. Telepon" name="no_telp" id="no_telp"
                                    value="{{ old('no_telp') }}" autocomplete="off"
                                    class="form-control bg-transparent @error('no_telp') is-invalid @enderror"
                                    minlength="10" maxlength="13" min="0" />
                                @if ($errors->has('no_telp'))
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        <div data-field="no_telp" data-validator="regexp">
                                            {{ $errors->first('no_telp') }}</div>
                                    </div>
                                @endif
                            </div>
                            <div class="fv-row mb-8">
                                <input type="text" placeholder="Alamat" name="alamat" id="alamat"
                                    value="{{ old('alamat') }}" autocomplete="off"
                                    class="form-control bg-transparent @error('alamat') is-invalid @enderror" />
                                @if ($errors->has('alamat'))
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        <div data-field="alamat" data-validator="regexp">
                                            {{ $errors->first('alamat') }}</div>
                                    </div>
                                @endif
                            </div>
                            <div class="fv-row mb-8">
                                <label class="form-control bg-transparent @error('foto') is-invalid @enderror">
                                    <input type="file" id="foto" name="foto" style="display: none;" accept="image/*"
                                    onchange="document.getElementById('fileName').innerHTML = this.files[0].name"
                                    required />
                                    <i class="ki-duotone ki-picture fs-2 position-absolute">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                    </i>
                                    <span id="fileName" class="ps-8">Pilih Foto</span>
                                </label>
                                @if ($errors->has('foto'))
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        <div data-field="foto" data-validator="regexp">{{ $errors->first('foto') }}
                                        </div>
                                    </div>
                                @endif
                            </div>
                            <div class="fv-row mb-8">
                                <input type="password" placeholder="Password" name="password" id="password"
                                    value="{{ old('password') }}" autocomplete="off"
                                    class="form-control bg-transparent @error('password') is-invalid @enderror" />
                                @if ($errors->has('password'))
                                    <div
                                        class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback">
                                        <div data-field="password" data-validator="regexp">
                                            {{ $errors->first('password') }}</div>
                                    </div>
                                @endif
                            </div>
                            {{-- <div class="fv-row mb-8" data-kt-password-meter="true">
                                <!--begin::Wrapper-->
                                <div class="mb-1">
                                    <!--begin::Input wrapper-->
                                    <div class="position-relative mb-3">
                                        <input class="form-control bg-transparent @error('password') is-invalid @enderror" type="password"
                                            placeholder="Password" name="password" id="password" value="{{ old('password') }}" autocomplete="off" />
                                        <span
                                            class="btn btn-sm btn-icon position-absolute translate-middle top-50 end-0 me-n2"
                                            data-kt-password-meter-control="visibility">
                                            <i class="ki-duotone ki-eye-slash fs-2"></i>
                                            <i class="ki-duotone ki-eye fs-2 d-none"></i>
                                        </span>
                                        @if ($errors->has('password'))
                                            <div class="fv-plugins-message-container fv-plugins-message-container--enabled invalid-feedback"><div data-field="password" data-validator="regexp">{{ $errors->first('password') }}</div></div>
                                        @endif
                                    </div>
                                    <!--end::Input wrapper-->
                                    <!--begin::Meter-->
                                    <div class="d-flex align-items-center mb-3"
                                        data-kt-password-meter-control="highlight">
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px me-2">
                                        </div>
                                        <div class="flex-grow-1 bg-secondary bg-active-success rounded h-5px"></div>
                                    </div>
                                    <!--end::Meter-->
                                </div>
                                <!--end::Wrapper-->
                                <!--begin::Hint-->
                                <div class="text-muted">Gunakan 8 karakter atau lebih dengan campuran huruf, angka & simbol.</div>
                                <!--end::Hint-->
                            </div> --}}
                            <div class="fv-row mb-8">
                                <!--begin::Repeat Password-->
                                <input placeholder="Konfirmasi Password" name="password_confirmation"
                                    id="password_confirmation" value="{{ old('password_confirmation') }}" type="password"
                                    autocomplete="off" class="form-control bg-transparent" />
                                <!--end::Repeat Password-->
                            </div>
                            <!--end::Input group=-->
                            <!--begin::Accept-->
                            <!--begin::Submit button-->
                            <div class="d-grid mb-10">
                                <button type="submit" id="kt_sign_up_submit" class="btn btn-primary">
                                    <!--begin::Indicator label-->
                                    <span class="indicator-label">Daftar</span>
                                    <!--end::Indicator label-->
                                    <!--begin::Indicator progress-->
                                    <span class="indicator-progress">Mohon menunggu...
                                        <span class="spinner-border spinner-border-sm align-middle ms-2"></span></span>
                                    <!--end::Indicator progress-->
                                </button>
                            </div>
                            <!--end::Submit button-->
                            <!--begin::Sign up-->
                            <div class="text-gray-500 text-center fw-semibold fs-6">Sudah mempunyai akun?
                                <a href="{{ url('login') }}" class="link-primary fw-semibold">Login</a>
                            </div>
                            <!--end::Sign up-->
                        </form>
                        <!--end::Form-->
                    </div>
                    <!--end::Wrapper-->
                </div>
                <!--end::Form-->
            </div>
            <!--end::Body-->
            <!--begin::Aside-->
            <div class="d-flex flex-lg-row-fluid w-lg-50 bgi-size-cover bgi-position-center order-1 order-lg-2"
                style="background-image: url({{ asset('public/assets/media/misc/auth-bg.png') }})">
                <!--begin::Content-->
                <div class="d-flex flex-column flex-center py-7 py-lg-15 px-5 px-md-15 w-100">
                    <!--begin::Logo-->
                    {{-- <a href="../../demo10/dist/index.html" class="mb-0 mb-lg-12">
                        <img alt="Logo" src="{{ asset('public/assets/media/logos/custom-1.png') }}" class="h-60px h-lg-75px" />
                    </a> --}}
                    <!--end::Logo-->
                    <!--begin::Image-->
                    <img class="d-none d-lg-block mx-auto w-275px w-md-50 w-xl-500px mb-10 mb-lg-20"
                        src="{{ asset('public/logo.png') }}" alt="" />
                    <!--end::Image-->
                    <!--begin::Title-->
                    <h1 class="d-none d-lg-block text-white fs-2qx fw-bolder text-center mb-7">SELAMAT DATANG</h1>
                    <!--end::Title-->
                    <!--begin::Text-->
                    <div class="d-none d-lg-block text-white fs-base text-center">Sistem Informasi Pengelompokan Siswa
                        PKL SMK Gema 45 Surabaya
                        {{-- <a href="#" class="opacity-75-hover text-warning fw-bold me-1">tes</a> --}}
                    </div>
                    <!--end::Text-->
                </div>
                <!--end::Content-->
            </div>
            <!--end::Aside-->
        </div>
        <!--end::Authentication - Sign-up-->
    </div>
    <!--end::Root-->
    <!--end::Main-->
    <!--begin::Javascript-->
    <script>
        var hostUrl = "assets/";
    </script>
    <!--begin::Global Javascript Bundle(mandatory for all pages)-->
    <script src="{{ asset('public/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/js/scripts.bundle.js') }}"></script>
    <!--end::Global Javascript Bundle-->
    <!--begin::Custom Javascript(used for this page only)-->
    {{-- <script src="{{ asset('public/assets/js/custom/authentication/sign-up/general.js') }}"></script> --}}
    <!--end::Custom Javascript-->
    <!--end::Javascript-->
    <script>
        $(document).ready(function() {
            $('#password, #confirm-password').on('keyup', function() {
                if ($('#password').val() === $('#confirm-password').val()) {
                    $('#message').html('Matching').css('color', 'green');
                } else {
                    $('#message').html('Not Matching').css('color', 'red');
                }
            });
        });
    </script>
</body>
<!--end::Body-->

</html>
