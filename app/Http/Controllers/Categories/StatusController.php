<?php

namespace App\Http\Controllers\Categories;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Categories\Status;
use App\Models\Idea;

/**
 * Class StatusController
 * @package App\Http\Controllers
 */
class StatusController extends Controller
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
    public function index()
    {
        return view('categories.status.index', [
            'items' => Status::all(),
            'title' => 'Статусы',
            'route' => 'categories.statuses'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        /** @var \App\Models\Categories\Status $status */
        $status = Status::findOrFail($request->route('id'));
        return view('categories.status.edit', [
            'item' => $status,
            'title' => 'Редактировать статус',
            'route' => route('categories.statuses.edit', ['id' => $status->id]),
            'deleteRoute' => route('categories.statuses.delete', ['id' => $status->id]),
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request)
    {
        /** @var \App\Models\Categories\Status $status */
        $status = Status::findOrFail($request->route('id'));
        $input = App::make('datacleaner')->cleanData($request->all());
        $status->fill($input);
        $status->is_active = (int)$input['is_active'];
        $status->save();

        return redirect()->route('categories.statuses.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('categories.status.edit', [
            'title' => 'Создать статус',
            'route' => route('categories.statuses.create')
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveNew(CategoryRequest $request)
    {
        $input = App::make('datacleaner')->cleanData($request->all());
        Status::create($input);

        return redirect()->route('categories.statuses.index');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        /** @var \App\Models\Categories\Status $status */
        $status = Status::findOrFail($request->route('id'));

        if (in_array($status->id, [1,2,3])) {
            return redirect()->back()->withErrors(['Это стандартный статус. Его нельзя удалить']);
        }

        $ideasCount = $status->ideas()->count();
        if ($ideasCount) {
            return redirect()->back()->withErrors(['Невозможно удалить статус. Существуют идеи с таким статусом']);
        }
        $status->delete();

        return redirect()->route('categories.statuses.index');
    }
}
