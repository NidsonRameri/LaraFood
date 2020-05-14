@extends('adminlte::page')

@section('title', "Permissões do perfil {$profile->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item active"><a href="{{route('profiles.index')}}" class='active'>Perfis</a></li>
    </ol>

    <h1>Permissões do perfil <strong>{{$profile->name}}</strong>
        <a href="{{route('profiles.permissions.available', $profile)}}" class="btn btn-dark"><i class="far fa-calendar-plus"></i> Adicionar nova permissão</a>
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
                    @foreach ($permissions as $permission)
                        <tr>
                            <td>{{$permission->name}}</td>
                            <td style='width=10px;'>
                                {{-- <a href="{{route('details.permission.index', $permission->url)}}" class="btn btn-dark"><i class="fas fa-angle-double-right"></i> Detalhes</a> --}}
                                <a href="{{route('profiles.permissions.detach', [$profile->id, $permission->id])}}" class="btn btn-danger"><i class="fas fa-angle-double-right"></i> Remover</a>
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