<div class="row">
    <div class="col-md-1">
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle waves-effect waves-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Roles
            </button>
            <form class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach($roles as $role)
                    <label class="dropdown-item">
                        <fieldset>
                            <div class="vs-checkbox-con vs-checkbox-primary">
                                <input type="radio" role="{{$role->id}}" name="roles" value="{{$role->name}}">
                                <span class="vs-checkbox" id="vs-checkbox-role-{{$role->id}}">
                                         <span class="vs-checkbox--check">
                                               <i class="vs-icon feather icon-check"></i>
                                         </span>
                                     </span>
                                <span class="">{{$role->name}}</span>
                            </div>
                        </fieldset>
                    </label>
                @endforeach
                <button type="button" class="btn btn-primary mb-2 ml-1 waves-effect waves-light">Xác nhận</button>
            </form>
        </div>
    </div>
    <div class="col-md-1">
        <div class="dropdown">
            <button class="btn btn-outline-primary dropdown-toggle waves-effect waves-light" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Permission
            </button>
            <form class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                @foreach($permissions as $permission)
                    <label class="dropdown-item">
                        <fieldset>
                            <div class="vs-checkbox-con vs-checkbox-primary">
                                <input type="checkbox" permission="{{$permission->id}}" name="permission" value="{{$permission->name}}">
                                <span class="vs-checkbox" id="vs-checkbox-{{$permission->id}}">
                                         <span class="vs-checkbox--check">
                                               <i class="vs-icon feather icon-check"></i>
                                         </span>
                                     </span>
                                <span class="">{{$permission->name}}</span>
                            </div>
                        </fieldset>
                    </label>
                @endforeach
                <button type="button" class="btn btn-primary mb-2 ml-1 waves-effect waves-light">Xác nhận</button>
            </form>
        </div>
    </div>
</div>