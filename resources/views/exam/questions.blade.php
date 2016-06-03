@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">开始考试</div>
                        <div class="row"> 考试时间<h2 id="time"></h2></div>
                    </div>

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
                                    <button class="btn btn-default" type="submit" onclick="confirm('是否提交试卷')">提交试卷
                                    </button>
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

    <script>
        function startTimer(duration, display) {
            var timer = duration, minutes, seconds;
            setInterval(function () {
                minutes = parseInt(timer / 60, 10);
                seconds = parseInt(timer % 60, 10);

                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                display.text(minutes + ":" + seconds);

                if (--timer < 0) {
                    timer = duration;
                }
            }, 1000);
        }

        jQuery(function ($) {
            var minutes = parseInt({{$time}});
            var fiveMinutes = 60 * minutes, display = $('#time');
            startTimer(fiveMinutes, display);
        });
    </script>
@endsection
