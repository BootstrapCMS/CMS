function cmsCommentDelete(bindval) {
    bindval = bindval || ".deletable";
    $(bindval).click(function() {
        $.ajax({
            url: $(this).attr("href"),
            type: "DELETE",
            dataType: "json",
            timeout: 5000,
            success: function(data, status, xhr) {
                if (!xhr.responseJSON) {
                    // TODO
                    return;
                }
                if (xhr.responseJSON.success !== true) {
                    // TODO
                    return;
                }
                if ($("#comments > div").length == 1) {
                    $("#comment_"+xhr.responseJSON.comment).fadeOut(300, function() {
                        $(this).remove();
                        $("<p id=\"nocomments\">There are currently no comments.</p>").prependTo("#comments").hide().fadeIn(300);
                    }); 
                } else {
                    $("#comment_"+xhr.responseJSON.comment).slideUp(300, function() {
                        $(this).remove();
                    });
                }
            },
            error: function(xhr, status, error) {
                if (!xhr.responseJSON) {
                    // TODO
                    return;
                }
            }
        });
        return false;
    });
}
