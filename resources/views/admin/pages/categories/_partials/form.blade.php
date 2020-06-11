@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <label for="">Nome</label>
    <input type="text" name="name" class="form-control" placeholder="Nome: " value="{{$category->name ?? old('name')}}">
</div>
<div class="form-group">
    <label for="">Descrição</label>
    <textarea name="description" cols='30' rows="5" class="form-control">{{$category->description ?? old('description')}}</textarea>
</div>