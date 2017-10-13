@if ($idea->isDeclined())
    <br />
    <div class="row">
        <div class="col-sm12">
            <div class="alert alert-danger">
                Отклонена по причине:
                    @if ($idea->getDeclineReason())
                        {{ $idea->getDeclineReason()->text }}
                    @endif
            </div>
        </div>
    </div>
@endif
