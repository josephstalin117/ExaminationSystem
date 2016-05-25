@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">欢迎登陆</div>
                @include('common.errors')
                <div class="panel-body">
                    参加测试的人员请务必诚实、独立地回答问题，只有如此，才能得到有效的结果！
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
