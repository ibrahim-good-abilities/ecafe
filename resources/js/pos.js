$(document).ready(function() {
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
    $('.category').on('click', function(e) {
        e.preventDefault();
        $('.category').removeClass('active');
        $(this).addClass('active');
    });


    var language = "https://cdn.datatables.net/plug-ins/1.10.19/i18n/Arabic.json";

    var t = $('#order').DataTable({
        searching: false,
        paging: false,
        info: false,
        "ordering": false,
        "language": {
            "url": language
        }
    });
    t.column(5).visible(false);
    t.column(3).visible(false);
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

    $(".category").on('click', function() {
        var target = $(this).attr('target');
        $(".products-box").removeClass('active');
        $(".products-box[category=" + target + "]").addClass('active');
    });

    $("#clear").on('click', function() {
        t.clear()
            .draw();
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

        var data = {
            'items': items,
            'customer_id': '1',
        };
        $.post(base_url + '/orders/add-new', data, function(response) {
            if (response) {
                t.clear()
                    .draw();
                $('#count').html('0');
                $('#total').html('0');
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

    $("#go-pay").on('click', function() {
        var net = parseFloat($("#total").text());
        var discount = parseFloat($("#discount").text());
        $("#bill-total").text(net + discount);
        $("#bill-pay").text(net);
        $("#bill-discount").text(discount);
        $("#bill-count").text($("#count").text());


    });


    $(document).on("click", '.qty-inc', function(qty) {
        var qty = $(this).closest('td').find('.qty').first().html();
        qty++;
        $(this).closest('td').find('.qty').first().html(qty);
        //
        var price = $('.price').html();
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
        var price = $('.price').html();
        increasePrice(parseFloat(-price));
        changeCountBy(-1);

    });




});