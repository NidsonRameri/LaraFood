@extends('adminlte::page')

@section('title', 'Cadastrar novo Usuário')

@section('content_header')
    <h1>Cadastrar novo Usuário</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('users.store')}}" class="form" method="POST">
                @include('admin.pages.users._partials.form')

                <div class="form-group">
                    <button type ="submit" class="btn btn-dark">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endsection