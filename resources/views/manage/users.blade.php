@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">个人资料</div>

                    <div class="panel-body">
                        @include('common.errors')
                        @include('manage.search')
                        <div class="row" style="margin-top: 10px">
                            <button type="button" class="btn btn-success" data-toggle="modal"
                                    data-target="#create">创建用户
                            </button>
                        </div>
                        @if(count($students)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>用户名</th>
                                        <th>姓名</th>
                                        <th>详情</th>
                                        <th>修改</th>
                                        <th>删除</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{$student->name}}</td>
                                            <td>{{$student->profile->nickname}}</td>
                                            <td><a href="" type="button" data-id="{{$student->id}}"
                                                   class="btn btn-primary openDetail" data-toggle="modal"
                                                   data-target="#detail">详情</a></td>
                                            <td><a href="" type="button" data-id="{{$student->id}}"
                                                   class="btn btn-primary openDetail" data-toggle="modal"
                                                   data-target="#update">修改</a></td>
                                            <td>
                                                <a href="" type="button" id="delete_student" data-id="{{$student->id}}}" data-toggle="modal"
                                                   data-target="#delete_dialog" class="btn btn-danger"><i
                                                            class="fa fa-btn fa-trash"></i>删除</a>
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
    <!--detail Modal -->
    <div class="modal fade" id="detail" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="name"></h4>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="telephone">手机号</label>
                        <p id="telephone"></p>
                    </div>
                    <div class="form-group">
                        <label for="nickname">真实姓名</label>
                        <p id="nickname"></p>
                    </div>
                    <div class="form-group">
                        <label for="email">邮箱</label>
                        <p id="email"></p>
                    </div>
                    <div class="form-group">
                        <label for="address">地址</label>
                        <p id="address"></p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                </div>
            </div>
        </div>
    </div>

    <!--update Modal -->
    <div class="modal fade" id="update" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title" id="name">更新学生用户</h4>
                </div>
                <div class="modal-body">
                    <form action="{{url('/usermanage/student/update/')}}" method="post">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="telephone">手机号</label>
                            <input class="form-control" type="number" id="telephone_update" name="telephone"
                                   placeholder="请输入手机号">
                        </div>
                        <div class="form-group">
                            <label for="nickname">真实姓名</label>
                            <input type="text" class="form-control" id="nickname_update" name="nickname"
                                   placeholder="请输入真实姓名">
                        </div>
                        <div class="form-group">
                            <label for="email">邮箱</label>
                            <input type="text" class="form-control" id="email_update" name="email"
                                   placeholder="请输入邮箱">
                        </div>
                        <div class="form-group">
                            <label for="address">地址</label>
                            <input type="text" class="form-control" id="address_update" name="address"
                                   placeholder="请输入地址">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!--create Modal -->
    <div class="modal fade" id="create" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                                aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">创建一个学生用户</h4>
                </div>
                <div class="modal-body">
                    <form action="{{url('/usermanage/student/create')}}" method="post">
                        {!! csrf_field() !!}
                        <input type="hidden" name="id" id="id">
                        <div class="form-group">
                            <label for="telephone">手机号</label>
                            <input class="form-control" type="number" id="telephone_create" name="telephone"
                                   placeholder="请输入手机号">
                        </div>
                        <div class="form-group">
                            <label for="name">用户名</label>
                            <input class="form-control" type="text" name="name"
                                   placeholder="请输入用户名">
                        </div>
                        <div class="form-group">
                            <label for="nickname">姓名</label>
                            <input type="text" class="form-control" id="nickname_create" name="nickname"
                                   placeholder="请输入真实姓名">
                        </div>
                        <div class="form-group">
                            <label for="email">邮箱</label>
                            <input type="text" class="form-control" id="email_create" name="email"
                                   placeholder="请输入邮箱">
                        </div>
                        <div class="form-group">
                            <label for="password">密码</label>
                            <input type="password" class="form-control" id="password_create" name="password"
                                   placeholder="请输入密码">
                        </div>
                        <div class="form-group">
                            <label for="address">地址</label>
                            <input type="text" class="form-control" id="address_update" name="address"
                                   placeholder="请输入地址">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
                            <button type="submit" class="btn btn-primary">保存</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete_dialog" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel">
        <div class="modal-dialog modal-sm">
            <div class="modal-content">
                <p>是否删除</p>
                <a href="" id="delete_confirm" type="button" class="btn btn-danger" data-dismiss="modal">删除</a>
                <a type="submit" class="btn btn-primary">取消</a>
            </div>
        </div>
    </div>
    <script>
        $("#delete_student").click(function(){

        });
        $(document).on("click", ".openDetail", function () {
            var user_id = $(this).data('id');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url: "{{URL::to('/')}}/api/usermanage/" + user_id,
                dataType: "json",
                method: "get",
                success: function (data) {
                    console.log('test');
                    $('#id').val(data.user.id);
                    $('#name').html(data.user.name);
                    $('#telephone').html(data.user.telephone);
                    $('#nickname').html(data.user.nickname);
                    $('#address').html(data.user.address);
                    $('#email').html(data.user.email);
                    $('#nickname_update').val(data.user.nickname);
                    $('#telephone_update').val(data.user.telephone);
                    $('#address_update').val(data.user.address);
                    $('#email_update').val(data.user.email);
                }
            });
        });
    </script>
@endsection
