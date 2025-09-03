@extends('master')
@section('judul', 'Hasil Pengelompokan')
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

@section('css')
@endsection
@section('konten')
    <div class="card card-flush">
        <div class="card-body" style="overflow: visible;">
            <ul class="nav nav-tabs nav-line-tabs nav-line-tabs-2x border-transparent fs-4 fw-semibold mb-15 sticky-nav">
                <li class="nav-item">
                    <a class="nav-link text-active-primary d-flex align-items-center pb-5 active" data-bs-toggle="tab"
                        href="#iterasi1">
                        <i class="ki-duotone ki-arrows-loop fs-2 me-2">
                            <span class="path1"></span>
                            <span class="path2"></span>
                            <span class="path3"></span>
                            <span class="path4"></span>
                            <span class="path5"></span>
                        </i>Iterasi 1</a>
                </li>
                @for ($x = 2; $x <= $maksimalIterasi; $x++)
                    <li class="nav-item" id="iterasiTab{{ $x }}">
                        <a class="nav-link text-active-primary d-flex align-items-center pb-5" data-bs-toggle="tab"
                            href="#iterasi{{ $x }}">
                            <i class="ki-duotone ki-arrows-loop fs-2 me-2">
                                <span class="path1"></span>
                                <span class="path2"></span>
                                <span class="path3"></span>
                                <span class="path4"></span>
                                <span class="path5"></span>
                            </i>Iterasi {{ $x }}</a>
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
                <div class="tab-pane fade show active" id="iterasi1" role="tabpanel">
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
                                                {{-- @dd($uikRandom1) --}}
                                                @foreach ($uikRandom1 as $index => $row)
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
                                                @foreach ($uikSquared1 as $index => $row)
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
                                                        foreach ($uikSquared1 as $row) {
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

                    @foreach ($uikClusters1 as $clusterIndex => $clusterData)
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
                                                @foreach ($columnTotalsClusters1[$clusterIndex] as $total)
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
                                                        @if ($i < count($columnTotalsClusters1) && $i < count($columnTotalsSquared))
                                                            {{ number_format($columnTotalsClusters1[$i][$j] / $columnTotalsSquared[$i], 4) }}
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

                    @foreach ($uikClusters1 as $clusterIndex => $clusterData)
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
                                                                    $columnTotalsClusters1[$clusterIndex][
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
                                @php
                                    // Inisialisasi $p0Totals sebagai array
                                    $p0Totals[1] = [];
                                @endphp
                                @foreach ($uikClusters1 as $clusterIndex => $clusterData)
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
                                                                $uikW = $uikSquared1[$rowIndex][$clusterIndex]; // Get Uik^w from uikSquared
                                                                // Calculate total objective function value for this cluster
                                                                foreach ($row as $dataIndex => $value) {
                                                                    if ($dataIndex > 0) {
                                                                        // Ignore "No." column
                                                                        $centerValue = number_format(
                                                                            $columnTotalsClusters1[$clusterIndex][
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
                                                                $p0Totals[1][$rowIndex] =
                                                                    ($p0Totals[1][$rowIndex] ?? 0) + $p0;
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
                                                @foreach ($p0Totals[1] as $total)
                                                    <tr>
                                                        <td class="text-dark text-hover-primary mb-1 fs-6 text-center">
                                                            {{ number_format($total, 4) }}</td>
                                                    </tr>
                                                @endforeach
                                                <tr>
                                                    <td class="text-dark text-hover-primary mb-1 fs-6 text-center">
                                                        <strong>{{ number_format(array_sum($p0Totals[1]), 4) }}</strong>
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
                                                @foreach ($uikClusters1 as $clusterIndex => $clusterData)
                                                    @php
                                                        $totalObjective = 0;
                                                        foreach ($row as $dataIndex => $value) {
                                                            if ($dataIndex > 0) {
                                                                // Ignore "No." column
                                                                $centerValue = number_format(
                                                                    $columnTotalsClusters1[$clusterIndex][
                                                                        $dataIndex - 1
                                                                    ] / $columnTotalsSquared[$clusterIndex],
                                                                    4,
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
                                                    @if ($clusterTotal == max($uikBaru))
                                                        <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                            <strong>{{ number_format($clusterTotal / $totalUikBaru, 4) }}</strong>
                                                        </td>
                                                    @else
                                                        <td class="text-dark text-hover-primary mb-1 fs-6">
                                                            {{ number_format($clusterTotal / $totalUikBaru, 4) }}
                                                        </td>
                                                    @endif
                                                @endforeach
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    {{-- @dd($uikRandom, $uikBaru1) --}}
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                @foreach ($allData as $x => $iter)
                    @if ($x != 1)
                        {{-- Skip jika iterasi adalah 1 --}}
                        <div class="tab-pane fade" id="iterasi{{ $x }}" role="tabpanel">
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
                                                        <th class="ps-4 min-w-40px rounded-start align-middle">
                                                            {{ $column }}
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
                                                                <td
                                                                    class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
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
                                        <div class="row">
                                            <div class="col-6">
                                                @foreach ($variabels as $v)
                                                    <p>- {{ $v->nama }} = {{ $v->deskripsi }}</p>
                                                @endforeach
                                            </div>
                                            <div class="col-6">
                                                <p>- Jumlah Data = {{ count($data[0]) }}</p>
                                                <p>- C = Cluster / Kelompok</p>
                                                <p>- Jumlah Cluster (c) = {{ $jumlahCluster }}</p>
                                                <p>- Pembobot (w) = {{ $pembobot }}</p>
                                                <p>- Nilai error (e) = {{ number_format($nilaiError, 2) }}</p>
                                                <p class="maxIterText">- Maksimal Iterasi (maxiter) =
                                                    {{ $maksimalIterasi }}</p>
                                                <p>- PO = {{ $x - 1 }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="card mb-5 mb-xl-8">
                                <div class="card-body py-3">
                                    <div class="row">
                                        <div class="col-6">
                                            <div class="table-responsive">
                                                <h3 style="text-align: center;">Tabel UIK</h3>
                                                <table
                                                    class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                                    <thead>
                                                        <tr class="fw-bold text-muted bg-light">
                                                            <th class="ps-4 min-w-40px rounded-start">Data Ke-</th>
                                                            @for ($i = 1; $i <= $jumlahCluster; $i++)
                                                                <th>C{{ $i }}</th>
                                                            @endfor
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($iter['uikRandom'] as $index => $row)
                                                            <tr>
                                                                <td
                                                                    class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                                    {{ $index + 1 }}
                                                                </td>
                                                                @foreach ($row as $value)
                                                                    <td class="text-dark text-hover-primary mb-1 fs-6">
                                                                        {{ number_format($value, 4) }}</td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="col-6">
                                            <div class="table-responsive">
                                                <h3 style="text-align: center;">Tabel UIK^{{ $pembobot }}</h3>
                                                <table
                                                    class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                                    <thead>
                                                        <tr class="fw-bold text-muted bg-light">
                                                            <th class="ps-4 min-w-40px rounded-start">Data Ke-</th>
                                                            @for ($i = 1; $i <= $jumlahCluster; $i++)
                                                                <th>C{{ $i }}^{{ $pembobot }}</th>
                                                            @endfor
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($iter['uikSquared'] as $index => $row)
                                                            <tr>
                                                                <td
                                                                    class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                                    {{ $index + 1 }}
                                                                </td>
                                                                @foreach ($row as $value)
                                                                    <td class="text-dark text-hover-primary mb-1 fs-6">
                                                                        {{ number_format($value, 4) }}
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td
                                                                class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                                <strong>Total</strong>
                                                            </td>
                                                            @php
                                                                $columnTotalsSquared = array_fill(0, $jumlahCluster, 0);
                                                                foreach ($iter['uikSquared'] as $row) {
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

                            @foreach ($iter['uikClusters'] as $clusterIndex => $clusterData)
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
                                                            <td
                                                                class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
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
                                                        @foreach ($iter['columnTotalsClusters'][$clusterIndex] as $total)
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
                                                                @if ($i < count($iter['columnTotalsClusters']) && $i < count($columnTotalsSquared))
                                                                    {{ number_format($iter['columnTotalsClusters'][$i][$j] / $columnTotalsSquared[$i], 4) }}
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

                            @foreach ($iter['uikClusters'] as $clusterIndex => $clusterData)
                                <div class="card mb-5 mb-xl-8">
                                    <div class="card-body py-3">
                                        <div class="table-responsive">
                                            <h3 style="text-align: center;">Tabel Fungsi Objektif Cluster
                                                {{ $clusterIndex + 1 }}
                                            </h3>
                                            <table class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                                <thead>
                                                    <tr class="fw-bold text-muted bg-light">
                                                        <th class="ps-4 min-w-40px rounded-start">Data Ke-</th>
                                                        @for ($i = 1; $i <= count($header) - 1; $i++)
                                                            <th class="min-w-100px">
                                                                (X{{ $i }}-Vkj{{ $i }})
                                                                ^2</th>
                                                        @endfor
                                                        <th class="min-w-100px"><strong>Total</strong></th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach ($data[0] as $rowIndex => $row)
                                                        <tr>
                                                            <td
                                                                class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                                {{ $rowIndex + 1 }}
                                                            </td>
                                                            @php $rowTotal = 0; @endphp
                                                            @foreach ($row as $dataIndex => $value)
                                                                @if ($dataIndex > 0)
                                                                    {{-- Mengabaikan kolom "No." --}}
                                                                    @php
                                                                        $centerValue = number_format(
                                                                            $iter['columnTotalsClusters'][
                                                                                $clusterIndex
                                                                            ][$dataIndex - 1] /
                                                                                $columnTotalsSquared[$clusterIndex],
                                                                            4,
                                                                        );
                                                                        $diffSquared = pow(
                                                                            ($scales[$header[$dataIndex]][$value] ??
                                                                                0) -
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
                                        @php
                                            // Inisialisasi $p0Totals sebagai array
                                            $p0Totals[$x] = [];
                                        @endphp
                                        @foreach ($iter['uikClusters'] as $clusterIndex => $clusterData)
                                            <div class="col-3">
                                                <div class="table-responsive">
                                                    <h3 style="text-align: center;">Tabel Cluster {{ $clusterIndex + 1 }}
                                                    </h3>
                                                    <table
                                                        class="table table-row-bordered border rounded align-middle gs-0 gy-4">
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
                                                                        $uikW =
                                                                            $iter['uikSquared'][$rowIndex][
                                                                                $clusterIndex
                                                                            ]; // Get Uik^w from uikSquared
                                                                        // Calculate total objective function value for this cluster
                                                                        foreach ($row as $dataIndex => $value) {
                                                                            if ($dataIndex > 0) {
                                                                                $centerValue = number_format(
                                                                                    $iter['columnTotalsClusters'][
                                                                                        $clusterIndex
                                                                                    ][$dataIndex - 1] /
                                                                                        $columnTotalsSquared[
                                                                                            $clusterIndex
                                                                                        ],
                                                                                    4,
                                                                                );
                                                                                $diffSquared = pow(
                                                                                    ($scales[$header[$dataIndex]][
                                                                                        $value
                                                                                    ] ??
                                                                                        0) -
                                                                                        $centerValue,
                                                                                    2,
                                                                                );
                                                                                $totalObjective += $diffSquared;
                                                                            }
                                                                        }
                                                                        $p0 = $totalObjective * $uikW;
                                                                        $p0Totals[$x][$rowIndex] =
                                                                            ($p0Totals[$x][$rowIndex] ?? 0) + $p0;
                                                                    @endphp
                                                                    <td
                                                                        class="ps-4 text-dark text-hover-primary mb-1 fs-6">
                                                                        {{ number_format($totalObjective, 4) }}</td>
                                                                    <td class="text-dark text-hover-primary mb-1 fs-6">
                                                                        {{ number_format($uikW, 4) }}</td>
                                                                    <td class="text-dark text-hover-primary mb-1 fs-6">
                                                                        <strong>{{ number_format($p0, 4) }}</strong>
                                                                    </td>
                                                                </tr>
                                                            @endforeach
                                                            {{-- @dd($totalObjective, $diffSquared, $centerValue, $uikW, $p0); --}}
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        @endforeach
                                        <div class="col-3">
                                            <div class="table-responsive">
                                                <h3 style="text-align: center;">Total P0</h3>
                                                <table
                                                    class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                                    <thead>
                                                        <tr class="fw-bold text-muted bg-light text-center">
                                                            <th class="min-w-100px rounded-start">Total</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach ($p0Totals[$x] as $total)
                                                            <tr>
                                                                <td
                                                                    class="text-dark text-hover-primary mb-1 fs-6 text-center">
                                                                    {{ number_format($total, 4) }}</td>
                                                            </tr>
                                                        @endforeach
                                                        <tr>
                                                            <td class="text-dark text-hover-primary mb-1 fs-6 text-center">
                                                                <strong>{{ number_format(array_sum($p0Totals[$x]), 4) }}</strong>
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
                                                        $maxColumn = '';
                                                        $maxValue = -INF;
                                                    @endphp
                                                    <tr>
                                                        <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                            {{ $rowIndex + 1 }}</td>
                                                        @foreach ($iter['uikClusters'] as $clusterIndex => $clusterData)
                                                            @php
                                                                $totalObjective = 0;
                                                                foreach ($row as $dataIndex => $value) {
                                                                    if ($dataIndex > 0) {
                                                                        $centerValue = number_format(
                                                                            $iter['columnTotalsClusters'][
                                                                                $clusterIndex
                                                                            ][$dataIndex - 1] /
                                                                                $columnTotalsSquared[$clusterIndex],
                                                                            4,
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
                                                                $uikBaru[$clusterIndex] = $totalObjective;
                                                                $totalUikBaru += $totalObjective;
                                                                if ($totalObjective > $maxValue) {
                                                                    $maxValue = $totalObjective;
                                                                    $maxColumn = 'C' . ($clusterIndex + 1);
                                                                }
                                                            @endphp
                                                        @endforeach
                                                        <td class="text-dark text-hover-primary mb-1 fs-6">
                                                            {{ number_format($totalUikBaru, 4) }}</td>
                                                        @foreach ($uikBaru as $clusterTotal)
                                                            @if ($clusterTotal == max($uikBaru))
                                                                <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                                    <strong>{{ number_format($clusterTotal / $totalUikBaru, 4) }}</strong>
                                                                </td>
                                                            @else
                                                                <td class="text-dark text-hover-primary mb-1 fs-6">
                                                                    {{ number_format($clusterTotal / $totalUikBaru, 4) }}
                                                                </td>
                                                            @endif
                                                        @endforeach
                                                        @php
                                                            // if ($x == $z) {
                                                                $maxColumnsList[$x][] = $maxColumn; // Menyimpan $maxColumn jika $x == $z
                                                            // }
                                                        @endphp
                                                        {{-- <td class="text-dark text-hover-primary mb-1 fs-6">
                                                            {{ $maxColumn }}
                                                        </td> --}}
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                @endforeach
                {{-- @dd($p0Totals[1]); --}}
                {{-- @dd($maxColumnsList, $finalIterationValue); --}}

                <div class="tab-pane fade" id="cek" role="tabpanel">
                    <div class="card mb-5 mb-xl-8">
                        <div class="card-header border-0 pt-5">
                            <h1 class="card-title align-items-start flex-column">
                                <span class="card-label fw-bold fs-3 mb-1">{{ $judul }}</span>
                                <span class="text-muted mt-1 fw-semibold fs-7">Periode: {{ $periode }}</span>
                            </h1>
                        </div>
                        <div class="card-body py-3">
                            <div class="table-responsive">
                                <h3 style="text-align: center;">Tabel Cek</h3>
                                <table class="table table-row-bordered border rounded align-middle gs-0 gy-4">
                                    <thead>
                                        <tr class="fw-bold text-muted bg-light">
                                            <th class="ps-4 min-w-40px rounded-start align-middle">Iterasi ke-</th>
                                            <th class="min-w-100px">P Total</th>
                                            <th class="min-w-100px">Error</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="ps-4 text-dark text-hover-primary mb-1 fs-6">
                                                1
                                            </td>
                                            <td class="text-dark text-hover-primary mb-1 fs-6">
                                                {{ number_format(array_sum($p0Totals[1]), 4) }}
                                            </td>
                                            <td class="text-dark text-hover-primary mb-1 fs-6">
                                                {{-- Biarkan kosong untuk iterasi pertama --}}
                                            </td>
                                        </tr>
                                        @php
                                            $previousPTotal = array_sum($p0Totals[1]);
                                            $stopDueToError = false; // Flag to check if loop stopped due to error condition
                                        @endphp
                                        <script>
                                            var lastZ = 0; // Variabel untuk menyimpan nilai $z terakhir
                                        </script>
                                        @for ($z = 2; $z <= $maksimalIterasi; $z++)
                                            @php
                                                $currentPTotal = array_sum($p0Totals[$z] ?? []);
                                                $difference = $previousPTotal - $currentPTotal;
                                            @endphp
                                            <tr>
                                                <td class="ps-4 text-dark text-hover-primary mb-1 fs-6">
                                                    {{ $z }}</td>
                                                <td class="text-dark text-hover-primary mb-1 fs-6">
                                                    {{ number_format($currentPTotal, 4) }}</td>
                                                <td class="text-dark text-hover-primary mb-1 fs-6">
                                                    {{ number_format($difference, 4) }}
                                                </td>
                                            </tr>
                                            <script>
                                                lastZ = {{ $z }}; // Update nilai lastZ setiap iterasi
                                            </script>
                                            @if ($difference < $nilaiError)
                                                @php $stopDueToError = true; @endphp
                                            @break
                                        @endif
                                        @php $previousPTotal = $currentPTotal; @endphp
                                    @endfor
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-4">
                            @if ($stopDueToError)
                                <p class="text-success">Nilai ini telah melebihi batas minimal error yakni
                                    <strong>{{ $nilaiError }}</strong> pada penentuan inisial pada awal clustering,
                                    maka iterasi dapat dihentikan.
                                </p>
                            @else
                                <p class="text-danger">Iterasi mencapai maksimal yaitu
                                    <strong>{{ $maksimalIterasi }}</strong> iterasi, tanpa memenuhi kriteria error.
                                </p>
                            @endif
                        </div>
                    </div>
                    @foreach ($allData as $x => $iter)
                        @if ($x == $z)
                            <div class="card-body py-3">
                                {{-- <div class="table-responsive">
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
                                                    $maxColumn = '';
                                                    $maxValue = -INF;
                                                @endphp
                                                <tr>
                                                    <td class="ps-4 text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                        {{ $rowIndex + 1 }}</td>
                                                    @foreach ($iter['uikClusters'] as $clusterIndex => $clusterData)
                                                        @php
                                                            $totalObjective = 0;
                                                            foreach ($row as $dataIndex => $value) {
                                                                if ($dataIndex > 0) {
                                                                    $centerValue = number_format(
                                                                        $iter['columnTotalsClusters'][
                                                                            $clusterIndex
                                                                        ][$dataIndex - 1] /
                                                                            $columnTotalsSquared[$clusterIndex],
                                                                        4,
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
                                                            $uikBaru[$clusterIndex] = $totalObjective;
                                                            $totalUikBaru += $totalObjective;
                                                            if ($totalObjective > $maxValue) {
                                                                $maxValue = $totalObjective;
                                                                $maxColumn = 'C' . ($clusterIndex + 1);
                                                            }
                                                        @endphp
                                                    @endforeach
                                                    <td class="text-dark text-hover-primary mb-1 fs-6">
                                                        {{ number_format($totalUikBaru, 4) }}</td>
                                                    @foreach ($uikBaru as $clusterTotal)
                                                        @if ($clusterTotal == max($uikBaru))
                                                            <td class="text-dark fw-bold text-hover-primary mb-1 fs-6">
                                                                <strong>{{ number_format($clusterTotal / $totalUikBaru, 4) }}</strong>
                                                            </td>
                                                        @else
                                                            <td class="text-dark text-hover-primary mb-1 fs-6">
                                                                {{ number_format($clusterTotal / $totalUikBaru, 4) }}
                                                            </td>
                                                        @endif
                                                    @endforeach
                                                    @php
                                                        if ($x == $finalIterationValue) {
                                                            $maxColumnsList[] = $maxColumn; // Menyimpan $maxColumn jika $x == $z
                                                        }
                                                    @endphp
                                                    <td class="text-dark text-hover-primary mb-1 fs-6">
                                                        {{ $maxColumn }}
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div> --}}
                                <div class="table-responsive">
                                    <h3 style="text-align: center;">Tabel Keanggotaan Akhir</h3>
                                    @php
                                        $groupedData = [];
                                        foreach ($data[0] as $rowIndex => $row) {
                                            $cluster = $maxColumnsList[$z][$rowIndex];
                                            $clusterNumber = (int)substr($cluster, 1); // Mengubah 'C1' menjadi 1
                                            if (!isset($groupedData[$clusterNumber])) {
                                                $groupedData[$clusterNumber] = [];
                                            }
                                            $groupedData[$clusterNumber][] = array_slice($row, 1); // Menghapus elemen pertama
                                        }
                                        ksort($groupedData); // Mengurutkan array berdasarkan nomor kelompok
                                    @endphp
                                
                                    @foreach ($groupedData as $clusterNumber => $clusterData)
                                        @php
                                            $kelompok = "Kelompok " . $clusterNumber;
                                        @endphp
                                        <h4>{{ $kelompok }}</h4>
                                        <table class="table table-row-bordered border rounded align-middle gs-0 gy-4 mb-5">
                                            <thead>
                                                <tr class="fw-bold text-muted bg-light">
                                                    <th class="ps-4 min-w-40px rounded-start align-middle">No.</th>
                                                    @foreach (array_slice($header, 1) as $column)
                                                        <th class="ps-4 min-w-40px rounded-start align-middle">
                                                            {{ $column }}
                                                        </th>
                                                    @endforeach
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($clusterData as $index => $row)
                                                    <tr>
                                                        <td class="ps-4 text-dark text-hover-primary mb-1 fs-6">
                                                            {{ $index + 1 }}
                                                        </td>
                                                        @foreach ($row as $value)
                                                            <td class="ps-4 text-dark text-hover-primary mb-1 fs-6">
                                                                {{ $value }}
                                                            </td>
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    @endforeach
                                </div>
                                <div class="mt-4">
                                    <h4>Keterangan:</h4>
                                    <div class="row">
                                        <div class="col-6">
                                            @foreach ($variabels as $v)
                                                <p>- {{ $v->nama }} = {{ $v->deskripsi }}</p>
                                            @endforeach
                                        </div>
                                        <div class="col-6">
                                            <p>- Jumlah Data = {{ count($data[0]) }}</p>
                                            <p>- C = Cluster / Kelompok</p>
                                            <p>- Jumlah Cluster (c) = {{ $jumlahCluster }}</p>
                                            <p>- Pembobot (w) = {{ $pembobot }}</p>
                                            <p>- Nilai error (e) = {{ number_format($nilaiError, 2) }}</p>
                                            <p class="maxIterText">- Maksimal Iterasi (maxiter) =
                                                {{ $maksimalIterasi }}</p>
                                            <p>- PO = 0</p>
                                        </div>
                                    </div>
                                </div>
                                {{-- <div class="text-end">
                                    <button id="exportPDF" class="btn btn-primary">Export PDF</button>
                                </div> --}}
                            </div>
                            {{-- @dd($allData, $finalIterationValue, $allData[$finalIterationValue], $maxColumn); --}}
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script>
    $(document).ready(function() {
        var maksimalIterasi = {{ $maksimalIterasi }};
        for (var x = 2; x <= maksimalIterasi; x++) {
            if (x > lastZ) {
                $('#iterasi' + x).hide(); // Sembunyikan tab iterasi yang tidak perlu
                $('#iterasiTab' + x).hide();
                $('.maxIterText').text('- Maksimal Iterasi (maxiter) = ' + lastZ);
                $('#finalIterationValue').val(lastZ);

            }
        }
        $.ajax({
            url: '{{ route('store.value') }}',
            type: 'POST',
            data: {
                value: lastZ,
                _token: '{{ csrf_token() }}'
            },
            success: function(response) {
                console.log(response);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
</script>
@include('my_components.toastr')
@include('my_components.datatables')
@endsection
