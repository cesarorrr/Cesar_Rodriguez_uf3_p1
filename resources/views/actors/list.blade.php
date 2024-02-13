<div class="container mt-4 text-center">
    <h1>{{$title}}</h1>

    @if(empty($actors['data']))
    <div class="alert alert-danger mt-4">
        No se ha encontrado ningún actor
    </div>
    @else
    <div class="table-responsive mt-4">
        <table style="border: 1px solid #dee2e6;" class="table text-center">
            <thead class="thead-dark">
                <tr>
                    <th style="border: 1px solid #dee2e6; padding: 8px;">Nombre</th>
                    <th style="border: 1px solid #dee2e6; padding: 8px;">Apellido</th>
                    <th style="border: 1px solid #dee2e6; padding: 8px;">Fecha de Nacimiento</th>
                    <th style="border: 1px solid #dee2e6; padding: 8px;">País</th>
                    <th style="border: 1px solid #dee2e6; padding: 8px;">Imagen</th>
                </tr>
            </thead>
            <tbody>
                @foreach($actors['data'] as $actor)
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

    <div class="mt-4">
        @if ($actors['prev_page_url'])
        <form action="{{ $actors['prev_page_url'] }}" method="get">
            <button type="submit" class="btn btn-primary">Anterior</button>
        </form>
        @endif
        @if ($actors['next_page_url'])
        <form action="{{ $actors['next_page_url'] }}" method="get">
            <button type="submit" class="btn btn-primary">Siguiente</button>
        </form>
        @endif
    </div>

    @endif
</div>