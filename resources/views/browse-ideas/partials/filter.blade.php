<form action="" id="fiter">
    <div class="row">
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::select('department_id', $filter['departmentsList'], '', ['class'=>'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::select('operational_goal_id', $filter['operationalGoalsList'], '', ['class'=>'form-control']) }}
            </div>
        </div>
        <div class="col-md-4">
            <div class="form-group">
                {{ Form::select('strategic_objective_id', $filter['strategicObjectivesList'], '', ['class'=>'form-control']) }}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::select('type_id', $filter['typesList'], '', ['class'=>'form-control']) }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::select('status_id', $filter['statuses'], '', ['class'=>'form-control']) }}
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                {{ Form::select('core_competency_id', $filter['coreCompetenciesList'], '', ['class'=>'form-control']) }}
            </div>
        </div>

        <div class="col-md-3">
            <div class="form-group">
                {{ Form::select('order_by', ['desc' => 'Сначала новые', 'asc' => 'Сначала старые'], '', ['class'=>'form-control']) }}
            </div>
        </div>
    </div>
</form>
<hr>