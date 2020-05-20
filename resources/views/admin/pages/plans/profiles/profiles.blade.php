@extends('adminlte::page')

@section('title', "Perfis do plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('admin.index')}}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{route('plans.index')}}">Planos</a></li>
        <li class="breadcrumb-item active"><a href="{{route('plans.profiles', $plan->id)}}" class='active'>Perfis</a></li>
    </ol>

    <h1>Perfis do plano <strong>{{$plan->name}}</strong>
        <a href="{{route('plans.profiles.available', $plan)}}" class="btn btn-dark"><i class="far fa-calendar-plus"></i> Adicionar novo perfil</a>
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
                    @foreach ($profiles as $profile)
                        <tr>
                            <td>{{$profile->name}}</td>
                            <td style='width=10px;'>
                                {{-- <a href="{{route('details.permission.index', $permission->url)}}" class="btn btn-dark"><i class="fas fa-angle-double-right"></i> Detalhes</a> --}}
                                <a href="{{route('plans.profiles.detach', [$plan->id, $profile->id])}}" class="btn btn-danger"><i class="fas fa-angle-double-right"></i> Remover</a>
                            </td>
                        </tr>
                    @endforeach 
                </tbody>
            </table>
        </div>
        <div class="card-footer">
            @if (isset($filters))
                {!! $profiles->appends($filters)->links() !!}
            @else
                {!! $profiles->links() !!}
            @endif
            
        </div>
    </div>
@stop