<div class="col-md-6">
    <div class="row">
        <div class="col-sm-12">
            <h4 class="pull-right">Самые активные пользователи:</h4>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            @foreach ($topUsers as $user)
                <span class="pull-right">
                    {{ $user->last_name }} {{ $user->name }} ({{ $user->number }})
                </span>
                <br />
            @endforeach
        </div>
    </div>
</div>