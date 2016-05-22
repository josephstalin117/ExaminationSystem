@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">题库</div>

                    <div class="panel-body">
                        @include('common.errors')
                        @if(count($singles)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>题目</th>
                                        <th>A</th>
                                        <th>B</th>
                                        <th>C</th>
                                        <th>D</th>
                                        <th>答案</th>
                                        <th>分值</th>
                                        <th>时间</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($singles as $single)
                                        <tr class="openModal" data-id="{{$single->id}}">
                                            <td>{{$single->title}}</td>
                                            <td>{{$single->a}}</td>
                                            <td>{{$single->b}}</td>
                                            <td>{{$single->c}}</td>
                                            <td>{{$single->d}}</td>
                                            <td>{{$single->answer}}</td>
                                            <td>{{$single->score}}</td>
                                            <td>{{$single->created_at}}</td>
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
