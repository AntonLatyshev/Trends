<?php
class ControllerProductService extends Controller {

    public function getSeoTitleUrl($current_url){
        if($current_url){
            $query = $this->db->query("SELECT * FROM oc_seo_mobule_link WHERE seo_url = '" . $current_url . "'");

            if ($query->num_rows) {
                return $query->row;
            } else {
                return false;
            }
        }
    }

	public function index() {
		$this->load->language('product/service');

		$this->load->model('catalog/service');

		$this->load->model('catalog/sproduct');

		$this->load->model('tool/image');

		if (isset($this->request->get['filter'])) {
			$filter = $this->request->get['filter'];
		} else {
			$filter = '';
		}

		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'p.sort_order';
		}

		if (isset($this->request->get['order'])) {
			$order = $this->request->get['order'];
		} else {
			$order = 'ASC';
		}

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}

		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			$limit = $this->config->get('config_product_limit');
		}
                
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);

		if (isset($this->request->get['path'])) {
			$url = ''; if( ! empty( $this->request->get['mfp'] ) ) { $url .= '&mfp=' . $this->request->get['mfp']; }

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$path = '';

			$parts = explode('_', (string)$this->request->get['path']);

			$level = count($parts);

			$service_id = (int)array_pop($parts);

			foreach ($parts as $path_id) {
				if (!$path) {
					$path = (int)$path_id;
				} else {
					$path .= '_' . (int)$path_id;
				}

				$service_info = $this->model_catalog_service->getService($path_id);

				if ($service_info) {
					$data['breadcrumbs'][] = array(
						'text' => $service_info['name'],
						'href' => $this->url->link('product/service', 'path=' . $path . $url)
					);
				}
			}
		} else {
			$service_id = 0;
			$level = 1;
		}
		
		$data['level'] = $level;

		$service_info = $this->model_catalog_service->getService($service_id);

		if ($service_info) {

            $current_path = parse_url($this->url->link('product/service', 'path=' . $this->model_catalog_service->getServicePath($service_id), 'SSL'));

            // SEO
            $rest = substr(HTTP_SERVER, 0, -1);
            $current_url = $rest . $_SERVER['REQUEST_URI'];
            $seo_title = $this->getSeoTitleUrl($current_url);
            $current_url = parse_url($current_url);
            // SEO

            if ($current_url['path'] != $current_path['path']) {
                //$this->response->redirect($this->url->link('product/service', 'path=' . $this->model_catalog_service->getServicePath($service_id), 'SSL'), '301');
            }

			$data['customer_group_id'] = $service_info['customer_group_id'];

			if ( ($this->config->get('config_customer_group_id') == $service_info['customer_group_id']) || $service_info['customer_group_id'] == '1' ) {

                if($seo_title){
                    if ($seo_title['seo_title']) {
                        $seoTitle = $seo_title['seo_title'];
                    }

                    if ($seo_title['seo_desc']) {
                        $seoMetaDescription = $seo_title['seo_desc'];
                    }

                    if ($seo_title['seo_keyword']) {
                        $seoMetaKeyword = $seo_title['seo_keyword'];
                    }

                    if ($seo_title['seo_h1']) {
                        $seoHeadingTitle = $seo_title['seo_h1'];
                    }

                    if ($seo_title['seo_text']) {
                        $seoDescription = $seo_title['seo_text'];
                    }
                }

                $set = array(
                    'setTitle'              => ( !empty($seoTitle) ) ? $seoTitle : $service_info['meta_title'],
                    'seoMetaDescription'    => ( !empty($seoMetaDescription) ) ? $seoMetaDescription : $service_info['meta_description'],
                    'seoMetaKeyword'        => ( !empty($seoMetaKeyword) ) ? $seoMetaKeyword : $service_info['meta_keyword'],
                    'seoHeadingTitle'       => ( !empty($seoHeadingTitle) ) ? $seoHeadingTitle : $service_info['name'],
                    'seoDescription'        => ( !empty($seoDescription) ) ? $seoDescription : $service_info['description']
                );

				$this->document->setTitle($set['setTitle']);
				$this->document->setDescription($set['seoMetaDescription']);
				$this->document->setKeywords($set['seoMetaKeyword']);
				$this->document->addLink($this->url->link('product/service', 'path=' . $this->request->get['path'], 'SSL'), 'canonical');

				$data['heading_title'] = $set['seoHeadingTitle'];

                $data['description'] = html_entity_decode($set['seoDescription'], ENT_QUOTES, 'UTF-8');
                $data['short_description'] = html_entity_decode($service_info['description_short'], ENT_QUOTES, 'UTF-8');

                $data['compare'] = $this->url->link('product/compare');

				$data['text_refine'] = $this->language->get('text_refine');
				$data['text_empty'] = $this->language->get('text_empty');
				$data['text_quantity'] = $this->language->get('text_quantity');
				$data['text_manufacturer'] = $this->language->get('text_manufacturer');
				$data['text_model'] = $this->language->get('text_model');
				$data['text_price'] = $this->language->get('text_price');
				$data['text_tax'] = $this->language->get('text_tax');
				$data['text_points'] = $this->language->get('text_points');
				$data['text_compare'] = sprintf($this->language->get('text_compare'), (isset($this->session->data['compare']) ? count($this->session->data['compare']) : 0));
				$data['text_sort'] = $this->language->get('text_sort');
				$data['text_limit'] = $this->language->get('text_limit');
				$data['text_vid'] = $this->language->get('text_vid');
				$data['text_more'] = $this->language->get('text_more');
				$data['text_all'] = $this->language->get('text_all');

				$data['button_cart'] = $this->language->get('button_cart');
				$data['read_more'] = $this->language->get('read_more');
				$data['button_wishlist'] = $this->language->get('button_wishlist');
				$data['button_compare'] = $this->language->get('button_compare');
				$data['button_continue'] = $this->language->get('button_continue');
				$data['button_list'] = $this->language->get('button_list');
				$data['button_grid'] = $this->language->get('button_grid');

				// Set the last service breadcrumb
				$data['breadcrumbs'][] = array(
					'text' => $service_info['name'],
					'href' => $this->url->link('product/service', 'path=' . $this->request->get['path'])
				);

				if ($service_info['image']) {
					$data['thumb'] = $this->model_tool_image->resize($service_info['image'], 555, 574);
				} else {
					$data['thumb'] = '';
				}

				if ($service_info['image_bg']) {
					$data['thumb_bg'] = 'image/' . $service_info['image_bg'];
				} else {
					$data['thumb_bg'] = '';
				}

				// Start custom_fields
				$custom_language_id = false;

				$this->load->model('localisation/language');

				$languages = $this->model_localisation_language->getLanguages();
				foreach ( $languages as $key => $value ) {
					if ($key == $this->language->get('code')) {
						$custom_language_id = $value['language_id'];
					}
				}

				$data['custom_field'] = array();
				if ( !empty($service_info['custom_field']) ) {
					$custom_fields = json_decode($service_info['custom_field'], true);
					if ( !empty($custom_fields[$custom_language_id]) ) {
						foreach ($custom_fields[$custom_language_id] as $custom_fields) {
							$data['custom_field'][$custom_fields['name']] = $custom_fields['value'];
						}
					}
				}
				// var_dump($data['custom_field']);
				// End custom_fields

				// Опции
				$data['config_catagory_product'] = $this->config->get('config_catagory_product');
				$data['config_catagory_product_position'] = $this->config->get('config_catagory_product_position');
				$data['config_catagory_product_child'] = $this->config->get('config_catagory_product_child');

				$url = ''; if( ! empty( $this->request->get['mfp'] ) ) { $url .= '&mfp=' . $this->request->get['mfp']; }

				if (isset($this->request->get['filter'])) {
					$url .= '&filter=' . $this->request->get['filter'];
				}

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				$fmSettings = $this->config->get('mega_filter_settings');

				if( ! empty( $fmSettings['not_remember_filter_for_subservices'] ) && false !== ( $mfpPos = strpos( $url, '&mfp=' ) ) ) {
					$mfUrlBeforeChange = $url;
					$mfSt = mb_strpos( $url, '&', $mfpPos+1, 'utf-8');
					$url = $mfSt === false ? '' : mb_substr($url, $mfSt, mb_strlen( $url, 'utf-8' ), 'utf-8');
				}
				
				// Категории услуги
				$data['services'] = array();

				$results = $this->model_catalog_service->getServices($service_id);

				foreach ($results as $result) {
					$filter_data = array(
						'filter_service_id'  => $result['service_id'],
						'filter_sub_service' => true
					);
					
					if (isset($result['image']) && is_file(DIR_IMAGE . $result['image'])) {
						$thumb = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
					} else {
						$thumb = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_category_width'), $this->config->get('config_image_category_height'));
					}

					$short_descr = html_entity_decode($result['description_short'], ENT_QUOTES, 'UTF-8');

					$sub_services = array();
					$sub_service_info = $this->model_catalog_service->getServices($result['service_id']);

					foreach ($sub_service_info as $info) {
						$sub_services[] = array(
							'name'  => $info['name'],
							'href'  => $this->url->link('product/service', 'path=' . $this->request->get['path'] . '_' . $result['service_id'] . '_' . $info['service_id']),
						);
					}

					$sub_cnt = count($sub_services);

					$data['services'][] = array(
						'name'  => $result['name'],
						'thumb' => $thumb,
						'href'  => $this->url->link('product/service', 'path=' . $this->request->get['path'] . '_' . $result['service_id'] . $url),
						'short_description'  => $short_descr,
						'sub_services' => $sub_services,
						'sub_cnt'      => $sub_cnt,
					);
				}

//				echo "<pre>";
//				    print_r($data['services']);
//				echo "</pre>";

				// Товары услуги
				$data['sproducts'] = array();

				$filter_data = array(
					'filter_service_id'  => $service_id,
//					'filter_filter'      => $filter,
//					'sort'               => $sort,
//					'order'              => $order,
//					'start'              => ($page - 1) * $limit,
//					'limit'              => $limit
				);

				$sproduct_total = $this->model_catalog_sproduct->getTotalSproducts($filter_data);

				$results = $this->model_catalog_sproduct->getSproducts($filter_data);

				foreach ($results as $result) {
                    if (isset($result['image_list']) && is_file(DIR_IMAGE . $result['image_list'])) {
						$image = $this->model_tool_image->resize($result['image_list'], $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
					} else {
						$image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_product_width'), $this->config->get('config_image_product_height'));
					}

					if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
						$price = $this->currency->format($this->tax->calculate($result['price'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$price = false;
					}

					if ((float)$result['special']) {
						$special = $this->currency->format($this->tax->calculate($result['special'], $result['tax_class_id'], $this->config->get('config_tax')));
					} else {
						$special = false;
					}

					if ($this->config->get('config_tax')) {
						$tax = $this->currency->format((float)$result['special'] ? $result['special'] : $result['price']);
					} else {
						$tax = false;
					}

					$data['sproducts'][] = array(
						'sproduct_id' => $result['sproduct_id'],
						'thumb'       => $image,
						'name'        => $result['name'],
						'quantity'    => $result['quantity'],
						'short_description' => utf8_substr(strip_tags(html_entity_decode($result['description_short'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
						'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_product_description_length')) . '..',
						'price'       => $price,
						'special'     => $special,
						'tax'         => $tax,
						'minimum'     => $result['minimum'] > 0 ? $result['minimum'] : 1,
						'href'        => $this->url->link('product/sproduct', 'path=' . $this->request->get['path'] . '&sproduct_id=' . $result['sproduct_id'] . $url),
					);
				}

				$url = ''; if( ! empty( $this->request->get['mfp'] ) ) { $url .= '&mfp=' . $this->request->get['mfp']; }
                                
				if (isset($this->request->get['filter'])) {
					$url .= '&filter=' . $this->request->get['filter'];
				}

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				$data['sorts'] = array();

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_default'),
					'value' => 'p.sort_order-ASC',
					'href'  => $this->url->link('product/service', 'path=' . $this->request->get['path'] . '&sort=p.sort_order&order=ASC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_name_asc'),
					'value' => 'pd.name-ASC',
					'href'  => $this->url->link('product/service', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=ASC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_name_desc'),
					'value' => 'pd.name-DESC',
					'href'  => $this->url->link('product/service', 'path=' . $this->request->get['path'] . '&sort=pd.name&order=DESC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_price_asc'),
					'value' => 'p.price-ASC',
					'href'  => $this->url->link('product/service', 'path=' . $this->request->get['path'] . '&sort=p.price&order=ASC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_price_desc'),
					'value' => 'p.price-DESC',
					'href'  => $this->url->link('product/service', 'path=' . $this->request->get['path'] . '&sort=p.price&order=DESC' . $url)
				);

				if ($this->config->get('config_review_status')) {
					$data['sorts'][] = array(
						'text'  => $this->language->get('text_rating_desc'),
						'value' => 'rating-DESC',
						'href'  => $this->url->link('product/service', 'path=' . $this->request->get['path'] . '&sort=rating&order=DESC' . $url)
					);

					$data['sorts'][] = array(
						'text'  => $this->language->get('text_rating_asc'),
						'value' => 'rating-ASC',
						'href'  => $this->url->link('product/service', 'path=' . $this->request->get['path'] . '&sort=rating&order=ASC' . $url)
					);
				}

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_model_asc'),
					'value' => 'p.model-ASC',
					'href'  => $this->url->link('product/service', 'path=' . $this->request->get['path'] . '&sort=p.model&order=ASC' . $url)
				);

				$data['sorts'][] = array(
					'text'  => $this->language->get('text_model_desc'),
					'value' => 'p.model-DESC',
					'href'  => $this->url->link('product/service', 'path=' . $this->request->get['path'] . '&sort=p.model&order=DESC' . $url)
				);

				$url = ''; if( ! empty( $this->request->get['mfp'] ) ) { $url .= '&mfp=' . $this->request->get['mfp']; }
                                
				if (isset($this->request->get['filter'])) {
					$url .= '&filter=' . $this->request->get['filter'];
				}

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				$data['limits'] = array();

				$limits = array_unique(array($this->config->get('config_product_limit'), 25, 50, 75, 100));

				sort($limits);

				foreach($limits as $value) {
					$data['limits'][] = array(
						'text'  => $value,
						'value' => $value,
						'href'  => $this->url->link('product/service', 'path=' . $this->request->get['path'] . $url . '&limit=' . $value)
					);
				}

				$url = ''; if( ! empty( $this->request->get['mfp'] ) ) { $url .= '&mfp=' . $this->request->get['mfp']; }
                                
				if (isset($this->request->get['filter'])) {
					$url .= '&filter=' . $this->request->get['filter'];
				}

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				$pagination = new Pagination();
				$pagination->total = $sproduct_total;
				$pagination->page = $page;
				$pagination->limit = $limit;
				$pagination->url = $this->url->link('product/service', 'path=' . $this->request->get['path'] . $url . '&page={page}');

				$data['pagination'] = $pagination->render();

				$data['results'] = sprintf($this->language->get('text_pagination'), ($sproduct_total) ? (($page - 1) * $limit) + 1 : 0, ((($page - 1) * $limit) > ($sproduct_total - $limit)) ? $sproduct_total : ((($page - 1) * $limit) + $limit), $sproduct_total, ceil($sproduct_total / $limit));

				$data['sort'] = $sort;
				$data['order'] = $order;
				$data['limit'] = $limit;
                                
				$data['continue'] = $this->url->link('common/home');

				$data['column_left'] = $this->load->controller('common/column_left');
				$data['column_right'] = $this->load->controller('common/column_right');
				$data['content_top'] = $this->load->controller('common/content_top');
				$data['content_bottom'] = $this->load->controller('common/content_bottom');
				$data['footer'] = $this->load->controller('common/footer');
				$data['header'] = $this->load->controller('common/header');

				$data['languagese'] = $this->language->getGroupData();

				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/service.tpl')) {

					if( isset( $this->request->get['mfilterAjax'] ) ) {
						$settings	= $this->config->get('mega_filter_settings');
						$baseTypes	= array( 'stock_status', 'manufacturers', 'rating', 'attributes', 'price', 'options', 'filters' );

						if( isset( $this->request->get['mfilterBTypes'] ) ) {
							$baseTypes = explode( ',', $this->request->get['mfilterBTypes'] );
						}

						if( ! empty( $settings['calculate_number_of_products'] ) || in_array( 'services:tree', $baseTypes ) ) {
							if( empty( $settings['calculate_number_of_products'] ) ) {
								$baseTypes = array( 'services:tree' );
							}

							$this->load->model( 'module/mega_filter' );

							$idx = 0;

							if( isset( $this->request->get['mfilterIdx'] ) )
								$idx = (int) $this->request->get['mfilterIdx'];

							$data['mfilter_json'] = json_encode( MegaFilterCore::newInstance( $this, NULL )->getJsonData($baseTypes, $idx) );
						}

						$data['header'] = $data['column_left'] = $data['column_right'] = $data['content_top'] = $data['content_bottom'] = $data['footer'] = '';
					}

					if( ! empty( $data['breadcrumbs'] ) && ! empty( $this->request->get['mfp'] ) ) {
						foreach( $data['breadcrumbs'] as $mfK => $mfBreadcrumb ) {
							$mfReplace = preg_replace( '/path\[[^\]]+\],?/', '', $this->request->get['mfp'] );
							$mfFind = ( mb_strpos( $mfBreadcrumb['href'], '?mfp=', 0, 'utf-8' ) !== false ? '?mfp=' : '&mfp=' );

							$data['breadcrumbs'][$mfK]['href'] = str_replace(array(
								$mfFind . $this->request->get['mfp'],
								'&amp;mfp=' . $this->request->get['mfp'],
								$mfFind . urlencode( $this->request->get['mfp'] ),
								'&amp;mfp=' . urlencode( $this->request->get['mfp'] )
							), $mfReplace ? $mfFind . $mfReplace : '', $mfBreadcrumb['href'] );
						}
					}

					// $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/service.tpl', $data));

					/* layout patch - choose template by path */
					$this->load->model ( 'design/layout' );
					if (isset ( $this->request->get ['route'] )) {
						$route = ( string ) $this->request->get ['route'];
					} else {
						$route = 'common/home';
					}
					$layout_template = $this->model_design_layout->getLayoutTemplate($route);
					$isLayoutRoute = true;
					if(!$layout_template){
						$layout_template = 'service';
						$isLayoutRoute = false;
					}
					// get general layout template
					if(!$isLayoutRoute){
						$layout_id = $this->model_catalog_service->getServiceLayoutId($service_id);
						if($layout_id){
							$tmp_layout_template = $this->model_design_layout->getGeneralLayoutTemplate($layout_id);
							if($tmp_layout_template)
								$layout_template = $tmp_layout_template;
						}
					}

					if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/' . $layout_template . '.tpl')) {
						$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/' . $layout_template . '.tpl', $data));
					} else {
						$this->response->setOutput($this->load->view('default/template/product/' . $layout_template . '.tpl', $data));
					}

				} else {

					if( ! empty( $data['breadcrumbs'] ) && ! empty( $this->request->get['mfp'] ) ) {
						foreach( $data['breadcrumbs'] as $mfK => $mfBreadcrumb ) {
							$mfReplace = preg_replace( '/path\[[^\]]+\],?/', '', $this->request->get['mfp'] );
							$mfFind = ( mb_strpos( $mfBreadcrumb['href'], '?mfp=', 0, 'utf-8' ) !== false ? '?mfp=' : '&mfp=' );

							$data['breadcrumbs'][$mfK]['href'] = str_replace(array(
								$mfFind . $this->request->get['mfp'],
								'&amp;mfp=' . $this->request->get['mfp'],
								$mfFind . urlencode( $this->request->get['mfp'] ),
								'&amp;mfp=' . urlencode( $this->request->get['mfp'] )
							), $mfReplace ? $mfFind . $mfReplace : '', $mfBreadcrumb['href'] );
						}
					}

					$this->response->setOutput($this->load->view('default/template/product/service.tpl', $data));
				}

			} else {



				$this->document->setTitle($service_info['meta_title']);
				$this->document->setDescription($service_info['meta_description']);
				$this->document->setKeywords($service_info['meta_keyword']);
				$this->document->addLink($this->url->link('product/service', 'path=' . $this->request->get['path']), 'canonical');

				$data['heading_title'] = $service_info['name'];

				$url = '';

				if (isset($this->request->get['path'])) {
					$url .= '&path=' . $this->request->get['path'];
				}

				if (isset($this->request->get['filter'])) {
					$url .= '&filter=' . $this->request->get['filter'];
				}

				if (isset($this->request->get['sort'])) {
					$url .= '&sort=' . $this->request->get['sort'];
				}

				if (isset($this->request->get['order'])) {
					$url .= '&order=' . $this->request->get['order'];
				}

				if (isset($this->request->get['page'])) {
					$url .= '&page=' . $this->request->get['page'];
				}

				if (isset($this->request->get['limit'])) {
					$url .= '&limit=' . $this->request->get['limit'];
				}

				// Set the last service breadcrumb
				$data['breadcrumbs'][] = array(
					'text' => $service_info['name'],
					'href' => $this->url->link('product/service', 'path=' . $this->request->get['path'])
				);

				$data['text_error_access'] = $this->language->get('text_error_access');

				$data['button_continue'] = $this->language->get('button_continue');

				$data['continue'] = $this->url->link('common/home');

				$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

				//$data['column_left'] = $this->load->controller('common/column_left');
				//$data['column_right'] = $this->load->controller('common/column_right');

				$data['column_left'] = '';
				$data['column_right'] = '';
				$data['content_top'] = $this->load->controller('common/content_top');
				$data['content_bottom'] = $this->load->controller('common/content_bottom');
				$data['footer'] = $this->load->controller('common/footer');
				$data['header'] = $this->load->controller('common/header');

				if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/no_access.tpl')) {
					$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/no_access.tpl', $data));
				} else {
					$this->response->setOutput($this->load->view('default/template/error/no_access.tpl', $data));
				}

			}

		} else {
			$url = ''; if( ! empty( $this->request->get['mfp'] ) ) { $url .= '&mfp=' . $this->request->get['mfp']; }

			if (isset($this->request->get['path'])) {
				$url .= '&path=' . $this->request->get['path'];
			}

			if (isset($this->request->get['filter'])) {
				$url .= '&filter=' . $this->request->get['filter'];
			}

			if (isset($this->request->get['sort'])) {
				$url .= '&sort=' . $this->request->get['sort'];
			}

			if (isset($this->request->get['order'])) {
				$url .= '&order=' . $this->request->get['order'];
			}

			if (isset($this->request->get['page'])) {
				$url .= '&page=' . $this->request->get['page'];
			}

			if (isset($this->request->get['limit'])) {
				$url .= '&limit=' . $this->request->get['limit'];
			}

			$data['breadcrumbs'][] = array(
				'text' => $this->language->get('text_error'),
				'href' => $this->url->link('product/service', $url)
			);

			$this->document->setTitle($this->language->get('text_error'));

			$data['heading_title'] = $this->language->get('text_error');

			$data['text_error'] = $this->language->get('text_error');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			$this->response->addHeader($this->request->server['SERVER_PROTOCOL'] . ' 404 Not Found');

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {

				if( isset( $this->request->get['mfilterAjax'] ) ) {
					$settings	= $this->config->get('mega_filter_settings');
					$baseTypes	= array( 'stock_status', 'manufacturers', 'rating', 'attributes', 'price', 'options', 'filters' );

					if( isset( $this->request->get['mfilterBTypes'] ) ) {
						$baseTypes = explode( ',', $this->request->get['mfilterBTypes'] );
					}

					if( ! empty( $settings['calculate_number_of_products'] ) || in_array( 'services:tree', $baseTypes ) ) {
						if( empty( $settings['calculate_number_of_products'] ) ) {
							$baseTypes = array( 'services:tree' );
						}

						$this->load->model( 'module/mega_filter' );

						$idx = 0;

						if( isset( $this->request->get['mfilterIdx'] ) )
							$idx = (int) $this->request->get['mfilterIdx'];

						$data['mfilter_json'] = json_encode( MegaFilterCore::newInstance( $this, NULL )->getJsonData($baseTypes, $idx) );
					}

					$data['header'] = $data['column_left'] = $data['column_right'] = $data['content_top'] = $data['content_bottom'] = $data['footer'] = '';
				}

				if( ! empty( $data['breadcrumbs'] ) && ! empty( $this->request->get['mfp'] ) ) {
					foreach( $data['breadcrumbs'] as $mfK => $mfBreadcrumb ) {
						$mfReplace = preg_replace( '/path\[[^\]]+\],?/', '', $this->request->get['mfp'] );
						$mfFind = ( mb_strpos( $mfBreadcrumb['href'], '?mfp=', 0, 'utf-8' ) !== false ? '?mfp=' : '&mfp=' );

						$data['breadcrumbs'][$mfK]['href'] = str_replace(array(
							$mfFind . $this->request->get['mfp'],
							'&amp;mfp=' . $this->request->get['mfp'],
							$mfFind . urlencode( $this->request->get['mfp'] ),
							'&amp;mfp=' . urlencode( $this->request->get['mfp'] )
						), $mfReplace ? $mfFind . $mfReplace : '', $mfBreadcrumb['href'] );
					}
				}

				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {

				if( isset( $this->request->get['mfilterAjax'] ) ) {
					$settings	= $this->config->get('mega_filter_settings');
					$baseTypes	= array( 'stock_status', 'manufacturers', 'rating', 'attributes', 'price', 'options', 'filters' );

					if( isset( $this->request->get['mfilterBTypes'] ) ) {
						$baseTypes = explode( ',', $this->request->get['mfilterBTypes'] );
					}

					if( ! empty( $settings['calculate_number_of_products'] ) || in_array( 'services:tree', $baseTypes ) ) {
						if( empty( $settings['calculate_number_of_products'] ) ) {
							$baseTypes = array( 'services:tree' );
						}

						$this->load->model( 'module/mega_filter' );

						$idx = 0;

						if( isset( $this->request->get['mfilterIdx'] ) )
							$idx = (int) $this->request->get['mfilterIdx'];

						$data['mfilter_json'] = json_encode( MegaFilterCore::newInstance( $this, NULL )->getJsonData($baseTypes, $idx) );
					}

					$data['header'] = $data['column_left'] = $data['column_right'] = $data['content_top'] = $data['content_bottom'] = $data['footer'] = '';
				}

				if( ! empty( $data['breadcrumbs'] ) && ! empty( $this->request->get['mfp'] ) ) {
					foreach( $data['breadcrumbs'] as $mfK => $mfBreadcrumb ) {
						$mfReplace = preg_replace( '/path\[[^\]]+\],?/', '', $this->request->get['mfp'] );
						$mfFind = ( mb_strpos( $mfBreadcrumb['href'], '?mfp=', 0, 'utf-8' ) !== false ? '?mfp=' : '&mfp=' );

						$data['breadcrumbs'][$mfK]['href'] = str_replace(array(
							$mfFind . $this->request->get['mfp'],
							'&amp;mfp=' . $this->request->get['mfp'],
							$mfFind . urlencode( $this->request->get['mfp'] ),
							'&amp;mfp=' . urlencode( $this->request->get['mfp'] )
						), $mfReplace ? $mfFind . $mfReplace : '', $mfBreadcrumb['href'] );
					}
				}

				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}
}