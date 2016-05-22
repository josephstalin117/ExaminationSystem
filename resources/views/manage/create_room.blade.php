@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">创建考场</div>

                    <div class="panel-body">
                        @include('common.errors')
                        <form action="{{url('/roommanage/store')}}" method="post">
                            {!! csrf_field() !!}
                            <div class="form-group">
                                <label for="name">试卷</label>
                                <input class="form-control" type="text" id="show_paper"
                                       placeholder="试卷名" disabled>
                                <input class="form-control" type="hidden" id="paper_id" name="paper_id">
                                <a href="" type="button" class="btn btn-primary openDetail" data-toggle="modal"
                                   data-target="#search_paper">搜索试卷</a>
                            </div>
                            <div class="form-group">
                                <label for="">考场名</label>
                                <input class="form-control" id="name" name="name"
                                       placeholder="请输入考场名">
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
                    <div class="row">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="search_content" name="search_content"
                                       placeholder="请输入试卷名">
                            </div>
                            <ul class="list-group" id="list_papers">
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
                url: "{{url('/api/papers/search')}}" + "/" + $("#search_content").val(),
                dataType: "json",
                method: "get",
                success: function (result) {
                    if ("success" == result.status) {
                        $("#list_papers").html('');
                        for (var i = 0; i < result.papers.length; i++) {
                            $("#list_papers").append("<li class='list-group-item' id=" + result.papers[i].id + "></li>");
                            $("#" + result.papers[i].id).append(result.papers[i].name);
                            $("#" + result.papers[i].id).append("<a class='btn btn-success follow' onclick='add_paper(" + result.papers[i].id + ")'>添加</a>");
                        }

                    }
                }
            });
        });

        function add_paper(paper_id) {
            $("#paper_id").val(paper_id);
            $("#show_paper").val(paper_id);
        }
    </script>
@endsection
