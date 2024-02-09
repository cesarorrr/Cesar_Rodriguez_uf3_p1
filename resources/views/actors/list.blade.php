@extends('layouts.master')

@section('contenido')
<div class="container mt-4 text-center">
    <h1>{{$title}}</h1>

    @if(empty($actors))
    <div class="alert alert-danger mt-4">
        No se ha encontrado ninguna película
    </div>
    @else
    <div class="table-responsive mt-4">
        <table style="border: 1px solid #dee2e6;" class="table text-center">
            <thead class="thead-dark">
                <tr>
                    @foreach($actors[0] as $key => $value)
                    <th style="border: 1px solid #dee2e6; padding: 8px;">{{$key}}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($actors as $actor)
                <tr>
                    <td style="border: 1px solid #dee2e6; padding: 8px;" class="align-middle">{{$actor['name']}}</td>
                    <td style="border: 1px solid #dee2e6; padding: 8px;" class="align-middle">{{$actor['surname']}}</td>
                    <td style="border: 1px solid #dee2e6; padding: 8px;" class="align-middle">{{$actor['birtdate']}}</td>
                    <td style="border: 1px solid #dee2e6; padding: 8px;" class="align-middle">{{$actor['country']}}</td>
                    <td style="border: 1px solid #dee2e6; padding: 8px;" class="align-middle"><img src="{{$actor['img_url']}}" alt="{{$actor['name']}}" style="width: 100px; height: 120px;"></td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @endif
</div>
@endsection