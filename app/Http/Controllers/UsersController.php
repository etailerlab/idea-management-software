<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\{
    RegistrationRequest,
    UpdateRequest
};
use App\Models\Auth\User;
use App\Service\Reference;
use Illuminate\Support\Facades\App;


/**
 * Class UsersController
 * @package App\Http\Controllers
 */
class UsersController extends Controller
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
        return view('users.index', ['users' => User::where('id', '>', 0)->paginate(15)]);
    }

    /**
     * @param RegistrationRequest $request
     * @return $this|\Illuminate\Http\RedirectResponse
     */
    public function saveNew(RegistrationRequest $request)
    {
        $input = App::make('datacleaner')->cleanData($request->all());
        try {
            $this->getUserRegistratorService()->register($input);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->route('users.index');
    }

    /**
     * @param UpdateRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(UpdateRequest $request)
    {
        /** @var \App\Models\Auth\User $user */
        $user = User::findOrFail($request->route('id'));
        $input = App::make('datacleaner')->cleanData($request->all());
        $input['is_active'] = isset($input['is_active']) ? (int)$input['is_active'] : 0;
        if (isset($input['email'])) {
            unset($input['email']);//not update email
        }

        try {
            $this->getUserRegistratorService()->update($user, $input);
        } catch (\Exception $e) {
            return back()->withErrors(['error' => $e->getMessage()]);
        }

        return redirect()->route('users.index');
    }

    /**
     * @param Request $request
     * @param Reference $reference
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit(Request $request, Reference $reference)
    {
        /** @var \App\Models\Auth\User $user */
        $user = User::findOrFail($request->route('id'));

        return view('users.edit', [
            'user' => $user,
            'inviteStatus' => $user->invitations()->first() ? $user->invitations()->first()->status : 'successful',
            'roles' => $reference->getAllRolesForSelect(),
            'departments' => $reference->getAllDepartmentForSelect(),
            'positions' => $reference->getAllPositionsForSelect(),
        ]);
    }

    /**
     * @param Reference $reference
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create(Reference $reference)
    {
        return view('users.create', [
            'roles' => $reference->getAllRolesForSelect(),
            'departments' => $reference->getAllDepartmentForSelect(),
            'positions' => $reference->getAllPositionsForSelect(),
        ]);
    }

    /**
     * @return \App\Service\UserRegistrator
     */
    protected function getUserRegistratorService()
    {
        return App::make('user_registrator');
    }
}
