$(document).ready(function() {
    $('.datepicker').pickadate({
        editable: true,
        format: 'dd-mm-yyyy',
    });
    $('.datepicker').off('click focus');
    $('body').on('click','.datepicker-icon',function (e){
        $picker = $(this).closest('.form-group').find('.datepicker');
        e.stopPropagation();
        e.preventDefault();
        picker = $picker.data('pickadate');
        picker.open();
    });

    if( $('.table-edit').find('#basic-tabs-components').length !== 0){
        $('.data-items').addClass('data-items-bottom-fixed');
    }
    // Add filtering
    $('.is-filter-grid').on('change',function (){
        if($(this).is(':checked'))
            $('.filters').removeClass('d-none');
        else
            $('.filters').addClass('d-none');
    });
    var rowHtml = '<tr>';
    $('.dataTable thead tr:first th').each(function( index ) {
        var style = $(this).attr('style');
        var filterDisable = '';
        if($(this).hasClass('filter-disable'))
            filterDisable = 'filter-disable';
        rowHtml += '<th style="'+style+' d-none" class="'+filterDisable+'"></th>';
    });
    rowHtml +='</tr>';
    $('.filters').html(rowHtml);
    var filters = $(".filters");
    filters.insertAfter($(".dataTable thead tr"));

    var isChange = false;
    $('#form-data-list input,#form-data-list select').on('keyup change',function (){
        $('.add-data-footer').addClass('d-flex');
        $('.table-edit .data-items').removeClass('data-items-unset');
        isChange = true;
    });

    $(document).on('keyup', function(e) {
        if (e.key == "Escape"){
            $('#data-list-view .hide-data-sidebar').click();
        }
    });
    insertElement();
    defaultGrid();
    getIdSelectAll();
    ajaxSetup();
    clickButtonAddNew();
    showTabEditer();
    submitDataForm();
    clickSelectAll();
    clickDeleteParams();
    disableSorting();
    clickApprove();
    imageThumbnail();
    //Functions

    function insertElement(){
        var actionDropdown = $(".actions-dropodown")
        actionDropdown.insertAfter($(".top .actions .dt-buttons"));
        var actionWarehousehLocation = $("#warehouse-location");
        actionWarehousehLocation.insertBefore($(".top .dt-buttons"));
        var filterOnOff = $(".filter-on-off");
        filterOnOff.insertAfter($("#dataTableBuilder_filter"));
    }
    function defaultGrid(){
        $('.row-error').hide();
        $('.dataTable').addClass('data-list-view');
        $('.action-btns .actions-dropodown').hide();

        $('body').on('click', '.action-edit', function (e) {
            e.stopPropagation();
            $(".add-new-data").addClass("show");
            $(".overlay-bg").addClass("show");
        });
        // Scrollbar
        if ($(".data-items").length > 0) {
            new PerfectScrollbar(".data-items", { wheelPropagation: false })
        }

        // Close sidebar
        $(".hide-data-sidebar, .cancel-data-btn, .overlay-bg").on("click", function(e) {
            if(isChange){
                alertsChange(e);
                return;
            }
            closeSidebar();
        })

        // mac chrome checkbox fix
        if (navigator.userAgent.indexOf("Mac OS X") != -1) {
            $(".dt-checkboxes-cell input, .dt-checkboxes").addClass("mac-checkbox")
        }


    }
    function imageThumbnail(){
        $('.upload-image').on('change',function (event){
            $('.image-thumbnail .row').html('');
            var files = event.target.files;
            var countFiles = $(this)[0].files.length;
            for(var i = 0;i <= countFiles;i++){
                var image = URL.createObjectURL(files[i]);
                var imageThumbnailHtml = '<img src="'+image+'" class="mr-1 click-image-thumbnail" alt="img placeholder" height="100" width="100" data-toggle="modal" data-backdrop="false" data-target="#backdrop"></div>';
                $('.image-thumbnail .row').append(imageThumbnailHtml);
            }
        });
    }
    function clickApprove(){
        $('body').on("click", "#button-approve", function(e) {
            var rowId = $(this).attr('param-id');
            alertsApprove(e,rowId);
        });
    }

    function submitDataForm(){
        $('.add-new-btn').attr('route',TABLE_NAME);
        $('#btn-submit').on('click',function(){
            var urlPOST = $('#form-data-list').attr('action');
            addNewAjax(urlPOST);
        });
    }
    function getIdSelectAll(){
        $('.data-list-view thead tr th:first-child input[type="checkbox"]').attr('id','select-all');
    }
    function ajaxSetup(){
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    }
    function clickButtonAddNew(){
        $('body').on("click", ".action-btns .add-new-btn", function(e) {
            $('.add-new-data .title').html('Thêm');
            $('.add-data-footer').addClass('d-flex');
            $('.table-edit .data-items').removeClass('data-items-unset');
            if(TRANSACTION_LAYOUT.includes(TABLE_NAME)){
                $('#form-data-list').html('');
                $('.add-new-data').css('width','60rem');
                addTabReorderAjax();
                return;
            }
            $('#form-data-list').trigger("reset");
            $('#form-data-list').attr('action',$(this).attr('route'));
            $('.form-group .error').remove();
            $('#click-measuring-conversion').val('');
            $('.click-image-thumbnail').addClass('d-none');
            buildCodeId();
            $('#form-data-list select option').removeAttr('selected');
        });
    }
    function addTabReorderAjax(){
        $.ajax({
            url:URL_TAB_CREATE_REORDER,
            method:"GET",
            data: {},
            type:'json'
        }).done(function(data) {
            $('#form-data-list').html(data.html);

        }).fail(function(jqXHR, textStatus, errorThrown) {
            toastr.error('Lỗi', 'Thông báo!');
        });
    }

    function buildCodeId(){
        $.ajax({
            url:URL_BUILD_CODE_ID,
            method:"POST",
            data: {table:TABLE_NAME,title:TITLE_NAME},
            type:'json'
        }).done(function(data) {
            $('input[name="code"]').val(data.code).prop('disabled', true);
        });
    }

    function showTabEditer(){
        $('body').on("click", ".data-list-view tbody tr", function(evt) {
            var checkClass = $(this).hasClass('selected');
            var $cell=$(evt.target).closest('td');
            if( $cell.index()>0){
                $('.add-new-data .title').html('Sửa');
                $(':checkbox').each(function() {
                    this.checked = false;
                });
                $('.selected').removeClass('selected');
                // Show tab edition
                if(!checkClass){
                    var rowId = $(this).find('.select-param').val();

                    if(TRANSACTION_LAYOUT.includes(TABLE_NAME)){
                        $('.add-new-data .title').html('detail');
                        $('#form-data-list').html('');
                        $('.add-new-data').css('width','60rem');
                    }

                    $('.click-image-thumbnail').addClass('d-none');
                    setDataEditerAjax(rowId);
                    $('.overlay-bg,.add-new-data').addClass('show');
                }
            }

            if(checkClass){
                $(this).removeClass('selected');
                $(this).find('.select-param').prop('checked', false);
            }else{
                $(this).addClass('selected');
                $(this).find('.select-param').prop('checked', true);
            }
            getCheckedAll();
            disableAction(getChecked());
        });
    }

    function setDataEditerAjax(rowId){

        $('#field-id').val(rowId);
        var postURL = TABLE_NAME + '/edit/'+rowId;
        $.ajax({
            url:postURL,
            method:"POST",
            data: {},
            type:'json',
        }).done(function(data) {
            if(TRANSACTION_LAYOUT.includes(TABLE_NAME)){
                $('#form-data-list').html(data.html);
                $('#button-approve').attr('param-id',rowId);
                var reorderActions = $(".reorder-actions");
                reorderActions.insertAfter($(".sidebar-actions .dropdown-menu a:last"));
                return;
            }
            $('#form-data-list').attr('action',data.route);
            $('#form-data-list').trigger("reset");
            $('#form-data-list select option').removeAttr('selected');
            $.each(data.old , function( index, value ) {
                if(index == 'image'){
                    if(value){
                        $('.click-image-thumbnail').attr('src',value);
                        $('.click-image-thumbnail').removeClass('d-none');
                    }
                }
                else if(INPUT_TYPE_SELECT.includes(index)){

                    $('#select-'+index+' option[value='+value+']').attr('selected',true);
                }
                else{
                    if(index == 'code')
                        $('#code-old').val(value);
                    $('input[name='+index+']').val(value);
                }
            });
        }).fail(function(jqXHR, textStatus, errorThrown) {

        });
    }

    function clickSelectAll(){
        $('#select-all').click(function(event) {
            event.stopPropagation();
            if(this.checked) {
                $('tbody tr').addClass('selected');
                $('tbody tr :checkbox').each(function() {
                    this.checked = true;
                });
            } else {
                $('tbody tr').removeClass('selected');
                $('tbody tr :checkbox').each(function() {
                    this.checked = false;
                });
            }
            disableAction(getChecked());
        });
    }

    function clickDeleteParams(){
        $('#delete-params').click(function(event) {
            var checkBoxeds = getChecked();
            if(checkBoxeds.length) {
                $('#delete-params').attr('checkBoxeds',JSON.stringify(checkBoxeds));
                alertsDelete(event);
                event.preventDefault();
            }
        });
    }
    function disableSorting(){
        $('body').on("click", ".data-list-view thead th", function(evt) {
            var checkClass = $(this).hasClass('sorting_desc');
            if(checkClass){
                $(document).ready(function() {
                    var table = $('.data-list-view').DataTable();
                    table.order( [] ).draw( false );
                } );
            }
        });
    }

    function getChecked(){
        var checkBoxeds = []
        $(".data-list-view tbody input[type=checkbox]:checked").each(function(){
            var value = $(this).val();
            if(value != 0)
                checkBoxeds.push(value);
        });
        return checkBoxeds;
    }
    function disableAction(checkBoxeds) {
        if(checkBoxeds.length){
            $('#select-all').addClass('checkbox-all-custom');
            $('.action-btns .actions-dropodown').show();
        }
        else{
            $('#select-all').removeClass('checkbox-all-custom');
            $('.action-btns .actions-dropodown').hide();
            $('#select-all').prop('checked', false);
        }
    }
    function checkCountSelectBox(){
        var checkBoxed = 0;
        $(".data-list-view tbody input[type=checkbox]:checked").each(function(){
            checkBoxed++;
        });
        return checkBoxed;
    }
    function getCheckedAll(){
        var checkBoxed = 0;
        $(".data-list-view tbody input[type=checkbox]").each(function(){
            checkBoxed++;
        });
        var checked = checkCountSelectBox();

        if(checkBoxed > checked)
            $('#select-all').prop('checked', false);
        else if(checkBoxed == checked)
            $('#select-all').prop('checked', true);
    }


    function addNewAjax(postURL){
        var isSuccessSubmit = false;
        var dataTable = $('.data-list-view').DataTable();
        $("#dataTableBuilder_processing").show();
        var disabled = $('#form-data-list').find(':input:disabled').removeAttr('disabled');
        $.ajax({
            url:postURL,
            method:"POST",
            data: new FormData($('#form-data-list')[0]),
            type:'json',
            contentType: false,
            processData: false
        }).done(function(data) {
            if(data.success){
                dataTable.ajax.reload();
                successChange();
                closeSidebar();
                toastr.success(data.message, 'Thông báo!');
                $('.action-btns .actions-dropodown').hide();
                isSuccessSubmit = true;
            }
        }).fail(function(xhr, textStatus, errorThrown) {
            var errors = xhr.responseJSON.errors;
            $('.form-group .error').remove();
            $.each(errors, function( index, value ) {
                var errorHtml = document.getElementsByClassName("row-error");
                var tabPanel = $('input[name="'+index+'"]').closest('.tab-pane');
                var tabPanelId =  tabPanel.attr('aria-labelledby');
                $('.row-error .message').html(value);
                $('.tab-pane,.nav-tabs .nav-link').removeClass('active');
                tabPanel.addClass('active');
                $('#'+tabPanelId).addClass('active');
                $('input[name="'+index+'"]').after(errorHtml[0].innerHTML);
            });
            toastr.error('Trường không hợp lệ!', 'Thông báo!');
        });

        $("#dataTableBuilder_processing").hide();
        disabled.attr('disabled','disabled');
    }
    function deleteRowAjax(){
        var dataTable = $('.data-list-view').DataTable();
        $("#dataTableBuilder_processing").show();
        $.ajax({
            url:URL_DELETE_API,
            method:"DELETE",
            data: {checkboxed:$('#delete-params').attr('checkBoxeds')},
            type:'json'
        }).done(function(data) {
            if(data.success){
                dataTable.ajax.reload();
                toastr.success(data.message, 'Thông báo!');
            }
            $("#dataTableBuilder_processing").hide();
        }).fail(function(jqXHR, textStatus, errorThrown) {
            toastr.error('Lỗi', 'Thông báo!');
        });
    }
    function approveAjax(rowId,isApprove,comment){
        var postURL = '/'+ TABLE_NAME +'/approve/'+rowId;
        $.ajax({
            url:postURL,
            method:"POST",
            data: {isApprove:isApprove,comment:comment},
            type:'json'
        }).done(function(data) {
            if(data.success){
                var dataTable = $('.data-list-view').DataTable();
                dataTable.ajax.reload();
                closeSidebar();
                toastr.success(data.message, 'Thông báo!');
            }
        }).fail(function(jqXHR, textStatus, errorThrown) {
            toastr.error('Lỗi', 'Thông báo!');
        });
    }
    function alertsDelete(e){
        e.preventDefault();
        Swal.fire({
            title: 'Bạn có muốn xoá không?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Xoá',
            confirmButtonClass: 'btn btn-danger',
            cancelButtonClass: 'btn btn-outline-danger waves-effect waves-light ml-1',
            cancelButtonText: 'Huỷ',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                deleteRowAjax();
            }
            else if (result.dismiss === Swal.DismissReason.cancel) {
                event.preventDefault();
            }
        });
    }
    function alertsApprove(e,rowId){
        e.preventDefault();
        Swal.fire({
            title: '<textarea class="form-control" id="approve-comment" rows="3" placeholder="Ghi chú"></textarea>',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Duyệt',
            confirmButtonClass: 'btn  btn-primary',
            cancelButtonClass: 'btn btn-outline-danger waves-effect waves-light ml-1',
            cancelButtonText: 'Không duyệt',
            buttonsStyling: false,
        }).then(function (result) {
            var comment = $('#approve-comment').val();
            if (result.value) {
                var isApprove = 1;
                approveAjax(rowId,isApprove,comment);
                event.preventDefault();
            }
            else if (result.dismiss === Swal.DismissReason.cancel) {
                var isApprove = 0;
                approveAjax(rowId,isApprove,comment);
                event.preventDefault();
            }
        });
    }
    function alertsChange(e){
        e.preventDefault();
        Swal.fire({
            title: 'Bạn có muốn thay đổi không?',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Có',
            confirmButtonClass: 'btn  btn-primary',
            cancelButtonClass: 'btn btn-outline-danger waves-effect waves-light ml-1',
            cancelButtonText: 'Không',
            buttonsStyling: false,
        }).then(function (result) {
            if (result.value) {
                $('#btn-submit').click();
                if(isSuccessSubmit)
                closeSidebar();
            }
            else if (result.dismiss === Swal.DismissReason.cancel) {
                closeSidebar();
            }
        });
    }

    function closeSidebar(){
        $(".add-new-data").removeClass("show")
        $(".overlay-bg").removeClass("show")
        $('.form-group .error').remove();
        $('.add-data-footer').removeClass('d-flex');
        $('.table-edit .data-items').addClass('data-items-unset');
        activeTabDefault();
        isChange = false;
    }

    function successChange(){
        $('#select-all').prop('checked',false);
        $('.action-btns .actions-dropodown').hide();
        $('#select-all').removeClass('checkbox-all-custom');
    }

    function activeTabDefault(){
        $('.tab-pane,.nav-tabs .nav-link').removeClass('active');
        $('.nav-tabs').find('.nav-link').first().addClass('active');
        $('.tab-content').find('.tab-pane').first().addClass('active');
    }
});