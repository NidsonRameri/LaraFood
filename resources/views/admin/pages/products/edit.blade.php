@extends('adminlte::page')

@section('title', "Editar produto {$product->title}")

@section('content_header')
    <h1>Editar produto {{$product->title}}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('products.update', $product->id)}}" class="form" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                @include('admin.pages.products._partials.form')
                <div class="form-group">
                    <button type ="submit" class="btn btn-dark">Salvar</button>
                </div>
            </form>
        </div>
    </div>
@endsection