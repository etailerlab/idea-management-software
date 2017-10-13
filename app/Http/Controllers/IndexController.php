<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\{
    App,
    Auth,
    Log
};

use App\Http\Requests\IdeaRequest;
use App\Models\Categories\Status;

/**
 * Class IndexController
 * @package App\Http\Controllers
 */
class IndexController extends Controller
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
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function addIdea()
    {
        /** @var \App\Service\Reference $reference */
        $reference = App::make('reference');
        $data = [
            'coreCompetenciesList' => $reference->getAllCoreCompetencyForSelect(),
            'operationalGoalsList' => $reference->getAllOperationalGoalForSelect(),
            'strategicObjectivesList' => $reference->getAllStrategicObjectiveForSelect(),
            'typesList' => $reference->getAllTypeForSelect(),
            'departmentsList' => $reference->getAllDepartmentForSelect(),
        ];
        return view('index.add-idea', $data);
    }

    /**
     * @param IdeaRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function createIdea(IdeaRequest $request)
    {
        try {
            $data = App::make('datacleaner')->cleanData($request->all());
            $status = App::make('repository.status')->getBySlug(Status::SLUG_ACTIVE);
            if (!isset($status)) {
                $status = Status::createNew(Status::SLUG_ACTIVE);
            }

            App::make('idea.control')->create(Auth::user(), $data, $status);
        } catch (\Exception $e) {
            Log::error($e);
            return redirect()->back();
        }

        return redirect()->route('add-idea-success');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function success()
    {
        return view('index.success');
    }
}