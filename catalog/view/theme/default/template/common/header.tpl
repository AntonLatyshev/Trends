<!DOCTYPE html>
<!--[if IE]><![endif]-->
<!--[if IE 8 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie8"><![endif]-->
<!--[if IE 9 ]><html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>" class="ie9"><![endif]-->
<!--[if (gt IE 9)|!(IE)]><!-->
<html dir="<?php echo $direction; ?>" lang="<?php echo $lang; ?>">
<!--<![endif]-->
<head>
  <meta charset="UTF-8" />
  <meta name="format-detection" content="telephone=no">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title><?php echo $title; ?></title>
  
  <?php if ($noindex) { ?>
  <!-- OCFilter Start -->
  <meta name="robots" content="noindex,nofollow" />
  <!-- OCFilter End -->
  <?php } ?>
  
  <base href="<?php echo $base; ?>" />
  
  <?php if ($description) { ?>
    <meta name="description" content="<?php echo $description; ?>" />
  <?php } ?>
  
  <?php if ($keywords) { ?>
     <meta name="keywords" content= "<?php echo $keywords; ?>" />
  <?php } ?>
  
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <?php if ($icon) { ?>
    <link href="<?php echo $icon; ?>" rel="icon" type="image/jpg" />
  <?php } ?>
  <link rel="apple-touch-icon" href="/image/catalog/favicon_apple.jpg">
  
  <?php foreach ($links as $link) { ?>
    <link href="<?php echo $link['href']; ?>" rel="<?php echo $link['rel']; ?>" />
  <?php } ?>

  <?php foreach ($styles as $style) { ?>
    <link href="<?php echo $style['href']; ?>" type="text/css" rel="<?php echo $style['rel']; ?>" media="<?php echo $style['media']; ?>" />
  <?php } ?>

  <link rel="stylesheet" href="/catalog/view/theme/default/stylesheet/slick-carousel/slick/slick.css">
  <link rel="stylesheet" href="/catalog/view/theme/default/stylesheet/slick-carousel/slick/slick-theme.css">
  <link rel="stylesheet" href="/catalog/view/javascript/vendor/fancybox/dist/jquery.fancybox.min.css">
  <link rel="stylesheet" href="/catalog/view/theme/default/stylesheet/malihu-custom-scrollbar-plugin-master/jquery.mCustomScrollbar.min.css">
  <link href="https://fonts.googleapis.com/css?family=Roboto:100,100i,300,300i,400,400i,500,500i,700,700i,900,900i" rel="stylesheet">
  <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/catalog/view/javascript/vendor/nouislider/distribute/nouislider.min.css">
  <link rel="stylesheet" href="/catalog/view/theme/default/stylesheet/index.css">

<!--  <link rel="stylesheet" href="/catalog/view/theme/default/stylesheet/checkout/index.css">-->
<!--  <link rel="stylesheet" href="/catalog/view/theme/default/stylesheet/checkout/style.css">-->
  
  <script>
    var LANGS = {};
    <?php $arr = $languagese; foreach($arr as $group => $langs){ ?>LANGS['<?php echo $group?>']={};<?php foreach($langs as $name_key => $value){?>LANGS['<?php echo $group?>']['<?php echo $name_key ;?>']='<?php echo $value ;?>';<?php } ?><?php } ?>
  </script>
  
  <?php echo $google_analytics; ?>

  <script  src="/catalog/view/javascript/jquery/jquery-2.1.1.min.js"></script>
<!--  <script type="text/javascript" src="/catalog/view/javascript/vendor/jquery/dist/jquery.js"></script>-->
  <?php foreach ($scripts as $script) { ?>
    <script src="<?php echo $script; ?>"></script>
  <?php } ?>
</head>

<body>
<div id="wrapper">

  <div class="hidden-menu">
    <div class="hidden-menu-overlay"></div>
    <div class="menu-close"><span></span>
    </div>
    <nav class="menu-box">
      <ul class="hidden-menu-holder">
        <li><a href="<?php echo $about_page['href']; ?>"><?php echo $about_page['title']; ?></a>
        </li>
        <li><a href="<?php echo $delivery_page['href']; ?>"><?php echo $delivery_page['title']; ?></a>
        </li>
        <li><a href="<?php echo $payment_page['href']; ?>"><?php echo $payment_page['title']; ?></a>
        </li>
        <li><a href="<?php echo $help_page['href']; ?>"><?php echo $help_page['title']; ?></a>
        </li>
        <li><a href="<?php echo $vacancy_page['href']; ?>"><?php echo $vacancy_page['title']; ?></a>
        </li>
      </ul>
    </nav>
  </div>

  <div class="hidden-search">
    <?php echo $search; ?>
  </div>

  <div class="hidden-feedback">
    <div class="feedback-holder">
      <span class="close-feedback"></span>
      <div class="hidden-feedback-box">
        <span class="feedback-name">ОБРАТНАЯ СВЯЗЬ</span>
        <form class="feedback-form form-faq" action="#" method="post">
          <div class="row">
            <input type="text" placeholder="Имя">
            <label class="error">Введите имя</label>
            <input type="tel" placeholder="Телефон">
            <label class="error">Введите имя</label>
          </div>
          <button type="submit" value="submit" class="feedback-submit">Отправить</button>
        </form>
      </div>
    </div>
  </div>

  <div class="hidden-item">
  </div>

  <header id="header">
    <div class="header-holder">
      <strong class="logo">
        <a href="/"></a>
      </strong>

      <?php echo $language; ?>

      <div class="navigation-box">
        <div id="nav-hamburger">
          <span></span>
          <span></span>
          <span></span>
        </div>
        <span class="nav-link"><?php echo $text_catalog; ?></span>
        <div class="nav-holder">
          <nav class="nav">
            <ul>
              <?php foreach ($categories as $category) { ?>
                <?php if (!empty($category['children'])) { ?>
                  <li class="parent">
                    <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>

                    <ul>
                      <?php foreach ($category['children'] as $children) { ?>
                        <?php if (!empty($children['children_children'])) { ?>
                          <li class="parent">
                            <a href="<?php echo $children['href']; ?>"><?php echo $children['name']; ?></a>

                            <ul>
                              <?php foreach ($children['children_children'] as $children_children) { ?>
                                <li data-img="<?php echo $children_children['image']; ?>">
                                  <a href="<?php echo $children_children['href']; ?>"><?php echo $children_children['name']; ?></a>
                                </li>
                              <?php } ?>
                            </ul>

                          </li>
                        <?php } else { ?>
                          <li>
                            <a href="<?php echo $children['href']; ?>"><?php echo $children['name']; ?></a>
                          </li>
                        <?php } ?>
                      <?php } ?>
                    </ul>

                  </li>
                <?php } else { ?>
                  <li>
                    <a href="<?php echo $category['href']; ?>"><?php echo $category['name']; ?></a>
                  </li>
                <?php } ?>
              <?php } ?>
            </ul>
          </nav>
          <div class="image-box">
            <img src="" alt="">
          </div>
        </div>
      </div>

      <div class="box-nav">
        <ul class="box-nav-menu">
          <li><a href="<?php echo $service_page['href']; ?>"><?php echo $service_page['title']; ?></a>
          </li>
          <li><a href="<?php echo $blog_page['href']; ?>"><?php echo $blog_page['title']; ?></a>
          </li>
          <li><a href="<?php echo $contacts['href']; ?>"><?php echo $contacts['title']; ?></a>
          </li>
        </ul>
      </div>
      <div class="more-box">
        <span class="nav-more"><?php echo $text_all; ?></span>
      </div>

      <div class="phone-header">
        <a class="phone" href="tel:<?php echo $telephone_digit; ?>">

          <?php echo $telephone; ?>

          <span><?php echo $text_call_free; ?></span>

        </a>
      </div>
      <div class="user-panel">
        <ul>
          <li class="search-button">
            <span class="holder-icon">
              <span class="search-header"></span>
            </span>
          </li>
          <li>
            <span class="holder-icon">
              <span class="feedback-header"></span>
            </span>
            <ul class="feedback-dropdown">
              <li><a class="phone" href="tel:<?php echo $telephone_digit_2; ?>"><?php echo $telephone_2; ?></a>
              </li>
              <li class="feedback">
                <span><?php echo $text_callme; ?></span>
              </li>
            </ul>
          </li>
          <li>
            <a href="<?php echo $login; ?>">
              <span class="holder-icon">
                <span class="login-header"></span>
              </span>
            </a>
          </li>
          <li class="card-box">
            <span class="holder-icon">
              <span class="card-header">
                <span class="card-counter"><?php echo $basket_count; ?></span>
              </span>
            </span>
          </li>
        </ul>
        <div class="hidden-card">
          <?php echo $cart; ?>
        </div>
      </div>
    </div>
  </header>
