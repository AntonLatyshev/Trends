$( document ).ready(function() {
    /* Search */
    $('#search input[name=\'search\']').parent().find('button').on('click', function () {
        url = $('base').attr('href') + 'index.php?route=product/search';
        var value = $('#search input[name=\'search\']').val();
        if (value) {
            url += '&search=' + encodeURIComponent(value);
        }
        location = url;
    });

    $('#search input[name=\'search\']').on('keydown', function (e) {
        if (e.keyCode == 13) {
            $('#search input[name=\'search\']').parent().find('button').trigger('click');
        }
    });
    
    // Currency
    $('#currency .currency-select').on('click', function (e) {
        e.preventDefault();

        $('#currency input[name=\'code\']').attr('value', $(this).attr('name'));

        $('#currency').submit();
    });

    // Language
    $('#language a').on('click', function (e) {
        e.preventDefault();

        $('#language input[name=\'code\']').attr('value', $(this).attr('href'));

        $('#language').submit();
    });

    // счетчик в попапе покупки товара
    $(document).on('click', '.quantity-block .quantity .jcf-number span', function(){
        var quantity = parseInt($(this).parent().find('input[name=quantity]').val());
        var key = $('.quantity-block .quantity').data('key');
        cart.update(key, quantity);
    });

    // счетчик в товаре
    $(document).on('click', '.product-buy-box .quantity .jcf-number span', function(){
        var quantity = parseInt($(this).parent().find('input[name=quantity]').val());
        var product_id = $('.product-buy-box').data('pid');
        $('.product-buy-box .buy-product').attr('onclick', "cart.add('" + product_id + "', '" + quantity + "');");
    });

});

// Cart add remove functions
var cart = {
    'add': function (product_id, quantity) {

        $.ajax({
            url: '/index.php?route=checkout/cart/add',
            type: 'post',
            data: 'product_id=' + product_id + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
            dataType: 'json',
            success: function (json) {
                $('.alert, .text-danger').remove();

                if (json['error']) {
                    if (json['error']['option']) {
                        for (i in json['error']['option']) {
                            var element = $('#input-option' + i.replace('_', '-'));
                            element.after('<div class="text-danger">' + json['error']['option'][i] + '</div>');
                        }
                    }
                }

                // if (json['redirect']) {
                //     location = json['redirect'];
                // }

                if (json['success']) {
                    $('.card-counter').html(json['total_cnt']);

                    $('.hidden-card').load('index.php?route=common/cart/info');

                    $('.hidden-item').html(json['success']).toggle();

                    $('.hidden-item-close, .continue-shopping, .hidden-item-overlay').click(function () {
                        $('.hidden-item').toggle();
                    });
                    jcf.replaceAll();

                }
            }
        });
    },
    'update': function (key, quantity) {
        $.ajax({
            url: '/index.php?route=checkout/cart/refresh',
            type: 'post',
            data: 'key=' + key + '&quantity=' + (typeof(quantity) != 'undefined' ? quantity : 1),
            dataType: 'json',
            success: function (json) {
                // Need to set timeout otherwise it wont update the total
                setTimeout(function () {
                    $('.total .total-price').html(json['product_total']);
                    $('.hidden-card').load('index.php?route=common/cart/info');
                    $('.card-counter').html(json['total_cnt']);
                }, 100);

            }
        });
    },
    'remove': function (key) {

        $.ajax({
            url: '/index.php?route=checkout/cart/remove',
            type: 'post',
            data: 'key=' + key,
            dataType: 'json',
            success: function (json) {
                $('.card-counter').html(json['total_cnt']);

                $('.hidden-card').load('index.php?route=common/cart/info');
            }
        });
    },

    'remove_checkout': function(key) {
        $.ajax({
            url: '/index.php?route=checkout/cart/remove',
            type: 'post',
            data: 'key=' + key,
            dataType: 'json',
            success: function(json) {
                if(json['total_cnt'] == 0){
                    location = location.origin;
                } else {
                    updateCart();
                    $('.hidden-card').load('index.php?route=common/cart/info');
                    $('.card-counter').html(json['total_cnt']);
                }
            }
        });
    }
};
