@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">成绩管理</div>

                    <div class="panel-body">
                        @include('common.errors')
                        @if(count($scores)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>学生名</th>
                                        <th>试卷</th>
                                        <th>成绩</th>
                                        <th>删除</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($scores as $score)
                                        <tr class="openModal" data-id="{{$score->id}}">
                                            <td>{{$score->user->profile->nickname}}</td>
                                            <td>{{$score->paper->name}}</td>
                                            <td>{{$score->score}}</td>
                                            <td>
                                                <a href="" type="button" data-id="{{$score->id}}"
                                                   class="btn btn-danger" data-toggle="modal"
                                                   data-target="#delete_dialog"><i class="fa fa-btn fa-trash"></i>删除</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="row">
                                暂无成绩
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
