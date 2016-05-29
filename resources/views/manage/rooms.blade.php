@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">试卷管理</div>

                    <div class="panel-body">
                        @include('common.errors')
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
                                        <th>考场成绩</th>
                                        <th>考试学生</th>
                                        <th>删除</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($rooms as $room)
                                        <tr class="openModal" data-id="{{$room->id}}">
                                            <td>{{$room->name}}</td>
                                            @if(count($room->paper))
                                                <td>{{$room->paper->name}}</td>
                                                <td>{{$room->paper->score}}</td>
                                                <td>{{$room->paper->time}}</td>
                                            @else
                                                <td>暂无试卷</td>
                                                <td>暂无成绩</td>
                                                <td>暂无数据</td>
                                            @endif
                                            <td>{{$room->remark}}</td>
                                            <td>
                                                @if(count($room->paper))
                                                    <a href="{{url('roommanage/room/'.$room->id.'/paper/'.$room->paper_id)}}"
                                                       type="button" class="btn btn-primary">查看考场成绩</a></td>
                                            @else
                                                <a href="" type="button" class="btn btn-primary">查看考场成绩</a></td>
                                            @endif
                                            <td>
                                                <a href="{{url('roommanage/edit/'.$room->id)}}" type="button"
                                                   data-id="{{$room->id}}"
                                                   class="btn btn-primary">修改</a></td>
                                            <td>
                                                <a href="" type="button" onclick="delete_room({{$room->id}})"
                                                   class="btn btn-danger"><i class="fa fa-btn fa-trash"></i>删除</a>
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
        function delete_room(id) {
            if (confirm("是否删除此考场")) {
                $.ajax({
                    url: "{{url('/api/roommanage/delete')}}" + "/" + id,
                    dataType: "json",
                    method: "get",
                    success: function (data) {
                        if ("success" == data.status) {
                            location.reload();
                        }
                    }
                });
            }
        }
    </script>
@endsection
