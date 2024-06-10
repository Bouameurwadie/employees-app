<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use ProtoneMedia\Splade\SpladeForm;
use ProtoneMedia\Splade\Facades\Splade;
use ProtoneMedia\Splade\FormBuilder\Select;
use ProtoneMedia\Splade\FormBuilder\Submit;
use ProtoneMedia\Splade\FormBuilder\Input;
use Spatie\Permission\Models\Permission;
use App\Http\Requests\CreatePermissionRequest ;
use App\Http\Requests\UpdatePermissionRequest ;
use App\Tables\Permissions ;

class PermissionController extends Controller
{
    public function index()
    {
        return view(
            'admin.permissions.index',
            [
                'permissions' => Permissions::class
            ]
        );
    }

    public function create()
    {
        //
        $form = SpladeForm::make()
            ->action(route('admin.permissions.store'))
            ->fields([
                Input::make('name')->label('Name'),
                Submit::make()->label('Save')
            ])->class('space-y-4 bg-white rounded p-4');

        return view('admin.permissions.create', [
            'form' => $form
        ]);
    }


    public function store(CreatePermissionRequest $request)
    {
        //
        Permission::create($request->validated());
        Splade::toast('Permission Created')->autoDismiss(3);
        return to_route('admin.permissions.index');
    }

    public function edit(Permission $permission)
    {
        //
        $form = SpladeForm::make()
            ->action(route('admin.permissions.update', $permission))
            ->method("PUT")
            ->fields([
                Input::make('name')->label('Name'),
                Submit::make()->label('Save')
            ])
            ->fill($permission)
            ->class('space-y-4 bg-white rounded p-4');

        return view('admin.permissions.edit', [
            'form' => $form
        ]);
    }

    public function update(UpdatePermissionRequest $request, Permission $permission)
    {
        //
        $permission->update($request->validated());
        Splade::toast('Role Updated')->autoDismiss(3);
        return to_route('admin.permissions.index');
    }


    public function destroy(Permission $permission)
    {
        //
        $permission->delete();
        Splade::toast('Permission Deleted')->autoDismiss(3);
        return back();
    }
}
