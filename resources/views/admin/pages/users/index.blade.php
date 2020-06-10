@extends('adminlte::page')

@section('title', 'Usuários')

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('users.index')}}" class='active'>Usuários</a></li>
    </ol>

    <h1>Usuários
        <a href="{{route('users.create')}}" class="btn btn-dark"><i class="far fa-calendar-plus"></i> Adicionar usuário</a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-header">
            <form action="{{route('users.search')}}" method="POST" class="form form-inline">
                @csrf
                <input type="text" name="filter" placeholder="Nome" class="form-control" value="{{$filters['filter'] ?? ''}}">
                <button type="submit" class="btn btn-dark"><i class="fas fa-search"></i> Pesquisar</button>
            </form>
        </div>
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th>E-mail</th>
                        <th width='400'>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                        <tr>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td style='width=10px;'>
                                <a href="{{route('users.show', $user->id)}}" class="btn btn-info"><i class="fas fa-angle-double-right"></i> Ver</a>
                                <a href="{{route('users.edit', $user->id)}}" class="btn btn-warning"><i class="far fa-edit"></i> Editar</a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $users->appends($filters)->links() !!}
            @else
                {!! $users->links() !!}
            @endif
            
        </div>
    </div>
@stop