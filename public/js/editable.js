$(document).ready(function() {
    $.fn.editable.defaults.mode = 'inline';
    $('.x-editable').editable({
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
