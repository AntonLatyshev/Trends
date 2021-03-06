<?php if ($error_warning) { ?>
    <div class="alert alert-warning"><i class="fa fa-exclamation-circle"></i> <?php echo $error_warning; ?></div>
<?php } ?>
<?php if ($shipping_methods) { ?>
    <?php foreach ($shipping_methods as $shipping_method) { ?>
        <?php if (!$shipping_method['error']) { ?>
            <?php foreach ($shipping_method['quote'] as $quote) { ?>
                <div class="row">
                    <div class="radio">
                        <label>
                            <?php if ($quote['code'] == $code) { // || !$code?>
                                <?php // $code = $quote['code']; ?>
                                <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" checked="checked" />
                            <?php } else { ?>
                                <input type="radio" name="shipping_method" value="<?php echo $quote['code']; ?>" />
                            <?php } ?>
                            <span class="pay"><?php echo $quote['title']; ?> <?php echo $quote['text']; ?></span>
                        </label>
                    </div>
                </div>
                <?php if ($quote['code'] == $code) { ?>
                    <div class="select">
                    <?php echo $shipping_method['fields']; ?>
                    </div>
                <?php } ?>
            <?php } ?>
        <?php } else { ?>
            <div class="alert alert-danger"><?php echo $shipping_method['error']; ?></div>
        <?php } ?>
    <?php } ?>
<?php } ?>