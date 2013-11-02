function cmsCommentFetchNew(data) {
    cmsCommentLock = false;
    cmsCommentFetch();
    console.log('done processing');
}

function cmsCommentFetchProcess(data) {
    // do something with the data
    console.log(xhr.responseJSON);

    var length = xhr.responseJSON.length;
    var num = 0;
    var done = 0;

    $("#comments > div").each(function() {
        var ok = false;
        for (var i = 0; i < length; i++) {
            if ($(this).data('pk') == xhr.responseJSON[i].comment_id) {
                if ($(this).data('ver') == xhr.responseJSON[i].comment_ver) {
                    ok = true;
                }
            }
        }
        if (ok == false) {
            num++;
            if ($("#comments > div").length == 1) {
                $(this).fadeOut(300, function() {
                    $(this).remove();
                    done++;
                }); 
            } else {
                $(this).slideUp(300, function() {
                    $(this).remove();
                    done++;
                });
            }
        }
    });

    var cmsCommentNewCheck = setInterval(function() {
        if (num === done) {
            clearInterval(cmsCommentNewCheck);
            cmsCommentFetchNew();
        }
    }, 10);
}

function cmsCommentFetchWork() {
$.ajax({
        url: $("#comments").data('url'),
        type: "GET",
        dataType: "json",
        timeout: 5000,
        success: function(data, status, xhr) {
            if (!xhr.responseJSON) {
                cmsCommentLock = false;
                cmsCommentFetch();
                return;
            }
            cmsCommentFetchProcess(xhr.responseJSON);
        },
        error: function(xhr, status, error) {
            cmsCommentLock = false;
            cmsCommentFetch();
            console.log('processing errored');
        }
    });
}

function cmsCommentFetchWait() {
    var cmsCommentFetchCheck = setInterval(function() {
        if (cmsCommentLock == false) {
            clearInterval(cmsCommentFetchCheck);
            cmsCommentLock = true;
            cmsCommentFetchWork()
        }
    }, 10);
    return false;
}

function cmsCommentFetch() {
    setTimeout(function() {
        cmsCommentFetchWait()
    }, 5000);
}
