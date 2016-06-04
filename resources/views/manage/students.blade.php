@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">添加学生管理</div>

                    <div class="panel-body">
                        @include('common.errors')
                        @if(count($students)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>考生名</th>
                                        <th>添加这个考生</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{$student->nickname}}</td>
                                            <td>
                                                <a href="" type="button" class="btn btn-danger"
                                                   onclick="add_user({{$student->id}})">添加这个考生</a>
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
        function add_user(user_id) {
            $.ajax({
                url: "{{url('/api/roommanage')}}" + "/" + "{{$room_id}}" + "/user/" + user_id,
                dataType: "json",
                method: "get",
                success: function (result) {
                    if ("success" == result.status) {
                        alert("添加学生成功");
                    } else if ("existed" == result.status) {
                        alert("学生已经添加");
                    }
                }
            });
        }
    </script>
@endsection
