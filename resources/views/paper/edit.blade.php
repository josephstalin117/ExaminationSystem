@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">修订试卷</div>

                    <div class="panel-body">
                        @include('common.errors')
                        <div class="row">
                            <a type="button" class="btn btn-success" data-toggle="modal"
                               data-target="#create_dialog">添加题目
                            </a>
                            <a type="button" class="btn btn-primary" data-toggle="modal"
                               data-target="#search_dialog">导入题目
                            </a>
                        </div>
                        @if(count($questions)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <tbody>
                                    @foreach($questions as $question)
                                        <tr class="openModal" data-id="{{$question->id}}">
                                            <td>{{$question->single->title}}</td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="{{$question->id}}" id="a" value="a"
                                                               checked>
                                                        {{$question->single->a}}
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="{{$question->id}}" id="b" value="b">
                                                        {{$question->single->b}}
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="{{$question->id}}" id="c" value="c">
                                                        {{$question->single->c}}
                                                    </label>
                                                </div>
                                                <div class="radio">
                                                    <label>
                                                        <input type="radio" name="{{$question->id}}" id="d" value="d">
                                                        {{$question->single->d}}
                                                    </label>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <b>答案</b>
                                                <p>{{$question->single->answer}}</p>
                                                <b>说明</b>
                                                <p>{{$question->single->remark}}</p>
                                                <b>分值</b>
                                                <p>{{$question->single->score}}</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><a href="{{url('/question/single/update/').'/'.$question->single->id}}"
                                                   type="button" class="btn btn-primary">修订</a>
                                                <a href="" type="button"
                                                   onclick="remove_single({{$question->id}})"
                                                   class="btn btn-danger">
                                                    <i class="fa fa-btn fa-trash"></i>删除</a>
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
                    <h4 class="modal-title">创建一个题目</h4>
                </div>
                <div class="modal-body">
                    <form action="{{url('/question/create')}}" method="post">
                        {!! csrf_field() !!}
                        <input type="hidden" name="paper_id" id="paper_id" value="{{$paper->id}}">
                        <div class="form-group">
                            <label for="title">题目</label>
                            <input class="form-control" type="text" name="title"
                                   placeholder="请输入题目">
                        </div>
                        <div class="form-group">
                            <label for="score">分值</label>
                            <input class="form-control" type="number" name="score"
                                   placeholder="请输入分数">
                        </div>
                        <div class="form-group">
                            <label for="a">a选项</label>
                            <input type="text" class="form-control" name="a">
                        </div>
                        <div class="form-group">
                            <label for="b">b选项</label>
                            <input type="text" class="form-control" name="b">
                        </div>
                        <div class="form-group">
                            <label for="c">c选项</label>
                            <input type="text" class="form-control" name="c">
                        </div>
                        <div class="form-group">
                            <label for="d">d选项</label>
                            <input type="text" class="form-control" name="d">
                        </div>
                        <div class="form-group">
                            <label for="answer">答案</label>
                            <select name="answer" id="answer" class="form-control">
                                <option value="a">A</option>
                                <option value="b">B</option>
                                <option value="c">C</option>
                                <option value="d">D</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="remark">备注</label>
                            <input type="text" class="form-control" id="remark" name="remark">
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

    <!--search user Modal -->
    <div class="modal fade" id="search_dialog" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">试题</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="form-group">
                            <div class="input-group">
                                <input type="text" class="form-control" id="search_content" name="search_content"
                                       placeholder="请输入题目内容">
                            </div>
                            <ul class="list-group" id="list_singles">
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        function remove_single(id) {
            if (confirm("是否移除此题目")) {
                $.ajax({
                    url: "{{url('/api/papermanage/question/remove')}}" + "/" + id,
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

        $("#search_content").change(function () {
            $.ajax({
                url: "{{url('/api/questionmanage/single/search')}}" + "/" + $("#search_content").val(),
                dataType: "json",
                method: "get",
                success: function (result) {
                    if ("success" == result.status) {
                        $("#list_singles").html('');
                        for (var i = 0; i < result.singles.length; i++) {
                            $("#list_singles").append("<li class='list-group-item' id=" + result.singles[i].id + "></li>");
                            $("#" + result.singles[i].id).append(result.singles[i].title);
                            $("#" + result.singles[i].id).append("<a class='btn btn-success follow' onclick='add_single(" + result.singles[i].id + ")'>添加</a>");
                        }

                    }
                }
            });
        });

        function add_single(id) {
            $.ajax({
                url: "{{url('/api/papermanage/import/paper')}}" + "/" + "{{$paper->id}}" + "/single/" + id,
                dataType: "json",
                method: "get",
                success: function (result) {
                    if ("success" == result.status) {
                        alert("添加试题成功");
                        location.reload();
                    } else if ("existed" == result.status) {
                        alert("试题已经添加");
                    }
                }
            });
        }

    </script>
@endsection