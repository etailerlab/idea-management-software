<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use App\Models\Idea;
use App\Models\Categories\{
    CoreCompetency,
    OperationalGoal,
    StrategicObjective,
    Department
};

class UpdateIdeaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $this
            ->updateIdeas()
            ->updateTable();

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {

    }

    protected function updateIdeas()
    {
        $ideas = Idea::all();
        foreach ($ideas as $idea) {
            if ($idea->core_competency_id) {
                $coreCompetency = CoreCompetency::find($idea->core_competency_id);
                if ($coreCompetency) {
                    $idea->coreCompetencies()->attach($coreCompetency->id);
                }
            }

            if ($idea->operational_goal_id) {
                $item = OperationalGoal::find($idea->operational_goal_id);
                if ($item) {
                    $idea->operationalGoals()->attach($item->id);
                }
            }

            if ($idea->strategic_objective_id) {
                $item = StrategicObjective::find($idea->strategic_objective_id);
                if ($item) {
                    $idea->strategicObjectives()->attach($item->id);
                }
            }

            if ($idea->department_id) {
                $item = Department::find($idea->department_id);
                if ($item) {
                    $idea->departments()->attach($item->id);
                }
            }
        }

        return $this;
    }

    protected function updateTable()
    {
        Schema::table('ideas', function (Blueprint $table) {
            $table->dropForeign('ideas_core_competency_id_foreign');
            $table->dropForeign('ideas_department_id_foreign');
            $table->dropForeign('ideas_operational_goal_id_foreign');
            $table->dropForeign('ideas_strategic_objective_id_foreign');

            $table->dropColumn('core_competency_id');
            $table->dropColumn('operational_goal_id');
            $table->dropColumn('strategic_objective_id');
            $table->dropColumn('department_id');

            $table->index('approve_status');
        });
    }
}
