<?php

class ControllerProductSproduct extends Controller
{
    private $error = array();

    protected function getPath($parent_id, $current_path = '')
    {

        $this->load->model('catalog/service');

        $service_info = $this->model_catalog_service->getService($parent_id);

        if ($service_info) {
            if (!$current_path) {
                $new_path = $service_info['service_id'];
            } else {
                $new_path = $service_info['service_id'] . '_' . $current_path;
            }

            $path = $this->getPath($service_info['parent_id'], $new_path);

            if ($path) {
                return $path;
            } else {
                return $new_path;
            }
        }
    }

    protected function getTrueUrl($sproduct_id)
    {
        $services = $this->model_catalog_sproduct->getServicesBySproductId($sproduct_id);

        if ($services) {

            foreach ($services as $service) {
                $path_true = $this->getPath($service['service_id']);
                $service_info = $this->model_catalog_service->getService($service['service_id']);

                if ($path_true) {
                    $cat_path = $path_true;
                } else {
                    $cat_path = $service_info['service_id'];
                }

                if ($service_info) {
                    $path_true = '';

                    foreach (explode('_', $cat_path) as $path_true_id) {

                        if (!$path_true) {
                            $path_true = $path_true_id;
                        } else {
                            $path_true .= '_' . $path_true_id;
                        }

                        $service_info = $this->model_catalog_service->getService($path_true_id);

                        if ($service_info) {
                            $data['breadcrumbs'][] = array(
                                'text' => $service_info['name'],
                                'href' => $this->url->link('product/service', '&path=' . $path_true),
                                'separator' => $this->language->get('text_separator')
                            );
                        }
                    }
                    break;
                }

            }

            return $path_true;

        }

    }

    public function index()
    {
        $this->load->language('product/sproduct');

        $data['breadcrumbs'] = array();

        $data['breadcrumbs'][] = array(
            'text' => $this->language->get('text_home'),
            'href' => $this->url->link('common/home')
        );

        // Insert model
        $this->load->model('catalog/manufacturer');

        $this->load->model('catalog/service');

        $this->load->model('catalog/sproduct');

        $data['isXhr'] = $this->request->isXhr();

        $path = '';

        if (isset($this->request->get['path'])) {

            $parts = explode('_', (string)$this->request->get['path']);
            $k = count($parts) - 1;
            $service_id = $parts[$k];

            foreach ($parts as $path_id) {
                if (!$path) {
                    $path = $path_id;
                } else {
                    $path .= '_' . $path_id;
                }

                $service_info = $this->model_catalog_service->getService($path_id);

                if ($service_info) {
                    $data['breadcrumbs'][] = array(
                        'text' => $service_info['name'],
                        'href' => $this->url->link('product/service', 'path=' . $path)
                    );
                }
            }

            // Set the last service breadcrumb
            $service_info = $this->model_catalog_service->getService($service_id);

            if ($service_info) {
                $url = '';

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

//				$data['breadcrumbs'][] = array(
//					'text' => $service_info['name'],
//					'href' => $this->url->link('product/service', 'path=' . $this->request->get['path'] . $url)
//				);
            }
        }

        // Fixed SEO url
        $path_true = $this->getTrueUrl((int)$this->request->get['sproduct_id']);
        

        // для товаров-услуг в категории Ремонт Iphone отличная структура Хедера, для этой категории установим флаг
        $services_id = explode('_', $path_true);
        $service_id = array_pop($services_id);

        if ($service_id == 14) {
            $service_all = true;
        } else {
            $service_all = false;
        }
        
        $data['service_all'] = $service_all;
        
        // товары-услуги из этой же категории
        $data['this_service_sproducts'] = array();

        $filter_data = array(
            'filter_service_id'  => $service_id,
        );

        $results = $this->model_catalog_sproduct->getSproducts($filter_data);
        
        foreach ($results as $result) {
            if ($this->request->get['sproduct_id'] == $result['sproduct_id']) {
                $active = true;
            } else {
                $active = false;
            }

            $data['this_service_sproducts'][] = array(
                'sproduct_id' => $result['sproduct_id'],
                'name'        => $result['name'],
                'href'        => $this->url->link('product/sproduct', 'path=' . $path_true . '&sproduct_id=' . $result['sproduct_id'] . $url),
                'active'      => $active,
            );
        }
        

        if (array_key_exists('search', $this->request->get)) {

        } elseif (array_key_exists('manufacturer_id', $this->request->get)) {

        } elseif (array_key_exists('path', $this->request->get)) {
            if (!empty($path_true)) {
                if ($path != $path_true) {
                    $this->response->redirect($this->url->link('product/sproduct', '&path=' . $path_true . '&sproduct_id=' . $this->request->get['sproduct_id']), '301');
                }
            }
        } else {
            if (!empty($path_true)) {
                if ($path != $path_true) {
                    $this->response->redirect($this->url->link('product/sproduct', '&path=' . $path_true . '&sproduct_id=' . $this->request->get['sproduct_id']), '301');
                }
            }
        }

        if (isset($this->request->get['manufacturer_id'])) {
            $data['breadcrumbs'][] = array(
                'text' => $this->language->get('text_brand'),
                'href' => $this->url->link('product/manufacturer')
            );

            $url = '';

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

            $manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($this->request->get['manufacturer_id']);

            if ($manufacturer_info) {
                $data['breadcrumbs'][] = array(
                    'text' => $manufacturer_info['name'],
                    'href' => $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $this->request->get['manufacturer_id'] . $url)
                );
            }
        }

        if (isset($this->request->get['search']) || isset($this->request->get['tag'])) {
            $url = '';

            if (isset($this->request->get['search'])) {
                $url .= '&search=' . $this->request->get['search'];
            }

            if (isset($this->request->get['tag'])) {
                $url .= '&tag=' . $this->request->get['tag'];
            }

            if (isset($this->request->get['description'])) {
                $url .= '&description=' . $this->request->get['description'];
            }

            if (isset($this->request->get['service_id'])) {
                $url .= '&service_id=' . $this->request->get['service_id'];
            }

            if (isset($this->request->get['sub_service'])) {
                $url .= '&sub_service=' . $this->request->get['sub_service'];
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
                'text' => $this->language->get('text_search'),
                'href' => $this->url->link('product/search', $url)
            );
        }

        if (isset($this->request->get['sproduct_id'])) {
            $sproduct_id = (int)$this->request->get['sproduct_id'];
        } else {
            $sproduct_id = 0;
        }

        $sproduct_info = $this->model_catalog_sproduct->getSproduct($sproduct_id);

        /*code start*/
        if ((strtotime(date('Y-m-d')) >= strtotime($sproduct_info['promo_date_start'])) && (strtotime(date('Y-m-d')) <= strtotime($sproduct_info['promo_date_end'])) || (($sproduct_info['promo_date_start'] == '0000-00-00') && ($sproduct_info['promo_date_end'] == '0000-00-00'))) {
            $promo_on = TRUE;
        } else {
            $promo_on = FALSE;
        }
        /*code end*/

        if ($sproduct_info) {
            $url = '';

            if (isset($this->request->get['path'])) {
                $url .= '&path=' . $this->request->get['path'];
            }

            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }

            if (isset($this->request->get['manufacturer_id'])) {
                $url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
            }

            if (isset($this->request->get['search'])) {
                $url .= '&search=' . $this->request->get['search'];
            }

            if (isset($this->request->get['tag'])) {
                $url .= '&tag=' . $this->request->get['tag'];
            }

            if (isset($this->request->get['description'])) {
                $url .= '&description=' . $this->request->get['description'];
            }

            if (isset($this->request->get['service_id'])) {
                $url .= '&service_id=' . $this->request->get['service_id'];
            }

            if (isset($this->request->get['sub_service'])) {
                $url .= '&sub_service=' . $this->request->get['sub_service'];
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
                'text' => $sproduct_info['name'],
                'href' => $this->url->link('product/sproduct', $url . '&sproduct_id=' . $this->request->get['sproduct_id'])
            );

            $this->document->setTitle($sproduct_info['meta_title']);
            $this->document->setDescription($sproduct_info['meta_description']);
            $this->document->setKeywords($sproduct_info['meta_keyword']);
            $this->document->addLink($this->url->link('product/sproduct', 'path=' . $path_true . '&sproduct_id=' . $this->request->get['sproduct_id']), 'canonical');

            // Blueimp style
            $this->document->addStyle('catalog/view/theme/default/stylesheet/blueimp/blueimp-gallery.css');
            $this->document->addStyle('catalog/view/theme/default/stylesheet/blueimp/blueimp-gallery-indicator.css');

            // Blueimp script
            $this->document->addScript('catalog/view/javascript/blueimp/blueimp-gallery.js');
            $this->document->addScript('catalog/view/javascript/blueimp/blueimp-gallery-fullscreen.js');
            $this->document->addScript('catalog/view/javascript/blueimp/blueimp-gallery-indicator.js');
            $this->document->addScript('catalog/view/javascript/blueimp/jquery.blueimp-gallery.js');

            $data['heading_title'] = $sproduct_info['name'];

            $data['text_select'] = $this->language->get('text_select');
            $data['text_manufacturer'] = $this->language->get('text_manufacturer');
            $data['text_model'] = $this->language->get('text_model');
            $data['text_reward'] = $this->language->get('text_reward');
            $data['text_points'] = $this->language->get('text_points');
            $data['text_stock'] = $this->language->get('text_stock');
            $data['text_discount'] = $this->language->get('text_discount');
            $data['text_tax'] = $this->language->get('text_tax');
            $data['text_option'] = $this->language->get('text_option');
            $data['text_minimum'] = sprintf($this->language->get('text_minimum'), $sproduct_info['minimum']);
            $data['text_write'] = $this->language->get('text_write');
            $data['text_login'] = sprintf($this->language->get('text_login'), $this->url->link('account/login', '', 'SSL'), $this->url->link('account/register', '', 'SSL'));
            $data['text_note'] = $this->language->get('text_note');
            $data['text_tags'] = $this->language->get('text_tags');
            $data['text_related'] = $this->language->get('text_related');
            $data['text_loading'] = $this->language->get('text_loading');

            $data['entry_qty'] = $this->language->get('entry_qty');
            $data['entry_name'] = $this->language->get('entry_name');
            $data['entry_review'] = $this->language->get('entry_review');
            $data['entry_rating'] = $this->language->get('entry_rating');
            $data['entry_good'] = $this->language->get('entry_good');
            $data['entry_bad'] = $this->language->get('entry_bad');

            $data['button_cart'] = $this->language->get('button_cart');
            $data['button_wishlist'] = $this->language->get('button_wishlist');
            $data['button_compare'] = $this->language->get('button_compare');
            $data['button_upload'] = $this->language->get('button_upload');
            $data['button_continue'] = $this->language->get('button_continue');

            $this->load->model('catalog/review');

            $data['tab_description'] = $this->language->get('tab_description');
            $data['tab_attribute'] = $this->language->get('tab_attribute');
            $data['tab_review'] = sprintf($this->language->get('tab_review'), 'reviews');

            $data['sproduct_id'] = (int)$this->request->get['sproduct_id'];
            $data['manufacturer'] = $sproduct_info['manufacturer'];
            $data['manufacturers'] = $this->url->link('product/manufacturer/info', 'manufacturer_id=' . $sproduct_info['manufacturer_id']);
            $data['model'] = $sproduct_info['model'];
            $data['reward'] = $sproduct_info['reward'];
            $data['points'] = $sproduct_info['points'];

            $data['action_nf'] = $this->url->link('product/sproduct/processing_form_nf');

            /* In cart */
//            $cart_sproducts = $this->cart->getSproducts();
            $cart_ids = array();
//            if(is_array($cart_sproducts) && !empty($cart_sproducts)) {
//                foreach ($cart_sproducts as $cart_sproduct) {
//                    $cart_ids[] = $cart_sproduct['sproduct_id'];
//                }
//                array_unique($cart_ids);
//            }

            $wish_list = (!empty($this->session->data['wishlist'])) ? $this->session->data['wishlist'] : array();

            $data['button_cart']       = (in_array($sproduct_info['sproduct_id'], $cart_ids)) ? $this->language->get('button_in_cart') : $this->language->get('button_cart');
            $data['in_cart']           = (in_array($sproduct_info['sproduct_id'], $cart_ids)) ? true : false;
            $data['button_wishlist']   = (in_array($sproduct_info['sproduct_id'], $wish_list)) ? $this->language->get('button_in_wishlist') : 'Добавить в желаемое';
            $data['in_wishlist']       = (in_array($sproduct_info['sproduct_id'], $wish_list)) ? true : false;

            if ($sproduct_info['quantity'] <= 0) {
                $data['stock'] = $sproduct_info['stock_status'];
            } elseif ($this->config->get('config_stock_display')) {
                $data['stock'] = $sproduct_info['quantity'];
            } else {
                $data['stock'] = $this->language->get('text_instock');
            }

            $this->load->model('tool/image');

            if ($sproduct_info['image']) {
                $data['popup'] = $this->model_tool_image->resize($sproduct_info['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height'));
            } else {
                $data['popup'] = '';
            }

            if ($sproduct_info['image']) {
                $data['thumb'] = $this->model_tool_image->resize($sproduct_info['image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height'));
            } else {
                $data['thumb'] = '';
            }

            if ($sproduct_info['image_bg']) {
                $data['thumb_bg'] = 'image/' . $sproduct_info['image_bg'];
            } else {
                $data['thumb_bg'] = '';
            }

            if ($sproduct_info['image_nf']) {
                $data['thumb_nf'] = $this->model_tool_image->resize($sproduct_info['image_nf'], 341, 402);
            } else {
                $data['thumb_nf'] = '';
            }

            if ($sproduct_info['image_add']) {
                $data['thumb_add'] = $this->model_tool_image->resize($sproduct_info['image_add'], 437, 508);
            } else {
                $data['thumb_add'] = '';
            }

            if ($sproduct_info['image_trigger']) {
                $data['thumb_trigger'] = $this->model_tool_image->resize($sproduct_info['image_trigger'], 328, 579);
            } else {
                $data['thumb_trigger'] = '';
            }

            $data['images'] = array();

            $results = $this->model_catalog_sproduct->getSproductImages($this->request->get['sproduct_id']);

            foreach ($results as $result) {
                $image_description = $result['sproduct_image_description'][$this->config->get('config_language_id')]['text'];

                $data['images'][] = array(
                    'popup' => $this->model_tool_image->resize($result['image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
                    'thumb' => $this->model_tool_image->resize($result['image'], 768, 435),
                    'image_description' => $image_description,
                );
            }

            // слайдер услуг в Табах
            $sproduct_tab_services = array();

            $results = $this->model_catalog_sproduct->getSproductsTabServices($this->request->get['sproduct_id']);

            foreach ($results as $result) {
                $tab = $result['sproduct_tab_service_description'][$this->config->get('config_language_id')]['additional'];
                $sproduct_tab_services[$tab][] = array(
                    'thumb' => $this->model_tool_image->resize($result['image'], 276, 335),
                    'price_min' => (float)$result['price_min'],
                    'price_max' => (float)$result['price_max'],
                    'sort_order' => $result['sort_order'],
                    'name' => $result['sproduct_tab_service_description'][$this->config->get('config_language_id')]['name'],
                    'description' => $result['sproduct_tab_service_description'][$this->config->get('config_language_id')]['description'],
                    'tab' => $result['sproduct_tab_service_description'][$this->config->get('config_language_id')]['additional'],
                );
            }

            $data['sproduct_tab_services'] = $sproduct_tab_services;
            // end слайдер услуг в Табах ---------------------------

            // блок Выберите услугу
            $sproduct_services = array();

            $results = $this->model_catalog_sproduct->getSproductsServices($this->request->get['sproduct_id']);

            foreach ($results as $result) {
                $sproduct_services[] = array(
                    'thumb' => $this->model_tool_image->resize($result['image'], 471, 353),
                    'price_min' => (float)$result['price_min'],
                    'price_max' => (float)$result['price_max'],
                    'sort_order' => $result['sort_order'],
                    'name' => $result['sproduct_service_description'][$this->config->get('config_language_id')]['name'],
                    'description' => $result['sproduct_service_description'][$this->config->get('config_language_id')]['description'],
                );
            }

            $data['sproduct_services'] = $sproduct_services;
            // end блок Выберите услугу-----------------------------
            

            if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
                $data['price'] = $this->currency->format($this->tax->calculate($sproduct_info['price'], $sproduct_info['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $data['price'] = false;
            }

            if ((float)$sproduct_info['special']) {
                $data['special'] = $this->currency->format($this->tax->calculate($sproduct_info['special'], $sproduct_info['tax_class_id'], $this->config->get('config_tax')));
            } else {
                $data['special'] = false;
            }

            if ($this->config->get('config_tax')) {
                $data['tax'] = $this->currency->format((float)$sproduct_info['special'] ? $sproduct_info['special'] : $sproduct_info['price']);
            } else {
                $data['tax'] = false;
            }

            $discounts = $this->model_catalog_sproduct->getSproductDiscounts($this->request->get['sproduct_id']);

            $data['discounts'] = array();

            foreach ($discounts as $discount) {
                $data['discounts'][] = array(
                    'quantity' => $discount['quantity'],
                    'price' => $this->currency->format($this->tax->calculate($discount['price'], $sproduct_info['tax_class_id'], $this->config->get('config_tax')))
                );
            }

            $data['price_value'] = $sproduct_info['price'];
            $data['special_value'] = $sproduct_info['special'];
            $data['tax_value'] = (float)$sproduct_info['special'] ? $sproduct_info['special'] : $sproduct_info['price'];

            $var_currency = array();
            $var_currency['value'] = $this->currency->getValue();
            $var_currency['symbol_left'] = $this->currency->getSymbolLeft();
            $var_currency['symbol_right'] = $this->currency->getSymbolRight();
            $var_currency['decimals'] = $this->currency->getDecimalPlace();
            $var_currency['decimal_point'] = $this->language->get('decimal_point');
            $var_currency['thousand_point'] = $this->language->get('thousand_point');
            $data['currency'] = $var_currency;

            $data['dicounts_unf'] = $discounts;

            $data['tax_class_id'] = $sproduct_info['tax_class_id'];
            $data['tax_rates'] = $this->tax->getRates(0, $sproduct_info['tax_class_id']);

            $data['options'] = array();

            foreach ($this->model_catalog_sproduct->getSproductOptions($this->request->get['sproduct_id']) as $option) {
                // Skip Option if disabled
                if (isset($option['sproduct_page']) && $option['sproduct_page'] == 0) continue;

                $sproduct_option_value_data = array();
                foreach ($option['sproduct_option_value'] as $option_value) {
                    if (!$option_value['subtract'] || ($option_value['quantity'] > 0)) {
                        if ((($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) && (float)$option_value['price']) {
                            $price = $this->currency->format($this->tax->calculate($option_value['price'], $sproduct_info['tax_class_id'], $this->config->get('config_tax') ? 'P' : false));
                        } else {
                            $price = false;
                        }

                        $sproduct_option_value_data[] = array(
                            'price_value' => $option_value['price'],
                            'points_value' => intval($option_value['points_prefix'] . $option_value['points']),
                            'sproduct_option_value_id' => $option_value['sproduct_option_value_id'],
                            'option_value_id' => $option_value['option_value_id'],
                            'name' => $option_value['name'],
                            'image' => $this->model_tool_image->resize($option_value['image'], 50, 50),
                            'sproduct_option_image' => $this->model_tool_image->resize($option_value['sproduct_option_image'], $this->config->get('config_image_thumb_width'), $this->config->get('config_image_thumb_height')),
                            'sproduct_option_image_popup' => $this->model_tool_image->resize($option_value['sproduct_option_image'], $this->config->get('config_image_popup_width'), $this->config->get('config_image_popup_height')),
                            'price' => $price,
                            'price_prefix' => $option_value['price_prefix']
                        );
                    }
                }

                $data['options'][] = array(
                    'sproduct_option_id' => $option['sproduct_option_id'],
                    'sproduct_option_value' => $sproduct_option_value_data,
                    'option_id' => $option['option_id'],
                    'name' => $option['name'],
                    'sproduct_page' => isset($option['sproduct_page']) ? ((int)$option['sproduct_page']) : 1,
                    'type' => $option['type'],
                    'style' => $option['style'],
                    'value' => $option['value'],
                    'required' => $option['required']
                );
            }

            if ($sproduct_info['minimum']) {
                $data['minimum'] = $sproduct_info['minimum'];
            } else {
                $data['minimum'] = 1;
            }

            /*code start*/
            $promo_top_right = $this->model_catalog_sproduct->getPromo($sproduct_info['sproduct_id'], $sproduct_info['promo_top_right']);

            if (!empty($promo_top_right['promo_text']) && $promo_on) {
                if (!empty($promo_top_right['promo_link'])) {
                    $promo_tags = '<span>Notes: </span><span style="color:red"><a href="' . $promo_top_right['promo_link'] . '" Title="Click Me">' . $promo_top_right['promo_text'] . '</a></span>';
                    if (!empty($promo_top_right['pimage'])) {
                        $promo_tags = $promo_tags . '<br /><tr><td colspan="2"><a href="' . $promo_top_right['promo_link'] . '" Title="Click Me"><img src="image/' . $promo_top_right['pimage'] . '" /></a></td></tr>';
                    }
                } else {
                    $promo_tags = '<span>Notes: </span><span style="color: red; font-weight:bold;">' . $promo_top_right['promo_text'] . '</span>';
                    if (!empty($promo_top_right['pimage'])) {
                        $promo_tags = $promo_tags . '<br /><tr><td colspan="2"><img src="image/' . $promo_top_right['pimage'] . '" /></td></tr>';
                    }
                }
            } else {
                $promo_tags = '';
            }

            if (!empty($promo_top_right['promo_text']) && $promo_on) {
                $promo_tag_sproduct_top_right = '<div class="promotags" style="width:100px;height:100px;top:0px;right:0px;background: url(\'' . 'image/' . $promo_top_right['image'] . '\') no-repeat;background-position:top right"></div>';
            } else {
                $promo_tag_sproduct_top_right = '';
            }

            $promo_top_left = $this->model_catalog_sproduct->getPromo($sproduct_info['sproduct_id'], $sproduct_info['promo_top_left']);
            if (!empty($promo_top_left['promo_text']) && $promo_on) {
                $promo_tag_sproduct_top_left = '<div class="promotags" style="width:100px;height:100px;top:0px;left:0px;background: url(\'' . 'image/' . $promo_top_left['image'] . '\') no-repeat;background-position:top left"></div>';
            } else {
                $promo_tag_sproduct_top_left = '';
            }

            $promo_bottom_left = $this->model_catalog_sproduct->getPromo($sproduct_info['sproduct_id'], $sproduct_info['promo_bottom_left']);
            if (!empty($promo_bottom_left['promo_text']) && $promo_on) {
                $promo_tag_sproduct_bottom_left = '<div class="promotags" style="width:100px;height:100px;bottom:0px;left:0px;background: url(\'' . 'image/' . $promo_bottom_left['image'] . '\') no-repeat;background-position:bottom left"></div>';
            } else {
                $promo_tag_sproduct_bottom_left = '';
            }

            $promo_bottom_right = $this->model_catalog_sproduct->getPromo($sproduct_info['sproduct_id'], $sproduct_info['promo_bottom_right']);
            if (!empty($promo_bottom_right['promo_text']) && $promo_on) {
                $promo_tag_sproduct_bottom_right = '<div class="promotags" style="width:100px;height:100px;bottom:0px;right:0px;background: url(\'' . 'image/' . $promo_bottom_right['image'] . '\') no-repeat;background-position:bottom right"></div>';
            } else {
                $promo_tag_sproduct_bottom_right = '';
            }
            /*code end*/

            $data['review_status'] = $this->config->get('config_review_status');

            if ($this->config->get('config_review_guest') || $this->customer->isLogged()) {
                $data['review_guest'] = true;
            } else {
                $data['review_guest'] = false;
            }

            if ($this->customer->isLogged()) {
                $data['customer_name'] = $this->customer->getFirstName() . '&nbsp;' . $this->customer->getLastName();
            } else {
                $data['customer_name'] = '';
            }

            // Start custom_fields
            $custom_language_id = false;

            $this->load->model('localisation/language');

            $languages = $this->model_localisation_language->getLanguages();
            foreach ($languages as $key => $value) {
                if ($key == $this->language->get('code')) {
                    $custom_language_id = $value['language_id'];
                }
            }

            $data['custom_field'] = array();
            if (!empty($sproduct_info['custom_field'])) {
                $custom_fields = json_decode($sproduct_info['custom_field'], true);
                if (!empty($custom_fields[$custom_language_id])) {
                    foreach ($custom_fields[$custom_language_id] as $custom_fields) {
                        $data['custom_field'][$custom_fields['name']] = $custom_fields['value'];
                    }
                }
            }
            // var_dump($data['custom_field']);
            // End custom_fields

            $data['reviews'] = sprintf($this->language->get('text_reviews'), 'reviews');
//            $data['rating'] = (int)$sproduct_info['rating'];
            $data['description'] = html_entity_decode($sproduct_info['description'], ENT_QUOTES, 'UTF-8');
            $data['attribute_groups'] = $this->model_catalog_sproduct->getSproductAttributes($this->request->get['sproduct_id']);

            /*code start*/
            $data['promo_tags'] = $promo_tags;
            $data['promo_tag_sproduct_top_right'] = $promo_tag_sproduct_top_right;
            $data['promo_tag_sproduct_top_left'] = $promo_tag_sproduct_top_left;
            $data['promo_tag_sproduct_bottom_left'] = $promo_tag_sproduct_bottom_left;
            $data['promo_tag_sproduct_bottom_right'] = $promo_tag_sproduct_bottom_right;
            /*code end*/

            $data['sproducts'] = array();

            $results = $this->model_catalog_sproduct->getSproductRelated($this->request->get['sproduct_id']);

            foreach ($results as $result) {
                if ($result['image']) {
                    $image = $this->model_tool_image->resize($result['image'], $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
                } else {
                    $image = $this->model_tool_image->resize('placeholder.png', $this->config->get('config_image_related_width'), $this->config->get('config_image_related_height'));
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

//                if ($this->config->get('config_review_status')) {
//                    $rating = (int)$result['rating'];
//                } else {
//                    $rating = false;
//                }

                $data['sproducts'][] = array(
                    'sproduct_id' => $result['sproduct_id'],
                    'thumb' => $image,
                    'name' => $result['name'],
                    'quantity' => $result['quantity'],
                    'description' => utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $this->config->get('config_sproduct_description_length')) . '..',
                    'price' => $price,
                    'special' => $special,
                    'tax' => $tax,
                    'minimum' => $result['minimum'] > 0 ? $result['minimum'] : 1,
//                    'rating' => $rating,
                    'href' => $this->url->link('product/sproduct', 'sproduct_id=' . $result['sproduct_id'])
                );
            }

            $data['tags'] = array();

            if ($sproduct_info['tag']) {
                $tags = explode(',', $sproduct_info['tag']);

                foreach ($tags as $tag) {
                    $data['tags'][] = array(
                        'tag' => trim($tag),
                        'href' => $this->url->link('product/search', 'tag=' . trim($tag))
                    );
                }
            }

            $data['text_payment_recurring'] = $this->language->get('text_payment_recurring');
            $data['recurrings'] = $this->model_catalog_sproduct->getProfiles($this->request->get['sproduct_id']);

            $this->model_catalog_sproduct->updateViewed($this->request->get['sproduct_id']);

            if ($this->config->get('config_google_captcha_status')) {
                $this->document->addScript('https://www.google.com/recaptcha/api.js');

                $data['site_key'] = $this->config->get('config_google_captcha_public');
            } else {
                $data['site_key'] = '';
            }

            /* layout patch - choose template by path */
            $this->load->model('design/layout');
            if (isset ($this->request->get ['route'])) {
                $route = ( string )$this->request->get ['route'];
            } else {
                $route = 'common/home';
            }
            $layout_template = $this->model_design_layout->getLayoutTemplate($route);

            $isLayoutRoute = true;
            if (!$layout_template) {
                $layout_template = 'sproduct';
                $isLayoutRoute = false;
            }
            // get general layout template
            if (!$isLayoutRoute) {
                $layout_id = $this->model_catalog_sproduct->getSproductLayoutId($this->request->get['sproduct_id']);
                if ($layout_id) {
                    $tmp_layout_template = $this->model_design_layout->getGeneralLayoutTemplate($layout_id);
                    if ($tmp_layout_template)
                        $layout_template = $tmp_layout_template;
                }
            }

            $data['column_left'] = $this->load->controller('common/column_left');
            $data['column_right'] = $this->load->controller('common/column_right');
            $data['content_top'] = $this->load->controller('common/content_top');
            $data['content_bottom'] = $this->load->controller('common/content_bottom');
            $data['footer'] = $this->load->controller('common/footer');
            $data['header'] = $this->load->controller('common/header');
            $data['sproduct_series'] = $this->load->controller('product/series');

            // Группа пользователя
            $customer_group_now = $this->config->get('config_customer_group_id'); //$this->customer->getGroupId()

            // Группа пользоватедля для доступа к категории
            $service_info = $this->model_catalog_sproduct->getServices($sproduct_id);
            if (!empty($service_info)) {
                $service_id_sproduct = $service_info[0]['service_id'];
                $service_info = $this->model_catalog_sproduct->getService($service_id_sproduct);
                $customer_group_access = $service_info['customer_group_id'];

                if ($customer_group_now == $customer_group_access || $customer_group_access == '1') {
                    $data['group_access'] = true;
                } else {
                    $data['group_access'] = false;
                }
            } else {
                $data['group_access'] = true;
            }

            if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/' . $layout_template . '.tpl')) {
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/' . $layout_template . '.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('default/template/product/' . $layout_template . '.tpl', $data));
            }
        } else {
            $url = '';

            if (isset($this->request->get['path'])) {
                $url .= '&path=' . $this->request->get['path'];
            }

            if (isset($this->request->get['filter'])) {
                $url .= '&filter=' . $this->request->get['filter'];
            }

            if (isset($this->request->get['manufacturer_id'])) {
                $url .= '&manufacturer_id=' . $this->request->get['manufacturer_id'];
            }

            if (isset($this->request->get['search'])) {
                $url .= '&search=' . $this->request->get['search'];
            }

            if (isset($this->request->get['tag'])) {
                $url .= '&tag=' . $this->request->get['tag'];
            }

            if (isset($this->request->get['description'])) {
                $url .= '&description=' . $this->request->get['description'];
            }

            if (isset($this->request->get['service_id'])) {
                $url .= '&service_id=' . $this->request->get['service_id'];
            }

            if (isset($this->request->get['sub_service'])) {
                $url .= '&sub_service=' . $this->request->get['sub_service'];
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
                'href' => $this->url->link('product/sproduct', $url . '&sproduct_id=' . $sproduct_id)
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
                $this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
            } else {
                $this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
            }
        }
    }

    public function getRecurringDescription()
    {
        $this->language->load('product/sproduct');
        $this->load->model('catalog/sproduct');

        if (isset($this->request->post['sproduct_id'])) {
            $sproduct_id = $this->request->post['sproduct_id'];
        } else {
            $sproduct_id = 0;
        }

        if (isset($this->request->post['recurring_id'])) {
            $recurring_id = $this->request->post['recurring_id'];
        } else {
            $recurring_id = 0;
        }

        if (isset($this->request->post['quantity'])) {
            $quantity = $this->request->post['quantity'];
        } else {
            $quantity = 1;
        }

        $sproduct_info = $this->model_catalog_sproduct->getSproduct($sproduct_id);
        $recurring_info = $this->model_catalog_sproduct->getProfile($sproduct_id, $recurring_id);

        $json = array();

        if ($sproduct_info && $recurring_info) {
            if (!$json) {
                $frequencies = array(
                    'day' => $this->language->get('text_day'),
                    'week' => $this->language->get('text_week'),
                    'semi_month' => $this->language->get('text_semi_month'),
                    'month' => $this->language->get('text_month'),
                    'year' => $this->language->get('text_year'),
                );

                if ($recurring_info['trial_status'] == 1) {
                    $price = $this->currency->format($this->tax->calculate($recurring_info['trial_price'] * $quantity, $sproduct_info['tax_class_id'], $this->config->get('config_tax')));
                    $trial_text = sprintf($this->language->get('text_trial_description'), $price, $recurring_info['trial_cycle'], $frequencies[$recurring_info['trial_frequency']], $recurring_info['trial_duration']) . ' ';
                } else {
                    $trial_text = '';
                }

                $price = $this->currency->format($this->tax->calculate($recurring_info['price'] * $quantity, $sproduct_info['tax_class_id'], $this->config->get('config_tax')));

                if ($recurring_info['duration']) {
                    $text = $trial_text . sprintf($this->language->get('text_payment_description'), $price, $recurring_info['cycle'], $frequencies[$recurring_info['frequency']], $recurring_info['duration']);
                } else {
                    $text = $trial_text . sprintf($this->language->get('text_payment_cancel'), $price, $recurring_info['cycle'], $frequencies[$recurring_info['frequency']], $recurring_info['duration']);
                }

                $json['success'] = $text;
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    public function processing_form() {
        $this->load->language('product/sproduct');

        $json = array();

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()) {

            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

            $mail->setTo($this->config->get('config_email'));
            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender(html_entity_decode($this->request->post['name'], ENT_QUOTES, 'UTF-8'));
            $mail->setSubject(html_entity_decode(sprintf($this->language->get('entry_subject'), $this->request->post['name']), ENT_QUOTES, 'UTF-8'));
            $mail->setText(strip_tags(html_entity_decode($this->request->post['page'] . "\n" . $this->request->post['title'] . "\n" . $this->request->post['subtitle'] . "\n" . $this->language->get('entry_name') . ": " . $this->request->post['name'] . "\n" . $this->language->get('entry_phone') . ": " . $this->request->post['phone'] . "\n" . $this->language->get('entry_comment') . ": " . $this->request->post['comment'] . "\n", ENT_QUOTES, 'UTF-8')));
            $mail->send();

            $json['success'] = $this->language->get('text_success');
        }

        $json['error'] = '';

        if (isset($this->error['name'])) {
            $json['error']['error_name'] = $this->error['name'];
        }

        if (isset($this->error['phone'])) {
            $json['error']['error_phone'] = $this->error['phone'];
        }

        if (isset($this->error['comment'])) {
            $json['error']['error_comment'] = $this->error['comment'];
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    protected function validate() {
        if ( preg_match('/[0-9()]/', $this->request->post['name']) ) {
            $this->error['name'] = $this->language->get('error_name_number');
        }

        if ((utf8_strlen($this->request->post['name']) < 3) || (utf8_strlen($this->request->post['name']) > 32)) {
            $this->error['name'] = $this->language->get('error_name');
        }

        if (!preg_match('/^[\d\s()-]+$/', $this->request->post['phone'])) {
            $this->error['phone'] = $this->language->get('error_phone');
        }

        if ((utf8_strlen($this->request->post['comment']) < 10) || (utf8_strlen($this->request->post['comment']) > 3000)) {
            $this->error['comment'] = $this->language->get('error_comment');
        }

        return !$this->error;
    }
    
    public function processing_form_nf() {
        $this->load->language('product/sproduct');

        $json = array();

        if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate_nf()) {

            $mail = new Mail();
            $mail->protocol = $this->config->get('config_mail_protocol');
            $mail->parameter = $this->config->get('config_mail_parameter');
            $mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
            $mail->smtp_username = $this->config->get('config_mail_smtp_username');
            $mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
            $mail->smtp_port = $this->config->get('config_mail_smtp_port');
            $mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

            $mail->setTo($this->config->get('config_email'));
            $mail->setFrom($this->config->get('config_email'));
            $mail->setSender('not found service');
            $mail->setSubject($this->language->get('entry_subject_nf'));
            $mail->setText(strip_tags(html_entity_decode($this->request->post['title_nf'] . "\n" . $this->request->post['subtitle_nf'] . "\n" . $this->language->get('entry_phone') . ": " . $this->request->post['phone'] . "\n" . $this->language->get('entry_comment_nf') . ": " . $this->request->post['comment'] . "\n", ENT_QUOTES, 'UTF-8')));
            $mail->send();

            $json['success'] = $this->language->get('text_success');
        }

        $json['error'] = '';

        if (isset($this->error['phone'])) {
            $json['error']['error_phone'] = $this->error['phone'];
        }

        if (isset($this->error['comment'])) {
            $json['error']['error_comment'] = $this->error['comment'];
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }

    protected function validate_nf() {
        if (!preg_match('/^[\d\s()-]+$/', $this->request->post['phone'])) {
            $this->error['phone'] = $this->language->get('error_phone');
        }

        if ((utf8_strlen($this->request->post['comment']) < 10) || (utf8_strlen($this->request->post['comment']) > 3000)) {
            $this->error['comment'] = $this->language->get('error_comment_nf');
        }

        return !$this->error;
    }
}
