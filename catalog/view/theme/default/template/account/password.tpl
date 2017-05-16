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
      
      <form class="form-faq" name="personal-info" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <input type="password" class="password" name="old_password" value="<?php echo $old_password; ?>" placeholder="<?php echo $entry_old_password; ?>">
        <?php if ($error_password_old) { ?>
          <label class="error"><?php echo $error_password_old; ?></label>
        <?php } ?>
        
        <input type="password" class="new-password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>">
        <?php if ($error_password) { ?>
          <label class="error"><?php echo $error_password; ?></label>
        <?php } ?>
        
        <input type="password" class="repeat-new-password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>">
        <?php if ($error_confirm) { ?>
          <label class="error"><?php echo $error_confirm; ?></label>
        <?php } ?>
        <button type="submit" class="submit-form"><?php echo $text_save; ?></button>
      </form>
    </div>
  </div>
</main>

<?php echo $footer; ?>