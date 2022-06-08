<section id="data-list-view" class="data-list-view-header">
    <div class="table-edit">
        <div class="add-new-data-sidebar">
            <div class="overlay-bg"></div>
            <div class="add-new-data">
                <div class="div px-2 d-flex new-data-title justify-content-between {{in_array($table,tableTransaction()) ? 'white' : ''}}" >
                    <div class="sidebar-arrow-left hide-data-sidebar">
                        <i class="feather icon-arrow-left"></i>
                    </div>
                    <div class="sidebar-title">
                        <h4 class="text-uppercase fw-bold title">Sửa</h4>
                    </div>
                    <div class="sidebar-more-vertical">
                        <div class="sidebar-actions">
                            <div class="d-flex flex-row-reverse">
                                <div class="btn-group">
                                    <div class="dropdown">
                                        <button type="text" class="btn waves-effect waves-light" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <i class="feather icon-more-vertical"></i>
                                        </button>
                                        <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <a href="#" class="from-edit dropdown-item"><i class="feather icon-edit"></i>Sửa</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @widget('TabComponents',['table'=>$table])
                <div class="data-items pb-3 data-items-unset">
                    <form method="post" id="form-data-list" action="{{ route($table)}}" enctype="multipart/form-data">
                        @csrf
                    <div class="data-fields mt-3 px-2">
                        <div class="row d-block">
                        <input type="hidden" name="code_old" id="code-old">
                        @if(tabComponemts($table))
                            <div class="tab-content">
                                @foreach(tabComponemts($table) as $key => $columnNames)
                                    <div class="tab-pane {{($key == 'overview') ? 'active' : ''}}" id="{{$key}}" aria-labelledby="{{$key}}-tab" role="tabpanel">
                                        @foreach($columns as $column)
                                            @if(!in_array($column,$columnNames))
                                                @continue
                                            @endif
                                            <div class="col-md-12">
                                                <label>{{__($tablePrefix.$column)}}</label>
                                                <div class="form-group">
                                                    <input type="text"  name="{{$column}}"  class="form-control" {{($column == 'code') ? 'disabled' : ''}}>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                @endforeach
                            </div>
                        @else
                                @foreach($columns as $column)
                                    <div class="col-md-12">
                                        <label>{{__($tablePrefix.$column)}}</label>
                                        <div class="form-group">
                                            <input type="text"  name="{{$column}}"   class="form-control" {{($column == 'code') ? 'disabled' : ''}}>
                                        </div>
                                    </div>
                                @endforeach
                        @endif
                            <div class="row-error">
                                <div class="error">
                                    <div class="alert alert-warning alert-dismissible mb-2" role="alert">
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                        <p class="mb-0 message">
                                        </p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="add-data-footer d-none justify-content-around px-3 mt-2">
                    <div class="add-data-btn">
                        <button type="button" id="{{(in_array($table,tableTransaction())) ? 'action-approve-transaction' : 'btn-submit'}}" class="btn btn-primary">Lưu</button>
                    </div>
                    <div class="cancel-data-btn">
                        <button type="button" class="btn btn-outline-danger">Huỷ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>