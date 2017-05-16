<?php echo $header; ?>

<div id="main">
  <div class="content">
    <div class="catalog-slider">
      <?php foreach ($banner_top as $item) { ?>
        <div class="slide">
          <div class="slide-img">
            <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" width="1900" height="660">
            <div class="slide-info">
              <strong class="info-name"><?php echo $item['title']; ?></strong>
              <div class="info-text">
                <p><?php echo $item['text']; ?></p>
              </div>
              <span class="info-price"><?php echo $item['additional']; ?></span>
              <a class="info-buy-product" href="<?php echo $item['href']; ?>"><em></em><?php echo $text_buy; ?></a>
            </div>
          </div>
        </div>
      <?php }; ?>
    </div>

    <div class="content-box">
      <div class="box-title">КАТАЛОГ ТОВАРОВ</div>
      <div class="product-list">
        <ul class="tabset">
          <li><a class="tab active" href="#tab-11">ВСЕ ТОВАРЫ</a>
          </li>
          <li><a class="tab" href="#tab-12">ТЕЛЕФОНЫ</a>
          </li>
          <li><a class="tab" href="#tab-13">ПЛАНШЕТЫ</a>
          </li>
          <li><a class="tab" href="#tab-14">НОУТБУКИ</a>
          </li>
          <li><a class="tab" href="#tab-15">РОБОТОТЕХНИКА</a>
          </li>
          <li><a class="tab" href="#tab-16">ЭЛЕКТРОТРАНСПОРТ</a>
          </li>
          <li><a class="tab" href="#tab-17">АКСЕССУАРЫ</a>
          </li>
        </ul>
        <div class="tab-holder">
          <div id="tab-11">
            <div class="content-catalog">
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <span class="catalog-sale">SALE</span>
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img1.jpg" width="229" height="216">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/all_catalog_img_hover.jpg" width="255" height="240">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="old-price">$549.99</span>
                    <span class="sale-price">$449.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img4.jpg" width="222" height="209">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item4_hover.jpg" width="2000" height="2000">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/catalog_img_item5.jpg" width="190" height="181">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item5_hover.jpg" width="301" height="523">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <span class="catalog-sale">SALE</span>
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img1.jpg" width="229" height="216">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/all_catalog_img_hover.jpg" width="255" height="240">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="old-price">$549.99</span>
                    <span class="sale-price">$449.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img4.jpg" width="222" height="209">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item4_hover.jpg" width="2000" height="2000">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/catalog_img_item5.jpg" width="190" height="181">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item5_hover.jpg" width="301" height="523">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="tab-12">
            <div class="content-catalog">
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <span class="catalog-sale">SALE</span>
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img1.jpg" width="229" height="216">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/all_catalog_img_hover.jpg" width="255" height="240">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="old-price">$549.99</span>
                    <span class="sale-price">$449.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img4.jpg" width="222" height="209">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item4_hover.jpg" width="2000" height="2000">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/catalog_img_item5.jpg" width="190" height="181">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item5_hover.jpg" width="301" height="523">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <span class="catalog-sale">SALE</span>
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img1.jpg" width="229" height="216">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/all_catalog_img_hover.jpg" width="255" height="240">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="old-price">$549.99</span>
                    <span class="sale-price">$449.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img4.jpg" width="222" height="209">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item4_hover.jpg" width="2000" height="2000">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/catalog_img_item5.jpg" width="190" height="181">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item5_hover.jpg" width="301" height="523">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="tab-13">
            <div class="content-catalog">
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <span class="catalog-sale">SALE</span>
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img1.jpg" width="229" height="216">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/all_catalog_img_hover.jpg" width="255" height="240">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="old-price">$549.99</span>
                    <span class="sale-price">$449.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img4.jpg" width="222" height="209">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item4_hover.jpg" width="2000" height="2000">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/catalog_img_item5.jpg" width="190" height="181">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item5_hover.jpg" width="301" height="523">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <span class="catalog-sale">SALE</span>
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img1.jpg" width="229" height="216">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/all_catalog_img_hover.jpg" width="255" height="240">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="old-price">$549.99</span>
                    <span class="sale-price">$449.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img4.jpg" width="222" height="209">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item4_hover.jpg" width="2000" height="2000">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/catalog_img_item5.jpg" width="190" height="181">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item5_hover.jpg" width="301" height="523">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="tab-14">
            <div class="content-catalog">
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <span class="catalog-sale">SALE</span>
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img1.jpg" width="229" height="216">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/all_catalog_img_hover.jpg" width="255" height="240">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="old-price">$549.99</span>
                    <span class="sale-price">$449.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img4.jpg" width="222" height="209">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item4_hover.jpg" width="2000" height="2000">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/catalog_img_item5.jpg" width="190" height="181">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item5_hover.jpg" width="301" height="523">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <span class="catalog-sale">SALE</span>
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img1.jpg" width="229" height="216">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/all_catalog_img_hover.jpg" width="255" height="240">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="old-price">$549.99</span>
                    <span class="sale-price">$449.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img4.jpg" width="222" height="209">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item4_hover.jpg" width="2000" height="2000">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/catalog_img_item5.jpg" width="190" height="181">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item5_hover.jpg" width="301" height="523">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="tab-15">
            <div class="content-catalog">
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <span class="catalog-sale">SALE</span>
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img1.jpg" width="229" height="216">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/all_catalog_img_hover.jpg" width="255" height="240">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="old-price">$549.99</span>
                    <span class="sale-price">$449.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img4.jpg" width="222" height="209">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item4_hover.jpg" width="2000" height="2000">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/catalog_img_item5.jpg" width="190" height="181">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item5_hover.jpg" width="301" height="523">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <span class="catalog-sale">SALE</span>
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img1.jpg" width="229" height="216">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/all_catalog_img_hover.jpg" width="255" height="240">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="old-price">$549.99</span>
                    <span class="sale-price">$449.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img4.jpg" width="222" height="209">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item4_hover.jpg" width="2000" height="2000">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/catalog_img_item5.jpg" width="190" height="181">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item5_hover.jpg" width="301" height="523">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="tab-16">
            <div class="content-catalog">
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <span class="catalog-sale">SALE</span>
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img1.jpg" width="229" height="216">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/all_catalog_img_hover.jpg" width="255" height="240">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="old-price">$549.99</span>
                    <span class="sale-price">$449.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img4.jpg" width="222" height="209">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item4_hover.jpg" width="2000" height="2000">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/catalog_img_item5.jpg" width="190" height="181">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item5_hover.jpg" width="301" height="523">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <span class="catalog-sale">SALE</span>
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img1.jpg" width="229" height="216">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/all_catalog_img_hover.jpg" width="255" height="240">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="old-price">$549.99</span>
                    <span class="sale-price">$449.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img4.jpg" width="222" height="209">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item4_hover.jpg" width="2000" height="2000">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/catalog_img_item5.jpg" width="190" height="181">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item5_hover.jpg" width="301" height="523">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="tab-17">
            <div class="content-catalog">
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <span class="catalog-sale">SALE</span>
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img1.jpg" width="229" height="216">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/all_catalog_img_hover.jpg" width="255" height="240">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="old-price">$549.99</span>
                    <span class="sale-price">$449.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img4.jpg" width="222" height="209">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item4_hover.jpg" width="2000" height="2000">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/catalog_img_item5.jpg" width="190" height="181">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item5_hover.jpg" width="301" height="523">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <span class="catalog-sale">SALE</span>
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img1.jpg" width="229" height="216">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/all_catalog_img_hover.jpg" width="255" height="240">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="old-price">$549.99</span>
                    <span class="sale-price">$449.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/all_catalog_img4.jpg" width="222" height="209">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item4_hover.jpg" width="2000" height="2000">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
              <div class="catalog-item">
                <div class="image-holder">
                  <a href="#">
                    <div class="catalog-image">
                      <img src="/images/catalog_img_item5.jpg" width="190" height="181">
                    </div>
                    <div class="catalog-image-hover">
                      <img src="/images/catalog_img_item5_hover.jpg" width="301" height="523">
                    </div>
                  </a>
                </div>
                <div class="description">
                  <a href="#" class="catalog-name">Samsung Galaxy j5 Black</a>
                  <div class="item-description">
                    <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой от
                      попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                  </div>
                  <div class="catalog-price">
                    <span class="topical-price">$649.99</span>
                  </div>
                  <div class="button-box">
                    <div class="quantity">
                      <input type="number" value="1" min="1" max="20" step="1">
                    </div>
                    <button class="item-buy"><em></em>Купить</button>
                    <span class="item-buy-click">Купить в один клик</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="content-box services">
      <div class="services-box">
        <div class="box-title"><?php echo $text_our_service; ?></div>
        <div class="content-services">
          <ul>
            <?php foreach ($banner_service as $item) { ?>
              <li>
                <a href="<?php echo $item['href']; ?>" class="services-ovh">
                  <div class="services-info">
                    <?php if ($item['image_add']) { ?>
                      <img src="<?php echo $item['image_add']; ?>" width="<?php echo $item['width_add']; ?>" height="<?php echo $item['height_add']; ?>">
                    <?php }; ?>
                    <span class="services-name"><?php echo $item['title']; ?></span>
                    <span class="go-services"><?php echo $text_go; ?><em></em></span>
                  </div>
                  <div class="services-img">
                    <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>" width="<?php echo $item['width']; ?>" height="<?php echo $item['height']; ?>">
                  </div>
                </a>
              </li>
            <?php }; ?>
          </ul>
        </div>
        <div class="all-services-box">
          <div class="all-services-holder">
            <a class="all-services" href="#"><?php echo $text_all_service; ?></a>
          </div>
        </div>
      </div>
    </div>

    <div class="content-box profitable">
      <div class="box-title">ВЫГОДНЫЕ ПРЕДЛОЖЕНИЯ</div>
      <div class="product-list">
        <ul class="tabset">
          <li><a class="tab active" href="#tab-21">АКЦИОННЫЕ ПРЕДЛОЖЕНИЯ</a>
          </li>
          <li><a class="tab" href="#tab-22">НОВЫЕ ПОСТУПЛЕНИЯ</a>
          </li>
        </ul>
        <div class="tab-holder">
          <div id="tab-21">
            <div class="content-catalog slider-holder">
              <div class="catalog-sale-slider">
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-sale">SALE</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="old-price">$549.99</span>
                      <span class="sale-price">$449.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-sale">SALE</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img3.jpg" width="255" height="240">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="old-price">$549.99</span>
                      <span class="sale-price">$449.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-sale">SALE</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="old-price">$549.99</span>
                      <span class="sale-price">$449.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-sale">SALE</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="old-price">$549.99</span>
                      <span class="sale-price">$449.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-sale">SALE</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="old-price">$549.99</span>
                      <span class="sale-price">$449.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-sale">SALE</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="old-price">$549.99</span>
                      <span class="sale-price">$449.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-sale">SALE</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="old-price">$549.99</span>
                      <span class="sale-price">$449.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-sale">SALE</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="old-price">$549.99</span>
                      <span class="sale-price">$449.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div id="tab-22">
            <div class="content-catalog slider-holder">
              <div class="catalog-sale-slider">
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-new">New</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="topical-price">$649.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-new">New</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="topical-price">$649.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-new">New</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="topical-price">$649.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-new">New</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="topical-price">$649.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-new">New</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="topical-price">$649.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-new">New</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="topical-price">$649.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-new">New</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="topical-price">$649.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
                <div class="catalog-item">
                  <div class="image-holder">
                    <a href="#">
                      <span class="catalog-new">New</span>
                      <div class="catalog-image">
                        <img src="/images/all_catalog_img2.jpg" width="244" height="229">
                      </div>
                      <div class="catalog-image-hover">
                        <img src="/images/catalog_img_item3_hover.jpg" width="175" height="282">
                      </div>
                    </a>
                  </div>
                  <div class="description">
                    <a href="#" class="catalog-name">Iphone SE 64GB Gold(Sprint)</a>
                    <div class="item-description">
                      <p>15.6" (1920x1080), матовый / Intel Core i3 6100U 2300 МГц / 2 Core / ОЗУ 4Gb (2 слота DDR3L) / HDD 500Gb (7200 об/мин) / AMD Radeon R7 340 1024Mb / Оптический привод DVD / DTS Studio Sound / клавиатура HP Premium с защитой
                        от попадания жидкости / TPM модуль, Устройство HP для считывания отпечатков пальцев / DOS / 2.15 кг / Серый</p>
                    </div>
                    <div class="catalog-price">
                      <span class="topical-price">$649.99</span>
                    </div>
                    <div class="button-box">
                      <div class="quantity">
                        <input type="number" value="1" min="1" max="20" step="1">
                      </div>
                      <button class="item-buy"><em></em>Купить</button>
                      <span class="item-buy-click">Купить в один клик</span>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    
    <div class="content-box article">
      <div class="box-title"><?php echo $text_latest_art; ?> <span class="box-signature"><?php echo $text_be_informed; ?></span>
      </div>
      <div class="product-list">
        <ul class="tabset">
          <?php foreach ($blog_categories as $key => $category) { ?>
              <?php if (!empty($category['articles'])) { ?>
                <li>
                  <a class="tab <?php echo $key==0 ? 'active' : ''; ?>" href="#tab-3<?php echo $key+1; ?>"><?php echo $category['name']; ?></a>
                </li>
              <?php } ?>
          <?php } ?>
        </ul>
        <div class="tab-holder">
          <?php foreach ($blog_categories as $key => $category) { ?>
              <?php if (!empty($category['articles'])) { ?>
                  <div id="tab-3<?php echo $key+1; ?>">
                    <div class="article-slider-holder">
                      <ul class="news-slider">
                        <?php foreach ($category['articles'] as $article) { ?>
                        <li class="slide-news-box">
                          <div class="news-box-img">
                            <a href="<?php echo $article['href']; ?>">
                              <img src="<?php echo $article['image']; ?>" alt="<?php echo $article['title']; ?>" width="373" height="218">
                            </a>
                          </div>
                          <div class="news-box-info">
                            <span class="info-date"><?php echo $article['date_added']; ?></span>
                            <a href="<?php echo $article['href']; ?>"><?php echo $article['title']; ?></a>
                            <div class="info-text">
                              <p><?php echo $article['description']; ?></p>
                            </div>
                          </div>
                        </li>
                        <?php } ?>
                      </ul>
                    </div>
                  </div>
              <?php } ?>
          <?php } ?>
        </div>
      </div>
      <div class="all-services-box">
        <div class="all-services-holder">
          <a class="all-services" href="#"><?php echo $text_all_article; ?></a>
        </div>
      </div>
    </div>

    <div class="content-box">
      <div class="box-title"><?php echo $text_our_partners; ?><span class="box-signature"><?php echo $text_partners_best; ?></span>
      </div>
    </div>
    <div class="content-box partners">
      <div class="content-catalog partners">
        <ul>
          <?php foreach ($banner_partners as $item) { ?>
            <li class="catalog-item">
              <a href="<?php echo $item['href']; ?>">
                <div class="catalog-image">
                  <img src="<?php echo $item['image']; ?>" width="<?php echo $item['width']; ?>" height="<?php echo $item['height']; ?>">
                </div>
              </a>
            </li>
          <?php }; ?>
        </ul>
      </div>
    </div>

  </div>
  <div class="content-bottom">
    <div class="content-bottom-holder">
      <div class="image-box">
        <img src="<?php echo $seo_image; ?>" width="555" height="574" alt="<?php echo $seo_title; ?>">
      </div>
      <div class="content-bottom-box">
        <h1 class="box-title"><?php echo $seo_title; ?></h1>
        <div class="mCustomScrollbar" data-mcs-theme="dark">
          <div class="box-text">
            <?php echo $seo_text; ?>
          </div>
        </div>
        <a href="#" class="go-services"><?php echo $text_more; ?><em></em></a>
      </div>
    </div>
  </div>
</div>

<?php echo $footer; ?>