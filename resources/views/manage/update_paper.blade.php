@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">修改试卷</div>

                    <div class="panel-body">
                        @include('common.errors')
                        <form action="{{url('/paper/store')}}" method="post">
                            {!! csrf_field() !!}
                            <input type="hidden" name="id" value="{{$paper->id}}">
                            <div class="form-group">
                                <label for="name">试卷名</label>
                                <input class="form-control" type="text" name="name"
                                       placeholder="请输入试卷名" value="{{$paper->name}}">
                            </div>
                            <div class="form-group">
                                <label for="score">分值</label>
                                <input class="form-control" type="number" name="score"
                                       placeholder="请输入试卷总成绩" value="{{$paper->score}}">
                            </div>
                            <div class="form-group">
                                <label for="time">时间</label>
                                <input type="number" class="form-control" id="time" name="time"
                                       value="{{$paper->time}}">
                            </div>
                            <div class="form-group">
                                <label for="remark">备注</label>
                                <input type="text" class="form-control" id="remark" name="remark"
                                       value="{{$paper->remark}}">
                            </div>
                            <button class="btn btn-primary" type="submit">提交</button>
                            <a type="button" href="{{url('/papers')}}" class="btn btn-default">关闭</a>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
