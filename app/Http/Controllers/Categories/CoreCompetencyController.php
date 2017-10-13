<?php

namespace App\Http\Controllers\Categories;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Categories\CoreCompetency;
use App\Models\Idea;

/**
 * Class CoreCompetencyController
 * @package App\Http\Controllers
 */
class CoreCompetencyController extends Controller
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
            'items' => CoreCompetency::all(),
            'title' => 'Основные компетенции',
            'route' => 'categories.core-competency'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        /** @var \App\Models\Categories\CoreCompetency $item */
        $item = CoreCompetency::findOrFail($request->route('id'));
        return view('categories.status.edit', [
            'item' => $item,
            'title' => 'Редактировать элемент',
            'route' => route('categories.core-competency.edit', ['id' => $item->id]),
            'deleteRoute' => route('categories.core-competency.delete', ['id' => $item->id]),
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request)
    {
        /** @var \App\Models\Categories\CoreCompetency $item */
        $item = CoreCompetency::findOrFail($request->route('id'));
        $input = App::make('datacleaner')->cleanData($request->all());
        $item->fill($input);
        $item->is_active = (int)$input['is_active'];
        $item->save();

        return redirect()->route('categories.core-competency.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('categories.status.edit', [
            'title' => 'Создать Основную компетенцию',
            'route' => route('categories.core-competency.create')
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveNew(CategoryRequest $request)
    {
        $input = App::make('datacleaner')->cleanData($request->all());
        CoreCompetency::create($input);

        return redirect()->route('categories.core-competency.index');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        /** @var \App\Models\Categories\CoreCompetency $item */
        $item = CoreCompetency::findOrFail($request->route('id'));

        $itemCount = $item->ideas()->count();
        if ($itemCount) {
            return redirect()->back()->withErrors(['Невозможно удалить элемент. Существуют идеи с такой компетенцией']);
        }
        $item->delete();

        return redirect()->route('categories.core-competency.index');
    }
}
