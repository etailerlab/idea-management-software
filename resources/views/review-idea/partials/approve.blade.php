@role('superadmin')
    @if ($idea->isNew())
        <br />
        <div class="row">
            <form action="{{ route('review-idea', ['id' => $idea->id]) }}" method="post">
                {{ csrf_field() }}
                <div class="row">
                    <div class="col-sm-1">
                        <div class="form-group">
                            <button  value="1" name="status" type="submit" class="btn btn-success pull-left">Принять</button>
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <button value="2" name="status" type="submit" class="btn btn-danger pull-left">Отклонить</button>
                                </div>
                            </div>
                            <div class="col-sm-9">
                                <div class="form-group">
                                    {{ Form::text('reason','', ['class'=>'form-control', 'placeholder' => 'Укажите причину отклонения']) }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endif
@endrole
