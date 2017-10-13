@role('superadmin')
    @if(!$idea->isDeclined())
        <div class="row">
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <a href="{{ route('edit-idea', ['id' => $idea->id]) }}" class="btn btn-success pull-left">Редактировать</a>
                    </div>
                </div>
            </div>
        </div>
    @endif
@endrole