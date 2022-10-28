$(document).ready(function() {
         
    /**
    * Execute a function given a delay time
    * 
    * @param {type} func
    * @param {type} wait
    * @param {type} immediate
    * @returns {Function}
    */
    var debounce = function (func, wait, immediate) {
        var timeout;
        return function() {
            var context = this, args = arguments;
            var later = function() {
                    timeout = null;
                    if (!immediate) func.apply(context, args);
            };
            var callNow = immediate && !timeout;
            clearTimeout(timeout);
            timeout = setTimeout(later, wait);
            if (callNow) func.apply(context, args);
        };
    };

    $('.addtocart-btn').click(function (e){
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.product_id').val();
        var qty_input = $(this).closest('.product_data').find('.qty-input').val();

        $.ajax({
             method: "POST",
             url: "/add-to-cart",
             data: {
                 'product_id': product_id,
                 'product_qty': qty_input,
                 '_token': $('#token').val()
             },
             success: function (data) {
                 if(data.success){
                    window.location.reload();
                    Swal.fire("Success!",data.success,"success");
                 }else{
                    Swal.fire("Info", data.error, "info");
                 }
             }
         });
    });

    $('.increment-btn').click(function (e){
        e.preventDefault();
        
        var inc_value = $(this).closest('.product_data').find('.qty-input').val();
        var stock = $(this).closest('.product_data').find('.stock').val();
        var value = parseInt(inc_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value <stock)
        {
            value++;
            $(this).closest('.product_data').find('.qty-input').val(value);
        } 
    });

    $('.decrement-btn').click(function (e){
        e.preventDefault();
        var dec_value = $(this).closest('.product_data').find('.qty-input').val();
        var value = parseInt(dec_value, 10);
        value = isNaN(value) ? 0 : value;
        if(value >1)
        {
            value--;
            $(this).closest('.product_data').find('.qty-input').val(value);
        } 
     });

    $('.delete-cart-item').click(function (e){
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.product_id').val();
        
        $.ajax({
                method: "POST",
                url: "/delete-cart-item",
                data: {
                    'product_id': product_id,
                    '_token': $('#token').val()
                },
                success: function (data) {
                    if(data.success){
                        window.location.reload();
                        Swal.fire("Success!",data.success,"success");
                    }else{
                        Swal.fire("Info", data.error, "info");
                    }
                }
            });
    });

    $('.update-cart-item').click(debounce(function (e){
        e.preventDefault();
        var product_id = $(this).closest('.product_data').find('.product_id').val();
        var qty_input = $(this).closest('.product_data').find('.qty-input').val();
        $("body").css("cursor", "not-allowed");
        $('.update-cart-item').prop('disabled', true);
        $('#checkout').removeAttr('href');
        $('#continue').removeAttr('href');
        $('.delete-cart-item').hide();
        setTimeout(function() { 
            $.ajax({
                    method: "POST",
                    url: "/update-cart-item",
                    data: {
                        'product_id': product_id,
                        'product_qty': qty_input,
                        '_token': $('#token').val()
                    },
                    success: function (data) {
                        if(data.success){
                            window.location.reload();
                        }else{
                            Swal.fire("Info", data.error, "info");
                        }
                    }
                });
                
        }, 1000);
    },1000));
 });