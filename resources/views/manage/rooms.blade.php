@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">试卷管理</div>

                    <div class="panel-body">
                        @include('common.errors')
                        @include('paper.search')
                        <div class="row" style="margin-top: 10px">
                            <a href="{{url('roommanage/create')}}" class="btn btn-success">创建新考场</a>
                        </div>
                        @if(count($rooms)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>考场名</th>
                                        <th>试卷</th>
                                        <th>总分</th>
                                        <th>用时</th>
                                        <th>考场备注</th>
                                        <th>考试学生</th>
                                        <th>删除</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rooms as $room)
                                        <tr class="openModal" data-id="{{$room->id}}">
                                            <td>{{$room->name}}</td>
                                            <td>{{$room->paper->name}}</td>
                                            <td>{{$room->paper->score}}</td>
                                            <td>{{$room->paper->time}}</td>
                                            <td>{{$room->remark}}</td>
                                            <td><a href="{{url('roommanage/edit/'.$room->id)}}" type="button"
                                                   data-id="{{$room->id}}"
                                                   class="btn btn-primary">修改</a></td>
                                            <td>
                                                <a href="" type="button" data-id="{{$room->id}}"
                                                   class="btn btn-danger" data-toggle="modal"
                                                   data-target="#delete_dialog"><i class="fa fa-btn fa-trash"></i>删除</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $(document).on("click", ".openModal", function () {
            var user_id = $(this).data('id');
            $("#delete_confirm").click(function () {
                $.ajax({
                    url: "{{url('/')}}/api/paper/delete/" + user_id,
                    dataType: "json",
                    method: "get",
                    success: function (data) {
                        if ("success" == data.status) {
                            console.log('1');
                            location.reload();
                        }
                    }
                });
            });
        });
    </script>

@endsection
