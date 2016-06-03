@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">创建题目</div>

                    <div class="panel-body">
                        @include('common.errors')
                        <form action="{{url('/question/single/store')}}" method="post">
                            {!! csrf_field() !!}
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
                                <a type="button" class="btn btn-default" href="{{url('/question/singles')}}">关闭</a>
                                <button type="submit" class="btn btn-primary">保存</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
    </script>
@endsection
