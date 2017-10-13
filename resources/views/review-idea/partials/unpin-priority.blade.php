@if ($idea->is_priority === 1 && $idea->isApproved() && Entrust::hasRole(['superadmin', 'admin']))
    <br />
    <div class="row">
        <div class="col-sm12">
            <form action="{{ route('unpin-priority', ['id' => $idea->id]) }}" method="post" class="js-disable-after-submit">
                {{ csrf_field() }}
                <div class="col-sm-3">
                    <button type="submit" class="btn btn-danger pull-left">Не приоритетное</button>
                </div>
            </form>
        </div>
    </div>
@endif