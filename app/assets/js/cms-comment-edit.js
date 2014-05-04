function cmsCommentSubmit(that) {
    $(that).ajaxSubmit({
        url: $("#comments").data("url")+"/"+$(that).data("pk"),
        dataType: 'json',
        clearForm: true,
        resetForm: true,
        timeout: 5000,
        success: function(data, status, xhr) {
            if (!xhr.responseJSON) {
                $("#edit_comment").modal("hide");
                return;
            }
            if (xhr.responseJSON.success !== true || !xhr.responseJSON.msg || !xhr.responseJSON.comment_id || !xhr.responseJSON.comment_ver || !xhr.responseJSON.comment_text) {
                $("#edit_comment").modal("hide");
                return;
            }
            $("#comment_"+xhr.responseJSON.comment_id).data("ver", xhr.responseJSON.comment_ver);
            $("#main_comment_"+xhr.responseJSON.comment_id).fadeOut(cmsCommentTime/2, function() {
                $(this).html(xhr.responseJSON.comment_text);
                $(this).fadeIn(cmsCommentTime/2, function() {
                    $("#edit_comment").modal("hide");
                });
            });
        },
        error: function(xhr, status, error) {
            $("#edit_comment").modal("hide");
        }
    });
}

function cmsCommentEditShow(that) {
    $("#edit_commentform").data("pk", $(that).data('pk'));
    $("#verion").attr("value", $("#comment_"+$(that).data('pk')).data('ver'));
    $("#edit_body").val($("#main_comment_"+$(that).data('pk')).text().replace(/<br\s*[\/]?>/gi, "\n"));
    $("#edit_comment").modal("show");
}

function cmsCommentEdit(bindval) {
    bindval = bindval || ".editable";
    $(bindval).click(function() {
        var that = this;
        var cmsCommentEditCheck = setInterval(function() {
            if (cmsCommentLock == false) {
                clearInterval(cmsCommentEditCheck);
                cmsCommentLock = true;
                cmsCommentEditShow(that);
            }
        }, 10);
        return false;
    });
}

function cmsCommentModel() {
    $("#edit_comment").on("hidden.bs.modal", function () {
        cmsCommentLock = false;
    });
    $("#edit_comment_ok").click(function () {
        $("#edit_commentform").trigger("submit");
    });
    $("textarea#edit_body").keydown(function (e) {
        if (e.ctrlKey && e.keyCode === 13) {
            $("#edit_commentform").trigger("submit");
        }
    });
    $("#edit_commentform").submit(function() {
        var that = this;
        cmsCommentSubmit(that);
        return false;
    });
}
