@extends('adminlte::page')

@section('title', 'Cadastrar nova Categoria')

@section('content_header')
    <h1>Cadastrar nova Categoria</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('categories.store')}}" class="form" method="POST">
                @include('admin.pages.categories._partials.form')

                <div class="form-group">
                    <button type ="submit" class="btn btn-dark">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endsection