(function(window, undefined) {
    'use strict';
    let ROW_EDIT_OLD = [];
    $('body').on("keyup change", "#form-data-list .transaction-tab input, #form-data-list .transaction-tab select", function(e) {
        var isDetail = $('.tab-reorder').attr('is-detail')
        e.preventDefault();
        if(isDetail){
            $('.btn-submit').removeClass('d-none');
            $('#action-cancel-transaction').removeClass('d-none');
        }

    });

    $('body').on("click", ".action-edit-item", function(e) {
        e.preventDefault();
        var rowId =  $(this).closest('tr').find('input[name="row_id"]').val();
        ROW_EDIT_OLD[rowId] = $(this).closest('tr').html();

        $(this).parent().addClass('d-none');
        $(this).closest('th,td').find('.action-submit-edit').removeClass('d-none');
        $(this).closest('tr').find('.editer').each(function() {
            var value = $(this).text();
            var name = $(this).attr('name');
            if(name == 'comment'){
                var input = $('<th><textarea class="form-control" name="'+name+'">'+value+'</textarea> </th>');
            }else{
                var input = $('<th><input class="form-control" name="'+name+'" value="'+value+'"/></th>');
            }
            $(this).replaceWith(input);
        });
    });
    $('body').on("click", ".action-delete-item", function(e) {
        var that = this;
        var params = getValueForm(that);
        deleteReorderItem(params,that);
    });
    $('body').on("click", ".action-approve-item", function(e) {
        var that = this;
        e.preventDefault();
        var params = getValueForm(that);
        $('.error .message').html('');
        editReorderItem(params,that)
    });

    function getValueForm(that){
        let params = [];
        $(that).closest('tr').find('input,textarea').each(function() {
            var name = $(this).attr('name');
            var value = $(this).val();
            params.push({name:name,value:value});
        });
        return params;
    }

    $('body').on("click", "#action-approve-transaction", function(e) {
        editTransactions();
    });
    $('body').on("click", "#action-cancel-transaction", function(e) {
        $('.btn-submit').addClass('d-none');
        $('#action-cancel-transaction').addClass('d-none');
    });

    $('body').on("click", ".action-cancel-item", function(e) {
        var rowId =  $(this).closest('tr').find('input[name="row_id"]').val();
        var that = this;
        $(this).closest('tr').html(ROW_EDIT_OLD[rowId]);
        displayAction(that)
    });
    function displayAction(that){
            $(that).closest('th,td').find('.action-submit-edit').addClass('d-none');
            $(that).closest('th,td').find('.action-edit-delete').removeClass('d-none');
    }

    $('body').on("change", ".upload-image", function(event) {
        $('.image-thumbnail .row').html('');
        var files = event.target.files;
        var countFiles = $(this)[0].files.length;
        for(var i = 0;i <= countFiles;i++){
            var image = URL.createObjectURL(files[i]);
            var imageThumbnailHtml = '<img src="'+image+'" class="mr-1 click-image-thumbnail" alt="img placeholder" height="40" width="40" data-toggle="modal" data-backdrop="false" data-target="#backdrop"></div>';
            $('.image-thumbnail .row').append(imageThumbnailHtml);
        }
    });


    function editTransactions(){
        var postURL = '/'+TABLE_NAME;
        $('.error .message').html('');
        $.ajax({
            url:postURL,
            method:"POST",
            data: new FormData($('#form-data-list-transection')[0]),
            type:'json',
            contentType: false,
            processData: false
        }).done(function(data) {
            if(data.success){
                closeSidebar();
                var dataTable = $('.data-list-view').DataTable();
                dataTable.ajax.reload();
                toastr.success(data.message, 'Thông báo!');
            }else{
                toastr.error(data.message, 'Thông báo!');
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            var errors = jqXHR.responseJSON.errors;
            $('.form-group .error').remove();
            $.each(errors, function( index, value ) {
                $('.row-error .message').html(value);
                var errorHtml = document.getElementsByClassName("row-error");
                $('input[name="'+index+'"]')
                    .after(errorHtml[0].innerHTML);
            });
            toastr.error('Trường không hợp lệ!', 'Thông báo!');
        });
    }

    function editReorderItem(params,that){
        var postURL = '/'+ TABLE_NAME +'/reorder_items/edit';
        $.ajax({
            url:postURL,
            method:"POST",
            data: params,
            type:'json'
        }).done(function(data) {
            if(data.success){
                displayAction(that);
                $(that).closest('tr').find('input[name="row_id"]').val(data.rowId);
                $.each(data.model, function( index, value ) {
                    var elm = $('<th class="editer" name="'+index+'[]">'+value+'</th>');
                    $(that)
                        .closest('tr')
                        .find('input[name="'+index+'[]"],textarea[name="'+index+'[]"]')
                        .closest('th,td').replaceWith(elm);
                });
                toastr.success(data.message, 'Thông báo!');
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            var errors = jqXHR.responseJSON.errors;
            $('.form-group .error').remove();
            $.each(errors, function( index, value ) {
                if(index == 'reorder_quantity.0')
                    var message = value.map(function(x){return x.replace('reorder_quantity.0','')});
                toastr.error(message, 'Thông báo!');
                let fieldName = index.replace(".0", "[]");
                $(that)
                    .closest('tr')
                    .find('input[name="'+fieldName+'"]').addClass('error-custom');
            });

        });
    }

    function deleteReorderItem(params,that){
        var postURL = '/'+ TABLE_NAME +'/reorder_items/delete';
        Swal.fire({
            title: 'Bạn có muốn xoá không?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có',
            confirmButtonClass: 'btn  btn-primary',
            cancelButtonClass: 'btn btn-outline-danger waves-effect waves-light ml-1',
            cancelButtonText: 'Không',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                $.ajax({
                    url:postURL,
                    method:"POST",
                    data: params,
                    type:'json'
                }).done(function(data) {
                    if(data.success){
                       $(that).closest('tr').remove();
                    }
                }).fail(function(jqXHR, textStatus, errorThrown) {
                    console.log(222);
                });
            }
            else if (result.dismiss === Swal.DismissReason.cancel) {
                console.log(33);
            }
        });

    }
    function closeSidebar(){
        $(".add-new-data").removeClass("show")
        $(".overlay-bg").removeClass("show")
        $('.form-group .error').remove();
        $('.add-data-footer').removeClass('d-flex');
        $('.table-edit .data-items').addClass('data-items-unset');
        $('#action-approve-transaction').addClass('d-none');
        $('#action-cancel-transaction').addClass('d-none');
    }
})(window);
