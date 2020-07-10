@extends('adminlte::page')

@section('title', "Cargos do usuário {$user->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('users.index')}}" class='active'>Usuários</a></li>
    </ol>

    <h1>Cargos do usuário <strong>{{$user->name}}</strong>
        <a href="{{route('users.roles.available', $user)}}" class="btn btn-dark"><i class="far fa-calendar-plus"></i> Adicionar novo cargo</a>
    </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width='50'>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($roles as $role)
                        <tr>
                            <td>{{$role->name}}</td>
                            <td style='width=10px;'>
                                {{-- <a href="{{route('details.role.index', $role->url)}}" class="btn btn-dark"><i class="fas fa-angle-double-right"></i> Detalhes</a> --}}
                                <a href="{{route('users.roles.detach', [$user->id, $role->id])}}" class="btn btn-danger"><i class="fas fa-angle-double-right"></i> Remover</a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $roles->appends($filters)->links() !!}
            @else
                {!! $roles->links() !!}
            @endif
            
        </div>
    </div>
@stop