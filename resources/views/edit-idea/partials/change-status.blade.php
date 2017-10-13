@if ($idea->isApproved() && Entrust::hasRole(['superadmin', 'admin']))
    <br />
    <div class="row">
        <form action="{{ route('change-status', ['id' => $idea->id]) }}" method="post" class="js-disable-after-submit">
            {{ csrf_field() }}
            <div class="row">
                <div class="col-sm-3">
                    <div class="form-group">
                        <button type="submit" class="btn btn-success pull-left">Изменить статус</button>
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        {{ Form::select('status_id', $statuses, $status->id, ['class'=>'form-control']) }}
                    </div>
                </div>
            </div>
        </form>
    </div>
@endif