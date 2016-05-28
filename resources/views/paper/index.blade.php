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
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#create_dialog">创建新试卷
                            </button>
                        </div>
                        @if(count($papers)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>试卷名</th>
                                        <th>出题人</th>
                                        <th>总分</th>
                                        <th>用时</th>
                                        <th>备注</th>
                                        <th>修订</th>
                                        <th>删除</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($papers as $paper)
                                        <tr class="openModal" data-id="{{$paper->id}}">
                                            <td>{{$paper->name}}</td>
                                            <td>{{$paper->user->profile->nickname}}</td>
                                            <td>{{$paper->score}}</td>
                                            <td>{{$paper->time}}</td>
                                            <td>{{$paper->remark}}</td>
                                            <td><a href="{{url('paper/edit/'.$paper->id)}}" type="button"
                                                   data-id="{{$paper->id}}"
                                                   class="btn btn-primary openDetail">修订</a></td>
                                            <td>
                                                <a href="" type="button" data-id="{{$paper->id}}"
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
    <!--create Modal -->
    <div class="modal fade" id="create_dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">创建试卷</h4>
                </div>
                <div class="modal-body">
                    <form action="{{url('/paper/create')}}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="name">试卷名</label>
                            <input class="form-control" type="text" id="paper_create" name="name"
                                   placeholder="请输入试卷名">
                        </div>
                        <div class="form-group">
                            <label for="score">试卷分值</label>
                            <input class="form-control" type="number" name="score"
                                   placeholder="请输入试卷成绩">
                        </div>
                        <div class="form-group">
                            <label for="time">时间</label>
                            <input type="number" class="form-control" id="time" name="time"
                                   placeholder="请输入时间">
                        </div>
                        <div class="form-group">
                            <label for="remark">备注</label>
                            <input type="text" class="form-control" id="remark" name="remark"
                                   placeholder="请输入备注">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    {{--delete Modal--}}
    <div class="modal fade" id="delete_dialog" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <h4>是否删除</h4>
                <a href="" type="button" id="delete_confirm" class="btn btn-danger" data-dismiss="modal">删除</a>
                <a type="submit" class="btn btn-primary" data-dismiss="modal">取消</a>
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
