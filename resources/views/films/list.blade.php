@extends('layouts.master')

@section('contenido')
<div class="container mt-4 text-center">
    <h1>{{$title}}</h1>

    @if(empty($films))
    <div class="alert alert-danger mt-4">
        No se ha encontrado ninguna película
    </div>
    @else
    <div class="table-responsive mt-4">
        <table style="border: 1px solid #dee2e6;" class="table text-center">
            <thead class="thead-dark">
                <tr>
                    @foreach($films[0] as $key => $value)
                    <th style="border: 1px solid #dee2e6; padding: 8px;">{{$key}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($films as $film)
                <tr>
                    <td style="border: 1px solid #dee2e6; padding: 8px;" class="align-middle">{{$film['name']}}</td>
                    <td style="border: 1px solid #dee2e6; padding: 8px;" class="align-middle">{{$film['year']}}</td>
                    <td style="border: 1px solid #dee2e6; padding: 8px;" class="align-middle">{{$film['genre']}}</td>
                    <td style="border: 1px solid #dee2e6; padding: 8px;" class="align-middle">{{$film['country']}}</td>
                    <td style="border: 1px solid #dee2e6; padding: 8px;" class="align-middle">{{$film['duration']}}</td>
                    <td style="border: 1px solid #dee2e6; padding: 8px;" class="align-middle"><img src="{{$film['img_url']}}" alt="{{$film['name']}}" style="width: 100px; height: 120px;"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection