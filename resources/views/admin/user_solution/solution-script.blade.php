<script src="{{ asset('assets/vendor/summernote/summernote-bs4.min.js') }}"></script>
<script>
    $(document).ready(function() {
        $('#description').summernote();
    });


    $("#project_id").change(function() {
        var userId = $('#employee_id').val()
        var projectId = $(this).val();
        var url = window.location.origin + '/admin/assignment/get-task-by-user/' + projectId
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            data: {
                userId: userId,
            },
            success: function(data) {
                var htmlTask = `<option value="">--Select Task--</option>`;
                if (data.length > 0) {
                    $.each(data, function(key, val) {
                        htmlTask += `<option value="${val?.id}">${val?.task}</option>`;
                    });
                    $('#user_project_id').html(htmlTask);
                } else {
                    $('#user_project_id').html(htmlTask);
                }
            }
        });
    });


    $("#user_project_id").change(function() {
        var userProjectId = $(this).val();
        var url = window.location.origin + '/admin/assignment/get-problem-by-user/' + userProjectId
        $.ajax({
            type: "GET",
            url: url,
            dataType: "json",
            success: function(data) {
                var htmlProblem = `<option value="">--Select Problem--</option>`;
                if (data.length > 0) {
                    $.each(data, function(key, val) {

                        htmlProblem += `<option value="${val?.id}">${val?.title}</option>`;
                    });

                    $('#user_problem_id').html(htmlProblem);
                } else {
                    $('#user_problem_id').html(htmlProblem);
                }
            }
        });
    });
</script>
