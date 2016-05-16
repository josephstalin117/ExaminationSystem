<div class="row">
    <form class="form-inline">
        <div class="form-group">
            <div class="input-group">
                <input type="text" class="form-control" id="search_content" name="search_content" placeholder="请输入试卷名">
                <input class="btn btn-success" id="search" type="button" value="搜索"/>
            </div>
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>试卷名</th>
                    <th>出题人</th>
                    <th>总成绩</th>
                    <th>备注</th>
                    <th>考试时间</th>
                    <th>操作</th>
                </tr>
                </thead>
                <tbody id="search_results">
                </tbody>
            </table>
        </div>
    </form>
</div>
<script>
    $(function () {
        $("#search").click(function () {
            $.ajax({
                url: "{{url('/api/papers/search')}}" + "/" + $("#search_content").val(),
                dataType: "json",
                method: "get",
                success: function (result) {
                    if ("success" == result.status) {
                        $("#search_results").html('');
                        for (var i = 0; i < result.papers.length; i++) {
                            $("#search_results").append("<tr>");
                            $("#search_results").append("<td>" + result.papers[i].name + "</td>");
                            $("#search_results").append("<td>" + result.papers[i].nickname + "</td>");
                            $("#search_results").append("<td>" + result.papers[i].score + "</td>");
                            $("#search_results").append("<td>" + result.papers[i].remark + "</td>");
                            $("#search_results").append("<td>" + result.papers[i].time + "</td>");
                            $("#search_results").append("<td>" + "<input value='选择' class='btn btn-success getPaper' data-id=" + result.papers[i].id + " data-name=" + result.papers[i].name + ">" + "</td>");
                            $("#search_results").append("</tr>");
                        }

                    }
                }
            });
        });
    });
</script>
