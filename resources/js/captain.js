$(document).ready(function() {
    // Enable pusher logging - don't include this in production
    Pusher.logToConsole = true;

    var pusher = new Pusher(pusher_app_key, {
        cluster: 'eu',
        forceTLS: true
    });


    var oldvalue = 0;
    var oldprice = 0;
    var olddiscount = 0;
    var counter = 0;

    $('.categories').slick({
        slidesToShow: 1,
        variableWidth: true,
        infinite: false,

    });


    //activate certain category
    $('.category-box').on('click', function(e) {
        e.preventDefault();
        $('.category-box').removeClass('active');
        $(this).addClass('active');
        var target = $(this).attr('target');
        $(".products-box").removeClass('active');
        $(".products-box[category=" + target + "]").addClass('active');
    });


    var language = "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json";

    var t = $('#order').DataTable({
        searching: false,
        paging: false,
        info: false,
        "ordering": false,
        "language": {
            "url": language
        },
        scrollY: "235px",
        scrollX: true,
        scrollCollapse: true,
        columnDefs: [{
                "targets": [3],
                "visible": false,
                "searchable": false
            },
            {
                "targets": [5],
                "visible": false
            },
            {
                width: '20%',
                targets: 0
            },
            {
                width: '50px',
                targets: 4
            }
        ],
        fixedColumns: true
    });
    //add certain product
    $('.product').on('click', function() {
        var price = $(this).attr('price');
        var p_id = $(this).attr('p-id');
        var name = $(this).closest('.product-box').find('.product-name').first().text();
        var categoryName = $('.category.active').first().text();

        increasePrice(parseFloat(price));
        changeCountBy(1);
        //
        if ($('[data-product-id="' + p_id + '"]').length > 0) {
            var qty = $('[data-product-id="' + p_id + '"]').html();
            qty++;
            $('[data-product-id="' + p_id + '"]').html(qty);
        } else {
            t.row.add([
                '<span  class="delete fas fa-trash-alt"></span>',
                '<span  class="price" > ' + price + '</span>',
                `<span  class=" qty-inc"><i class="fas fa-plus-square"></i></span>
                 <span  class="qty" data-product-id="` + p_id + `"> 1 </span>
                 <span  class=" qty-dec"><i class="fas fa-minus-square"></i></span>`,
                '<span  class="categoryName">' + categoryName + '</span>',
                '<span  class="name">' + name + '</span>',
                '<span  class="p_id">' + p_id + '</span>'
            ]).draw(false);
        }
    });

    //delete certain product
    $('#order').on('click', 'td .delete', function() {
        t.row($(this).closest('tr')).remove().draw(false);
        var price = $(this).closest('tr').children('td').children(".price").text();
        var quantity = $(this).closest('tr').children('td').children(".qty").text();
        changePriceBy(-1 * quantity * parseFloat(price));
        changeCountBy(-1 * quantity);
    });

    // Trigger on change events
    $('#order').on('focusout', '.qty', function() {
        var value = $(this).text();
        var quantity = parseInt(value.replace(/[^\d.]/g, ''), 10);
        console.log('entered qty = ' + quantity);
        if (isNaN(quantity))
            quantity = 1;
        $(this).text(quantity);
        if (quantity == oldvalue)
            return;
        var newQuantity = quantity - oldvalue;
        console.log('new qty = ' + newQuantity);
        changeCountBy(newQuantity);
        var currentPrice = parseFloat($(this).closest('tr').children('td').children(".price").text());
        changePriceBy(newQuantity * currentPrice);
        oldvalue = 0;
        return;
    });

    $('#order').on('focusout', '.price', function() {
        var value = $(this).text();
        var price = parseFloat(value.replace(/[^\d.]/g, ''), 10);
        if (isNaN(price))
            price = 0;
        $(this).text(price);
        if (price == oldprice)
            return;
        var newPrice = price - oldprice;
        var currentCount = parseInt($(this).closest('tr').children('td').children(".qty").text());
        changePriceBy(newPrice * currentCount);
        oldprice = 0;
        return;

    });


    $('#order,#order-details').on('keypress', 'span', function(e) {


        if (e.which == 13) {
            $(this).blur();
        }
        return e.which != 13;
    });

    $("#clear").on('click', function() {
        t.clear().draw();
        $('#count').html('0');
        $('#total').html('0');

    });


    $("#payment").on('click', function() {
        var items = [];
        t.rows().every(function(index, element) {
            var row = this.data();
            var product_id = $(row[5]).html(); // Index 6 - the 7th column in the table
            var quantity = $(this.node()).find('td').eq(2).text();
            items.push({ 'product_id': product_id.trim(), 'quantity': quantity.trim() });
        });

        if (items.length == 0) {
            swal({
                title: 'Your order is empty!',
                icon: 'error'
            });
            return false;
        }

        var table = $('#table_number').val();
        if (table.length == 0) {
            swal({
                title: 'Table number is empty!',
                icon: 'error'
            });
            return false;

        }

        $("#checkout-from").hide();
        $("#checkout-processing").show();

        var data = {
            'items': items,
            'customer_id': '1',
            'coupon_code': $('#coupon').val(),
            '_token': $('#_order_token').val(),
            'notes': $('#notes').val(),
            'table_number': $('#table_number').val()
        };
        $.post(base_url + '/orders/add-new', data, function(response) {
            if (response) {
                if (Object.keys(response.coupon).length != 0) {
                    if (typeof(response.coupon.error) !== "undefined") {
                        swal({
                            title: response.coupon.error,
                            icon: 'error'
                        });
                        $("#checkout-from").show();
                        $("#checkout-processing").hide();
                        return false;
                    } else {
                        $("#coupon_code").html(response.coupon.code);
                        $("#discount_value").html(response.coupon.discount);
                    }
                } else {
                    $("#coupon_info").hide();
                }

                document.location.href = base_url + '/captain/order/' + response.order.id;
            }
        });
    });
    //custom functions
    //increase price
    function increasePrice(price) {
        var total = parseFloat($('#total').text());
        $('#total').text(price + total);

    }

    function changeCountBy(number) {
        console.log('counter was = ' + counter);
        counter = counter + number;
        $('#count').text(counter);
        console.log('counter become = ' + counter);
    }

    function changePriceBy(value) {
        var total = parseFloat($('#total').text());
        $('#total').text(total + value);
    }



    $(document).on("click", '.qty-inc', function(qty) {


        var qty = $(this).closest('td').find('.qty').first().html();
        qty++;
        $(this).closest('td').find('.qty').first().html(qty);
        //
        var price = $(this).closest('tr').find('.price').first().html();
        increasePrice(parseFloat(price));
        changeCountBy(1);

    });

    $(document).on("click", '.qty-dec', function(qty) {
        var qty = $(this).closest('td').find('.qty').first().html();
        //
        if (qty == 1) {
            return false;
        }
        qty--;
        $(this).closest('td').find('.qty').first().html(qty);
        var price = $(this).closest('tr').find('.price').first().html();
        increasePrice(parseFloat(-price));
        changeCountBy(-1);

    });


    $('#active-orders').slick({
        slidesToShow: 8,
        slidesToScroll: 8,
        infinite: false,
    });

    $(document).on('click', '.order-number', function() {
        document.location.href = $(this).data('href');
    });



    var _channel = pusher.subscribe('captain');
    _channel.bind('order-status', function(data) {
        if ($(".selected.order-number[data-number='" + data.order_id + "']").length > 0) {
            $("#status").html(data.status);
        } else {
            setInterval(function() {
                if ($(".order-number[data-number='" + data.order_id + "']").hasClass('selected')) {
                    $(".order-number[data-number='" + data.order_id + "']").removeClass('selected');
                } else {
                    $(".order-number[data-number='" + data.order_id + "']").addClass('selected');
                }
            }, 500);

        }
        var snd = new Audio(base_url + '/resources/sounds/notification.mp3');
        notify(data.message);
        snd.play();
    });

});