<?php

namespace App\Http\Controllers\Categories;

use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Categories\Position;
use App\Models\Auth\User;

/**
 * Class PositionController
 * @package App\Http\Controllers
 */
class PositionController extends Controller
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
            'items' => Position::all(),
            'title' => 'Должности',
            'route' => 'categories.position'
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request)
    {
        /** @var \App\Models\Categories\Position $item */
        $item = Position::findOrFail($request->route('id'));
        return view('categories.status.edit', [
            'item' => $item,
            'title' => 'Редактировать элемент',
            'route' => route('categories.position.edit', ['id' => $item->id]),
            'deleteRoute' => route('categories.position.delete', ['id' => $item->id]),
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(CategoryRequest $request)
    {
        /** @var \App\Models\Categories\Position $item */
        $item = Position::findOrFail($request->route('id'));
        $input = App::make('datacleaner')->cleanData($request->all());
        $item->fill($input);
        $item->is_active = (int)$input['is_active'];
        $item->save();

        return redirect()->route('categories.position.index');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('categories.status.edit', [
            'title' => 'Создать Должность',
            'route' => route('categories.position.create')
        ]);
    }

    /**
     * @param CategoryRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function saveNew(CategoryRequest $request)
    {
        $input = App::make('datacleaner')->cleanData($request->all());
        Position::create($input);

        return redirect()->route('categories.position.index');
    }

    /**
     * @param Request $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function delete(Request $request)
    {
        /** @var \App\Models\Categories\Position $item */
        $item = Position::findOrFail($request->route('id'));

        $itemCount = User::where('position_id', '=', $item->id)->count();
        if ($itemCount) {
            return redirect()->back()->withErrors(['Невозможно удалить элемент. Существуют пользователи с такой должностью']);
        }
        $item->delete();

        return redirect()->route('categories.position.index');
    }
}
