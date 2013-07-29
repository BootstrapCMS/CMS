$(function () {
    $('[data-method]').not(".disabled").append(function () {
        var methodForm = "\n"
        methodForm += "<form action='" + $(this).attr('href') + "' method='POST' style='display:none'>\n"
        methodForm += " <input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n"
        if ($(this).attr('data-token')) {
            methodForm += "<input type='hidden' name='_token' value='" + $(this).attr('data-token') + "'>\n"
        }
        methodForm += "</form>\n"
        return methodForm
    })
        .removeAttr('href')
        .attr('onclick', ' if ($(this).hasClass(\'action_confirm\')) { if(confirm("Are you sure you want to do this?")) { $(this).find("form").submit(); } } else { $(this).find("form").submit(); }');
});
