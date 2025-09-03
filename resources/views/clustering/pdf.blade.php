<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $data->judul }}</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        h1, h2, h3 { text-align: center; }
        .page-break { page-break-after: always; }
    </style>
</head>
<body>
    <h1>{{ $data->judul }}</h1>
    <p>Periode: {{ $data->periode }}</p>

    <!-- Iterasi 1 -->
    <div>
        <h2>Iterasi 1</h2>
        {!! $allData['iterasi1'] !!}
    </div>
    <div class="page-break"></div>

    <!-- Iterasi 2 sampai maksimal -->
    @for ($i = 2; $i <= $data->maksimal_iterasi; $i++)
        @if (isset($allData['iterasi'.$i]))
            <div>
                <h2>Iterasi {{ $i }}</h2>
                {!! $allData['iterasi'.$i] !!}
            </div>
            <div class="page-break"></div>
        @endif
    @endfor

    <!-- Cek -->
    <div>
        <h2>Cek</h2>
        {!! $allData['cek'] !!}
    </div>
</body>
</html>