<?php
class ControllerCommonHome extends Controller {
	public function index() {
		$this->document->setTitle($this->config->get('config_meta_title'));
		$this->document->setDescription($this->config->get('config_meta_description'));
		$this->document->setKeywords($this->config->get('config_meta_keyword'));

		if (isset($this->request->get['route'])) {
			$this->document->addLink(HTTP_SERVER, 'canonical');
		}

		//------------------------------------------------------------------
		// Этот блок не будет использоваться. Переделал формирование главной на макет
		// данные блоки определяются в контроллерах подключаемых модулей (banner, html..)
		
		$this->load->language('common/home');
		
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

		$this->load->model('design/banner');
		$this->load->model('tool/image');

		// Баннер верхний
		$banner_top = $this->model_design_banner->getBanner(7);

		$data['banner_top'] = array();

		foreach ($banner_top as $item){
			$width = 1285;
			if ($item['width']) {
				$width = $item['width'];
			}
			
			$height = 446;
			if ($item['height']) {
				$height = $item['height'];
			}
			
			if ($item['image']) {
				$image = $this->model_tool_image->resize($item['image'], $width, $height);
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', $width, $height);
			}

			$data['banner_top'][] = array(
				'title' => $item['title'],
				'text'  => $item['text'],
				'additional'  => $item['additional'],
				'image' => $image,
				'href'  => $item['link']
			);
		}

		// Баннер Наши Услуги
		$banner_service = $this->model_design_banner->getBanner(9);

		$data['banner_service'] = array();

		foreach ($banner_service as $item){
			$width = 285;
			if ($item['width']) {
				$width = $item['width'];
			}

			$height = 257;
			if ($item['height']) {
				$height = $item['height'];
			}

			if ($item['image']) {
				$image = $this->model_tool_image->resize($item['image'], $width, $height);
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', $width, $height);
			}
			
			$width_add = 36;
			if ($item['width_add']) {
				$width_add = $item['width_add'];
			}

			$height_add = 44;
			if ($item['height_add']) {
				$height_add = $item['height_add'];
			}

			if ($item['image_add']) {
				$image_add = $this->model_tool_image->resize($item['image_add'], $width_add, $height_add);
			} else {
				$image_add = '';
			}

			$data['banner_service'][] = array(
				'title' => $item['title'],
				'text'  => $item['text'],
				'additional'  => $item['additional'],
				'image' => $image,
				'width' => $width,
				'height' => $height,
				'image_add' => $image_add,
				'width_add' => $width_add,
				'height_add' => $height_add,
				'href'  => $item['link']
			);
		}
		
		// Блок Последние Статьи
		$this->load->model('catalog/ncategory');
		$this->load->model('catalog/news');

		$data['blog_categories'] = array();

		// сначала занесем в массив все статьи скопом
		$articles = array();

		$all_news = $this->model_catalog_news->getNews();

		if ($all_news) {
			foreach ($all_news as $new) {
				$title = $new['title'];
				$da = date('d.m.Y', strtotime($new['date_added']));
				if ($new['image']) {
					$image = $this->model_tool_image->resize($new['image'], 373, 218);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', 373, 218);
				}

				if($new['description2']) {
					$desc = utf8_substr(strip_tags(html_entity_decode($new['description2'], ENT_QUOTES, 'UTF-8')), 0, 180) . '..';
				} else {
					$desc = utf8_substr(strip_tags(html_entity_decode($new['description'], ENT_QUOTES, 'UTF-8')), 0, 180) . '..';
				}

				$href =  $this->url->link('news/article','news_id=' . $new['news_id']);

				$articles[] = array(
					'title'       => $title,
					'date_added'  => $da,
					'image'       => $image,
					'description' => $desc,
					'href'        => $href,
				);
			}

			$data['blog_categories'][] = array(
				'ncategory_id' => 0,
				'name'         => $this->language->get('text_all_article'),
				'articles'     => $articles,
			);
		}

		// потом статьи по категориям
		$blog_categories = $this->model_catalog_ncategory->getncategories();

		foreach ($blog_categories as $category) {
			$articles = array();
			
			$sdata = array(
				'filter_ncategory_id' => $category['ncategory_id'],
			);

			$results = $this->model_catalog_news->getNews($sdata);

			foreach ($results as $result) {
				$title = $result['title'];
				$da = date('d.m.Y', strtotime($result['date_added']));
				if ($result['image']) {
					$image = $this->model_tool_image->resize($result['image'], 373, 218);
				} else {
					$image = $this->model_tool_image->resize('placeholder.png', 373, 218);
				}

				if($result['description2']) {
					$desc = utf8_substr(strip_tags(html_entity_decode($result['description2'], ENT_QUOTES, 'UTF-8')), 0, 180) . '..';
				} else {
					$desc = utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, 180) . '..';
				}

				$href =  $this->url->link('news/article','news_id=' . $result['news_id']);
				
				$articles[] = array(
					'title'       => $title,
					'date_added'  => $da,
					'image'       => $image,
					'description' => $desc,
					'href'        => $href,
				);
			}

			$data['blog_categories'][] = array(
				'ncategory_id' => $category['ncategory_id'],
				'name'         => $category['name'],
				'articles'     => $articles,
			);
		}

		// Баннер Наши Партнеры
		$banner_partners = $this->model_design_banner->getBanner(8);

		$data['banner_partners'] = array();

		foreach ($banner_partners as $item){
			$width_p = 148;
			if ($item['width']) {
				$width_p = $item['width'];
			}

			$height_p = 56;
			if ($item['height']) {
				$height_p = $item['height'];
			}

			if ($item['image']) {
				$image = $this->model_tool_image->resize($item['image'], $width_p, $height_p);
			} else {
				$image = $this->model_tool_image->resize('placeholder.png', $width_p, $height_p);
			}

			$data['banner_partners'][] = array(
				'title' => $item['title'],
				'text'  => $item['text'],
				'image' => $image,
				'width' => $width_p,
				'height' => $height_p,
				'href'  => $item['link']
			);
		}

		// SEO блок
		$lang = 'ru';
		if (isset($_SESSION['language'])) {
			$lang = $_SESSION['language'];
		}

		$data['seo_title'] = html_entity_decode($this->config->get('config_title_seo_text_' . $lang));

		$data['seo_text'] = html_entity_decode($this->config->get('config_seo_text_' . $lang));

		$seo_image = $this->config->get('config_seo_image');
		if ($seo_image) {
			$data['seo_image'] = $this->model_tool_image->resize($seo_image, 400, 414);
		} else {
			$data['seo_image'] = '';
		}

		//
		// ---------------------------------------------------------------------------


		$data['column_left'] = $this->load->controller('common/column_left');
		$data['column_right'] = $this->load->controller('common/column_right');
		$data['content_top'] = $this->load->controller('common/content_top');
		$data['content_bottom'] = $this->load->controller('common/content_bottom');
		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/common/home.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/common/home.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/common/home.tpl', $data));
		}
	}
}