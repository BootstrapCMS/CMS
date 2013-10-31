function cmsRest() {
    $('[data-method]').not(".disabled").append(function () {
        var methodForm = "\n";
        methodForm += "<form action='" + $(this).attr('href') + "' method='POST' style='display:none'>\n";
        methodForm += " <input type='hidden' name='_method' value='" + $(this).attr('data-method') + "'>\n";
        if ($(this).attr('data-token')) {
            methodForm += "<input type='hidden' name='_token' value='" + $(this).attr('data-token') + "'>\n";
        }
        methodForm += "</form>\n";
        return methodForm;
    })
        .removeAttr('href')
        .attr('onclick', ' if $(this).find("form").submit();');
}

$(document).ready(cmsRest());
