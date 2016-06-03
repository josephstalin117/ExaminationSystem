@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">{{$name}} 试卷成绩列表</div>

                    <div class="panel-body">
                        @include('common.errors')
                        @include('manage.search')
                        @if(count($list)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>考生名</th>
                                        <th>成绩</th>
                                        <th>考场</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $item)
                                        <tr>
                                            <td>{{$item['nickname']}}</td>
                                            <td>{{$item['score']}}</td>
                                            <td>{{$item['room_name']}}</td>
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
@endsection
