@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <label for="">* Título</label>
    <input type="text" name="title" class="form-control" placeholder="Título: " value="{{$product->title ?? old('title')}}">
</div>

<div class="form-group">
    <label for="">* Preço</label>
    <input type="text" name="price" class="form-control" placeholder="Preço: " value="{{$product->price ?? old('price')}}">
</div>

<div class="form-group">
    <label for="">* Imagem</label>
    <input type="file" name="image" class="form-control">
</div>

<div class="form-group">
    <label for="">* Descrição</label>
    <textarea name="description" cols='30' rows="5" class="form-control">{{$product->description ?? old('description')}}</textarea>
</div>