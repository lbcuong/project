<?php

use App\Models\Goods;
use App\Models\GoodsIssue;
use App\Models\GoodsReceipt;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
function saveImageDirectory($image)
{
    $directory =  config('default.directory.images.inventory');
    $path = $image->move($directory, $image->getClientOriginalName());
    return $path->getPathName();
}

function getColumnDataBase($table,$diff = array())
{
    $columns = Schema::getColumnListing($table);
    $diffDefault = ['id','created_at','updated_at'];
    $diffColumns = array_merge($diffDefault,$diff);
    return array_diff( $columns, $diffColumns);
}


function getLableSelect($column,$value){
    switch ($column) {
        case 'gender':
            ($value ==  1) ? 'Nam' : 'Nữ';
            break;
        default: null;
    }
}

function formatDate($date){
    return date("Y-m-d", strtotime($date));
}
function getNextId($table)
{
    $statement = DB::select("show table status like '$table'");
    return $statement[0]->Auto_increment;
}

function getCodeNextId($table,$title){
    preg_match_all('/(?<=\s|^)[a-z]/i', $title, $matches);
    $words = '';
    foreach($matches[0] as $matche){
        $words .= $matche;
    }
    $nextId = str_pad(getNextId($table), 5, '0', STR_PAD_LEFT);
    return trim($words.$nextId);
}

function inputTypeDate(){
    return [
        'from_date',
        'thru_date'
    ];
}

function inputTypeSelect(){
    $columnSelects = [

    ];
    return $columnSelects;
}
function checkInputTypeSelect($column){
    $columnSelects =  inputTypeSelect();
    return in_array($column,$columnSelects);
}

function getTypeColumn($table,$column)
{
    try {
        return DB::getSchemaBuilder()->getColumnType($table, $column);

    } catch (Exception $e) {

        $isFieldDate = in_array($column,inputTypeDate());
        if($isFieldDate)  return 'date';

    }
}

function tablePrefixName($table){
    return $table . '.';
}

function getTableParameters()
{
    return [
        'aaSorting'=> [],
        'info' =>false,
        'paging' => true,
        'orderCellsTop' => true,
        'search' => ['regex' =>true],
        'columnDefs' =>[['targets'=> 0,'className'=>'dt-checkboxes-cell','width'=> '8%','orderable'=> false]],
        'dom' =>  '<"top actions-sticky"<"actions action-btns"B><"action-filters"lf>><"clear">rt<"bottom"<"actions">p>',
        'oLanguage' => ['sLengthMenu' => '_MENU_','sSearch' => ''],
        'aLengthMenu' => [[4, 10, 15, 20,100], [4, 10, 15, 20,100]],
        'pageLength' => 100,
        'buttons'=> [[
            'text' =>"<i class='feather icon-plus'></i> Thêm",
            'className' => "add-new-btn action-edit"
        ]],
        'deferRender' => true,
        'scrollY' => 500,
        'scrollCollapse' => true,
        'scroller' => true,
        'initComplete' => "function () {

                var api = this.api();
            // For each column
            api
                .columns()
                .eq(0)
                .each(function (colIdx) {
                    var cell = $('.filters th').eq(
                        $(api.column(colIdx).header()).index()
                    );
                   
                    if($(cell).hasClass('filter-disable')){ 
                          $(cell).html('');
                    }else{
                        var option = '';
                        api.column(colIdx).data().unique().sort().each( function ( d, j ) {
                            option += '<option value=\"'+d+'\">'+d+'</option>';
                        });   

                        $(cell).html('<div class=\"form-group\"><select class=\"select2 form-control\" multiple=\"multiple\">'+option+'</select></div>');
                    }
                    $(
                        'select',
                        $('.filters th').eq($(api.column(colIdx).header()).index())
                    )
                        .off('change')
                        .on('change', function (e) {
                            var search = [];
                            e.stopPropagation();
                            e.preventDefault()
                            search = $(this).val().join('|');
                             console.log(search);
                            api
                                .column(colIdx)
                                .search(search,true, false)
                                .draw();
                        });   
                });  
                      $('.select2').select2({
                            dropdownAutoWidth: true,
                            width: '100%'
                         }); 
                }",
    ];
}


function tableTransaction(){
    $params = [
        'reorder_guidelines',
        'goods_receipts',
        'goods_issues'
    ];
    return $params;
}

function isJson($string) {
    json_decode($string);
    return (json_last_error() == JSON_ERROR_NONE);
}
function getLabelApprove($value){
    return  array_search($value, config('default.is_approve'));
}

function getItemAutocomplete($request)
{
    $search = $request->search;
    if($search == ''){
        $goodsItem = Goods::orderby('id','asc')->limit(5)->get();
    }else{
        $goodsItem = Goods::whereRelation('product','name','like', '%' .$search . '%')->limit(5)->get();
    }
    $response = array();
    foreach($goodsItem as $goods){
        $response[] = array(
            'value'=>   $goods->id,
            'label'=>   $goods->product->name,
            'code' =>   $goods->product->code
        );
    }
    return  json_encode($response);
}

function tabComponemts($table){
    $tabs = array();
    switch ($table) {
        case "measuring_units":
            $tabs['overview'] = array('code','name');
            $tabs['tab2'] = array('comment');


            return $tabs;
            break;
        default:
            return $tabs;
    }
}
function fillActionComponents($table){
    $tableInFill = array('measuring_units');
    return in_array($table,$tableInFill);
}