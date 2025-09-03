<!DOCTYPE html>
<html lang="en">
<head>
    <base href="../" />
    <title>@yield('judul') | SIGEMA 45</title>
    <meta name="csrf-token" content="{{ csrf_token() }}">
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
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="SIGEMA 45" />
    <link rel="canonical" href="{{ url()->current() }}" />
    <link rel="shortcut icon" href="{{ asset('public/logo3.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="{{ asset('public/assets/plugins/custom/datatables/datatables.bundle.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('public/assets/plugins/global/plugins.bundle.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('public/assets/css/style.bundle.css') }}" rel="stylesheet" type="text/css" />
    <style>
        .sticky-nav {
            position: -webkit-sticky;
            /* Untuk Safari */
            position: sticky;
            top: 75px;
            /* Sesuaikan dengan tinggi navbar atau header Anda */
            z-index: 999;
            /* Pastikan lebih rendah dari navbar jika ada */
            background-color: white;
            /* Opsi untuk memastikan tab terlihat jelas */
        }
    </style>
    @yield('css')
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>

<body id="kt_body" class="header-tablet-and-mobile-fixed aside-enabled">
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
    <div class="d-flex flex-column flex-root">
        <div class="page d-flex flex-row flex-column-fluid">
            <div id="kt_aside" class="aside py-9" data-kt-drawer="true" data-kt-drawer-name="aside"
                data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true"
                data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start"
                data-kt-drawer-toggle="#kt_aside_toggle">
                <div class="aside-menu flex-column-fluid ps-5 pe-3 mb-7" id="kt_aside_menu">
                    <div class="w-100 hover-scroll-y d-flex pe-2" id="kt_aside_menu_wrapper" data-kt-scroll="true"
                        data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto"
                        data-kt-scroll-dependencies="#kt_aside_footer, #kt_header"
                        data-kt-scroll-wrappers="#kt_aside, #kt_aside_menu, #kt_aside_menu_wrapper"
                        data-kt-scroll-offset="102">
                        <div class="menu menu-column menu-rounded menu-sub-indention menu-active-bg fw-semibold my-auto"
                            id="#kt_aside_menu" data-kt-menu="true">
                            <div class="menu-item pt-5">
                                <div class="menu-content">
                                    {{-- <span class="menu-heading fw-bold text-uppercase fs-7">Selamat datang, <b>{{ Auth::user()->name }}</b>!</span> --}}
                                    <span class="menu-heading fw-bold text-uppercase fs-7">Admin Dashboard</span>
                                </div>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('dashboard') ? 'active' : '' }}" href="{{ url('dashboard') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-home-3 fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Beranda</span>
                                </a>
                            </div>
                            <div class="menu-item pt-5">
                                <div class="menu-content">
                                    <span class="menu-heading fw-bold text-uppercase fs-7">Daftar Menu</span>
                                </div>
                            </div>
                            @if (Auth::user()->id_priv == 1)
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('variabel') ? 'active' : '' }}" href="{{ url('variabel') }}">
                                        <span class="menu-icon">
                                            <i class="ki-duotone ki-element-8 fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                                <span class="path6"></span>
                                            </i>
                                        </span>
                                        <span class="menu-title">Variabel</span>
                                    </a>
                                </div>
                            @endif
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs(['cluster*', 'clustering.process-upload', 'clustering.inisialisasi', 'clustering.inisialisasi2']) ? 'active' : '' }}" href="{{ url('cluster') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-graph fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Clustering</span>
                                </a>
                            </div>
                            <div class="menu-item">
                                <a class="menu-link {{ request()->routeIs('panduan') ? 'active' : '' }}" href="{{ url('panduan') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-question-2 fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Panduan</span>
                                </a>
                            </div>
                            @if (Auth::user()->id_priv == 1)
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('user') ? 'active' : '' }}" href="{{ url('user') }}">
                                        <span class="menu-icon">
                                            <i class="ki-duotone ki-people fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                                <span class="path6"></span>
                                            </i>
                                        </span>
                                        <span class="menu-title">Pengguna</span>
                                    </a>
                                </div>
                            @endif
                            @if (Auth::user()->id_priv == 1)
                                <div class="menu-item">
                                    <a class="menu-link {{ request()->routeIs('log') ? 'active' : '' }}" href="{{ url('log') }}">
                                        <span class="menu-icon">
                                            <i class="ki-duotone ki-information-5 fs-2">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                                <span class="path3"></span>
                                                <span class="path4"></span>
                                                <span class="path5"></span>
                                                <span class="path6"></span>
                                            </i>
                                        </span>
                                        <span class="menu-title">Log Aktivitas</span>
                                    </a>
                                </div>
                            @endif
                            <div class="menu-item">
                                <a class="menu-link" href="{{ url('logout') }}">
                                    <span class="menu-icon">
                                        <i class="ki-duotone ki-exit-left fs-2">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                            <span class="path3"></span>
                                            <span class="path4"></span>
                                            <span class="path5"></span>
                                            <span class="path6"></span>
                                        </i>
                                    </span>
                                    <span class="menu-title">Logout</span>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="aside-footer flex-column-auto px-9" id="kt_aside_menu">
                    <div class="d-flex flex-stack">
                        <div class="d-flex align-items-center">
                            <div class="symbol symbol-circle symbol-40px">
                                @if (Auth::user()->foto)
                                    <img src="{{ asset('public/storage/images/user/' . Auth::user()->foto) }}"
                                        alt="photo" />
                                @else
                                    <img src="{{ asset('public/storage/images/user/user.png') }}"
                                        alt="photo" />
                                @endif
                            </div>
                            <div class="ms-2">
                                <a href="{{ url('user/profil') }}"
                                    class="text-gray-800 text-hover-primary fs-6 fw-bold lh-1">{{ Auth::user()->name }}</a>
                                <span
                                    class="text-muted fw-semibold d-block fs-7 lh-1">{{ Auth::user()->email }}</span>
                            </div>
                        </div>
                        <div class="ms-1">
                            <div class="btn btn-sm btn-icon btn-active-color-primary position-relative me-n2"
                                data-kt-menu-trigger="click" data-kt-menu-overflow="true"
                                data-kt-menu-placement="top-end">
                                <i class="ki-duotone ki-setting-2 fs-1">
                                    <span class="path1"></span>
                                    <span class="path2"></span>
                                </i>
                            </div>
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                                data-kt-menu="true">
                                <div class="menu-item px-3">
                                    <div class="menu-content d-flex align-items-center px-3">
                                        <div class="symbol symbol-50px me-5">
                                            @if (Auth::user()->foto)
                                                <img alt="Logo"
                                                src="{{ asset('public/storage/images/user/' . Auth::user()->foto) }}" />
                                            @else
                                                <img alt="Logo"
                                                src="{{ asset('public/storage/images/user/user.png') }}" />
                                            @endif
                                        </div>
                                        <div class="d-flex flex-column">
                                            <div class="fw-bold d-flex align-items-center fs-5">
                                                {{ Auth::user()->name }}
                                                <span class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
                                                    @if (Auth::user()->id_priv == 1)
                                                        Admin
                                                    @else
                                                        User
                                                    @endif
                                                </span>
                                            </div>
                                            <a href="{{ url('user/profil') }}"
                                                class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="separator my-2"></div>
                                <div class="menu-item px-5 my-1">
                                    <a href="{{ url('user/profil') }}" class="menu-link px-5">Profil Saya</a>
                                </div>
                                <div class="menu-item px-5">
                                    <a href="{{ route('logout') }}" class="menu-link px-5">Logout</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">
                <div id="kt_header" class="header header-bg">
                    <div class="container-fluid">
                        <div class="header-brand me-5">
                            <div class="d-flex align-items-center d-lg-none ms-n2 me-2" title="Show aside menu">
                                <div class="btn btn-icon btn-color-white btn-active-color-primary w-30px h-30px"
                                    id="kt_aside_toggle">
                                    <i class="ki-duotone ki-abstract-14 fs-1">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </div>
                            </div>
                            <a href="{{ url('dashboard') }}">
                                <img alt="Logo" src="{{ asset('public/logo3.png') }}"
                                    class="h-25px h-lg-50px d-none d-md-block" />
                                <img alt="Logo" src="{{ asset('public/logo3.png') }}"
                                    class="h-25px d-block d-md-none" />
                            </a>
                            <h1 class="text-white ms-2 mt-2">SIGEMA</h1>
                        </div>
                        <div class="topbar d-flex align-items-stretch">
                            <div class="d-flex align-items-stretch me-2 me-lg-4">
                                <div id="kt_header_search"
                                    class="header-search d-flex align-items-center header-search w-lg-250px"
                                    data-kt-search-keypress="true" data-kt-search-min-length="2"
                                    data-kt-search-enter="enter" data-kt-search-layout="menu"
                                    data-kt-search-responsive="lg" data-kt-menu-trigger="auto"
                                    data-kt-menu-permanent="true" data-kt-menu-placement="bottom-end">
                                    <div data-kt-search-element="toggle"
                                        class="search-toggle-mobile d-flex d-lg-none align-items-center">
                                        <div
                                            class="d-flex btn btn-icon btn-borderless btn-color-white btn-active-primary bg-white bg-opacity-10">
                                            <i class="ki-duotone ki-magnifier fs-1 text-white">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </div>
                                    </div>
                                    <form data-kt-search-element="form"
                                        class="d-none d-lg-block w-100 position-relative mb-2 mb-lg-0"
                                        autocomplete="off">
                                        <input type="hidden" />
                                        <i
                                            class="ki-duotone ki-magnifier fs-2 position-absolute top-50 translate-middle-y ms-0 ms-lg-4">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>
                                        <input type="text" class="form-control form-control-flush ps-8 ps-lg-12"
                                            name="search" value="" placeholder="Cari"
                                            data-kt-search-element="input" id="searchInput" />
                                        <span
                                            class="position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-lg-5"
                                            data-kt-search-element="spinner">
                                            <span
                                                class="spinner-border h-15px w-15px align-middle text-gray-400"></span>
                                        </span>
                                        <span
                                            class="btn btn-flush btn-active-color-primary position-absolute top-50 end-0 translate-middle-y lh-0 d-none me-lg-4"
                                            data-kt-search-element="clear">
                                            <i class="ki-duotone ki-cross fs-2 fs-lg-1 me-0">
                                                <span class="path1"></span>
                                                <span class="path2"></span>
                                            </i>
                                        </span>
                                    </form>
                                    <div data-kt-search-element="content"
                                        class="menu menu-sub menu-sub-dropdown py-7 px-7 overflow-hidden w-300px w-md-350px">
                                        <div data-kt-search-element="wrapper">
                                            <div data-kt-search-element="results" class="d-none" id="hasil_cari">
                                                <div class="scroll-y mh-200px mh-lg-350px">
                                                    <h3 class="fs-5 text-muted m-0 pt-5 pb-5"
                                                        data-kt-search-element="category-title">Daftar Pencarian:</h3>
                                                    <a href="{{ url('dashboard') }}" id="hasil_cari1"
                                                        data-label="Beranda"
                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5 search-item">
                                                        <div class="symbol symbol-40px me-4">
                                                            <span class="symbol-label bg-light">
                                                                <i class="ki-duotone ki-home-3 fs-2 text-primary">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                    <span class="path6"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="fs-6 fw-semibold">Beranda</span>
                                                            {{-- <span class="fs-7 fw-semibold text-muted">#45670</span> --}}
                                                        </div>
                                                    </a>
                                                    <a href="{{ url('variabel') }}" id="hasil_cari2"
                                                        data-label="Variabel"
                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5 search-item">
                                                        <div class="symbol symbol-40px me-4">
                                                            <span class="symbol-label bg-light">
                                                                <i class="ki-duotone ki-element-8 fs-2 text-primary">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                    <span class="path6"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="fs-6 fw-semibold">Variabel</span>
                                                            {{-- <span class="fs-7 fw-semibold text-muted">#45690</span> --}}
                                                        </div>
                                                    </a>
                                                    <a href="{{ url('cluster') }}" id="hasil_cari3"
                                                        data-label="Clustering"
                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5 search-item">
                                                        <div class="symbol symbol-40px me-4">
                                                            <span class="symbol-label bg-light">
                                                                <i
                                                                    class="ki-duotone ki-graph fs-2 text-primary">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                    <span class="path6"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="fs-6 fw-semibold">Clustering</span>
                                                            {{-- <span class="fs-7 fw-semibold text-muted">#21090</span> --}}
                                                        </div>
                                                    </a>
                                                    <a href="{{ url('panduan') }}" id="hasil_cari4"
                                                        data-label="Panduan"
                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5 search-item">
                                                        <div class="symbol symbol-40px me-4">
                                                            <span class="symbol-label bg-light">
                                                                <i
                                                                    class="ki-duotone ki-question-2 fs-2 text-primary">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                    <span class="path6"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="fs-6 fw-semibold">Panduan</span>
                                                            {{-- <span class="fs-7 fw-semibold text-muted">#34560</span> --}}
                                                        </div>
                                                    </a>
                                                    <a href="{{ url('user') }}" id="hasil_cari5"
                                                        data-label="Pengguna"
                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5 search-item">
                                                        <div class="symbol symbol-40px me-4">
                                                            <span class="symbol-label bg-light">
                                                                <i
                                                                    class="ki-duotone ki-people fs-2 text-primary">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                    <span class="path6"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="fs-6 fw-semibold">Pengguna</span>
                                                            {{-- <span class="fs-7 fw-semibold text-muted">#34560</span> --}}
                                                        </div>
                                                    </a>
                                                    <a href="{{ url('log') }}" id="hasil_cari6"
                                                        data-label="Log Aktivitas"
                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5 search-item">
                                                        <div class="symbol symbol-40px me-4">
                                                            <span class="symbol-label bg-light">
                                                                <i
                                                                    class="ki-duotone ki-information-5 fs-2 text-primary">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                    <span class="path6"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="fs-6 fw-semibold">Log Aktivitas</span>
                                                            {{-- <span class="fs-7 fw-semibold text-muted">#34560</span> --}}
                                                        </div>
                                                    </a>
                                                    <a href="{{ url('logout') }}" id="hasil_cari7"
                                                        data-label="Logout"
                                                        class="d-flex text-dark text-hover-primary align-items-center mb-5 search-item">
                                                        <div class="symbol symbol-40px me-4">
                                                            <span class="symbol-label bg-light">
                                                                <i
                                                                    class="ki-duotone ki-exit-left fs-2 text-primary">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                    <span class="path6"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <span class="fs-6 fw-semibold">Logout</span>
                                                            {{-- <span class="fs-7 fw-semibold text-muted">#34560</span> --}}
                                                        </div>
                                                    </a>
                                                </div>
                                            </div>
                                            <div class="" data-kt-search-element="main" id="awal_cari">
                                                <div class="d-flex flex-stack fw-semibold mb-4">
                                                    <span class="text-muted fs-6 me-2">Daftar Pencarian:</span>
                                                </div>
                                                <div class="scroll-y mh-200px mh-lg-325px">
                                                    <div class="d-flex align-items-center mb-5">
                                                        <div class="symbol symbol-40px me-4">
                                                            <span class="symbol-label bg-light">
                                                                <i class="ki-duotone ki-home-3 fs-2 text-primary">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                    <span class="path6"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ url('dashboard') }}"
                                                                class="fs-6 text-gray-800 text-hover-primary fw-semibold">Beranda</a>
                                                            {{-- <span class="fs-7 text-muted fw-semibold">#45789</span> --}}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-5">
                                                        <div class="symbol symbol-40px me-4">
                                                            <span class="symbol-label bg-light">
                                                                <i
                                                                    class="ki-duotone ki-element-8 fs-2 text-primary">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                    <span class="path6"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ url('variabel') }}"
                                                                class="fs-6 text-gray-800 text-hover-primary fw-semibold">Variabel</a>
                                                            {{-- <span class="fs-7 text-muted fw-semibold">#84050</span> --}}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-5">
                                                        <div class="symbol symbol-40px me-4">
                                                            <span class="symbol-label bg-light">
                                                                <i class="ki-duotone ki-graph fs-2 text-primary">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                    <span class="path6"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ url('cluster') }}"
                                                                class="fs-6 text-gray-800 text-hover-primary fw-semibold">Clustering</a>
                                                            {{-- <span class="fs-7 text-muted fw-semibold">#84250</span> --}}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-5">
                                                        <div class="symbol symbol-40px me-4">
                                                            <span class="symbol-label bg-light">
                                                                <i
                                                                    class="ki-duotone ki-question-2 fs-2 text-primary">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                    <span class="path6"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ url('panduan') }}"
                                                                class="fs-6 text-gray-800 text-hover-primary fw-semibold">Panduan</a>
                                                            {{-- <span class="fs-7 text-muted fw-semibold">#67945</span> --}}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-5">
                                                        <div class="symbol symbol-40px me-4">
                                                            <span class="symbol-label bg-light">
                                                                <i class="ki-duotone ki-people fs-2 text-primary">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                    <span class="path6"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ url('user') }}"
                                                                class="fs-6 text-gray-800 text-hover-primary fw-semibold">Pengguna</a>
                                                            {{-- <span class="fs-7 text-muted fw-semibold">#84250</span> --}}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-5">
                                                        <div class="symbol symbol-40px me-4">
                                                            <span class="symbol-label bg-light">
                                                                <i class="ki-duotone ki-information-5 fs-2 text-primary">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                    <span class="path6"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ url('log') }}"
                                                                class="fs-6 text-gray-800 text-hover-primary fw-semibold">Log
                                                                Aktivitas</a>
                                                            {{-- <span class="fs-7 text-muted fw-semibold">#45690</span> --}}
                                                        </div>
                                                    </div>
                                                    <div class="d-flex align-items-center mb-5">
                                                        <div class="symbol symbol-40px me-4">
                                                            <span class="symbol-label bg-light">
                                                                <i
                                                                    class="ki-duotone ki-exit-left fs-2 text-primary">
                                                                    <span class="path1"></span>
                                                                    <span class="path2"></span>
                                                                    <span class="path3"></span>
                                                                    <span class="path4"></span>
                                                                    <span class="path5"></span>
                                                                    <span class="path6"></span>
                                                                </i>
                                                            </span>
                                                        </div>
                                                        <div class="d-flex flex-column">
                                                            <a href="{{ url('logout') }}"
                                                                class="fs-6 text-gray-800 text-hover-primary fw-semibold">Logout</a>
                                                            {{-- <span class="fs-7 text-muted fw-semibold">#24005</span> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div data-kt-search-element="empty" class="text-center d-none">
                                                <div class="pt-10 pb-10">
                                                    <i class="ki-duotone ki-search-list fs-4x opacity-50">
                                                        <span class="path1"></span>
                                                        <span class="path2"></span>
                                                        <span class="path3"></span>
                                                    </i>
                                                </div>
                                                <div class="pb-15 fw-semibold">
                                                    <h3 class="text-gray-600 fs-5 mb-2">Tidak ada hasil yang ditemukan
                                                    </h3>
                                                    <div class="text-muted fs-7">Silakan coba lagi dengan kata kunci
                                                        lain</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center me-2 me-lg-4">
                                <a href="#"
                                    class="btn btn-icon btn-borderless btn-color-white btn-active-primary bg-white bg-opacity-10 position-relative"
                                    data-kt-menu-trigger="click" data-kt-menu-attach="parent"
                                    data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-user fs-1 text-white">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                    <span
                                        class="bullet bullet-dot bg-success h-6px w-6px position-absolute translate-middle top-0 start-50 animation-blink"></span>
                                </a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-800 menu-state-bg menu-state-color fw-semibold py-4 fs-6 w-275px"
                                    data-kt-menu="true">
                                    <div class="menu-item px-3">
                                        <div class="menu-content d-flex align-items-center px-3">
                                            <div class="symbol symbol-50px me-5">
                                                @if (Auth::user()->foto)
                                                    <img alt="Logo"
                                                        src="{{ asset('public/storage/images/user/' . Auth::user()->foto) }}" />
                                                @else
                                                    <img alt="Logo"
                                                        src="{{ asset('public/storage/images/user/user.png') }}" />
                                                @endif
                                            </div>
                                            <div class="d-flex flex-column">
                                                <div class="fw-bold d-flex align-items-center fs-5">
                                                    {{ Auth::user()->name }}
                                                    <span
                                                        class="badge badge-light-success fw-bold fs-8 px-2 py-1 ms-2">
                                                        @if (Auth::user()->id_priv == 1)
                                                            Admin
                                                        @else
                                                            User
                                                        @endif
                                                    </span>
                                                </div>
                                                <a href="{{ url('user/profil') }}"
                                                    class="fw-semibold text-muted text-hover-primary fs-7">{{ Auth::user()->email }}</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="separator my-2"></div>
                                    <div class="menu-item px-5 my-1">
                                        <a href="{{ url('user/profil') }}" class="menu-link px-5">Profil Saya</a>
                                    </div>
                                    <div class="menu-item px-5">
                                        <a href="{{ route('logout') }}" class="menu-link px-5">Logout</a>
                                    </div>
                                </div>
                            </div>
                            <div class="d-flex align-items-center me-2 me-lg-4">
                                <a href="#"
                                    class="btn btn-icon btn-borderless btn-color-white btn-active-primary bg-white bg-opacity-10"
                                    data-kt-menu-trigger="{default:'click', lg: 'hover'}" data-kt-menu-attach="parent"
                                    data-kt-menu-placement="bottom-end">
                                    <i class="ki-duotone ki-night-day theme-light-show fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                        <span class="path3"></span>
                                        <span class="path4"></span>
                                        <span class="path5"></span>
                                        <span class="path6"></span>
                                        <span class="path7"></span>
                                        <span class="path8"></span>
                                        <span class="path9"></span>
                                        <span class="path10"></span>
                                    </i>
                                    <i class="ki-duotone ki-moon theme-dark-show fs-2">
                                        <span class="path1"></span>
                                        <span class="path2"></span>
                                    </i>
                                </a>
                                <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-title-gray-700 menu-icon-gray-500 menu-active-bg menu-state-color fw-semibold py-4 fs-base w-150px"
                                    data-kt-menu="true" data-kt-element="theme-mode-menu">
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                            data-kt-value="light">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-duotone ki-night-day fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                    <span class="path5"></span>
                                                    <span class="path6"></span>
                                                    <span class="path7"></span>
                                                    <span class="path8"></span>
                                                    <span class="path9"></span>
                                                    <span class="path10"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Terang</span>
                                        </a>
                                    </div>
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                            data-kt-value="dark">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-duotone ki-moon fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Gelap</span>
                                        </a>
                                    </div>
                                    <div class="menu-item px-3 my-0">
                                        <a href="#" class="menu-link px-3 py-2" data-kt-element="mode"
                                            data-kt-value="system">
                                            <span class="menu-icon" data-kt-element="icon">
                                                <i class="ki-duotone ki-screen fs-2">
                                                    <span class="path1"></span>
                                                    <span class="path2"></span>
                                                    <span class="path3"></span>
                                                    <span class="path4"></span>
                                                </i>
                                            </span>
                                            <span class="menu-title">Sistem</span>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
                    <div class="toolbar d-flex flex-stack mb-3 mb-lg-5" id="kt_toolbar">
                        <div id="kt_toolbar_container" class="container-fluid d-flex flex-stack flex-wrap">

                            @yield('breadcrumb')

                        </div>
                    </div>
                    <div class="post d-flex flex-column-fluid" id="kt_post">
                        <div id="kt_content_container" class="container-xxl">

                            @yield('konten')

                        </div>
                    </div>
                </div>
                <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
                    <div
                        class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
                        <div class="text-dark order-2 order-md-1">
                            <span class="text-muted fw-semibold me-1">{{ date('Y') }}&copy;</span>
                            <a href="" target="_blank" class="text-gray-800 text-hover-primary">SIGEMA</a>
                        </div>
                        <ul class="menu menu-gray-600 menu-hover-primary fw-semibold order-1">
                            <li class="menu-item">
                                <a href="{{ url('panduan') }}" target="_blank" class="menu-link px-2">Panduan</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ url('user') }}" target="_blank" class="menu-link px-2">Pengguna</a>
                            </li>
                            <li class="menu-item">
                                <a href="{{ url('log') }}" target="_blank" class="menu-link px-2">Log
                                    Aktivitas</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="kt_scrolltop" class="scrolltop" data-kt-scrolltop="true">
        <i class="ki-duotone ki-arrow-up">
            <span class="path1"></span>
            <span class="path2"></span>
        </i>
    </div>

    @yield('modal')
    
    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{ asset('public/assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/js/scripts.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/custom/datatables/datatables.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/plugins/custom/formrepeater/formrepeater.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/js/custom/utilities/modals/create-account.js') }}"></script>
    <script src="{{ asset('public/assets/js/custom/apps/ecommerce/settings/settings.js') }}"></script>
    {{-- <script src="{{ asset('public/assets/js/custom/apps/ecommerce/catalog/save-product.js') }}"></script> --}}
    <script src="{{ asset('public/assets/js/widgets.bundle.js') }}"></script>
    <script src="{{ asset('public/assets/js/custom/widgets.js') }}"></script>
    <script src="{{ asset('public/assets/js/custom/apps/chat/chat.js') }}"></script>
    <script src="{{ asset('public/assets/js/custom/utilities/modals/upgrade-plan.js') }}"></script>
    <script src="{{ asset('public/assets/js/custom/utilities/modals/create-campaign.js') }}"></script>
    <script src="{{ asset('public/assets/js/custom/utilities/modals/create-app.js') }}"></script>
    <script src="{{ asset('public/assets/js/custom/utilities/modals/users-search.js') }}"></script>
    <script src="{{ asset('public/assets/js/custom/apps/ecommerce/settings/settings.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const searchInput = document.getElementById('searchInput');
            const searchResults = document.querySelectorAll('.search-item');
            const noResultsMessage = document.querySelector('[data-kt-search-element="empty"]');

            searchInput.addEventListener('input', function() {
                const searchTerm = searchInput.value.trim().toLowerCase();
                let hasResults = false;

                searchResults.forEach(function(result) {
                    const label = result.getAttribute('data-label')
                .toLowerCase(); // Ambil label dari data-label
                    const isVisible = label.includes(searchTerm);

                    if (isVisible) {
                        result.classList.remove('d-none'); // Tampilkan elemen hasil pencarian
                        hasResults = true;
                    } else {
                        result.classList.add('d-none'); // Sembunyikan elemen yang tidak sesuai
                    }
                });

                if (!hasResults) {
                    noResultsMessage.classList.remove(
                    'd-none'); // Tampilkan pesan "Tidak ada hasil yang ditemukan"
                } else {
                    noResultsMessage.classList.add(
                    'd-none'); // Sembunyikan pesan "Tidak ada hasil yang ditemukan"
                }
            });
        });
    </script>
    @yield('script')
</body>

</html>
