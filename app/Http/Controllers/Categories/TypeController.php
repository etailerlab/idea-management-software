<?php

namespace App\Http\Controllers\Categories;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Categories\Type;
use App\Models\Idea;

/**
 * Class TypeController
 * @package App\Http\Controllers
 */
class TypeController extends Controller
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
            'items' => Type::all(),
            'title' => 'Типы',
            'route' => 'categories.type'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        /** @var \App\Models\Categories\Type $item */
        $item = Type::findOrFail($request->route('id'));
        return view('categories.status.edit', [
            'item' => $item,
            'title' => 'Редактировать элемент',
            'route' => route('categories.type.edit', ['id' => $item->id]),
            'deleteRoute' => route('categories.type.delete', ['id' => $item->id]),
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request)
    {
        /** @var \App\Models\Categories\Type $item */
        $item = Type::findOrFail($request->route('id'));
        $input = App::make('datacleaner')->cleanData($request->all());
        $item->fill($input);
        $item->is_active = (int)$input['is_active'];
        $item->save();

        return redirect()->route('categories.type.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('categories.status.edit', [
            'title' => 'Создать Тип',
            'route' => route('categories.type.create')
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveNew(CategoryRequest $request)
    {
        $input = App::make('datacleaner')->cleanData($request->all());
        Type::create($input);

        return redirect()->route('categories.type.index');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        /** @var \App\Models\Categories\Type $item */
        $item = Type::findOrFail($request->route('id'));

        $itemCount = Idea::where('type_id', '=', $item->id)->count();
        if ($itemCount) {
            return redirect()->back()->withErrors(['Невозможно удалить элемент. Существуют идеи с таким типом']);
        }
        $item->delete();

        return redirect()->route('categories.type.index');
    }
}
