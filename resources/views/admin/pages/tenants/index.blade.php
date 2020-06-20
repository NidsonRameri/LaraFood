@extends('adminlte::page')

@section('title', 'Empresas')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('tenants.index')}}" class='active'>Empresas</a></li>
    </ol>

    <h1>Empresas</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('tenants.search')}}" method="POST" class="form form-inline">
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
                        <th>Nome</th>
                        <th width='400'>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tenants as $tenant)
                        <tr>
                            {{-- php artisan storage:link || criar storage dentro da pasta public para acessar as imagens--}} 
                            <td>
                                <img src="{{url("storage/{$tenant->logo}")}}" alt="{{$tenant->name}}" style='max-width: 100px'>    
                            </td>
                            <td>{{$tenant->name}}</td>
                            <td style='width=10px;'>
                                <a href="{{route('tenants.show', $tenant->id)}}" class="btn btn-info"><i class="fas fa-angle-double-right"></i> Ver</a>
                                <a href="{{route('tenants.edit', $tenant->id)}}" class="btn btn-warning"><i class="far fa-edit"></i> Editar</a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $tenants->appends($filters)->links() !!}
            @else
                {!! $tenants->links() !!}
            @endif
            
        </div>
    </div>
@stop