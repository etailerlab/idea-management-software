<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\{
    App,
    Auth
};
use App\Http\Requests\User\PasswordRequest;

/**
 * Class ProfileController
 * @package App\Http\Controllers
 */
class ProfileController extends Controller
{
    /**
     * ProfileController constructor.
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('profile.index', ['user' => Auth::user()]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request)
    {
        /** @var \App\Models\Auth\User $user */
        $user = Auth::user();
        $rulesValidation = [
            'name' => 'required|max:191',
            'last_name' => 'required|max:191',
        ];

        $data = App::make('datacleaner')->cleanData($request->all());
        $this->validate($request, $rulesValidation);
        $user->name = $data['name'];
        $user->last_name = $data['last_name'];
        $user->save();
        $request->session()->flash('alert-success', 'Изменения успешно сохранены.');

        return redirect()->route('profile.index');
    }

    /**
     * @param PasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function changePass(PasswordRequest $request)
    {
        /** @var \App\Models\Auth\User $user */
        $user = Auth::user();
        $input = $request->all();
        $user->password = bcrypt($input['password']);
        $user->save();
        $request->session()->flash('alert-success', 'Пароль успешно изменен.');

        return redirect()->route('profile.index');
    }
}
