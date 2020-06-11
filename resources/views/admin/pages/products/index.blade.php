@extends('adminlte::page')

@section('title', 'Produtos')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('products.index')}}" class='active'>Produtos</a></li>
    </ol>

    <h1>Produtos
        <a href="{{route('products.create')}}" class="btn btn-dark"><i class="far fa-calendar-plus"></i> Adicionar produto</a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('products.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{$filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i> Pesquisar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Imagem</th>
                        <th>Título</th>
                        <th width='400'>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                        <tr>
                            {{-- php artisan storage:link || criar storage dentro da pasta public para acessar as imagens--}} 
                            <td>
                                <img src="{{url("storage/{$product->image}")}}" alt="{{$product->title}}" style='max-width: 100px'>    
                            </td>
                            <td>{{$product->title}}</td>
                            <td style='width=10px;'>
                                <a href="{{route('products.show', $product->id)}}" class="btn btn-info"><i class="fas fa-angle-double-right"></i> Ver</a>
                                <a href="{{route('products.edit', $product->id)}}" class="btn btn-warning"><i class="far fa-edit"></i> Editar</a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $products->appends($filters)->links() !!}
            @else
                {!! $products->links() !!}
            @endif
            
        </div>
    </div>
@stop