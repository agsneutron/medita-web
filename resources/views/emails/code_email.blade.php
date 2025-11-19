@extends('components.mail._main')
@section('content')
    <div>
        <h1>¡Su contraseña fue cambiada!</h1>
    </div>
    <div class="col-12">
        <h3>Correo: {{$email}}</h3>
        <h3>Nueva contraseña: <span style="text-decoration: none;">{{$password}}</span></h3>
    </div>
@endsection
