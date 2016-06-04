@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    @if(Auth::check())
                        @if(Config::get('constants.ROLE_ADMIN')==Auth::user()->role)
                            <div class="panel-heading">欢迎来到职业性格测试系统后台</div>

                            <div class="panel-body">
                                点击上方导航栏进行修改
                            </div>
                        @else
                            <div class="panel-heading">欢迎来到职业性格测试系统</div>
                            <div class="panel-body">
                                <div class="container marketing">

                                    <div class="row">
                                        <div class="col-lg-4">
                                            <h2>公平</h2>
                                            <p>公平的考试,平等的机会</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <h2>科学</h2>
                                            <p>科学的统计,得出最精确的判断</p>
                                        </div>
                                        <div class="col-lg-4">
                                            <h2>便利</h2>
                                            <p>随时随地,开始做题</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        <div class="panel-heading">欢迎来到职业性格测试系统</div>
                        <div class="panel-body">
                            <div class="container marketing">

                                <div class="row">
                                    <div class="col-lg-3">
                                        <h2>公平</h2>
                                        <p>合理的考察机制</p>
                                    </div>
                                    <div class="col-lg-3">
                                        <h2>科学</h2>
                                        <p>科学严谨的态度来处理您的性格</p>
                                    </div>
                                    <div class="col-lg-3">
                                        <h2>快捷</h2>
                                        <p>为您节省宝贵的时间</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
@endsection
