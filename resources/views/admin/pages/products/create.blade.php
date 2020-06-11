@extends('adminlte::page')

@section('title', 'Cadastrar novo produto')

@section('content_header')
    <h1>Cadastrar novo produto</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('products.store')}}" class="form" method="POST" enctype="multipart/form-data"> 
                @include('admin.pages.products._partials.form')

                <div class="form-group">
                    <button type ="submit" class="btn btn-dark">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endsection