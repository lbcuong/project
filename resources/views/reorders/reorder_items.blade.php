@foreach($oldData->items as $key => $param)
    <tr>
        <th>
            <input type="hidden" name="goods[]" value="{{$param->goods_id}}"
                   class="form-control">
            <input type="hidden" name="row_id" value="{{$param->id}}"
                   class="form-control">
            {{$param->goods->product->code}}
        </th>
        <th>
            <input type="hidden" name="transaction_id" value="{{$oldData->id}}"
                   class="form-control">
            {{$param->goods->product->name}}</th>
        @if(!isset($isDetail))
        <th><input type="text" name="reorder_quantity[]" class="form-control"
                   value="{{$param->reorder_quantity}}" disabled></th>
        <th><input type="text" name="comment_items[]" class="form-control"
                   value="{{$param->comment}}"></th>
        <th>
        @else
            <th class="editer" name="reorder_quantity[]">{{$param->reorder_quantity}}</th>
            <th class="editer" name="comment_items[]">{{$param->comment}}</th>
        @endif
        </th>
       @if($permission)
           <th>
                    <div class="action-edit-delete">
                        <a href="#" class="action-edit-item"><i class="feather icon-edit"></i></a>
                        <a href="#" class="action-delete-item"><i class="feather icon-trash-2"></i></a>
                    </div>
                    <div class="action-submit-edit d-none">
                        <a href="#" class="from-edit action-approve-item"><i class="fa fa-check text-success"></i></a>
                        <a href="#" class="from-edit action-cancel-item"><i class="fa fa-times text-danger"></i></a>
                    </div>
                </th>
       @endif

    </tr>
@endforeach
