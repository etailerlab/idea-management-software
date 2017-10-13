{{ csrf_field() }}
<div class="form-group">
    <label for="name">Имя</label>
    {{ Form::text('name', isset($item) ? $item->name : '', ['class'=>'form-control']) }}
</div>
<div class="form-group">
    <div class="checkbox">
        <label>
            <input name="is_active" type="hidden" value="0">
            {{ Form::checkbox('is_active', true, isset($item) ? $item->is_active : false) }}Активно?
        </label>
    </div>
</div>