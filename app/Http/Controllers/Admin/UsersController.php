<?php

namespace App\Http\Controllers\Admin;

use App\Core\Traits\GridWithSimpleSearch;
use App\Dal\Entities\Admin\UserAdmin;
use Illuminate\Http\Request;
use App\Http\Controllers\BkControllerBase;

class UsersController extends BkControllerBase
{
    use GridWithSimpleSearch;

    public function index(Request $request)
    {
        $gridItems = $this->getGrid($request, UserAdmin::class);

        return view(
            'admin.users.index',
            [
                'gridItems' => $gridItems,
                'query' => $gridItems->searchQuery,
            ]
        );
    }

    public function add(Request $request)
    {
        $returnToListUrl = routeWithQuery('admin.users');

        if ($this->isPost()) {

            $this->validateAddForm($request);

            $entity = new UserAdmin($request->all());
            $entity->password = \Hash::make($request->password);
            $entity->save();


            return redirect(
                routeWithQuery(
                    'admin.users.edit',
                    ['id' => $entity->id, 'success' => true]
                )
            );

        } else {
            $entity = new UserAdmin();
        }

        return view(
            'admin.users.form',
            [
                'entity' => $entity,
                'returnToListUrl' => $returnToListUrl,
            ]
        );
    }

    public function edit(Request $request, $id)
    {
        $returnToListUrl = route('admin.users', [], ['success']);
        $entity = UserAdmin::findOrFail($id);

        if ($this->isPost()) {
            $this->validateEditForm($request);
            if (password_verify($request->password , $entity->password)) {
                $entity->fill($request->all());
                $entity->password = \Hash::make($request->password_new);
                $entity->save();
                return redirect(
                    routeWithQuery(
                        'admin.users.edit',
                        ['id' => $entity->id, 'success' => true]
                    )
                );
            } else {
                $request->session()->flash('error', 'Password does not match');

                return redirect()->back();
            }
        }

        $entity = UserAdmin::findOrFail($id);


        return view(
            'admin.users.editform',
            [
                'entity' => $entity,
                'success' => $request->success,
                'returnToListUrl' => $returnToListUrl
            ]
        );
    }

    public function delete($id)
    {
        $entity = UserAdmin::findOrFail($id);

        $entity->delete();

        return redirect()->back();
    }

    private function validateAddForm(Request $request)
    {
        $this->validate(
            $request,
            [
                'name' => 'bail|required|max:255',
                'email' => 'bail|unique:users|required|max:255',
                'password' => 'bail|required|max:512',
            ],
            [],
            [
                'name' => 'Name',
                'email' => 'Email',
                'password' => 'Password',
            ]
        );
    }

    private function validateEditForm(Request $request)
    {
        $this->validate(
            $request,
            [
                'password_new' => 'bail|required|max:512',
                'password_new_second' => 'bail|required|max:512|same:password_new',
            ],
            [],
            [
//                'name' => 'Name',
//                'email' => 'Email',
                'password_new' => 'New User Password',
                'password_new_second' => 'Repeat New User Password',
            ]
        );
    }
}
