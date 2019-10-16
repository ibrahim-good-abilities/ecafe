$(document).ready(function() {
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher(pusher_app_key, {
        cluster: 'eu',
        forceTLS: true
    });


    function redrawThePage() {
        if ($('.order-content').length > 0) {
            $(".empty-orders").addClass('hidden');
        } else {
            $(".empty-orders").removeClass('hidden');
        }
    }

    redrawThePage();
    $(document).on('click', 'a[href="#payment"]', function(e) {
        var order_id = $(this).closest('div').data('order_id');
        $("#payment input[name='order_id']").val(order_id);

        var order_total = $(this).closest('div').data('order_total');
        $("#payment p[name='order_total']").html(order_total);

        $('#payment2').on('click', function(e) {
            var paid = $("#input").val();
            var data = {
                '_token': $('#_order_token').val(),
                'order_id': order_id,
            };

            $.post(base_url + '/cashier/order', data, function(response) {
                if (response) {
                    $('#payment').modal('close');

                    //render response 
                    $("#order_id").html(response.order.id);
                    $("#order_date").html(response.order.created_at);
                    $("#discount").html(response.order.discount);
                    $("#order_table").html(response.order.table_number);
                    var discount = response.order.discount;
                    var sub_total = 0;
                    var total_quantity = 0;
                    var grand_total = 0;
                    $.each(response.items, function(i, item) {
                        $("#order_details tbody").append(`
                            <tr>
                                <td class="text-center">
                                    ${item.id}
                                </td >
                                <td class="text-center">
                                    ${item.name}
                                </td >
                                <td class="text-center">
                                    ${item.quantity} 
                                </td >
                                <td class="text-center">
                                    ${item.price * item.quantity}
                                </td>   
                            </tr>
                    `);
                        sub_total += (item.price * item.quantity);
                        total_quantity += item.quantity;



                    });

                    grand_total = (sub_total - discount);
                    $("#sub_total").html(sub_total).val();
                    $("#total_quantity").html(total_quantity);
                    $("#grand_total").html(grand_total);
                    $("#paid").html(paid);

                    $('#bill').modal('open');

                    $('.order-content[data-order_id="' + order_id + '"]').remove();
                    redrawThePage();
                }
            });
            e.preventDefault();

        });

        e.preventDefault();
    });

    $('.modal').modal();

    $('#print').on('click', function() {
        $('#modal-print').printThis({
            importStyle: true,
        });
    })


    $("#close").on("click", function() {
        $('#bill').modal('close');
    });



    $('#input').on('keyup', function() {
        var num = $('#input').val();
        var val = $("#total").text();
        var total = num - val;
        $(".third-line p").html(total);
    });

    var channel = pusher.subscribe('cashier');
    channel.bind('order-status', function(data) {
        var snd = new Audio(base_url + '/resources/sounds/notification.mp3');
        notify(data.message)
        var promise = snd.play();
        if (promise) {
            //Older browsers may not return a promise, according to the MDN website
            promise.catch(function(error) { console.log(error); });
        }
    });
    $('.tooltipped').tooltip();
});