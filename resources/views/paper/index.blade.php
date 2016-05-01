@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">个人资料</div>

                    <div class="panel-body">
                        @include('common.errors')
                        @include('paper.search')
                        <div class="row" style="margin-top: 10px">
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#create">创建新试卷
                            </button>
                        </div>
                        @if(count($papers)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>试卷名</th>
                                        <th>出题人</th>
                                        <th>总分</th>
                                        <th>用时</th>
                                        <th>备注</th>
                                        <th>浏览</th>
                                        <th>修订</th>
                                        <th>删除</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($papers as $paper)
                                        <tr>
                                            <td>{{$paper->name}}</td>
                                            <td>{{$paper->user->profile->name}}</td>
                                            <td>{{$paper->score}}</td>
                                            <td>{{$paper->time}}</td>
                                            <td>{{$paper->remark}}</td>
                                            <td><a href="" type="button" data-id="{{$student->id}}"
                                                   class="btn btn-primary openDetail" data-toggle="modal"
                                                   data-target="#detail">浏览</a></td>
                                            <td><a href="" type="button" data-id="{{$student->id}}"
                                                   class="btn btn-primary openDetail" data-toggle="modal"
                                                   data-target="#detail">修订</a></td>
                                            <td>
                                                <a href="{{url('usermanage/student/delete/'.$student->id)}}"
                                                   type="button"
                                                   class="btn btn-danger" data-toggle="modal"
                                                   data-target=".bs-example-modal-sm"><i class="fa fa-btn fa-trash"></i>删除</a>
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
    <div class="modal fade" id="" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                ...
            </div>
        </div>
    </div>
@endsection
