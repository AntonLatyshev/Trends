<?php
class ControllerModuleBanner extends Controller {
	public function index($setting) {
		static $module = 0;

		$this->load->language('module/banner');

		// Ленги
		$data['text_buy'] = $this->language->get('text_buy');
		$data['text_our_service'] = $this->language->get('text_our_service');
		$data['text_go'] = $this->language->get('text_go');
		$data['text_all_service'] = $this->language->get('text_all_service');
		$data['text_our_partners'] = $this->language->get('text_our_partners');
		$data['text_partners_best'] = $this->language->get('text_partners_best');
		$data['text_more'] = $this->language->get('text_more');
		$data['text_latest_art'] = $this->language->get('text_latest_art');
		$data['text_be_informed'] = $this->language->get('text_be_informed');
		$data['text_all_article'] = $this->language->get('text_all_article');
		$data['text_top_product'] = $this->language->get('text_top_product');
		// for about page
		$data['text_why_we'] = $this->language->get('text_why_we');
		$data['text_our_team'] = $this->language->get('text_our_team');
		$data['text_gallery'] = $this->language->get('text_gallery');
		$data['text_brands'] = $this->language->get('text_brands');

		$this->load->model('design/banner');
		$this->load->model('tool/image');

//		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.carousel.css');
//		$this->document->addStyle('catalog/view/javascript/jquery/owl-carousel/owl.transitions.css');
//		$this->document->addScript('catalog/view/javascript/jquery/owl-carousel/owl.carousel.min.js');

		$data['banners'] = array();

		$results = $this->model_design_banner->getBanner($setting['banner_id']);

		foreach ($results as $result) {

			// Seo url
			$link = $result['link'];

			$string_url = array(
				0 => "product/category&amp;path",
				1 => "product/product&amp;product_id",
				2 => "information/information&amp;information_id"
			);

			$routeUrl = explode('=', $result['link']);

			foreach ($string_url as $key => $value) {

				if ( in_array($value, $routeUrl) ) {
					switch ($key) {
						case 0:
							if (!empty($routeUrl[2])) {
								$link = $this->url->link('product/category', 'path=' . $routeUrl[2]);
							}
							break;
						case 1:
							if (!empty($routeUrl[2])) {
								$link = $this->url->link('product/product', 'product_id=' . $routeUrl[2]);
							}
							break;
						case 2:
							if (!empty($routeUrl[2])) {
								$link = $this->url->link('information/information', 'information_id=' . $routeUrl[2]);
							}
							break;
					}
				}

			}

			$width = $setting['width'];
			if ($result['width']) {
				$width = $result['width'];
			}

			$height = $setting['height'];
			if ($result['height']) {
				$height = $result['height'];
			}

			if ($result['image']) {
				$image = $this->model_tool_image->resize($result['image'], $width, $height);
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', $width, $height);
			}

			$width_add = 36;
			if ($result['width_add']) {
				$width_add = $result['width_add'];
			}

			$height_add = 44;
			if ($result['height_add']) {
				$height_add = $result['height_add'];
			}

			if ($result['image_add']) {
				$image_add = $this->model_tool_image->resize($result['image_add'], $width_add, $height_add);
			} else {
				$image_add = '';
			}

//			if (is_file(DIR_IMAGE . $result['image'])) {
				$data['banners'][] = array(
				'title' => $result['title'],
					'text'  => $result['text'],
					'additional'  => $result['additional'],
					'image' => $image,
					'width' => $width,
					'height' => $height,
					'image_add' => $image_add,
					'width_add' => $width_add,
					'height_add' => $height_add,
					'link'  => $link,
//					'image' => $this->model_tool_image->resize($result['image'], $setting['width'], $setting['height'])
				);
//			}
		}

		$data['module'] = $module++;

		$file_tpl = 'banner';
		if ( !empty($setting['name_tpl']) ) {
			$file_tpl = $setting['name_tpl'];
		}

		$data['languagese'] = $this->language->getGroupData();

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/' . $file_tpl . '.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/' . $file_tpl . '.tpl', $data);
		} else {
			echo 213;
			return $this->load->view('default/template/module/' . $file_tpl . '.tpl', $data);
		}
	}
}