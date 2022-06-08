<div class="col-12 mt-5" id="load-page">
    <div class="table-responsive border rounded px-1 ">
        <h6 class="border-bottom py-1 mx-1 mb-0 font-medium-2"><i class="feather icon-lock mr-50 "></i>Permission</h6>
        <input type="hidden" value="{{$user->id}}" id="user-id">
        <input type="hidden" value="{{route('permission.update',['user' => $user->id])}}" id="url-post">
        @if(!empty($permissions))
            <table class="table table-borderless">
                <thead>
                <tr>
                    <th></th>
                    @foreach($permissions as $permission)
                        <th>{{$permission->name}}</th>
                    @endforeach
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Permission</td>
                    @foreach($permissions as $permission)
                        <td>
                            <div class="custom-control custom-checkbox"><input type="checkbox"
                                    id="permisstion-checkbox{{$permission->id}}"
                                    class="custom-control-input checkbox-permissions"
                                    permission="{{$permission->id}}"
                                    @if($user->can($permission->name)) checked @endif/>
                                <label class="custom-control-label"
                                       for="permisstion-checkbox{{$permission->id}}"></label>
                            </div>
                        </td>
                    @endforeach
                </tr>
                </tbody>
            </table>
        @endif
    </div>
    @push('js')
            <!-- BEGIN: Page Vendor JS-->

            <!-- END: Page JS-->
            <script src="/app-assets/js/custom/permission.js"></script>

    @endpush

</div>

