@include('admin.includes.alerts')

@csrf
<div class="form-group">
    <label for="">Identificador da Mesa</label>
    <input type="text" name="identify" class="form-control" placeholder="Identificador da Mesa" value="{{$table->identify ?? old('identify')}}">
</div>
<div class="form-group">
    <label for="">Descrição</label>
    <textarea name="description" cols='30' rows="5" class="form-control">{{$table->description ?? old('description')}}</textarea>
</div>