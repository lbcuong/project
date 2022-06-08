<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;
use App\Models\User;

class PermissionController extends Controller
{
    public function store(Request $request,User $user)
    {
        $value = $request->value;
        $permisstionId = $request->permisstionId;
        $permission = Permission::find($permisstionId);
        if ($value)
            $user->givePermissionTo($permission->name);
        else
            $user->revokePermissionTo($permission->name);

        return response()->json( array('success' => true));
    }

    public function permission(Request $request){
        $checkboxIds = json_decode($request->userId,true);
        $users = User::whereIn('id',$checkboxIds);
        foreach($users as $user){
            $user->givePermissionTo($request->permission);
        }
        return back()->withStatus(__('Phân quyền thành công.'));
    }
}
