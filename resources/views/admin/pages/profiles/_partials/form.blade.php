@include('admin.includes.alerts')
@csrf

<div class="form-group">
    <label for="">* Nome:</label>
    <input type="text" name="name" placeholder="Nome" class="form-control" value="{{$profile->name ?? old('name')}}">
</div>

<div class="form-group">
    <label for="">Descrição:</label>
    <input type="text" name="description" placeholder="Descrição" class="form-control" value="{{$profile->description ?? old('description')}}">
</div>

<div class="form-group">
    <button type="submit" class="btn btn-info">Salvar</button>
</div>