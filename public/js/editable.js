$(document).ready(function() {
    $.fn.editable.defaults.;
    $('.x-editable').editable({
        mode = 'inline',
        },
        success: function(response, newValue) {
            if(!response) {
                return "Unknown error!";
            }
            if(response.success === false) {
                 return response.msg;
            }
        }
    });
});
