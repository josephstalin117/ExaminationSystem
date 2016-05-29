@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">考场学生管理</div>

                    <div class="panel-body">
                        @include('common.errors')
                        <div class="row" style="margin-top: 10px">
                            <a href="" type="button" class="btn btn-primary" data-toggle="modal"
                               data-target="#search_user_dialog">添加考试学生</a>
                        </div>
                        @if(count($room_users)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>考生名</th>
                                        <th>删除考生</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($room_users as $room_user)
                                        <tr class="openModal" data-id="{{$room_user->id}}">
                                            @if($room_user->user)
                                                <td>{{$room_user->user->profile->nickname}}</td>
                                                <td>
                                                    <a href="" type="button" class="btn btn-danger"
                                                       onclick="remove_user({{$room_user->id}})">删除考生</a>
                                                </td>
                                            @else
                                                <td>暂无考生</td>
                                                <td>
                                                    <a href="" type="button" class="btn btn-danger"
                                                       onclick="">删除考生</a>
                                                </td>
                                            @endif
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
    <!--search user Modal -->
    <div class="modal fade" id="search_user_dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">学生</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="search_content" name="search_content"
                                       placeholder="请输入学生姓名">
                            </div>
                            <ul class="list-group" id="list_users">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $("#search_content").change(function () {
            $.ajax({
                url: "{{url('/api/usermanage/search')}}" + "/" + $("#search_content").val(),
                dataType: "json",
                method: "get",
                success: function (result) {
                    if ("success" == result.status) {
                        $("#list_users").html('');
                        for (var i = 0; i < result.users.length; i++) {
                            $("#list_users").append("<li class='list-group-item' id=" + result.users[i].id + "></li>");
                            $("#" + result.users[i].id).append(result.users[i].nickname);
                            $("#" + result.users[i].id).append("<a class='btn btn-success follow' onclick='add_user(" + result.users[i].id + ")'>添加</a>");
                        }

                    }
                }
            });
        });

        function add_user(user_id) {
            $.ajax({
                url: "{{url('/api/roommanage')}}" + "/" + "{{$room_id}}" + "/user/" + user_id,
                dataType: "json",
                method: "get",
                success: function (result) {
                    if ("success" == result.status) {
                        alert("添加学生成功");
                        location.reload();
                    } else if ("existed" == result.status) {
                        alert("学生已经添加");
                    }
                }
            });
        }

        function remove_user(room_user_id) {
            if (confirm("是否删除?")) {
                $.ajax({
                    url: "{{url('/api/roommanage/user/remove')}}" + "/" + room_user_id,
                    dataType: "json",
                    method: "get",
                    success: function (result) {
                        if ("success" == result.status) {
                            location.reload();
                        }
                    }
                });
            }

        }
    </script>
@endsection
