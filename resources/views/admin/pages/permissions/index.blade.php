@extends('adminlte::page')

@section('title', 'Permissões')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('permissions.index')}}" class='active'>Permissões</a></li>
    </ol>

    <h1>Permissões 
        <a href="{{route('permissions.create')}}" class="btn btn-dark"><i class="far fa-calendar-plus"></i>  Adicionar Permissão</a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('permissions.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Filtro" class="form-control" value="{{$filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i> Pesquisar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width='400'>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{$permission->name}}</td>
                            <td style='width=10px;'>
                                {{-- <a href="{{route('details.permission.index', $permission->url)}}" class="btn btn-dark"><i class="fas fa-angle-double-right"></i> Detalhes</a> --}}
                                <a href="{{route('permissions.show', $permission->id)}}" class="btn btn-info"><i class="fas fa-angle-double-right"></i> Ver</a>
                                <a href="{{route('permissions.edit', $permission->id)}}" class="btn btn-warning"><i class="far fa-edit"></i> Editar</a>
                                <a href="{{route('permissions.profiles', $permission->id)}}" class="btn btn-info"><i class="fas fa-address-book"></i> Perfis</a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $permissions->appends($filters)->links() !!}
            @else
                {!! $permissions->links() !!}
            @endif
            
        </div>
    </div>
@stop