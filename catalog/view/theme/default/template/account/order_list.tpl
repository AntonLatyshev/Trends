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

      <?php if ($orders) { ?>
        <div class="table-box orders">
          <table class="orders-table layout" cellspacing="0" cellpadding="0">
            <tr class="cap-table">
              <th><?php echo $column_order_id; ?></th>
              <th><?php echo $column_date_added; ?></th>
              <th><?php echo $column_ttn; ?></th>
              <th></th>
            </tr>
            <?php foreach ($orders as $order) { ?>
              <tr>
                <td class="number-order"><?php echo $order['order_id']; ?></td>
                <td class="date-order"><?php echo $order['date_added']; ?></td>
                <td class="courier-order"><?php echo $order['shipping_company']; ?> <?php echo $order['shipping_postcode']; ?></td>
                <td><a href="<?php echo $order['href']; ?>"><?php echo $text_view; ?></a>
                </td>
              </tr>
            <?php } ?>
          </table>
        </div>
      <?php } else { ?>
        <p><?php echo $text_empty; ?></p>
      <?php } ?>
    </div>
  </div>
</main>

<?php echo $footer; ?>