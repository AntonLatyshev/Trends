<?php
class ControllerModuleHTML extends Controller {
	public function index($setting) {
		$data['module_id'] = substr($setting['name'], strrpos($setting['name'],"|")+1);

		$data['languagese'] = $this->language->getGroupData();

		$this->load->language('common/home');

		$description_for_html['text_show_category'] = $this->language->get('text_show_category');

		if (isset($setting['module_description'][$this->config->get('config_language_id')])) {
			$data['heading_title'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['title'], ENT_QUOTES, 'UTF-8');
			$data['html'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['description'], ENT_QUOTES, 'UTF-8');

			if ( empty($setting['module_description'][$this->config->get('config_language_id')]['description_for_html']) ) {
				$data['description_for_html'] = '';
			}

			if ( !empty($setting['module_description'][$this->config->get('config_language_id')]['html_tpl']) ) {

				// Блок Последние Статьи ---------------------------
				$this->load->model('catalog/ncategory');
				$this->load->model('catalog/news');

				$description_for_html['blog_categories'] = array();

				// сначала занесем в массив все статьи скопом
				$articles = array();

				$all_news = $this->model_catalog_news->getNews();

				if ($all_news) {
					foreach ($all_news as $new) {
						$title = $new['title'];
						$da = date('d.m.Y', strtotime($new['date_added']));
						if ($new['image'] || $new['image2']) {
							if ($new['image2']) {
								$image = $this->model_tool_image->resize($new['image2'], 373, 218);
							} else {
								$image = $this->model_tool_image->resize($new['image'], 373, 218);
							}
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

					$description_for_html['blog_categories'][] = array(
						'ncategory_id' => 65,
						'ncat_href'    => $this->url->link('news/ncategory', 'ncat=65'),
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
						if ($result['image'] || $result['image2']) {
							if ($result['image2']) {
								$image = $this->model_tool_image->resize($result['image2'], 373, 218);
							} else {
								$image = $this->model_tool_image->resize($result['image'], 373, 218);
							}
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

					$description_for_html['blog_categories'][] = array(
						'ncategory_id' => $category['ncategory_id'],
						'ncat_href'    => $this->url->link('news/ncategory', 'ncat=' . $category['ncategory_id']),
						'name'         => $category['name'],
						'articles'     => $articles,
					);
				}

				$description_for_html['text_more'] = $this->language->get('text_more');
				$description_for_html['text_latest_art'] = $this->language->get('text_latest_art');
				$description_for_html['text_be_informed'] = $this->language->get('text_be_informed');
				// end Блок Последние Статьи -----------------------

				// SEO блок ----------------------------------------
				$lang = 'ru';
				if (isset($_SESSION['language'])) {
					$lang = $_SESSION['language'];
				}

				$description_for_html['seo_title'] = html_entity_decode($this->config->get('config_title_seo_text_' . $lang));

				$description_for_html['seo_text'] = html_entity_decode($this->config->get('config_seo_text_' . $lang));

				$seo_image = $this->config->get('config_seo_image');
				if ($seo_image) {
					$description_for_html['seo_image'] = $this->model_tool_image->resize($seo_image, 400, 414);
				} else {
					$description_for_html['seo_image'] = '';
				}

				$description_for_html['text_all_article'] = $this->language->get('text_all_article');
				// end SEO блок -------------------------------------

				// Статья блога - блок Читайте также ---------------------
				if (isset($this->request->get['news_id'])) {
					$news_id = (int)$this->request->get['news_id'];
				} else {
					$news_id = 0;
				}

				$description_for_html['article'] = array();

				$results = $this->model_catalog_news->getNewsRelated($news_id);

				foreach ($results as $result) {
					if ($result['title']) {
						if ($result['image'] || $result['image2']) {
							if ($result['image2']) {
								$image = $this->model_tool_image->resize($result['image2'], 92, 65);
							} else {
								$image = $this->model_tool_image->resize($result['image'], 92, 65);
							}
						} else {
							$image = $this->model_tool_image->resize('placeholder.png', 92, 65);
						}
						if ($result['description'] || $result['description2']) {
							if($result['description2'] && (strlen(html_entity_decode($result['description2'], ENT_QUOTES, 'UTF-8')) > 20)) {
								$desc = html_entity_decode($result['description2'], ENT_QUOTES, 'UTF-8');
							} else {
								$desc_limit = $this->config->get('ncategory_bnews_desc_length') ? $this->config->get('ncategory_bnews_desc_length') : 600;
								$desc = utf8_substr(strip_tags(html_entity_decode($result['description'], ENT_QUOTES, 'UTF-8')), 0, $desc_limit) . '..';
							}
						} else {
							$desc = '';
						}

						$description_for_html['article'][] = array(
							'article_id'  => $result['news_id'],
							'name'        => $result['title'],
							'thumb'       => $image,
							'description' => $desc,
							'href'        => $this->url->link('news/article', '&news_id=' . $result['news_id']),
						);
					}
				}
				// end Статья блога - Читайте также -----------------


				$data['html_tpl'] = $setting['module_description'][$this->config->get('config_language_id')]['html_tpl'];

				$description_for_html['heading_title'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['title'], ENT_QUOTES, 'UTF-8');
				$description_for_html['text'] = $data['description_for_html'] = html_entity_decode($setting['module_description'][$this->config->get('config_language_id')]['description_for_html'], ENT_QUOTES, 'UTF-8');
                                
                                $custom_language_id = false;
				$this->load->model('localisation/language');
				$languages = $this->model_localisation_language->getLanguages();
				foreach ( $languages as $key => $value ) {
					if ($key == $this->language->get('code')) {
						$custom_language_id = $value['language_id'];
					}
				}
				$description_for_html['custom_field'] = array();
				if ( !empty($setting['custom_field'][$this->config->get('config_language_id')]) ) {
					$custom_fields = $setting['custom_field'][$this->config->get('config_language_id')];
                                        foreach ($custom_fields as $custom_fields) {
						$description_for_html['custom_field'][$custom_fields['name']] = html_entity_decode($custom_fields['value'], ENT_QUOTES, 'UTF-8');
					}
				}
                                                                
                                if(isset($this->request->get['route'])){
                                    $description_for_html['route'] = true;
                                } else {
                                    $description_for_html['route'] = false;
                                }
                                                                
                                
				$data['html_tpl'] = $this->load->view('default/template/information/html/' . $data['html_tpl'] . '.tpl', $description_for_html);
			} else {
				$data['description_for_html'] = '';
				$data['html_tpl'] = '';
			}

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/html.tpl')) {
				return $this->load->view($this->config->get('config_template') . '/template/module/html.tpl', $data);
			} else {
				return $this->load->view('default/template/module/html.tpl', $data);
			}
		}
	}
}