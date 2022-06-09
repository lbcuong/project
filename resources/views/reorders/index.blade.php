<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/smoothness/jquery-ui.css">
<div class="tab-reorder" is-detail="{{$isDetail ?? ''}}">
    @widget('TransactionBreadcrumb',['table'=>$table])
    <form method="post" id="form-data-list-transection" enctype="multipart/form-data">
        <div class="row-custom">
            <div class="transaction-tab">
                <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">{{$title}}</h4>
                    </div>
                    <div class="card-content">
                        <div class="card-body">
                            <div class="row">
                                @foreach($columns as $column)
                                    <div class="col-xl-4 col-md-6 col-12">
                                        <fieldset class="form-group">
                                            <label for="basicInput">{{__(tablePrefixName($table).$column)}}</label>
                                            <input type="text" name="{{$column}}" placeholder="{{__($column)}}" value="{{old($column, $oldData[$column] ?? '')}} {{($column =='code' AND !old($column, $oldData[$column] ?? '')) ? getCodeNextId($table,$title) : ''}}" class="form-control">
                                        </fieldset>
                                    </div>
                                @endforeach
                            </div>
                            <div class="float-right mt-2 mb-2">
                                <button type="button" id="action-approve-transaction"
                                        class="btn-submit btn btn-primary waves-effect waves-light d-none" disabled>Xác nhận
                                </button>
                                <button type="button" id="action-cancel-transaction"
                                        class="btn btn-outline-danger waves-effect waves-light d-none">Huỷ
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="transaction-items-tab">
                @include('reorders.detail')
            </div>
        </div>
    </form>
</div>
<script>

    var t = $('.add-reorder').DataTable(
        {
            "paging":   false,
            "ordering": false,
            "searching": false,
            "info": false
        }
    );
    var counter = 0;
    var CSRF_TOKEN = $('meta[name="csrf-token"]').attr('content');
    $(document).ready(function(){
        const isDetail = "{{$isDetail}}";
        $('.datepicker').pickadate(
            {
                editable: true,
                format: 'dd-mm-yyyy',
            });
        $('.datepicker').off('click focus');
        $('body').on('click', '.remove', function () {
            var table = $('.add-reorder').DataTable();
            var row = $(this).parents('tr');
            if ($(row).hasClass('child')) {
                table.row($(row).prev('tr')).remove().draw();
            }
            else
            {
                table
                    .row($(this).parents('tr'))
                    .remove()
                    .draw();
            }
        });

        $("#product-search").autocomplete({
            minLength: 0,
            source: function( request, response ) {
                // Fetch data
                $.ajax({
                    url: URL_AUTO_COMPLETE,
                    type: 'post',
                    dataType: "json",
                    data: {
                        _token: CSRF_TOKEN,
                        search: request.term

                    }
                }).done(function(data) {
                    response( data );
                });
            },
            select: function (event, ui) {
                var searchHistory = [];
                $("#table-reorder tbody tr").each(function( index ) {
                    searchHistory.push($.trim($(this).find('th,td').first().text()));
                });
                var code = ui.item.code;
                var btnApprove = '';
                if(isDetail)
                    btnApprove = '<a href="#" row-id="'+ui.item.value+'" class="from-edit action-approve-item"><i class="fa fa-check text-success"></i></a>';
                if(!searchHistory.includes(code)){
                    var transactionId = $('.add-reorder input[name="transaction_id"]').val();
                    t.row.add( [
                        '<input type="hidden" name="goods[]" value="'+ui.item.value+'" class="form-control"><input type="hidden" name="row_id" class="form-control">'+code,
                        '<input type="hidden" name="transaction_id" value="'+transactionId+'" class="form-control">'
                        +ui.item.label,
                        '<input type="text" name="reorder_quantity[]" class="form-control" required>',
                        '<input type="text" name="comment_items[]" class="form-control">',
                        '<div class="action-edit-delete d-none"><a href="#" class="from-edit action-edit-item"><i class="feather icon-edit"></i></a><a href="#" class="action-delete-item"><i class="feather icon-trash-2"></i></a></div>' +
                        '<div class="action-submit-edit">' + btnApprove +
                        '<a class="remove from-edit action-cancel-item"><i class="fa fa-times text-danger"></i></a></div>'
                    ] ).draw( false );
                    counter++;
                }else{
                    Swal.fire({
                        title: "Vật tư đã được chọn!",
                        type: "error",
                        confirmButtonClass: 'btn btn-primary',
                        buttonsStyling: false,
                    });
                }
                return false;
            }
        }).focus(function() {
            $(this).autocomplete('search', $(this).val())
        });
    });
</script>