    <div class="row">
        <div class="btn-group mr-1 mb-1">
            <div class="dropdown">
                <a  type="text" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="feather icon-more-horizontal"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                        <a href='#' postURL='/{{$table}}/detail/{{$param->id}}' class='action-detail dropdown-item'><i class='feather icon-zoom-in'></i>Chi tiết</a>
                        <a href='#' postURL='/{{$table}}/edit/{{$param->id}}' id="{{$param->id}}" class='action-edit from-edit dropdown-item'><i class='feather icon-edit'></i>Sửa</a>
                        <a href='/{{$table}}/delete/{{$param->id}}' class='action-delete dropdown-item'><i class='feather icon-trash'></i>Xoá</a>
                </div>
            </div>
        </div>
    </div>
