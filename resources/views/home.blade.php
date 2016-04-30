@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">控制台</div>
                @include('common.errors')

                <div class="panel-body">
                    欢迎登陆
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
