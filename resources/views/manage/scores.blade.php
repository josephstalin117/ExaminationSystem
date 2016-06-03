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
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($scores as $score)
                                        <tr class="openModal" data-id="{{$score->id}}">
                                            @if($score->user)
                                                <td>{{$score->user->profile->nickname}}</td>
                                            @else
                                                <td>暂无考生</td>
                                            @endif
                                            @if($score->paper)
                                                <td>{{$score->paper->name}}</td>
                                            @else
                                                <td>暂无试卷</td>
                                            @endif
                                            <td>{{$score->score}}</td>
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
@endsection
