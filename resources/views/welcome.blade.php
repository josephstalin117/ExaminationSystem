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
                                            <img class="img-circle"
                                                 src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                                 alt="Generic placeholder image" width="140" height="140">
                                            <h2>Heading</h2>
                                            <p>Donec sed odio dui. Etiam porta sem malesuada magna mollis euismod.
                                                Nullam id
                                                dolor id nibh ultricies vehicula ut id elit. Morbi leo risus, porta ac
                                                consectetur ac, vestibulum at eros. Praesent commodo cursus magna.</p>
                                            <p><a class="btn btn-default" href="#" role="button">View
                                                    details &raquo;</a>
                                            </p>
                                        </div><!-- /.col-lg-4 -->
                                        <div class="col-lg-4">
                                            <img class="img-circle"
                                                 src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                                 alt="Generic placeholder image" width="140" height="140">
                                            <h2>Heading</h2>
                                            <p>Duis mollis, est non commodo luctus, nisi erat porttitor ligula, eget
                                                lacinia
                                                odio sem nec elit. Cras mattis consectetur purus sit amet fermentum.
                                                Fusce
                                                dapibus, tellus ac cursus commodo, tortor mauris condimentum nibh.</p>
                                            <p><a class="btn btn-default" href="#" role="button">View
                                                    details &raquo;</a>
                                            </p>
                                        </div><!-- /.col-lg-4 -->
                                        <div class="col-lg-4">
                                            <img class="img-circle"
                                                 src="data:image/gif;base64,R0lGODlhAQABAIAAAHd3dwAAACH5BAAAAAAALAAAAAABAAEAAAICRAEAOw=="
                                                 alt="Generic placeholder image" width="140" height="140">
                                            <h2>Heading</h2>
                                            <p>Donec sed odio dui. Cras justo odio, dapibus ac facilisis in, egestas
                                                eget
                                                quam.
                                                Vestibulum id ligula porta felis euismod semper. Fusce dapibus, tellus
                                                ac
                                                cursus
                                                commodo, tortor mauris condimentum nibh, ut fermentum massa justo sit
                                                amet
                                                risus.</p>
                                            <p><a class="btn btn-default" href="#" role="button">View
                                                    details &raquo;</a>
                                            </p>
                                        </div><!-- /.col-lg-4 -->
                                    </div><!-- /.row -->
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
