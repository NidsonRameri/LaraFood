@extends('adminlte::page')

@section('title', 'Cadastrar nova empresa')

@section('content_header')
    <h1>Cadastrar nova empresa</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{route('tenants.store')}}" class="form" method="POST" enctype="multipart/form-data"> 
                @include('admin.pages.tenants._partials.form')

                <div class="form-group">
                    <button type ="submit" class="btn btn-dark">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@endsection