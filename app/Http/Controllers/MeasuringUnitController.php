<?php

namespace App\Http\Controllers;

use App\DataTables\MeasuringUnitsDataTable;
use App\Http\Requests\MeasuringUnitRequest;
use App\Models\MeasuringUnit;
use Illuminate\Http\Request;

class MeasuringUnitController extends Controller
{
    const TITLE = "ĐƠN VỊ TÍNH";
    const TABLE = "measuring_units";

    public function index(MeasuringUnitsDataTable $dataTable, MeasuringUnitRequest $request,MeasuringUnit $measuringUnit)
    {
        $title = self::TITLE;
        $table = self::TABLE;
        $columns = getColumnDataBase($table);
        if ($request->isMethod('get'))
            return $dataTable->render('layouts.tables.index',compact('title','table','columns'));
        else
            return $this->store($request,$measuringUnit);
    }

    public function store($request,$model)
    {
        $params = $request->all();
        if($model->id){
            $model->update($params);
            $message = "Sửa thành công.";
        }
        else{
            MeasuringUnit::create($params);
            $message = "Thêm thành công.";
        }
        return response()->json( array('success' => true,'message'=>$message));
    }

    public function edit(MeasuringUnit $measuringUnit)
    {
        $oldData = $measuringUnit;
        $routeSubmit = route('measuring_units',['measuringUnit'=> $measuringUnit->id]);
        return response()->json( array('success' => true,'old' => $oldData,'route'=>$routeSubmit));
    }

    public function detail(MeasuringUnit $measuringUnit)
    {
        $table = self::TABLE;
        $columns = getColumnDataBase($table);
        $param = $measuringUnit;
        return response()->json( array('success' => true,'html'=>view('layouts.tables.detail', compact('columns','param','table'))->render()));
    }

    public function destroy(Request $request)
    {
        $checkboxIds = json_decode($request->checkboxed,true);
        MeasuringUnit::whereIn('id',$checkboxIds)->delete();
        $message = 'Đã xoá thành công.';
        return response()->json( array('success' => true,'message'=>$message));
    }

}
