

$(document).ready(function() {
    $(document).on('click', 'a[href="#payment"]', function(e) {
        var order_id = $(this).closest('div').data('order_id');
        $("#payment input[name='order_id']").val(order_id);

        var order_total = $(this).closest('div').data('order_total');
        debugger;
        $("#payment span[name='order_total']").html(order_total);
        e.preventDefault();
    });

        $('.modal').modal();


        
      
        $('#input').on('keyup', function(){
            var num = $('#input').val();
            var toreplace= $(".third-line p").text();
            toreplace = toreplace.replace("0000",num);
            $(".third-line p").html(toreplace);
         
            
          });
    });





