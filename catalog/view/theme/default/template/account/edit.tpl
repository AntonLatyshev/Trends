<?php echo $header; ?>

<main id="main">
  <div class="content-box">
    <ul class="breadcrumbs">
      <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
        <li><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a> <?php } else { ?><span><?php echo $breadcrumb['text']; ?></span><?php } ?></li>
      <?php } ?>
    </ul>
    <span class="box-title"><?php echo $text_account; ?></span>
    <?php if ($success) { ?>
      <div class="alert alert-success"><?php echo $success; ?></div>
    <?php } ?>
    <div class="personal-area-box">
      <?php echo $column_left; ?>

      <form class="form-faq" name="personal-info" method="post" action="<?php echo $action; ?>">
        <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>">
        <?php if ($error_firstname) { ?>
          <label class="error"><?php echo $error_firstname; ?></label>
        <?php } ?>

        <input type="tel" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>">
        <?php if ($error_telephone) { ?>
          <label class="error"><?php echo $error_telephone; ?></label>
        <?php } ?>

        <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>">
        <?php if ($error_email) { ?>
          <label class="error"><?php echo $error_email; ?></label>
        <?php } ?>
        
        <button type="submit" class="submit-form"><?php echo $button_save; ?></button>
      </form>
    </div>
  </div>
</main>

<?php echo $footer; ?>