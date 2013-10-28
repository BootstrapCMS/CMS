$(document).ready(function() {
    $.fn.editable.defaults.mode = 'inline';
    $('.x-editable').editable({
        ajaxOptions: {
            dataType: 'json',
            type: 'PUT'
        },
        success: function(response, newValue) {
            console.log(response);
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
            console.log(error.responseJSON);
            if (!error.responseJSON) {
                return "There was an unknown error!";
            }
            if (error.responseJSON.success !== true) {
                if (!error.responseJSON.msg) {
                    return "There was an unknown error!";
                }
                return error.responseJSON.msg;
            }
            return "There was an unknown error!";
        }
    });
});
