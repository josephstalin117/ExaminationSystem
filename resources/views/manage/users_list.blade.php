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
                        @if(count($students)>0)
                            <div class="row" style="margin-top: 10px;">
                                <table class="table table-bordered">
                                    <thead>
                                    <tr>
                                        <th>用户名</th>
                                        <th>姓名</th>
                                        <th>详情</th>
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
                                            <td><a href="" type="button" class="btn btn-danger">删除</a></td>
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!--update Modal -->
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
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <script>
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
                    $('#name').html(data.user.name);
                    $('#telephone').html(data.user.telephone);
                    $('#nickname').html(data.user.nickname);
                    $('#address').html(data.user.address);
                    $('#email').html(data.user.email);
                }
            });
        });
    </script>
@endsection
