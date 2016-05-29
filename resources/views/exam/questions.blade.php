@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">开始考试</div>

                    <div class="panel-body">
                        @include('common.errors')
                        @if(count($questions)>0)
                            <div class="row">
                                <form action="{{url("/exam/room/$room_id/paper/$paper_id/rate")}}" method="post">
                                    {!! csrf_field() !!}
                                    <table class="table table-bordered">
                                        @foreach($questions as $question)
                                            <tr class="openModal" data-id="{{$question->id}}">
                                                <td>{{$question->single->title}}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="{{$question->id}}" id="a"
                                                                   value="a">
                                                            {{$question->single->a}}
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="{{$question->id}}" id="b"
                                                                   value="b">
                                                            {{$question->single->b}}
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="{{$question->id}}" id="c"
                                                                   value="c">
                                                            {{$question->single->c}}
                                                        </label>
                                                    </div>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="{{$question->id}}" id="d"
                                                                   value="d">
                                                            {{$question->single->d}}
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </table>
                                    <button class="btn btn-default" type="submit">提交试卷</button>
                                </form>
                            </div>
                        @else
                            <div class="row">暂无题目</div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
