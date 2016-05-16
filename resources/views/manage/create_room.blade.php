@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">试卷管理</div>

                    <div class="panel-body">
                        @include('common.errors')
                        <form action="{{url('/roommange/store')}}" method="post">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="name">试卷</label>
                                <input class="form-control" type="text" id="paper_id" name="paper_id"
                                       placeholder="请输入试卷名" disabled>
                                <a href="" type="button" data-id=""
                                   class="btn btn-primary openDetail" data-toggle="modal"
                                   data-target="#search_paper">搜索试卷</a>
                            </div>
                            <div class="form-group">
                                <label for="">考场名</label>
                                <input class="form-control" id="name" name="name"
                                       placeholder="请输入考场名">
                            </div>
                            <div class="form-group">
                                <label for="">参加考试学生</label>
                                <input class="form-control" type="text" id="users_id" name="users_id"
                                       placeholder="参加考试的学生" disabled>
                                <a href="" type="button" data-id=""
                                   class="btn btn-primary openDetail" data-toggle="modal"
                                   data-target="#search_students">添加考试学生</a>
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
    </div>
    <!--search paper Modal -->
    <div class="modal fade" id="search_paper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">搜索试卷</h4>
                </div>
                <div class="modal-body">
                    @include('manage.search_papers')
                </div>
            </div>
        </div>
    </div>
    <!--search students Modal -->
    <div class="modal fade" id="search_paper" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">创建考场</h4>
                </div>
                <div class="modal-body">
                    <form action="{{url('/roommange/create')}}" method="post">
                        {!! csrf_field() !!}
                        <div class="form-group">
                            <label for="room_create">试卷名</label>
                            <input class="form-control" type="text" id="paper_name" name="name"
                                   placeholder="请输入试卷名">
                        </div>
                        <div class="form-group">
                            <label for="">考场名</label>
                            <input class="form-control" type="text" name="score"
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
        $(document).on("click", ".getPaper", function () {
            var paper_id = $(this).data('id');
            var paper_name = $(this).data('name');
            $("#paper_id").val(paper_id);
        });
    </script>
@endsection
