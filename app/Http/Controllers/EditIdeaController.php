<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\{
    App,
    Log
};
use App\Models\Idea;
use App\Models\Categories\Status;
use Illuminate\Http\Request;
use App\Http\Requests\IdeaRequest;
use App\Http\Requests\ChangeStatusRequest;
use App\Exceptions\IdeaIsNotApproved;


/**
 * Class EditIdeaController
 * @package App\Http\Controllers
 */
class EditIdeaController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        /** @var \App\Models\Idea $idea */
        $idea = Idea::findOrFail($request->route('id'));

        /** @var \App\Service\Reference $reference */
        $reference = App::make('reference');
        $data = [
            'coreCompetenciesList' => $reference->getAllCoreCompetencyForSelect(),
            'operationalGoalsList' => $reference->getAllOperationalGoalForSelect(),
            'strategicObjectivesList' => $reference->getAllStrategicObjectiveForSelect(),
            'typesList' => $reference->getAllTypeForSelect(),
            'departmentsList' => $reference->getAllDepartmentForSelect(),
            'statuses' => App::make('reference')->getAllStatusesForSelect(),
            'idea' => $idea,
            'status' => $idea->status,
        ];
        return view('edit-idea.edit-idea', $data);
    }

    /**
     * @param IdeaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function postEdit(IdeaRequest $request)
    {
        /** @var \App\Models\Idea $idea */
        $idea = Idea::findOrFail($request->route('id'));
        try {
            $data = App::make('datacleaner')->cleanData($request->all());
            $this->getIdeaControl()->update($idea, $data);
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back();
        }

        $request->session()->flash('alert-success', 'Изменения успешно сохранены.');
        return redirect()->back();
    }


    /**
     * @param ChangeStatusRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function changeStatus(ChangeStatusRequest $request)
    {
        /** @var \App\Models\Idea $idea */
        $idea = Idea::findOrFail($request->route('id'));
        $data = App::make('datacleaner')->cleanData($request->all());
        $statusId = (int)$data['status_id'];
        if ($statusId == $idea->status_id) {
            return redirect()->back();
        }

        try {
            /** @var \App\Models\Categories\Status $status */
            $status = Status::find($statusId);
            if ($status === null) {
                throw new \Exception('Такого статуса не существует');
            }
            $this->getIdeaControl()->changeStatus($idea, $status);
        } catch (IdeaIsNotApproved $e){
            return redirect()->back()->withErrors([$e->getMessage()]);
        }  catch (\Exception $e) {
            Log::error($e);
            return redirect()->back();
        }

        $request->session()->flash('alert-success', 'Изменения успешно сохранены.');
        return redirect()->back();
    }

    /**
     * @return \App\Service\IdeaControl
     */
    protected function getIdeaControl()
    {
        return App::make('idea.control');
    }
}
