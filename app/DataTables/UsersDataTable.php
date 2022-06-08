<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UsersDataTable extends DataTable
{
    const TABLE = 'users';

    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('checkbox', function ($user) {
                $permissionIds = $user->permissions->pluck('id');
                $permissionIds = json_encode($permissionIds);
                $roleId = $user->roles->pluck('id');
                $roleId = json_encode($roleId);
                return
                    "<input value='{$user->id}' permission='{$permissionIds}' role='{$roleId}' class='select-param' type='checkbox'>";
            })->addColumn('role', function ($user) {
                $roleName = implode(' | ',$user->roles->pluck('name')->all());
                return $roleName;
            })->addColumn('permission', function ($user) {
                $permissionName = implode(' | ',$user->permissions->pluck('name')->all());
                return $permissionName;
            })->rawColumns(['checkbox']);
    }

    public function query(User $model)
    {
        return $model->newQuery();
    }


    public function html()
    {
        return $this->builder()
            ->columns([
                'checkbox' => ['sorting' => false, 'class'=>'dt-checkboxes-cell filter-disable dt-checkboxes-select-all sorting_disabled','title'=>'<input id="select-all" type="checkbox" value="0">'],
                'name',
                'email' => ['sorting' => false, 'class'=> 'no-sort'],
                'role',
                'permission'
            ])->parameters(getTableParameters());
    }


    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'Users_' . date('YmdHis');
    }
}
