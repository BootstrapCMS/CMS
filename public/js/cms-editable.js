function cmsEditable(bindval) {
    bindval = bindval || ".x-editable";
    $.fn.editable.defaults.mode = "inline";
    $(bindval).editable({
        ajaxOptions: {
            dataType: "json",
            type: "PUT"
        },
        success: function(response, newValue) {
            if (!response) {
                return "There was an unknown error!";
            }
            if (response.success !== true) {
                if (!response.msg) {
                    return "There was an unknown error!";
                }
                return response.msg;
            }
        },
        error: function(error) {
            if (!error.responseJSON) {
                return "There was an unknown error!";
            }
            if (!error.responseJSON.msg) {
                return "There was an unknown error!";
            }
            return error.responseJSON.msg;
        }
    });
}

$(document).ready(cmsEditable());
