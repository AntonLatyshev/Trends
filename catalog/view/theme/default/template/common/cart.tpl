<?php if ($products) { ?>
<div id="cart" class="hidden-card-box">
  <span class="card-box-title"><?php echo $text_cart; ?></span>
  <ul class="selected-item-box">
    <?php foreach ($products as $product) { ?>
      <li class="selected-item">
        <div class="item-img">
          <a href="<?php echo $product['href']; ?>">
            <img src="<?php echo $product['thumb']; ?>" alt="<?php echo $product['name']; ?>" width="52" height="52">
          </a>
        </div>
        <div class="item-box">
          <a href="<?php echo $product['href']; ?>" class="name-item"><?php echo $product['name']; ?></a>
          <span class="quantity-item"><?php echo $product['quantity']; ?> шт.</span>
        </div>
        <span class="item-price"><?php echo $product['total']; ?></span>
        <span class="item-delete" onclick="cart.remove('<?php echo $product['key']; ?>');">&times;</span>
      </li>
    <?php } ?>
  </ul>
  <div class="total-box">
    <span><?php echo $text_totals; ?></span>&nbsp;
    <span class="total-price"><?php echo $total_total; ?></span>
  </div>
  <a href="<?php echo $checkout; ?>" class="checkout"><?php echo $text_checkout; ?></a>
</div>
<?php } else { ?>
  <p class="text-center"><?php echo $text_empty; ?></p>
<?php } ?>
