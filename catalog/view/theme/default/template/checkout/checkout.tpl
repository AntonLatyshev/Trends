<?php echo $header; ?>
    <div class="content-box cart">
        <ul class="breadcrumbs">
            <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
                <li><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a> <?php } else { ?><span><?php echo $breadcrumb['text']; ?></span><?php } ?></li>
            <?php } ?>
        </ul>
    </div>


    <div id="session-holder"></div>
    <div class="wrapper-cart cart-page">
        <div class="title"><?php echo $heading_title; ?></div>
        <div class="cart-holder">
            <div class="cart-row">
                <div class="cart-from">
                    <div class="step step-1" id="step-1"></div>
                    <div class="step step-2" id="step-2"></div>
                </div>
                <div class="cart-product" id="cart-product"></div>`
            </div>
        </div>
    </div>
<?php echo $footer; ?>

<script>
    $(document).ready(function() {

        /**
         * Get load getTotalProducts Cart
         **/
        $.ajax({
            url: '/index.php?route=checkout/cart',
            dataType: 'html',
            success: function(html) {
                $('#cart-product').html(html);

                /**
                 * Unset confirm button
                 **/
                $('#confirm-holder').html('');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });


        /**
         * Get load firstStep
         **/
        $.ajax({
            url: '/index.php?route=checkout/step_first',
            dataType: 'html',
            success: function(html) {
                $('#step-1').html(html);
                $('input[type="tel"]').mask('+38 (099) 999-99-99');
            },
            error: function(xhr, ajaxOptions, thrownError) {
                alert(thrownError + "\r\n" + xhr.statusText + "\r\n" + xhr.responseText);
            }
        });

    });
</script>
