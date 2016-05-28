@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">更新题目</div>

                    <div class="panel-body">
                        @include('common.errors')
                        <form action="{{url('/question/single/store')}}" method="post">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" value="{{$single->id}}">
                            <div class="form-group">
                                <label for="title">题目</label>
                                <input class="form-control" type="text" name="title"
                                       placeholder="请输入题目" value="{{$single->title}}">
                            </div>
                            <div class="form-group">
                                <label for="score">分值</label>
                                <input class="form-control" type="number" name="score"
                                       placeholder="请输入分数" value="{{$single->score}}">
                            </div>
                            <div class="form-group">
                                <label for="a">a选项</label>
                                <input type="text" class="form-control" name="a" value="{{$single->a}}">
                            </div>
                            <div class="form-group">
                                <label for="b">b选项</label>
                                <input type="text" class="form-control" name="b" value="{{$single->b}}">
                            </div>
                            <div class="form-group">
                                <label for="c">c选项</label>
                                <input type="text" class="form-control" name="c" value="{{$single->c}}">
                            </div>
                            <div class="form-group">
                                <label for="d">d选项</label>
                                <input type="text" class="form-control" name="d" value="{{$single->d}}">
                            </div>
                            <div class="form-group">
                                <label for="answer">答案</label>
                                <select name="answer" id="answer" class="form-control">
                                    <option value="a" @if('a'==$single->answer)selected="selected"@endif>A</option>
                                    <option value="b" @if('b'==$single->answer)selected="selected"@endif>B</option>
                                    <option value="c" @if('c'==$single->answer)selected="selected"@endif>C</option>
                                    <option value="d" @if('d'==$single->answer)selected="selected"@endif>D</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="remark">备注</label>
                                <input type="text" class="form-control" id="remark" name="remark"
                                       value="{{$single->remark}}">
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
    <script>
    </script>
@endsection
