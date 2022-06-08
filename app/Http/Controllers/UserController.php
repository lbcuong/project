<?php

namespace App\Http\Controllers;
use App\Http\Requests\PasswordRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use App\Exports\UsersExport;
use Carbon\Carbon;
use App\Exports\UsersPdf;
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\DataTables\UsersDataTable;
use App\Models\Person;
class UserController extends Controller
{
    const TITLE = "User";
    const TABLE = "users";

    public function index(UsersDataTable $usersDataTable,Request $request,User $user)
    {
        $title = self::TITLE;
        $table = self::TABLE;
        $params = $this->getFullUserInfo($user);
        $columns = $this->getColumn();
        $permissions =  Permission::all();
        $roles =  Role::all();
        if ($request->isMethod('get'))
            return $usersDataTable->render('layouts.tables.index',compact('title','table','columns','permissions','roles'));
        else
            return $this->store($request,$user);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        if ($request->isMethod('get'))
            return view('users.create');
        else
            return $this->store($request);

       return view('users.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store($request,$user)
    {
        $params = $request->all();
        $isFile = $request->hasFile('image');
        if($isFile){
            $fileImage = $request->file('image');
            $directory =  config('default.directory.images.avatar');
            $params['image'] = saveImageDirectory($fileImage,$directory);
        }
        if($user->id){
            $user->update($params);
            if($user->person()->exists())
                $user->person->update($params);
            else{
                $user->person()->create($params);
            }
            $message = 'Sửa thành công.';
        }
        else{
            User::create($params);
            $message = 'Thêm thành công.';
        }

        return back()->withStatus(__($message));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function profile(User $user)
    {
        $roles = Role::with('permissions')->get();
        $permissions =  Permission::all();
        return view('users.edit',compact('user','roles','permissions'));
    }

    public function infoEdit(User $user,Request $request){
        $user->personalInfo->update($request->all());
        return back()->withStatus(__('update user successfully.'));
    }

    public function edit(User $user)
    {
        $oldData = $this->getFullUserInfo($user);
        $table = self::TABLE;
        $routeSubmit = route('users',['user'=> $user->id]);
        return response()->json( array('success' => true,'old' => $oldData,'route'=>$routeSubmit));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        return back()->withStatus(__('Developing....'));
    }

    public function password(PasswordRequest $request,User $user)
    {
        $user->update(['password' => Hash::make($request->get('password'))]);
        return back()->withStatus(__('Password successfully updated.'));
    }

    public function import(Request $request)
    {
        Excel::import(new UsersImport,request()->file('import'));
        return back()->withStatus(__('import successfully.'));

    }

    public function export(Request $request)
    {
        $userIds = $request->userIds;
        return Excel::download(new UsersExport($userIds), 'users.xlsx');
    }

    public function printPdf(){
        $userIds = ['4870e2fe-b896-4039-867c-5b801f81719a'];
        $users = User::whereIn('uuid',[$userIds])->get();
        return Excel::download(new UsersPdf($users), 'users.pdf');
    }


    public function detail(User $user){
        $columns = $this->getColumn();
        $param = $this->getFullUserInfo($user);
        $tablePrefix = self::TABLE .'.';
        return response()->json( array('success' => true,'html'=>view('layouts.tables.detail', compact('columns','param','tablePrefix'))->render()));
    }

    private function removeRoles($user)
    {
        $user->with('roles')->get();
        foreach ($user->roles as $role){
            $user->removeRole($role->name);
        }
    }

    protected function getFullUserInfo($user){
       $columns = $this->getColumn();
       $param = $user::select(array_values($columns))
            ->leftJoin('persons', 'users.id', '=', 'persons.user_id')
            ->where('email',$user->email)
            ->first();
       return $param;
    }

    protected function getColumn(){
        $columns = array_merge(getColumn(self::TABLE),getColumn('persons'));
        $columns = array_diff( $columns,['remember_token','email_verified_at','password','is_active','user_id']);
        return $columns;
    }
}

