@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">选择试卷</div>

                    <div class="panel-body">
                        @include('common.errors')
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
                                        <th>考试</th>
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
                                            <td><a href="{{url('/exam/paper').'/'.$paper->id}}" type="button"
                                                   class="btn btn-primary openDetail">参加考试</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="row">暂无考试</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
