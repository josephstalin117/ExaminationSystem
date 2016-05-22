<div class="row">
    <div class="form-group">
        <div class="input-group">
            <input type="text" class="form-control" id="search_content" name="search_content" placeholder="请输入试卷名">
        </div>
        <ul class="list-group" id="list_papers">
        </ul>
    </div>
</div>
<script>
    $("#search_content").change(function () {
        $.ajax({
            url: "{{url('/api/papers/search')}}" + "/" + $("#search_content").val(),
            dataType: "json",
            method: "get",
            success: function (result) {
                if ("success" == result.status) {
                    $("#list_papers").html('');
                    for (var i = 0; i < result.papers.length; i++) {
                        $("#list_papers").append("<li class='list-group-item' id=" + result.papers[i].id + "></li>");
                        $("#" + result.papers[i].id).append(result.papers[i].name);
                        $("#" + result.papers[i].id).append("<a class='btn btn-success follow' onclick='add_paper(" + result.papers[i].id + ")'>添加</a>");
                    }

                }
            }
        });
    });

    function add_paper(paper_id) {
        $("#paper_id").val(paper_id);
        $("#show_paper").val(paper_id);
    }
</script>
