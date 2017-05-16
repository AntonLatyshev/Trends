<?php
class ControllerModuleFeatured extends Controller {
	public function index($setting) {
		$this->load->language('module/featured');

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_tax'] = $this->language->get('text_tax');
		$data['text_catalog'] = $this->language->get('text_catalog');
		$data['text_profitable'] = $this->language->get('text_profitable');
		$data['text_buy'] = $this->language->get('text_buy');
		$data['text_buy_click'] = $this->language->get('text_buy_click');

		$data['button_cart'] = $this->language->get('button_cart');
		$data['button_wishlist'] = $this->language->get('button_wishlist');
		$data['button_compare'] = $this->language->get('button_compare');

		$this->load->model('catalog/product');

		$this->load->model('tool/image');

		$data['products'] = array();
		// массив названий категорий (для табов 'Каталога товаров')
		$data['products_category_uniq'] = array();
		// массив названий категорий (для табов 'Выгодных предложений')
		$data['products_profitable'] = array();

		if (!$setting['limit']) {
			$setting['limit'] = 4;
		}

		if (!empty($setting['product'])) {
			$products = array_slice($setting['product'], 0, (int)$setting['limit']);

			foreach ($products as $product_id) {
				$product_info = $this->model_catalog_product->getProduct($product_id);

				if ($product_info) {
					$product_categories = $this->model_catalog_product->getCategories($product_info['product_id']);

					$categories = array();
					foreach ($product_categories as $product_category) {
						$category_info = $this->model_catalog_product->getCategory($product_category['category_id']);

						$categories[] = $category_info['name'];

						// добавим в массив категорий, если еще нету
						if (!in_array($category_info['name'], $data['products_category_uniq'])) {
							$data['products_category_uniq'][] = $category_info['name'];
						}
					}

                    if (isset($product_info['image']) && is_file(DIR_IMAGE . $product_info['image'])) {
						$image = $this->model_tool_image->resize($product_info['image'], $setting['width'], $setting['height']);
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', $setting['width'], $setting['height']);
					}

					$product_images = $this->model_catalog_product->getProductImages($product_info['product_id']);

					$images = array();
					foreach ($product_images as $product_image) {
						if (is_file(DIR_IMAGE . $product_image['image'])) {
							$images[] = $this->model_tool_image->resize($product_image['image'], $setting['width'], $setting['height']);
						}
					}

					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($product_info['price'], $product_info['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$price = false;
					}

					if ((float)$product_info['special']) {
						$special = $this->currency->format($this->tax->calculate($product_info['special'], $product_info['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$special = false;
					}

					if ($this->config->get('config_tax')) {
						$tax = $this->currency->format((float)$product_info['special'] ? $product_info['special'] : $product_info['price']);
					} else {
						$tax = false;
					}

					if ($this->config->get('config_review_status')) {
						$rating = $product_info['rating'];
					} else {
						$rating = false;
					}

					/*code start*/
					if((strtotime(date('Y-m-d')) >= strtotime($product_info['promo_date_start'])) && (strtotime(date('Y-m-d')) <= strtotime($product_info['promo_date_end'])) || (($product_info['promo_date_start'] == '0000-00-00') && ($product_info['promo_date_end'] == '0000-00-00'))) {
						$promo_on = TRUE;
					} else {
						$promo_on = FALSE;
					}

					$promo = $this->model_catalog_product->getPromo($product_info['product_id'],$product_info['promo_top_right']);
					if ( $promo_on && !empty($promo) ) {
						switch ($promo['promo_tags_id']) {
							case 107:
								$class = 'new';
								$tab_name = $this->language->get('text_tab_new');
								break;
							case 109:
								$class = 'sale';
								$tab_name = $this->language->get('text_tab_sale');
								break;
							case 110:
								$class = 'hit';
								$tab_name = $this->language->get('text_tab_hit');
								break;
							default:
								$class = '';
								$tab_name = '';
						}
						$promotag = array(
							'promo_tags_id' => $promo['promo_tags_id'],
							'class'   => $class,
							'tab_name'=> $tab_name,
							'text'    => $promo['promo_text'],
							'image'   => $promo['image'],
						);

						// добавим в массив promo-названий, если еще нету
						if (!in_array($tab_name, $data['products_profitable'])) {
							$data['products_profitable'][] = $tab_name;
						}
					} else {
						$promotag = array();
					}
					/*code end*/

					$data['products'][] = array(
						'product_id'  => $product_info['product_id'],
						'thumb'       => $image,
						'name'        => $product_info['name'],
						'quantity'    => $product_info['quantity'],
						'description' => utf8_substr(strip_tags(html_entity_decode($product_info['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
						'description_short' => utf8_substr(strip_tags(html_entity_decode($product_info['description_short'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
						'price'       => $price,
						'special'     => $special,
						'tax'         => $tax,
						'rating'      => $rating,
						'href'        => $this->url->link('product/product', 'product_id=' . $product_info['product_id']),
						'promotag'	  => $promotag,
						'categories'  => $categories,
						'images'      => $images,
					);
				}
			}
		}

		// id модуля
		$data['module_id'] = $setting['module_id'];

		// переменные, которые зависят от конкретного модуля
		if ($setting['module_id'] == 64) {
			$data['content_box_class'] = 'profitable';
			$data['content_catalog_class'] = 'slider-holder';
			$data['block_title'] = $this->language->get('text_profitable');
			$data['tabs_title'] = $data['products_profitable'];
			$data['tab_index'] = '2';
		} else {
			$data['content_box_class'] = '';
			$data['content_catalog_class'] = '';
			$data['block_title'] = $this->language->get('text_catalog');
			$data['tabs_title'] = $data['products_category_uniq'];
			$data['tab_index'] = '1';
		}

		$data['languagese'] = $this->language->getGroupData();

		if ($data['products']) {
			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/featured.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/featured.tpl', $data);
			} else {
				return $this->load->view('default/template/module/featured.tpl', $data);
			}
		}
	}
}