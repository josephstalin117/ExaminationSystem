<div class="row" style="margin-top: 10px">
    <div class="input-group">
        <label for="search_user">搜索学生</label>
        <input type="text" class="form-control" id="search_user" placeholder="搜索">
        <ul class="list-group" id="list_users">
        </ul>
    </div>
</div>
<script>
    $("#search_user").change(function () {
        $.ajax({
            url: "{{url('/api/usermanage/search')}}" + "/" + $("#search_user").val(),
            dataType: "json",
            method: "get",
            success: function (result) {
                if ("success" == result.status) {
                    $("#list_users").html('');
                    for (var i = 0; i < result.users.length; i++) {
                        $("#list_users").append("<li class='list-group-item' id=" + result.users[i].id + "></li>");
                        $("#" + result.users[i].id).append(result.users[i].nickname);
                        $("#" + result.users[i].id).append("<a class='btn btn-success follow' onclick='follow(" + result.users[i].id + ")'>关注</a>");
                    }

                }
            }
        });
    });

    function follow(follow_user_id) {
        $.ajax({
            url: "{{url('/api/follow')}}" + "/" + follow_user_id,
            dataType: "json",
            method: "get",
            success: function (data) {
                if ("success" == data.status) {
                    alert("发送关注申请成功");
                } else if ("followed" == data.status) {
                    alert("已经发送关注请求");
                } else {
                    alert("关注失败");
                }
            }
        });
    }

</script>
