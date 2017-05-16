<?php echo $header; ?>

<main id="main">
  <div class="content-box">
    <ul class="breadcrumbs">
      <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
        <li><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a> <?php } else { ?><span><?php echo $breadcrumb['text']; ?></span><?php } ?></li>
      <?php } ?>
    </ul>
    <div class="forgot-password-block">
      <span class="feedback-name"><?php echo $heading_title; ?></span>

      <span class="subname"><?php echo $text_email; ?></span>
      <form class="feedback-form form-faq" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
        <div class="row">
          <input type="text" name="email" placeholder="Email">
          <?php if ($error_warning) { ?>
            <label class="error"><?php echo $error_warning; ?></label>
          <?php } ?>
        </div>
        <button type="submit" value="submit" class="feedback-submit"><?php echo $text_send; ?></button>
      </form>
    </div>
  </div>
</main>

<?php echo $footer; ?>