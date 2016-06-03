@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">试卷统计</div>

                    <div class="panel-body">
                        @include('common.errors')
                        @include('manage.search')
                        @if(count($list)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>试卷名</th>
                                        <th>总分</th>
                                        <th>平均分</th>
                                        <th>最高分</th>
                                        <th>最低分</th>
                                        <th>查看</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($list as $item)
                                        <tr class="openModal" data-id="{{$item['id']}}">
                                            <td>{{$item['name']}}</td>
                                            <td>{{$item['total_score']}}</td>
                                            <td>{{$item['avg_score']}}</td>
                                            <td>{{$item['max_score']}}</td>
                                            <td>{{$item['min_score']}}</td>
                                            <td>
                                                <a href="{{url('statistics/paper/'.$item['id'])}}"
                                                   type="button" class="btn btn-primary">具体查看考场成绩</a></td>
                                            <td>
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
