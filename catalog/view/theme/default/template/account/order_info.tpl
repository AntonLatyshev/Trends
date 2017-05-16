<?php echo $header; ?>

<main id="main">
  <div class="content-box">
    <ul class="breadcrumbs">
      <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
        <li><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a> <?php } else { ?><span><?php echo $breadcrumb['text']; ?></span><?php } ?></li>
      <?php } ?>
    </ul>
    <span class="box-title"><?php echo $text_account; ?></span>
    <div class="personal-area-box">
      <?php echo $column_left; ?>

      <div class="table-box orders">
        <div class="data-holder">
          <a class="link-back" href="<?php echo $continue; ?>"><?php echo $text_back; ?></a>
          <div class="data-box">
            <?php if ($shipping_company && $shipping_postcode) { ?>
              <span><?php echo $column_ttn; ?>:<em class="courier-order"><?php echo $shipping_company; ?> - <?php echo $shipping_postcode; ?></em></span>
            <?php } ?>
            <span><?php echo $column_date_added; ?>:<em class="date-order"><?php echo $date_added; ?></em></span>
          </div>
        </div>
        <table class="orders-table order" cellspacing="0" cellpadding="0">
          <tr class="cap-table">
            <th><?php echo $column_name; ?></th>
            <th><?php echo $column_price; ?></th>
            <th><?php echo $column_quantity; ?></th>
            <th><?php echo $column_total; ?></th>
          </tr>
          <?php foreach ($products as $product) { ?>
            <tr>
              <td>
                <div class="item-holder">
                  <a href="<?php echo $product['href']; ?>">
                    <div class="item-img">
                      <img src="<?php echo $product['image']; ?>" title="<?php echo $product['name']; ?>" alt="<?php echo $product['name'] . ' фото'; ?>">
                    </div>
                    <span class="item-name"><?php echo $product['name']; ?></span>
                  </a>
                </div>
              </td>
              <td><?php echo $product['price']; ?></td>
              <td><span class="quantity"><?php echo $product['quantity']; ?> шт.</span>
              </td>
              <td><?php echo $product['total']; ?></td>
            </tr>
          <?php } ?>
        </table>
        <div class="table-total">
          <div class="total-info">
            <?php if ($shipping_method) { ?>
              <span><?php echo $text_shipping_method; ?>:<em><?php echo $shipping_method; ?> <?php echo $total_shipping ? '('.$total_shipping.')' : ''; ?></em></span>
            <?php } ?>
            <?php if ($payment_method) { ?>
              <span><?php echo $text_payment_method; ?>:<em><?php echo $payment_method; ?></em></span>
            <?php } ?>
          </div>
          <span class="total-sum"><?php echo $text_total; ?><em><?php echo $total_total; ?></em></span>
        </div>
      </div>
    </div>
  </div>
</main>

<?php echo $footer; ?>