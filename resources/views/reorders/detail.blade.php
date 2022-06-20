<div class="col-md-12">
    <div class="card">
        <div class="card-header">
            <h4 class="card-title">Chi tiết vật tư</h4>
        </div>
        <div class="card-content">
            <div class="card-body">
                    @if($permission)
                    <div class="col-md-3 form-product-search">
                        <input id="product-search" name type="text" class="mt-2 mb-2 form-control" placeholder="Nhập tên vật tư">
                    </div>
                    @endif
                <div class="table-responsive">
                    <table class="table add-rows add-reorder" id="table-reorder">
                        <thead>
                        <tr>
                            <th>Mã hàng</th>
                            <th>Tên</th>
                            <th>Số lượng</th>
                            <th>Ghi chú</th>
                            @if($permission)
                                <th>Action</th>
                            @endif
                        </tr>
                        </thead>
                        <tbody>
                        @if($oldData->items ?? '')
                            @include('reorders.reorder_items')
                        @endif
                        </tbody>
                    </table>
                    <div class="row-error d-none">
                        <div class="error">
                            <p class="mb-0 message text-danger">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>