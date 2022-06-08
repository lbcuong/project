<div class="modal fade text-left" id="xlarge" tabindex="-1" role="dialog" aria-labelledby="myModalLabel16" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-xl" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myModalLabel16">Chi Tiết</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <table id="table" class="table">
                    <thead class="thead-detail">
                    <tr>
                        @foreach($columns as $column)
                            <th>{{__(tablePrefixName($table).$column)}}</th>
                        @endforeach
                    </tr>
                    </thead>
                    <tbody>
                    <tr>
                        @foreach($columns as $column)
                            @if($param[$column] == '') @continue @endif
                            @if($column == 'is_approve')
                                <th>
                                    {{$param[$column] ? "Đã duyệt" : "Chưa duyệt" }}
                                </th>
                            @elseif($column == 'image')
                                <th class="table-image"><img width="30%" src="{{$param[$column] }}"></th>
                            @elseif(getTypeColumn($table,$column) == 'date')
                                <th>{{date("d-m-Y", strtotime($param[$column] ))}}</th>
                            @elseif($column == 'gender')
                                <th>{{ getLableSelect($column,$param[$column])}}</th>
                            @else
                                <th>{{$param[$column]}}</th>
                            @endif
                        @endforeach
                    </tr>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-danger" data-dismiss="modal">Đóng</button>
            </div>
        </div>
    </div>
</div>

