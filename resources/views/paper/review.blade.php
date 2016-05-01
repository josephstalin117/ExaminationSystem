@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">试卷管理</div>

                    <div class="panel-body">
                        @include('common.errors')
                        @include('paper.search')
                        <div class="row" style="margin-top: 10px">
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#create_dialog">创建新试卷
                            </button>
                        </div>
                        @if(count($papers)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <tbody>
                                    @foreach($papers as $paper)
                                        <tr class="openModal" data-id="{{$paper->id}}">
                                            <td>{{$paper->name}}</td>
                                            <td>{{$paper->user->profile->nickname}}</td>
                                            <td>{{$paper->score}}</td>
                                            <td>{{$paper->time}}</td>
                                            <td>{{$paper->remark}}</td>
                                            <td><a href="" type="button" data-id="{{$paper->id}}"
                                                   class="btn btn-primary openDetail" data-toggle="modal"
                                                   data-target="#detail">浏览</a></td>
                                            <td><a href="" type="button" data-id="{{$paper->id}}"
                                                   class="btn btn-primary openDetail" data-toggle="modal"
                                                   data-target="#detail">修订</a></td>
                                            <td>
                                                <a href="" type="button" data-id="{{$paper->id}}"
                                                   class="btn btn-danger" data-toggle="modal"
                                                   data-target="#delete_dialog"><i class="fa fa-btn fa-trash"></i>删除</a>
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