@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">考场管理</div>

                    <div class="panel-body">
                        @include('common.errors')
                        @if(count($room_users)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>考场名</th>
                                        <th>试卷名</th>
                                        <th>总分</th>
                                        <th>用时</th>
                                        <th>备注</th>
                                        <th>考试</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($room_users as $room_user)
                                        <tr class="openModal" data-id="{{$room_user->room_id}}">
                                            <td>{{$room_user->room->name}}</td>
                                            <td>{{$room_user->room->paper->name}}</td>
                                            <td>{{$room_user->room->paper->score}}</td>
                                            <td>{{$room_user->room->paper->time}}</td>
                                            <td>{{$room_user->room->remark}}</td>
                                            <td><a href="{{url('/exam/room').'/'.$room_user->room_id.'/paper/'.$room_user->room->paper->id}}"
                                                   type="button"
                                                   class="btn btn-primary">参加考试</a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="row">
                                暂无考场
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
