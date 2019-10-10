

$(document).ready(function() {
    $(document).on('click', 'a[href="#payment"]', function(e) {
        var order_id = $(this).closest('div').data('order_id');

        $("#payment input[name='order_id']").val(order_id);
        e.preventDefault();
    });
    
        $('.modal').modal();
    });





