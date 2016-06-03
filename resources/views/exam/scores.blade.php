@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">考试成绩</div>

                    <div class="panel-body">
                        @include('common.errors')
                        @if(count($scores)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>考场名</th>
                                        <th>试卷名</th>
                                        <th>成绩</th>
                                        <th>时间</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($scores as $score)
                                        <tr class="openModal" data-id="{{$score->id}}">
                                            @if($score->room)
                                                <td>{{$score->room->name}}</td>
                                            @else
                                                <td>暂无姓名</td>
                                            @endif
                                            @if($score->paper)
                                                <td>{{$score->paper->name}}</td>
                                            @else
                                                <td>暂无试卷名</td>
                                            @endif
                                            <td>{{$score->score}}</td>
                                            <td>{{$score->created_at}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                {!! $scores->links() !!}
                            </div>
                        @else
                            <div class="row">
                                暂无考场成绩
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
