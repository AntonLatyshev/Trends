<?php  
class ControllerProductVacansies extends Controller {
	public function index() {
		$this->load->language('product/vacansy');

		$this->load->model('catalog/vacansy');

		if (isset($this->request->get['page'])) {
			$page = $this->request->get['page'];
		} else {
			$page = 1;
		}
		
		if (isset($this->request->get['limit'])) {
			$limit = $this->request->get['limit'];
		} else {
			//$limit = $this->config->get('config_product_limit');
			$limit = 1000;
		}		
		
		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/home')
		);
		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_bread_vacansy'),
			'href' => $this->url->link('common/home')
		);

		$this->document->setTitle($this->language->get('head_vacansy'));
		$this->document->setDescription($this->language->get('head_vacansy'));
		$this->document->setKeywords($this->language->get('head_vacansy'));

		$data['heading_title'] = $this->language->get('head_vacansy');
		$data['button_more'] = $this->language->get('button_more');
		$data['button_details'] = $this->language->get('button_details');
		$data['button_sent_rez'] = $this->language->get('button_sent_rez');
		$data['text_no_vac'] = $this->language->get('text_no_vac');
		$data['text_camehome'] = $this->language->get('text_camehome');
		$data['text_not_found'] = $this->language->get('text_not_found');
		$data['text_not_found_sub'] = $this->language->get('text_not_found_sub');
		$data['show_mo'] = $this->language->get('show_mo');
		
		
		$data['text_from'] = $this->language->get('text_from');
		$data['text_to'] = $this->language->get('text_to');

		$data['vacansies'] = array();

		$filter_data = array(
			'start'              => ($page - 1) * $limit,
			'limit'              => $limit
		);
		
		$vacansy_total = $this->model_catalog_vacansy->getTotalVacansies();

		if($vacansy_total>0) {
			$cities = $this->model_catalog_vacansy->getVacansyCities();

			$results = $this->model_catalog_vacansy->getVacansies($filter_data);

			foreach ($results as $result) {

				$data['vacansies'][$this->language->get('text_all_cities')][] = array(
					'vacansy_id' => $result['vacansy_id'],
					'vac_city' => strip_tags(html_entity_decode($result['vac_city'], ENT_QUOTES, 'UTF-8')),
					'vac_name' => strip_tags(html_entity_decode($result['vac_name'], ENT_QUOTES, 'UTF-8')),
					'vac_requirements' => strip_tags(html_entity_decode($result['vac_requirements'], ENT_QUOTES, 'UTF-8')),
				);

				$data['vacansies'][$result['vac_city']][] = array(
					'vacansy_id' => $result['vacansy_id'],
					'vac_city' => strip_tags(html_entity_decode($result['vac_city'], ENT_QUOTES, 'UTF-8')),
					'vac_name' => strip_tags(html_entity_decode($result['vac_name'], ENT_QUOTES, 'UTF-8')),
					'vac_requirements' => strip_tags(html_entity_decode($result['vac_requirements'], ENT_QUOTES, 'UTF-8')),
				);
			}
		}

		$data['footer'] = $this->load->controller('common/footer');
		$data['header'] = $this->load->controller('common/header');

		$data['total_article'] = $vacansy_total;
		$start_news = ((($page - 1) * $limit) + $limit);
		$data['start_news'] = ($start_news > $vacansy_total) ? $vacansy_total : $start_news;

		$data['limit_news'] = $limit;

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/product/vacansies.tpl')) {
			$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/product/vacansies.tpl', $data));
		} else {
			$this->response->setOutput($this->load->view('default/template/product/vacansies.tpl', $data));
		}

	}
	
    public function downloadMoreVac() {

        $json = array();
        $data = array();
		$url = '';
        $this->load->language('product/vacansy');

		$data['button_more'] = $this->language->get('button_more');
		$data['button_details'] = $this->language->get('button_details');
        $data['text_empty'] = $this->language->get('text_empty');

        $this->load->model('catalog/vacansy');

        $start = (int)$this->request->post['start'];
        $limit = (int)$this->request->post['limit'];

        $sdata = array(
            'start'           		=> $start,
            'limit'           		=> $limit
        );

		$vacansy_total = $this->model_catalog_vacansy->getTotalVacansies();
		$json['total'] = $vacansy_total;
		$results = $this->model_catalog_vacansy->getVacansies($sdata);
		if ($results) {
			foreach ($results as $result) {	

					$datemass = explode('-', (string)$result['vac_date']);
					$datemass[1] = $this->language->get('month_'.$datemass[1]);
					$data['vacansies'][] = array(
						'vacansy_id' => $result['vacansy_id'],
						'vac_date' => $result['vac_date'],
						'vac_date_mass' => $datemass,
						'vac_name' => strip_tags(html_entity_decode($result['vac_name'], ENT_QUOTES, 'UTF-8')),
						'vac_schort_text' => strip_tags(html_entity_decode($result['vac_schort_text'], ENT_QUOTES, 'UTF-8')),
						'vac_link' => $this->url->link('product/vacansy', 'vacansy_id=' . $result['vacansy_id'] . $url)
					);

					$json['success'] = $this->load->view($this->config->get('config_template') . '/template/product/vacansy_ajax.tpl', $data);
			}	
		} else {
            $json['success'] = false;
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));

    }	
}