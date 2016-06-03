@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">用户成绩统计</div>

                    <div class="panel-body">
                        @include('common.errors')
                        @include('manage.search')
                        @if(count($users)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>用户名</th>
                                        <th>查看成绩</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($users as $user)
                                        <tr class="openModal">
                                            <td>{{$user->nickname}}</td>
                                            <td>
                                                <a href="{{url('statistics/user')}}/{{$user->id}}" type="button"
                                                   class="btn btn-primary">查看成绩</a>
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
@endsection
