<section id="data-list-view" class="data-list-view-header">
    <div class="table-edit">
        <div class="add-new-data-sidebar">
            <div class="overlay-bg"></div>
            <div class="add-new-data">
                <!-- Add class "white" => Header background color white -->
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
                <!--Template FillAction -->
                @widget('FillAction',['table'=>$table])
                <!--End Template FillActionr -->

                <!--Template TabComponent Header -->
                @widget('TabComponents',['table'=>$table])
                <!--End Template TabComponent Header -->

                <div class="data-items pb-3 data-items-unset">
                    <form method="post" id="form-data-list" action="{{ route($table)}}" enctype="multipart/form-data">
                        @csrf
                    <div class="data-fields mt-2 px-2">
                        <div class="row d-block">
                        <input type="hidden" name="code_old" id="code-old">
                            <div class="tab-content">
                                <!--TAB 1 -->
                                <div class="tab-pane active" id="overview" aria-labelledby="overview-tab" role="tabpanel">
                                    <div class="col-md-12">
                                        <label>Mã đơn vị</label>
                                        <div class="form-group">
                                            <input type="text" name="code" class="form-control" disabled="">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Tên đơn vị</label>
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control">
                                        </div>
                                    </div>
                                </div>

                                <!--TAB 2 -->
                                <div class="tab-pane" id="tab2" aria-labelledby="tab2-tab" role="tabpanel">
                                    <div class="col-md-12">
                                        <label>Select</label>
                                        <div class="form-group">
                                            <select class="select2 form-control">
                                                <option value="square">Square</option>
                                                <option value="rectangle">Rectangle</option>
                                                <option value="rombo">Rombo</option>
                                                <option value="romboid">Romboid</option>
                                                <option value="trapeze">Trapeze</option>
                                                <option value="polygon">Polygon</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <label>Nhận xét</label>
                                        <div class="form-group">
                                            <input type="text" name="comment" class="form-control">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--SHOW VALIDATE -->
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