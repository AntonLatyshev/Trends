<?php echo $header; ?>

<main id="main">
  <div class="content-box">
    <ul class="breadcrumbs">
      <?php foreach ($breadcrumbs as $i=> $breadcrumb) { ?>
        <li><?php if($i+1<count($breadcrumbs)) { ?><a href="<?php echo $breadcrumb['href']; ?>"><?php echo $breadcrumb['text']; ?></a> <?php } else { ?><span><?php echo $breadcrumb['text']; ?></span><?php } ?></li>
      <?php } ?>
    </ul>
    <div class="enter-registration">
      <div class="box-title"><?php echo $text_account; ?></div>

      <?php if ($success) { ?>
        <label class="alert alert-success"><?php echo $success; ?></label>
      <?php } ?>
      <label class="error" id="error_warning"></label>

      <div class="product-list">
        <ul class="tabset">
          <li><a class="tab active" href="#tab-11"><?php echo $text_login; ?></a>
          </li>
          <li><a class="tab" href="#tab-12"><?php echo $text_register; ?></a>
          </li>
        </ul>
        <div class="tab-holder">
          <div id="tab-11">
            <form name="enter" id="form-enter" class="form-faq" action="<?php echo $action; ?>" method="post" enctype="multipart/form-data">
              <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>">
              <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>">

              <div class="form-box">
                <input type="checkbox" value="remember-me" id="remember-me">
                <label for="remember-me"><?php echo $text_remember; ?></label>
                <a href="<?php echo $forgotten; ?>" class="forgot-password"><?php echo $text_forgotten; ?></a>
              </div>
              <input type="submit" value="<?php echo $button_login; ?>" class="submit-form after-add-review" />
            </form>
          </div>

          <div id="tab-12">
            <form name="registration" id="form-registration" class="form-faq" action="<?php echo $register; ?>" method="post" enctype="multipart/form-data">
              <input type="text" name="firstname" value="<?php echo $firstname; ?>" placeholder="<?php echo $entry_firstname; ?>">

              <input type="tel" name="telephone" value="<?php echo $telephone; ?>" placeholder="<?php echo $entry_telephone; ?>">

              <input type="text" name="email" value="<?php echo $email; ?>" placeholder="<?php echo $entry_email; ?>">

              <input type="password" name="password" value="<?php echo $password; ?>" placeholder="<?php echo $entry_password; ?>">

              <input type="password" name="confirm" value="<?php echo $confirm; ?>" placeholder="<?php echo $entry_confirm; ?>">

              <input type="hidden" name="country_id" value="<?php echo $country_id; ?>">
              <input type="hidden" name="zone_id" value="<?php echo $zone_id; ?>">

              <input type="submit" value="<?php echo $text_register; ?>" class="submit-form registration after-add-review" />
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</main>

<script>
  $('#form-registration').submit(function(e) {
    e.preventDefault();
    $.ajax({
      url: 'index.php?route=account/login/validateRegister',
      type: 'post',
      dataType: 'json',
      data: $("#form-registration").serialize(),
      success: function(json) {
        $('#form-registration label.error').remove();
        $('.enter-registration label.error').remove();
        $('.enter-registration label.alert').remove();

        if (json['error']) {
          for(var key in json.error){
            if(json.error.hasOwnProperty(key)){
              $('#form-registration [name="'+key+'"]').after('<label class="error">'+json.error[key]+'</label>');
            }
            if(key == 'exists'){
              $('#form-registration [name="email"]').after('<label class="error">'+json.error[key]+'</label>');
            }
          }
        }

        if (json['success']) {
          console.log(json['success']['text']);

          window.location.href = json['success']['redirect'];
        }
      }
    });
  });

  $('#form-enter').submit(function(e) {
    e.preventDefault();
    $.ajax({
      url: 'index.php?route=account/login/validateLogin',
      type: 'post',
      dataType: 'json',
      data: $("#form-enter").serialize(),
      success: function(json) {
        $('#form-registration label.error').remove();
        $('.enter-registration label.error').remove();
        $('.enter-registration label.alert').remove();

        if (json['error']) {
          $('.box-title').after('<label class="error">'+json['error']['warning']+'</label>');
        }

        if (json['success']) {
          window.location.href = json['success']['redirect'];
        }
      }
    });
  });
</script>

<?php echo $footer; ?>