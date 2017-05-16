<?php if (count($languages) > 1) { ?>
  <form action="<?php echo $action; ?>" method="post" enctype="multipart/form-data" id="language" class="language">
    <ul>
      <li>
        <?php foreach ($languages as $language) { ?>
          <?php if ($language['code'] == $code) { ?>
            <span><?php echo $language['code_new']; ?></span>
          <?php } ?>
        <?php } ?>
        <ul>
          <?php foreach ($languages as $language) { ?>
            <li>
              <a href="<?php echo $language['code']; ?>">
                <span><?php echo $language['code_new']; ?></span>
                <img src="image/flags/<?php echo $language['image']; ?>" alt="<?php echo $language['name']; ?>" title="<?php echo $language['name']; ?>" width="28" height="19">
              </a>
            </li>
          <?php } ?>
        </ul>
      </li>
    </ul>
    <input type="hidden" name="code" value="" />
    <input type="hidden" name="redirect" value="<?php echo $redirect; ?>" />
  </form>
<?php } ?>
