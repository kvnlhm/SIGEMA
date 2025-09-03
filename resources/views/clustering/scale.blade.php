@extends('master')
@section('judul', 'Skala Frekuensi Variabel')

@section('konten')
<div class="card">
    <div class="card-body">
        <h3>Skala Frekuensi Variabel</h3>
        <table class="table">
            <thead>
                <tr>
                    <th>Variabel</th>
                    <th>Skala</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($scales as $variabel => $scale)
                <tr>
                    <td>{{ $variabel }}</td>
                    <td>{{ number_format($scale, 2) }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection

