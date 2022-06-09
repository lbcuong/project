<?php

namespace App\Http\Controllers;

use App\DataTables\ReordersDataTable;
use App\Http\Requests\ReorderRequest;
use App\Models\CaseModel;
use App\Models\ReorderGuideline;
use Illuminate\Http\Request;
use App\Models\Goods;
use App\Models\User;
use App\Models\ReorderItem;
class ReorderController extends Controller
{
    const TITLE = "Phiếu yêu cầu vật tư";
    const TABLE = "reorder_guidelines";

    public function index(ReorderRequest $request,ReorderGuideline $reorderGuideline)
    {
        if ($request->isMethod('get')){
            $title = self::TITLE;
            $table = self::TABLE;
            $oldData['route'] = route('reorder_guidelines',['reorderGuideline' => $oldData->id ?? '']);
            $diffColumn = $this->diffColumn();
            $columns = getColumnDataBase($table,$diffColumn);
            $isDetail = false;
            $permission = true;
            return response()->json( array('success' => true,'html'=>view('reorders.index',
                compact('table','title','oldData','isDetail','columns','permission'))
                ->render()));
        }else
            return $this->store($request);
    }

    public function store($request)
    {
        $params = $request->all();
        if(!isset($params['goods'])){
            $message = 'Chưa nhập chi tiết vật tư';
            return response()->json( array('success' => false,'message'=>$message));
        }

        $checkEditer = ReorderGuideline::where('code',$params['code']);
        if($checkEditer->count()){
            $checkEditer->first()->update($params);
            $message = "Cập nhập thành công.";
        }else{
            $reorderGuideline = ReorderGuideline::create($params);
            $message = "Thêm thành công.";
            $params['reorder_guideline_id'] = $reorderGuideline->id;
                foreach($params['goods'] as $key => $goodsId){
                    $goods = Goods::find($goodsId);
                    $params['goods_id'] = $goodsId;
                    $params['reorderable_type'] = ReorderGuideline::class;
                    $params['reorderable_id'] = $reorderGuideline->id;
                    $params['reorder_quantity'] = $params['reorder_quantity'][$key];
                    $params['comment'] = $params['comment_items'][$key];
                    ReorderItem::create($params);
                    $goods->reorder_guideline_id = $reorderGuideline->id;
                    $goods->save();
                }
        }
        return response()->json( array('success' => true,'message'=>$message));
    }

    public function edit(ReorderGuideline $reorderGuideline)
    {
        $oldData = $reorderGuideline;
        $routeSubmit = route(self::TABLE,['container'=> $reorderGuideline->id]);
        return response()->json( array('success' => true,'old' => $oldData,'route'=>$routeSubmit));
    }

    public function detail(ReorderGuideline $reorderGuideline)
    {
        $title = self::TITLE;
        $table = self::TABLE;
        $diffColumn = $this->diffColumn();
        $columns = getColumnDataBase($table,$diffColumn);
        $oldData = $reorderGuideline;
        $isDetail = true;
        $permission = true;
        return response()->json( array('success' => true,'html'=>view('reorders.index',
            compact('table','title','oldData','isDetail','columns','permission'))->render()));
    }

    public function destroy(Request $request)
    {
        $checkboxIds = json_decode($request->checkboxed,true);
        ReorderGuideline::whereIn('id',$checkboxIds)->delete();
        $message = 'Đã xoá thành công.';
        return response()->json( array('success' => true,'message'=>$message));
    }

    public function list(ReordersDataTable $dataTable){
        $title = self::TITLE;
        $table = self::TABLE;
        $diffColumn = array(
            'warehouse_id'
        );
        $columns = getColumnDataBase($table,$diffColumn);
        return $dataTable->render('layouts.tables.index',compact('title','table','columns'));
    }

    public function approve(ReorderGuideline $reorderGuideline, Request $request){
        $reorderGuideline->approve_comment = $request->comment;
        if($request->isApprove)
            $reorderGuideline->is_approve = config('default.is_approve.approved');
        else
            $reorderGuideline->is_approve = config('default.is_approve.disapprove');

        $reorderGuideline->save();
        $message = 'Cập nhập thành công.';
        return response()->json( array('success' => true,'message'=>$message));
    }

    protected function diffColumn(){
        return array(
            'reorder_level',
            'is_approve',
            'reorder_quantity',
            'approve_comment'
        );
    }


    public function editItem(Request $request){
        $request->validate([
            'reorder_quantity.*' => 'required|integer',
        ]);

        $params = $request->all();
        $rowId = $request->row_id;
        if($rowId){
            foreach($params['goods'] as $key => $goodsId){
                $params['goods_id'] = $goodsId;
                $params['reorder_quantity'] = $params['reorder_quantity'][0];
                $params['comment'] = $params['comment_items'][0];
            }
            $model = ReorderItem::find($rowId);
            $model->update($params);
        }else{
            if($params['goods']){
                foreach($params['goods'] as $key => $goodsId){
                    $params['goods_id'] = $goodsId;
                    $params['reorderable_type'] = ReorderGuideline::class;
                    $params['reorderable_id'] = $params['transaction_id'];
                    $params['reorder_quantity'] = $params['reorder_quantity'][$key];
                    $params['comment'] = $params['comment_items'][$key];
                    $model = ReorderItem::create($params);
                }
            }
        }
        $message = 'Cập nhập thành công';
        $dataUpdate = array('reorder_quantity'=>$model->reorder_quantity,'comment_items'=>$model->comment);
        return response()->json( array('success' => true,'message'=>$message,'rowId'=>$model->id,'model'=>$dataUpdate));
    }

    public function deleteItem(Request $request){
        $itemId = $request->row_id;
        $reorderItem = ReorderItem::find($itemId);
        $reorderItem->delete();
        return response()->json( array('success' => true));
    }
}
