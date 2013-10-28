$(document).ready(function() {
    $.fn.editable.defaults.mode = 'inline';
    $('.x-editable').editable({
        ajaxOptions: {
            dataType: 'json'
        },
        success: function(response, newValue) {
            console.log(response);
            if (!response) {
                return "There was an unknown error!";
            }
            if (response.success === false) {
                if (!response.msg) {
                    return "There was an unknown error!";
                }
                return response.msg;
            }
        },
        error: function(response, newValue) {
            console.log(response);
            if (!response) {
                return "There was an unknown error!";
            }
            if (response.success === false) {
                if (!response.msg) {
                    return "There was an unknown error!";
                }
                return response.msg;
            }
            return "There was an unknown error!";
        }
    });
});
