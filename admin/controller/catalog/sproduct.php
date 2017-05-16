<?php
class ControllerCatalogSproduct extends Controller {
	private $error = array();

	public function index() {
		$this->load->language('catalog/sproduct');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/sproduct');

		$this->getList();
	}

	public function add() {
		$this->load->language('catalog/sproduct');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/sproduct');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_sproduct->addSproduct($this->request->post);

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('catalog/sproduct', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function edit() {
		$this->load->language('catalog/sproduct');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/sproduct');

		if (($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validateForm()) {
			$this->model_catalog_sproduct->editSproduct($this->request->get['sproduct_id'], $this->request->post);

			if ( !empty($this->request->post['custom_field']) ) {
				$json_custom_fields = json_encode($this->request->post['custom_field'], JSON_UNESCAPED_UNICODE);
				$this->model_catalog_sproduct->editCustomFields($this->request->get['sproduct_id'], $json_custom_fields);
			} else {
				$json_custom_fields = false;
				$this->model_catalog_sproduct->editCustomFields($this->request->get['sproduct_id'], $json_custom_fields);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('catalog/sproduct', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getForm();
	}

	public function delete() {
		$this->load->language('catalog/sproduct');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/sproduct');

		if (isset($this->request->post['selected']) && $this->validateDelete()) {
			foreach ($this->request->post['selected'] as $sproduct_id) {
				$this->model_catalog_sproduct->deleteSproduct($sproduct_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('catalog/sproduct', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	public function copy() {
		$this->load->language('catalog/sproduct');

		$this->document->setTitle($this->language->get('heading_title'));

		$this->load->model('catalog/sproduct');

		if (isset($this->request->post['selected']) && $this->validateCopy()) {
			foreach ($this->request->post['selected'] as $sproduct_id) {
				$this->model_catalog_sproduct->copySproduct($sproduct_id);
			}

			$this->session->data['success'] = $this->language->get('text_success');

			$url = '';

			if (isset($this->request->get['filter_name'])) {
				$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_model'])) {
				$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
			}

			if (isset($this->request->get['filter_price'])) {
				$url .= '&filter_price=' . $this->request->get['filter_price'];
			}

			if (isset($this->request->get['filter_quantity'])) {
				$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
			}

			if (isset($this->request->get['filter_status'])) {
				$url .= '&filter_status=' . $this->request->get['filter_status'];
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

			$this->response->redirect($this->url->link('catalog/sproduct', 'token=' . $this->session->data['token'] . $url, 'SSL'));
		}

		$this->getList();
	}

	protected function getList() {
		if (isset($this->request->get['filter_name'])) {
			$filter_name = $this->request->get['filter_name'];
		} else {
			$filter_name = null;
		}

        if (isset($this->request->get['filter_service_id'])) {
            $filter_service_id = $this->request->get['filter_service_id'];

            $this->load->model('catalog/service');
            $data['filter_service_name'] = $this->db->query("SELECT name FROM " . DB_PREFIX . "service_description WHERE service_id = '" . $filter_service_id . "' LIMIT 1")->row['name'];



            $data['sproduct_services'] = array();

            $service_info = $this->model_catalog_service->getService($filter_service_id);

            if ($service_info) {
                $data['sproduct_services'][] = array(
                    'service_id' => $service_info['service_id'],
                    'name' => ($service_info['path']) ? $service_info['path'] . ' &gt; ' . $service_info['name'] : $service_info['name']
                );
            }else{
                $data['sproduct_services'] = "";
            }


        } else {
            $filter_service_id = null;
            $data['filter_service_name'] = '';
            $data['sproduct_services'][] = array(
                'service_id' => '',
                'name' => ''
            );
        }

		if (isset($this->request->get['filter_model'])) {
			$filter_model = $this->request->get['filter_model'];
		} else {
			$filter_model = null;
		}

		if (isset($this->request->get['filter_price'])) {
			$filter_price = $this->request->get['filter_price'];
		} else {
			$filter_price = null;
		}

		if (isset($this->request->get['filter_quantity'])) {
			$filter_quantity = $this->request->get['filter_quantity'];
		} else {
			$filter_quantity = null;
		}

		if (isset($this->request->get['filter_status'])) {
			$filter_status = $this->request->get['filter_status'];
		} else {
			$filter_status = null;
		}


		if (isset($this->request->get['sort'])) {
			$sort = $this->request->get['sort'];
		} else {
			$sort = 'pd.name';
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

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

        if (isset($this->request->get['filter_service_id'])) {
            $url .= '&filter_service_id=' . urlencode(html_entity_decode($this->request->get['filter_service_id'], ENT_QUOTES, 'UTF-8'));
        }

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/sproduct', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		$data['add'] = $this->url->link('catalog/sproduct/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['copy'] = $this->url->link('catalog/sproduct/copy', 'token=' . $this->session->data['token'] . $url, 'SSL');
		$data['delete'] = $this->url->link('catalog/sproduct/delete', 'token=' . $this->session->data['token'] . $url, 'SSL');

		$data['sproducts'] = array();

		$filter_data = array(
			'filter_name'	  => $filter_name,
			'filter_model'	  => $filter_model,
			'filter_price'	  => $filter_price,
            'filter_service_id' => $filter_service_id,
			'filter_quantity' => $filter_quantity,
			'filter_status'   => $filter_status,
			'sort'            => $sort,
			'order'           => $order,
			'start'           => ($page - 1) * $this->config->get('config_limit_admin'),
			'limit'           => $this->config->get('config_limit_admin')
		);

		$this->load->model('tool/image');

		$sproduct_total = $this->model_catalog_sproduct->getTotalSproducts($filter_data);

		$results = $this->model_catalog_sproduct->getSproducts($filter_data);

		foreach ($results as $result) {
			if (is_file(DIR_IMAGE . $result['image'])) {
				$image = $this->model_tool_image->resize($result['image'], 40, 40);
			} else {
				$image = $this->model_tool_image->resize('no_image.png', 40, 40);
			}

			$special = false;

			$sproduct_specials = $this->model_catalog_sproduct->getSproductSpecials($result['sproduct_id']);

			foreach ($sproduct_specials  as $sproduct_special) {
				if (($sproduct_special['date_start'] == '0000-00-00' || strtotime($sproduct_special['date_start']) < time()) && ($sproduct_special['date_end'] == '0000-00-00' || strtotime($sproduct_special['date_end']) > time())) {
					$special = $sproduct_special['price'];

					break;
				}
			}

			$data['sproducts'][] = array(
				'sproduct_id' => $result['sproduct_id'],
				'image'      => $image,
				'name'       => $result['name'],
				'model'      => $result['model'],
				'price'      => $result['price'],
				'special'    => $special,
				'quantity'   => $result['quantity'],
				'status'     => ($result['status']) ? $this->language->get('text_enabled') : $this->language->get('text_disabled'),
				'edit'       => $this->url->link('catalog/sproduct/edit', 'token=' . $this->session->data['token'] . '&sproduct_id=' . $result['sproduct_id'] . $url, 'SSL')
			);
		}

		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_list'] = $this->language->get('text_list');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_no_results'] = $this->language->get('text_no_results');
		$data['text_confirm'] = $this->language->get('text_confirm');

		$data['column_image'] = $this->language->get('column_image');
		$data['column_name'] = $this->language->get('column_name');
		$data['column_model'] = $this->language->get('column_model');
		$data['column_price'] = $this->language->get('column_price');
		$data['column_quantity'] = $this->language->get('column_quantity');
		$data['column_status'] = $this->language->get('column_status');
		$data['column_action'] = $this->language->get('column_action');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_status'] = $this->language->get('entry_status');

		$data['button_copy'] = $this->language->get('button_copy');
		$data['button_add'] = $this->language->get('button_add');
		$data['button_edit'] = $this->language->get('button_edit');
		$data['button_delete'] = $this->language->get('button_delete');
		$data['button_filter'] = $this->language->get('button_filter');

        $data['entry_service'] = $this->language->get('entry_service');

		$data['token'] = $this->session->data['token'];

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->session->data['success'])) {
			$data['success'] = $this->session->data['success'];

			unset($this->session->data['success']);
		} else {
			$data['success'] = '';
		}

		if (isset($this->request->post['selected'])) {
			$data['selected'] = (array)$this->request->post['selected'];
		} else {
			$data['selected'] = array();
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

        if (isset($this->request->get['filter_service_id'])) {
            $url .= '&filter_service_id=' . urlencode(html_entity_decode($this->request->get['filter_service_id'], ENT_QUOTES, 'UTF-8'));
        }

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}


        if (isset($this->request->get['filter_manufacturer'])) {
            $url .= '&filter_manufacturer=' . urlencode(html_entity_decode($this->request->get['filter_manufacturer'], ENT_QUOTES, 'UTF-8'));
        }

        if ($order == 'ASC') {
			$url .= '&order=DESC';
		} else {
			$url .= '&order=ASC';
		}

		if (isset($this->request->get['page'])) {
			$url .= '&page=' . $this->request->get['page'];
		}

		$data['sort_name'] = $this->url->link('catalog/sproduct', 'token=' . $this->session->data['token'] . '&sort=pd.name' . $url, 'SSL');
		$data['sort_model'] = $this->url->link('catalog/sproduct', 'token=' . $this->session->data['token'] . '&sort=p.model' . $url, 'SSL');
		$data['sort_price'] = $this->url->link('catalog/sproduct', 'token=' . $this->session->data['token'] . '&sort=p.price' . $url, 'SSL');
		$data['sort_quantity'] = $this->url->link('catalog/sproduct', 'token=' . $this->session->data['token'] . '&sort=p.quantity' . $url, 'SSL');
		$data['sort_status'] = $this->url->link('catalog/sproduct', 'token=' . $this->session->data['token'] . '&sort=p.status' . $url, 'SSL');
		$data['sort_order'] = $this->url->link('catalog/sproduct', 'token=' . $this->session->data['token'] . '&sort=p.sort_order' . $url, 'SSL');

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

        if (isset($this->request->get['filter_service_id'])) {
            $url .= '&filter_service_id=' . urlencode(html_entity_decode($this->request->get['filter_service_id'], ENT_QUOTES, 'UTF-8'));
        }

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
		}

		if (isset($this->request->get['sort'])) {
			$url .= '&sort=' . $this->request->get['sort'];
		}

		if (isset($this->request->get['order'])) {
			$url .= '&order=' . $this->request->get['order'];
		}

        if (isset($this->request->get['filter_manufacturer'])) {
            $url .= '&filter_manufacturer=' . urlencode(html_entity_decode($this->request->get['filter_manufacturer'], ENT_QUOTES, 'UTF-8'));
        }

        $pagination = new Pagination();
		$pagination->total = $sproduct_total;
		$pagination->page = $page;
		$pagination->limit = $this->config->get('config_limit_admin');
		$pagination->url = $this->url->link('catalog/sproduct', 'token=' . $this->session->data['token'] . $url . '&page={page}', 'SSL');

		$data['pagination'] = $pagination->render();

		$data['results'] = sprintf($this->language->get('text_pagination'), ($sproduct_total) ? (($page - 1) * $this->config->get('config_limit_admin')) + 1 : 0, ((($page - 1) * $this->config->get('config_limit_admin')) > ($sproduct_total - $this->config->get('config_limit_admin'))) ? $sproduct_total : ((($page - 1) * $this->config->get('config_limit_admin')) + $this->config->get('config_limit_admin')), $sproduct_total, ceil($sproduct_total / $this->config->get('config_limit_admin')));

		$data['filter_name'] = $filter_name;
		$data['filter_model'] = $filter_model;
		$data['filter_price'] = $filter_price;
        $data['filter_service_id'] = $filter_service_id;
		$data['filter_quantity'] = $filter_quantity;
		$data['filter_status'] = $filter_status;


		$data['sort'] = $sort;
		$data['order'] = $order;

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/sproduct_list.tpl', $data));
	}

	protected function getForm() {
            
                $this->document->addStyle('view/stylesheet/ocfilter/ocfilter.css');
                $this->document->addScript('view/javascript/ocfilter/ocfilter.js');
                
		$data['heading_title'] = $this->language->get('heading_title');

		$data['text_form'] = !isset($this->request->get['sproduct_id']) ? $this->language->get('text_add') : $this->language->get('text_edit');
		$data['text_enabled'] = $this->language->get('text_enabled');
		$data['text_disabled'] = $this->language->get('text_disabled');
		$data['text_none'] = $this->language->get('text_none');
		$data['text_yes'] = $this->language->get('text_yes');
		$data['text_no'] = $this->language->get('text_no');
		$data['text_plus'] = $this->language->get('text_plus');
		$data['text_minus'] = $this->language->get('text_minus');
		$data['text_default'] = $this->language->get('text_default');
		$data['text_option'] = $this->language->get('text_option');
		$data['text_option_value'] = $this->language->get('text_option_value');
		$data['text_select'] = $this->language->get('text_select');
		$data['text_percent'] = $this->language->get('text_percent');
		$data['text_amount'] = $this->language->get('text_amount');

		$data['entry_promo_banner'] = $this->language->get('entry_promo_banner');
		$data['entry_promo_banner'] = $this->language->get('entry_promo_banner');
		$data['entry_promo_date'] = $this->language->get('entry_promo_date');
		$data['entry_promo_date'] = $this->language->get('entry_promo_date');

		$data['entry_name'] = $this->language->get('entry_name');
		$data['entry_description'] = $this->language->get('entry_description');
		$data['entry_description_short'] = $this->language->get('entry_description_short');
		$data['entry_meta_title'] = $this->language->get('entry_meta_title');
		$data['entry_meta_description'] = $this->language->get('entry_meta_description');
		$data['entry_meta_keyword'] = $this->language->get('entry_meta_keyword');
		$data['entry_keyword'] = $this->language->get('entry_keyword');
		$data['entry_model'] = $this->language->get('entry_model');
		$data['entry_sku'] = $this->language->get('entry_sku');
		$data['entry_upc'] = $this->language->get('entry_upc');
		$data['entry_ean'] = $this->language->get('entry_ean');
		$data['entry_jan'] = $this->language->get('entry_jan');
		$data['entry_isbn'] = $this->language->get('entry_isbn');
		$data['entry_mpn'] = $this->language->get('entry_mpn');
		$data['entry_location'] = $this->language->get('entry_location');
		$data['entry_minimum'] = $this->language->get('entry_minimum');
		$data['entry_shipping'] = $this->language->get('entry_shipping');
		$data['entry_date_available'] = $this->language->get('entry_date_available');
		$data['entry_quantity'] = $this->language->get('entry_quantity');
		$data['entry_stock_status'] = $this->language->get('entry_stock_status');
		$data['entry_price'] = $this->language->get('entry_price');
		$data['entry_tax_class'] = $this->language->get('entry_tax_class');
		$data['entry_points'] = $this->language->get('entry_points');
		$data['entry_option_points'] = $this->language->get('entry_option_points');
		$data['entry_subtract'] = $this->language->get('entry_subtract');
		$data['entry_weight_class'] = $this->language->get('entry_weight_class');
		$data['entry_weight'] = $this->language->get('entry_weight');
		$data['entry_dimension'] = $this->language->get('entry_dimension');
		$data['entry_length_class'] = $this->language->get('entry_length_class');
		$data['entry_length'] = $this->language->get('entry_length');
		$data['entry_width'] = $this->language->get('entry_width');
		$data['entry_height'] = $this->language->get('entry_height');
		$data['entry_image'] = $this->language->get('entry_image');
		$data['entry_store'] = $this->language->get('entry_store');
		$data['entry_manufacturer'] = $this->language->get('entry_manufacturer');
		$data['entry_download'] = $this->language->get('entry_download');
		$data['entry_service'] = $this->language->get('entry_service');
		$data['entry_filter'] = $this->language->get('entry_filter');
		$data['entry_related'] = $this->language->get('entry_related');
		$data['entry_attribute'] = $this->language->get('entry_attribute');
		$data['entry_text'] = $this->language->get('entry_text');
		$data['entry_option'] = $this->language->get('entry_option');
		$data['entry_option_value'] = $this->language->get('entry_option_value');
		$data['entry_required'] = $this->language->get('entry_required');
		$data['entry_sort_order'] = $this->language->get('entry_sort_order');
		$data['entry_status'] = $this->language->get('entry_status');
		$data['entry_date_start'] = $this->language->get('entry_date_start');
		$data['entry_date_end'] = $this->language->get('entry_date_end');
		$data['entry_priority'] = $this->language->get('entry_priority');
		$data['entry_tag'] = $this->language->get('entry_tag');
		$data['entry_customer_group'] = $this->language->get('entry_customer_group');
		$data['entry_reward'] = $this->language->get('entry_reward');
		$data['entry_layout'] = $this->language->get('entry_layout');
		$data['entry_recurring'] = $this->language->get('entry_recurring');

		$data['help_keyword'] = $this->language->get('help_keyword');
		$data['help_sku'] = $this->language->get('help_sku');
		$data['help_upc'] = $this->language->get('help_upc');
		$data['help_ean'] = $this->language->get('help_ean');
		$data['help_jan'] = $this->language->get('help_jan');
		$data['help_isbn'] = $this->language->get('help_isbn');
		$data['help_mpn'] = $this->language->get('help_mpn');
		$data['help_minimum'] = $this->language->get('help_minimum');
		$data['help_manufacturer'] = $this->language->get('help_manufacturer');
		$data['help_stock_status'] = $this->language->get('help_stock_status');
		$data['help_points'] = $this->language->get('help_points');
		$data['help_service'] = $this->language->get('help_service');
		$data['help_filter'] = $this->language->get('help_filter');
		$data['help_download'] = $this->language->get('help_download');
		$data['help_related'] = $this->language->get('help_related');
		$data['help_tag'] = $this->language->get('help_tag');

		$data['button_save'] = $this->language->get('button_save');
		$data['button_cancel'] = $this->language->get('button_cancel');
		$data['button_attribute_add'] = $this->language->get('button_attribute_add');
		$data['button_option_add'] = $this->language->get('button_option_add');
		$data['button_option_value_add'] = $this->language->get('button_option_value_add');
		$data['button_discount_add'] = $this->language->get('button_discount_add');
		$data['button_special_add'] = $this->language->get('button_special_add');
		$data['button_image_add'] = $this->language->get('button_image_add');
		$data['button_remove'] = $this->language->get('button_remove');
		$data['button_recurring_add'] = $this->language->get('button_recurring_add');

		$data['tab_general'] = $this->language->get('tab_general');
                $data['tab_ocfilter'] = $this->language->get('tab_ocfilter');
                $data['entry_values'] = $this->language->get('entry_values');
                $data['ocfilter_select_service'] = $this->language->get('ocfilter_select_service');
		$data['tab_data'] = $this->language->get('tab_data');
		$data['tab_attribute'] = $this->language->get('tab_attribute');
		$data['tab_option'] = $this->language->get('tab_option');
		$data['tab_recurring'] = $this->language->get('tab_recurring');
		$data['tab_discount'] = $this->language->get('tab_discount');
		$data['tab_special'] = $this->language->get('tab_special');
		$data['tab_image'] = $this->language->get('tab_image');
		$data['tab_links'] = $this->language->get('tab_links');
		$data['tab_reward'] = $this->language->get('tab_reward');
		$data['tab_design'] = $this->language->get('tab_design');
		$data['tab_openbay'] = $this->language->get('tab_openbay');

		if (isset($this->error['warning'])) {
			$data['error_warning'] = $this->error['warning'];
		} else {
			$data['error_warning'] = '';
		}

		if (isset($this->error['name'])) {
			$data['error_name'] = $this->error['name'];
		} else {
			$data['error_name'] = array();
		}

		if (isset($this->error['meta_title'])) {
			$data['error_meta_title'] = $this->error['meta_title'];
		} else {
			$data['error_meta_title'] = array();
		}

		if (isset($this->error['model'])) {
			$data['error_model'] = $this->error['model'];
		} else {
			$data['error_model'] = '';
		}

		if (isset($this->error['date_available'])) {
			$data['error_date_available'] = $this->error['date_available'];
		} else {
			$data['error_date_available'] = '';
		}

		if (isset($this->error['keyword'])) {
			$data['error_keyword'] = $this->error['keyword'];
		} else {
			$data['error_keyword'] = '';
		}

		$url = '';

		if (isset($this->request->get['filter_name'])) {
			$url .= '&filter_name=' . urlencode(html_entity_decode($this->request->get['filter_name'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_model'])) {
			$url .= '&filter_model=' . urlencode(html_entity_decode($this->request->get['filter_model'], ENT_QUOTES, 'UTF-8'));
		}

		if (isset($this->request->get['filter_price'])) {
			$url .= '&filter_price=' . $this->request->get['filter_price'];
		}

		if (isset($this->request->get['filter_quantity'])) {
			$url .= '&filter_quantity=' . $this->request->get['filter_quantity'];
		}

		if (isset($this->request->get['filter_status'])) {
			$url .= '&filter_status=' . $this->request->get['filter_status'];
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

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('text_home'),
			'href' => $this->url->link('common/dashboard', 'token=' . $this->session->data['token'], 'SSL')
		);

		$data['breadcrumbs'][] = array(
			'text' => $this->language->get('heading_title'),
			'href' => $this->url->link('catalog/sproduct', 'token=' . $this->session->data['token'] . $url, 'SSL')
		);

		if (!isset($this->request->get['sproduct_id'])) {
			$data['action'] = $this->url->link('catalog/sproduct/add', 'token=' . $this->session->data['token'] . $url, 'SSL');
		} else {
			$data['action'] = $this->url->link('catalog/sproduct/edit', 'token=' . $this->session->data['token'] . '&sproduct_id=' . $this->request->get['sproduct_id'] . $url, 'SSL');
		}

		$data['cancel'] = $this->url->link('catalog/sproduct', 'token=' . $this->session->data['token'] . $url, 'SSL');

		if (isset($this->request->get['sproduct_id']) && ($this->request->server['REQUEST_METHOD'] != 'POST')) {
			$sproduct_info = $this->model_catalog_sproduct->getSproduct($this->request->get['sproduct_id']);
		}

		if (isset($this->request->post['custom_field'])) {
			$custom_fields = json_encode($this->request->post['custom_field'], JSON_UNESCAPED_UNICODE);
			$data['custom_fields'] = json_decode($custom_fields, true);
		} elseif (isset($this->request->get['sproduct_id'])) {
			$custom_fields = $this->model_catalog_sproduct->getPoductCustomFields($this->request->get['sproduct_id']);
			if ( !empty($custom_fields) ) {
				$data['custom_fields'] = json_decode($custom_fields, true);
			} else {
				$data['custom_fields'] = array();
			}
		} else {
			$data['custom_fields'] = array();
		}

		$data['token'] = $this->session->data['token'];

		$this->load->model('localisation/language');

		$data['languages'] = $this->model_localisation_language->getLanguages();

		if (isset($this->request->post['sproduct_description'])) {
			$data['sproduct_description'] = $this->request->post['sproduct_description'];
		} elseif (isset($this->request->get['sproduct_id'])) {
			$data['sproduct_description'] = $this->model_catalog_sproduct->getSproductDescriptions($this->request->get['sproduct_id']);
		} else {
			$data['sproduct_description'] = array();
		}

		if (isset($this->request->post['image'])) {
			$data['image'] = $this->request->post['image'];
		} elseif (!empty($sproduct_info)) {
			$data['image'] = $sproduct_info['image'];
		} else {
			$data['image'] = '';
		}

		if (isset($this->request->post['image_bg'])) {
			$data['image_bg'] = $this->request->post['image_bg'];
		} elseif (!empty($sproduct_info)) {
			$data['image_bg'] = $sproduct_info['image_bg'];
		} else {
			$data['image_bg'] = '';
		}

		if (isset($this->request->post['image_list'])) {
			$data['image_list'] = $this->request->post['image_list'];
		} elseif (!empty($sproduct_info)) {
			$data['image_list'] = $sproduct_info['image_list'];
		} else {
			$data['image_list'] = '';
		}

		if (isset($this->request->post['image_nf'])) {
			$data['image_nf'] = $this->request->post['image_nf'];
		} elseif (!empty($sproduct_info)) {
			$data['image_nf'] = $sproduct_info['image_nf'];
		} else {
			$data['image_nf'] = '';
		}

		if (isset($this->request->post['image_trigger'])) {
			$data['image_trigger'] = $this->request->post['image_trigger'];
		} elseif (!empty($sproduct_info)) {
			$data['image_trigger'] = $sproduct_info['image_trigger'];
		} else {
			$data['image_trigger'] = '';
		}

		if (isset($this->request->post['image_add'])) {
			$data['image_add'] = $this->request->post['image_add'];
		} elseif (!empty($sproduct_info)) {
			$data['image_add'] = $sproduct_info['image_add'];
		} else {
			$data['image_add'] = '';
		}

		$this->load->model('tool/image');

		if (isset($this->request->post['image']) && is_file(DIR_IMAGE . $this->request->post['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($this->request->post['image'], 100, 100);
		} elseif (!empty($sproduct_info) && is_file(DIR_IMAGE . $sproduct_info['image'])) {
			$data['thumb'] = $this->model_tool_image->resize($sproduct_info['image'], 100, 100);
		} else {
			$data['thumb'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		if (isset($this->request->post['image_bg']) && is_file(DIR_IMAGE . $this->request->post['image_bg'])) {
			$data['thumb_bg'] = $this->model_tool_image->resize($this->request->post['image_bg'], 100, 100);
		} elseif (!empty($sproduct_info) && is_file(DIR_IMAGE . $sproduct_info['image_bg'])) {
			$data['thumb_bg'] = $this->model_tool_image->resize($sproduct_info['image_bg'], 100, 100);
		} else {
			$data['thumb_bg'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['image_list']) && is_file(DIR_IMAGE . $this->request->post['image_list'])) {
			$data['thumb_list'] = $this->model_tool_image->resize($this->request->post['image_list'], 100, 100);
		} elseif (!empty($sproduct_info) && is_file(DIR_IMAGE . $sproduct_info['image_list'])) {
			$data['thumb_list'] = $this->model_tool_image->resize($sproduct_info['image_list'], 100, 100);
		} else {
			$data['thumb_list'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['image_nf']) && is_file(DIR_IMAGE . $this->request->post['image_nf'])) {
			$data['thumb_nf'] = $this->model_tool_image->resize($this->request->post['image_nf'], 100, 100);
		} elseif (!empty($sproduct_info) && is_file(DIR_IMAGE . $sproduct_info['image_nf'])) {
			$data['thumb_nf'] = $this->model_tool_image->resize($sproduct_info['image_nf'], 100, 100);
		} else {
			$data['thumb_nf'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['image_trigger']) && is_file(DIR_IMAGE . $this->request->post['image_trigger'])) {
			$data['thumb_trigger'] = $this->model_tool_image->resize($this->request->post['image_trigger'], 100, 100);
		} elseif (!empty($sproduct_info) && is_file(DIR_IMAGE . $sproduct_info['image_trigger'])) {
			$data['thumb_trigger'] = $this->model_tool_image->resize($sproduct_info['image_trigger'], 100, 100);
		} else {
			$data['thumb_trigger'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}
		
		if (isset($this->request->post['image_add']) && is_file(DIR_IMAGE . $this->request->post['image_add'])) {
			$data['thumb_add'] = $this->model_tool_image->resize($this->request->post['image_add'], 100, 100);
		} elseif (!empty($sproduct_info) && is_file(DIR_IMAGE . $sproduct_info['image_add'])) {
			$data['thumb_add'] = $this->model_tool_image->resize($sproduct_info['image_add'], 100, 100);
		} else {
			$data['thumb_add'] = $this->model_tool_image->resize('no_image.png', 100, 100);
		}

		$data['placeholder'] = $this->model_tool_image->resize('no_image.png', 100, 100);

		if (isset($this->request->post['model'])) {
			$data['model'] = $this->request->post['model'];
		} elseif (!empty($sproduct_info)) {
			$data['model'] = $sproduct_info['model'];
		} else {
			$data['model'] = '';
		}

		if (isset($this->request->post['sku'])) {
			$data['sku'] = $this->request->post['sku'];
		} elseif (!empty($sproduct_info)) {
			$data['sku'] = $sproduct_info['sku'];
		} else {
			$data['sku'] = '';
		}

		if (isset($this->request->post['upc'])) {
			$data['upc'] = $this->request->post['upc'];
		} elseif (!empty($sproduct_info)) {
			$data['upc'] = $sproduct_info['upc'];
		} else {
			$data['upc'] = '';
		}

		if (isset($this->request->post['ean'])) {
			$data['ean'] = $this->request->post['ean'];
		} elseif (!empty($sproduct_info)) {
			$data['ean'] = $sproduct_info['ean'];
		} else {
			$data['ean'] = '';
		}

		if (isset($this->request->post['jan'])) {
			$data['jan'] = $this->request->post['jan'];
		} elseif (!empty($sproduct_info)) {
			$data['jan'] = $sproduct_info['jan'];
		} else {
			$data['jan'] = '';
		}

		if (isset($this->request->post['isbn'])) {
			$data['isbn'] = $this->request->post['isbn'];
		} elseif (!empty($sproduct_info)) {
			$data['isbn'] = $sproduct_info['isbn'];
		} else {
			$data['isbn'] = '';
		}

		if (isset($this->request->post['mpn'])) {
			$data['mpn'] = $this->request->post['mpn'];
		} elseif (!empty($sproduct_info)) {
			$data['mpn'] = $sproduct_info['mpn'];
		} else {
			$data['mpn'] = '';
		}

		if (isset($this->request->post['location'])) {
			$data['location'] = $this->request->post['location'];
		} elseif (!empty($sproduct_info)) {
			$data['location'] = $sproduct_info['location'];
		} else {
			$data['location'] = '';
		}

		$this->load->model('setting/store');

		$data['stores'] = $this->model_setting_store->getStores();

		if (isset($this->request->post['sproduct_store'])) {
			$data['sproduct_store'] = $this->request->post['sproduct_store'];
		} elseif (isset($this->request->get['sproduct_id'])) {
			$data['sproduct_store'] = $this->model_catalog_sproduct->getSproductStores($this->request->get['sproduct_id']);
		} else {
			$data['sproduct_store'] = array(0);
		}

		if (isset($this->request->post['keyword'])) {
			$data['keyword'] = $this->request->post['keyword'];
		} elseif (!empty($sproduct_info)) {
			$data['keyword'] = $sproduct_info['keyword'];
		} else {
			$data['keyword'] = '';
		}

		if (isset($this->request->post['shipping'])) {
			$data['shipping'] = $this->request->post['shipping'];
		} elseif (!empty($sproduct_info)) {
			$data['shipping'] = $sproduct_info['shipping'];
		} else {
			$data['shipping'] = 1;
		}

		/*code start*/
		$data['promotags'] = $this->model_catalog_sproduct->getPromoTags();

		if (isset($this->request->post['promo_top_right'])) {
			$data['promo_top_right'] = $this->request->post['promo_top_right'];
		} elseif (isset($sproduct_info)) {
			$data['promo_top_right'] = $sproduct_info['promo_top_right'];
		} else {
			$data['promo_top_right'] = 0;
		}


		if (isset($this->request->post['promo_date_start'])) {
			$data['promo_date_start'] = $this->request->post['promo_date_start'];
		} elseif (isset($sproduct_info)) {
			if($sproduct_info['promo_date_start'] == '0000-00-00 00:00:00') {
				$data['promo_date_start'] = '';
			} else {
				$data['promo_date_start'] = $sproduct_info['promo_date_start'];
			}
		} else {
			$data['promo_date_start'] = '';
		}

		if (isset($this->request->post['promo_date_end'])) {
			$data['promo_date_end'] = $this->request->post['promo_date_end'];
		} elseif (isset($sproduct_info)) {
			if($sproduct_info['promo_date_end'] == '0000-00-00 00:00:00') {
				$data['promo_date_end'] = '';
			} else {
				$data['promo_date_end'] = $sproduct_info['promo_date_end'];
			}
		} else {
			$data['promo_date_end'] = '';
		}
		/*code end*/

		if (isset($this->request->post['price'])) {
			$data['price'] = $this->request->post['price'];
		} elseif (!empty($sproduct_info)) {
			$data['price'] = $sproduct_info['price'];
		} else {
			$data['price'] = '';
		}

		$this->load->model('catalog/recurring');

		$data['recurrings'] = $this->model_catalog_recurring->getRecurrings();

		if (isset($this->request->post['sproduct_recurrings'])) {
			$data['sproduct_recurrings'] = $this->request->post['sproduct_recurrings'];
		} elseif (!empty($sproduct_info)) {
			$data['sproduct_recurrings'] = $this->model_catalog_sproduct->getRecurrings($sproduct_info['sproduct_id']);
		} else {
			$data['sproduct_recurrings'] = array();
		}

		$this->load->model('localisation/tax_class');

		$data['tax_classes'] = $this->model_localisation_tax_class->getTaxClasses();

		if (isset($this->request->post['tax_class_id'])) {
			$data['tax_class_id'] = $this->request->post['tax_class_id'];
		} elseif (!empty($sproduct_info)) {
			$data['tax_class_id'] = $sproduct_info['tax_class_id'];
		} else {
			$data['tax_class_id'] = 0;
		}

		if (isset($this->request->post['date_available'])) {
			$data['date_available'] = $this->request->post['date_available'];
		} elseif (!empty($sproduct_info)) {
			$data['date_available'] = ($sproduct_info['date_available'] != '0000-00-00') ? $sproduct_info['date_available'] : '';
		} else {
			$data['date_available'] = date('Y-m-d');
		}

		if (isset($this->request->post['quantity'])) {
			$data['quantity'] = $this->request->post['quantity'];
		} elseif (!empty($sproduct_info)) {
			$data['quantity'] = $sproduct_info['quantity'];
		} else {
			$data['quantity'] = 1;
		}

		if (isset($this->request->post['minimum'])) {
			$data['minimum'] = $this->request->post['minimum'];
		} elseif (!empty($sproduct_info)) {
			$data['minimum'] = $sproduct_info['minimum'];
		} else {
			$data['minimum'] = 1;
		}

		if (isset($this->request->post['subtract'])) {
			$data['subtract'] = $this->request->post['subtract'];
		} elseif (!empty($sproduct_info)) {
			$data['subtract'] = $sproduct_info['subtract'];
		} else {
			$data['subtract'] = 1;
		}

		if (isset($this->request->post['sort_order'])) {
			$data['sort_order'] = $this->request->post['sort_order'];
		} elseif (!empty($sproduct_info)) {
			$data['sort_order'] = $sproduct_info['sort_order'];
		} else {
			$data['sort_order'] = 1;
		}

		$this->load->model('localisation/stock_status');

		$data['stock_statuses'] = $this->model_localisation_stock_status->getStockStatuses();

		if (isset($this->request->post['stock_status_id'])) {
			$data['stock_status_id'] = $this->request->post['stock_status_id'];
		} elseif (!empty($sproduct_info)) {
			$data['stock_status_id'] = $sproduct_info['stock_status_id'];
		} else {
			$data['stock_status_id'] = 0;
		}

		if (isset($this->request->post['status'])) {
			$data['status'] = $this->request->post['status'];
		} elseif (!empty($sproduct_info)) {
			$data['status'] = $sproduct_info['status'];
		} else {
			$data['status'] = true;
		}

		if (isset($this->request->post['weight'])) {
			$data['weight'] = $this->request->post['weight'];
		} elseif (!empty($sproduct_info)) {
			$data['weight'] = $sproduct_info['weight'];
		} else {
			$data['weight'] = '';
		}

		$this->load->model('localisation/weight_class');

		$data['weight_classes'] = $this->model_localisation_weight_class->getWeightClasses();

		if (isset($this->request->post['weight_class_id'])) {
			$data['weight_class_id'] = $this->request->post['weight_class_id'];
		} elseif (!empty($sproduct_info)) {
			$data['weight_class_id'] = $sproduct_info['weight_class_id'];
		} else {
			$data['weight_class_id'] = $this->config->get('config_weight_class_id');
		}

		if (isset($this->request->post['length'])) {
			$data['length'] = $this->request->post['length'];
		} elseif (!empty($sproduct_info)) {
			$data['length'] = $sproduct_info['length'];
		} else {
			$data['length'] = '';
		}

		if (isset($this->request->post['width'])) {
			$data['width'] = $this->request->post['width'];
		} elseif (!empty($sproduct_info)) {
			$data['width'] = $sproduct_info['width'];
		} else {
			$data['width'] = '';
		}

		if (isset($this->request->post['height'])) {
			$data['height'] = $this->request->post['height'];
		} elseif (!empty($sproduct_info)) {
			$data['height'] = $sproduct_info['height'];
		} else {
			$data['height'] = '';
		}
                                
		$this->load->model('localisation/length_class');

		$data['length_classes'] = $this->model_localisation_length_class->getLengthClasses();

		if (isset($this->request->post['length_class_id'])) {
			$data['length_class_id'] = $this->request->post['length_class_id'];
		} elseif (!empty($sproduct_info)) {
			$data['length_class_id'] = $sproduct_info['length_class_id'];
		} else {
			$data['length_class_id'] = $this->config->get('config_length_class_id');
		}

		$this->load->model('catalog/manufacturer');

		if (isset($this->request->post['manufacturer_id'])) {
			$data['manufacturer_id'] = $this->request->post['manufacturer_id'];
		} elseif (!empty($sproduct_info)) {
			$data['manufacturer_id'] = $sproduct_info['manufacturer_id'];
		} else {
			$data['manufacturer_id'] = 0;
		}

		if (isset($this->request->post['manufacturer'])) {
			$data['manufacturer'] = $this->request->post['manufacturer'];
		} elseif (!empty($sproduct_info)) {
			$manufacturer_info = $this->model_catalog_manufacturer->getManufacturer($sproduct_info['manufacturer_id']);

			if ($manufacturer_info) {
				$data['manufacturer'] = $manufacturer_info['name'];
			} else {
				$data['manufacturer'] = '';
			}
		} else {
			$data['manufacturer'] = '';
		}

		// Services
		$this->load->model('catalog/service');

		if (isset($this->request->post['sproduct_service'])) {
			$services = $this->request->post['sproduct_service'];
		} elseif (isset($this->request->get['sproduct_id'])) {
			$services = $this->model_catalog_sproduct->getSproductServices($this->request->get['sproduct_id']);
		} else {
			$services = array();
		}

		$data['sproduct_service'] = array();

		foreach ($services as $service_id) {
			$service_info = $this->model_catalog_service->getService($service_id);

			if ($service_info) {
				$data['sproduct_service'][] = array(
					'service_id' => $service_info['service_id'],
					'name' => ($service_info['path']) ? $service_info['path'] . ' &gt; ' . $service_info['name'] : $service_info['name']
				);
			}
		}

		// Filters
		$this->load->model('catalog/filter');

		if (isset($this->request->post['sproduct_filter'])) {
			$filters = $this->request->post['sproduct_filter'];
		} elseif (isset($this->request->get['sproduct_id'])) {
			$filters = $this->model_catalog_sproduct->getSproductFilters($this->request->get['sproduct_id']);
		} else {
			$filters = array();
		}

		$data['sproduct_filters'] = array();

		foreach ($filters as $filter_id) {
			$filter_info = $this->model_catalog_filter->getFilter($filter_id);

			if ($filter_info) {
				$data['sproduct_filters'][] = array(
					'filter_id' => $filter_info['filter_id'],
					'name'      => $filter_info['group'] . ' &gt; ' . $filter_info['name']
				);
			}
		}

		// Attributes
		$this->load->model('catalog/attribute');

		if (isset($this->request->post['sproduct_attribute'])) {
			$sproduct_attributes = $this->request->post['sproduct_attribute'];
		} elseif (isset($this->request->get['sproduct_id'])) {
			$sproduct_attributes = $this->model_catalog_sproduct->getSproductAttributes($this->request->get['sproduct_id']);
		} else {
			$sproduct_attributes = array();
		}

		$data['sproduct_attributes'] = array();

		foreach ($sproduct_attributes as $sproduct_attribute) {
			$attribute_info = $this->model_catalog_attribute->getAttribute($sproduct_attribute['attribute_id']);

			if ($attribute_info) {
				$data['sproduct_attributes'][] = array(
					'attribute_id'                  => $sproduct_attribute['attribute_id'],
					'name'                          => $attribute_info['name'],
					'sproduct_attribute_description' => $sproduct_attribute['sproduct_attribute_description']
				);
			}
		}

		// Options
		$this->load->model('catalog/option');

		if (isset($this->request->post['sproduct_option'])) {
			$sproduct_options = $this->request->post['sproduct_option'];
		} elseif (isset($this->request->get['sproduct_id'])) {
			$sproduct_options = $this->model_catalog_sproduct->getSproductOptions($this->request->get['sproduct_id']);
		} else {
			$sproduct_options = array();
		}

		$data['sproduct_options'] = array();

		foreach ($sproduct_options as $sproduct_option) {
			$sproduct_option_value_data = array();

			if (isset($sproduct_option['sproduct_option_value'])) {
				foreach ($sproduct_option['sproduct_option_value'] as $sproduct_option_value) {


                    if ($sproduct_option_value['sproduct_option_image'] && file_exists(DIR_IMAGE . $sproduct_option_value['sproduct_option_image'])) {
                        $opt_image = $sproduct_option_value['sproduct_option_image'];
                    } else {
                        $opt_image = 'no_image.png';
                    }



                    $sproduct_option_value_data[] = array(
						'sproduct_option_value_id' => $sproduct_option_value['sproduct_option_value_id'],
						'option_value_id'         => $sproduct_option_value['option_value_id'],
						'quantity'                => $sproduct_option_value['quantity'],
						'subtract'                => $sproduct_option_value['subtract'],
						'price'                   => $sproduct_option_value['price'],
						'price_prefix'            => $sproduct_option_value['price_prefix'],
						'points'                  => $sproduct_option_value['points'],
						'points_prefix'           => $sproduct_option_value['points_prefix'],
                        'sproduct_option_image'    	 => $opt_image,
                        'sproduct_option_image_thumb' => $this->model_tool_image->resize($opt_image, 100, 100),
						'weight'                  => $sproduct_option_value['weight'],
						'weight_prefix'           => $sproduct_option_value['weight_prefix']
					);
				}
			}

			$data['sproduct_options'][] = array(
				'sproduct_option_id'    => $sproduct_option['sproduct_option_id'],
				'sproduct_option_value' => $sproduct_option_value_data,
				'option_id'            => $sproduct_option['option_id'],
				'name'                 => $sproduct_option['name'],
				'type'                 => $sproduct_option['type'],
				'value'                => isset($sproduct_option['value']) ? $sproduct_option['value'] : '',
				'required'             => $sproduct_option['required']
			);
		}

		$data['option_values'] = array();

		foreach ($data['sproduct_options'] as $sproduct_option) {
			if ($sproduct_option['type'] == 'select' || $sproduct_option['type'] == 'radio' || $sproduct_option['type'] == 'checkbox' || $sproduct_option['type'] == 'image') {
				if (!isset($data['option_values'][$sproduct_option['option_id']])) {
					$data['option_values'][$sproduct_option['option_id']] = $this->model_catalog_option->getOptionValues($sproduct_option['option_id']);
				}
			}
		}

		$this->load->model('sale/customer_group');

		$data['customer_groups'] = $this->model_sale_customer_group->getCustomerGroups();

		if (isset($this->request->post['sproduct_discount'])) {
			$sproduct_discounts = $this->request->post['sproduct_discount'];
		} elseif (isset($this->request->get['sproduct_id'])) {
			$sproduct_discounts = $this->model_catalog_sproduct->getSproductDiscounts($this->request->get['sproduct_id']);
		} else {
			$sproduct_discounts = array();
		}

		$data['sproduct_discounts'] = array();

		foreach ($sproduct_discounts as $sproduct_discount) {
			$data['sproduct_discounts'][] = array(
				'customer_group_id' => $sproduct_discount['customer_group_id'],
				'quantity'          => $sproduct_discount['quantity'],
				'priority'          => $sproduct_discount['priority'],
				'price'             => $sproduct_discount['price'],
				'date_start'        => ($sproduct_discount['date_start'] != '0000-00-00') ? $sproduct_discount['date_start'] : '',
				'date_end'          => ($sproduct_discount['date_end'] != '0000-00-00') ? $sproduct_discount['date_end'] : ''
			);
		}

		if (isset($this->request->post['sproduct_special'])) {
			$sproduct_specials = $this->request->post['sproduct_special'];
		} elseif (isset($this->request->get['sproduct_id'])) {
			$sproduct_specials = $this->model_catalog_sproduct->getSproductSpecials($this->request->get['sproduct_id']);
		} else {
			$sproduct_specials = array();
		}

		$data['sproduct_specials'] = array();

		foreach ($sproduct_specials as $sproduct_special) {
			$data['sproduct_specials'][] = array(
				'customer_group_id' => $sproduct_special['customer_group_id'],
				'priority'          => $sproduct_special['priority'],
				'price'             => $sproduct_special['price'],
				'date_start'        => ($sproduct_special['date_start'] != '0000-00-00') ? $sproduct_special['date_start'] : '',
				'date_end'          => ($sproduct_special['date_end'] != '0000-00-00') ? $sproduct_special['date_end'] :  ''
			);
		}

		// Images
		if (isset($this->request->post['sproduct_image'])) {
			$sproduct_images = $this->request->post['sproduct_image'];
		} elseif (isset($this->request->get['sproduct_id'])) {
			$sproduct_images = $this->model_catalog_sproduct->getSproductImages($this->request->get['sproduct_id']);
		} else {
			$sproduct_images = array();
		}

		$data['sproduct_images'] = array();

		foreach ($sproduct_images as $sproduct_image) {
			if (is_file(DIR_IMAGE . $sproduct_image['image'])) {
				$image = $sproduct_image['image'];
				$thumb = $sproduct_image['image'];
			} else {
				$image = '';
				$thumb = 'no_image.png';
			}

			$data['sproduct_images'][] = array(
				'image'      => $image,
				'thumb'      => $this->model_tool_image->resize($thumb, 100, 100),
				'sort_order' => $sproduct_image['sort_order'],
				'sproduct_image_description' => $sproduct_image['sproduct_image_description'],
			);
		}

		// Tab Select Service
		if (isset($this->error['warning_image'])) {
			$data['error_warning_image'] = $this->error['warning_image'];
		} else {
			$data['error_warning_image'] = '';
		}

		if (isset($this->error['warning_name'])) {
			$data['error_warning_name'] = $this->error['warning_name'];
		} else {
			$data['error_warning_name'] = '';
		}

		$sproduct_services = array();

		if (isset($this->request->post['sproduct_services'])) {
			$sproduct_services = $this->request->post['sproduct_services'];

		} elseif (isset($this->request->get['sproduct_id'])) {
			$sproduct_services = $this->model_catalog_sproduct->getSproductsServices($this->request->get['sproduct_id']);

		}

		$data['sproduct_services'] = array();
		
		foreach ($sproduct_services as $sproduct_service) {
			if (is_file(DIR_IMAGE . $sproduct_service['image'])) {
				$image = $sproduct_service['image'];
				$thumb = $sproduct_service['image'];
			} else {
				$image = '';
				$thumb = 'no_image.png';
			}

			$data['sproduct_services'][] = array(
				'image'      => $image,
				'thumb'      => $this->model_tool_image->resize($thumb, 100, 100),
				'price_min'  => $sproduct_service['price_min'],
				'price_max'  => $sproduct_service['price_max'],
				'sort_order' => $sproduct_service['sort_order'],
				'sproduct_service_description' => $sproduct_service['sproduct_service_description'],
			);
		}
		// end Tab Select Service
		
		
		// Tab Slide Service
		if (isset($this->error['warning_image_tab'])) {
			$data['error_warning_image_tab'] = $this->error['warning_image_tab'];
		} else {
			$data['error_warning_image_tab'] = '';
		}

		if (isset($this->error['warning_additional_tab'])) {
			$data['error_warning_additional_tab'] = $this->error['warning_additional_tab'];
		} else {
			$data['error_warning_additional_tab'] = '';
		}
		
		if (isset($this->error['warning_name_tab'])) {
			$data['error_warning_name_tab'] = $this->error['warning_name_tab'];
		} else {
			$data['error_warning_name_tab'] = '';
		}

		$sproduct_tab_services = array();

		if (isset($this->request->post['sproduct_tab_services'])) {
			$sproduct_tab_services = $this->request->post['sproduct_tab_services'];

		} elseif (isset($this->request->get['sproduct_id'])) {
			$sproduct_tab_services = $this->model_catalog_sproduct->getSproductsTabServices($this->request->get['sproduct_id']);

		}

		$data['sproduct_tab_services'] = array();
		
		foreach ($sproduct_tab_services as $sproduct_tab_service) {
			if (is_file(DIR_IMAGE . $sproduct_tab_service['image'])) {
				$image = $sproduct_tab_service['image'];
				$thumb = $sproduct_tab_service['image'];
			} else {
				$image = '';
				$thumb = 'no_image.png';
			}

			$data['sproduct_tab_services'][] = array(
				'image'      => $image,
				'thumb'      => $this->model_tool_image->resize($thumb, 100, 100),
				'price_min'  => $sproduct_tab_service['price_min'],
				'price_max'  => $sproduct_tab_service['price_max'],
				'sort_order' => $sproduct_tab_service['sort_order'],
				'sproduct_tab_service_description' => $sproduct_tab_service['sproduct_tab_service_description'],
			);
		}
		// end Tab Slide Service

		// Downloads
		$this->load->model('catalog/download');

		if (isset($this->request->post['sproduct_download'])) {
			$sproduct_downloads = $this->request->post['sproduct_download'];
		} elseif (isset($this->request->get['sproduct_id'])) {
			$sproduct_downloads = $this->model_catalog_sproduct->getSproductDownloads($this->request->get['sproduct_id']);
		} else {
			$sproduct_downloads = array();
		}

		$data['sproduct_downloads'] = array();

		foreach ($sproduct_downloads as $download_id) {
			$download_info = $this->model_catalog_download->getDownload($download_id);

			if ($download_info) {
				$data['sproduct_downloads'][] = array(
					'download_id' => $download_info['download_id'],
					'name'        => $download_info['name']
				);
			}
		}

		if (isset($this->request->post['sproduct_related'])) {
			$sproducts = $this->request->post['sproduct_related'];
		} elseif (isset($this->request->get['sproduct_id'])) {
			$sproducts = $this->model_catalog_sproduct->getSproductRelated($this->request->get['sproduct_id']);
		} else {
			$sproducts = array();
		}

		$data['sproduct_relateds'] = array();

		foreach ($sproducts as $sproduct_id) {
			$related_info = $this->model_catalog_sproduct->getSproduct($sproduct_id);

			if ($related_info) {
				$data['sproduct_relateds'][] = array(
					'sproduct_id' => $related_info['sproduct_id'],
					'name'       => $related_info['name']
				);
			}
		}

		if (isset($this->request->post['points'])) {
			$data['points'] = $this->request->post['points'];
		} elseif (!empty($sproduct_info)) {
			$data['points'] = $sproduct_info['points'];
		} else {
			$data['points'] = '';
		}

		if (isset($this->request->post['sproduct_reward'])) {
			$data['sproduct_reward'] = $this->request->post['sproduct_reward'];
		} elseif (isset($this->request->get['sproduct_id'])) {
			$data['sproduct_reward'] = $this->model_catalog_sproduct->getSproductRewards($this->request->get['sproduct_id']);
		} else {
			$data['sproduct_reward'] = array();
		}

		if (isset($this->request->post['sproduct_layout'])) {
			$data['sproduct_layout'] = $this->request->post['sproduct_layout'];
		} elseif (isset($this->request->get['sproduct_id'])) {
			$data['sproduct_layout'] = $this->model_catalog_sproduct->getSproductLayouts($this->request->get['sproduct_id']);
		} else {
			$data['sproduct_layout'] = array();
		}

		$this->load->model('design/layout');

		$data['layouts'] = $this->model_design_layout->getLayouts();

		$data['header'] = $this->load->controller('common/header');
		$data['column_left'] = $this->load->controller('common/column_left');
		$data['footer'] = $this->load->controller('common/footer');

		$this->response->setOutput($this->load->view('catalog/sproduct_form.tpl', $data));
	}

	protected function validateForm() {
		if (!$this->user->hasPermission('modify', 'catalog/sproduct')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		foreach ($this->request->post['sproduct_description'] as $language_id => $value) {
			if ((utf8_strlen($value['name']) < 3) || (utf8_strlen($value['name']) > 255)) {
				$this->error['name'][$language_id] = $this->language->get('error_name');
			}

			if ((utf8_strlen($value['meta_title']) < 3) || (utf8_strlen($value['meta_title']) > 255)) {
				$this->error['meta_title'][$language_id] = $this->language->get('error_meta_title');
			}
		}

		foreach($this->request->post['sproduct_services'] as $iteml){
			if(!isset($iteml['image']) or empty($iteml['image'])) {
				$this->error['warning_image'] = $this->language->get('error_simage');
			}

			foreach($iteml['sproduct_service_description'] as $elem) {
				if (!isset($elem['name']) or empty($elem['name'])) {
					$this->error['warning_name'] = $this->language->get('error_sname');
				}
			}
		}
		
		foreach($this->request->post['sproduct_tab_services'] as $iteml){
			if(!isset($iteml['image']) or empty($iteml['image'])) {
				$this->error['warning_image_tab'] = $this->language->get('error_simage_tab');
			}

			foreach($iteml['sproduct_tab_service_description'] as $elem) {
				if (!isset($elem['name']) or empty($elem['name'])) {
					$this->error['warning_name_tab'] = $this->language->get('error_sname_tab');
				}
				if (!isset($elem['additional']) or empty($elem['additional'])) {
					$this->error['warning_additional_tab'] = $this->language->get('error_sadditional_tab');
				}
			}
		}

//		if ((utf8_strlen($this->request->post['model']) < 1) || (utf8_strlen($this->request->post['model']) > 64)) {
//			$this->error['model'] = $this->language->get('error_model');
//		}

		if (utf8_strlen($this->request->post['keyword']) > 0) {
			$this->load->model('catalog/url_alias');

			$url_alias_info = $this->model_catalog_url_alias->getUrlAlias($this->request->post['keyword']);

			if ($url_alias_info && isset($this->request->get['sproduct_id']) && $url_alias_info['query'] != 'sproduct_id=' . $this->request->get['sproduct_id']) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}

			if ($url_alias_info && !isset($this->request->get['sproduct_id'])) {
				$this->error['keyword'] = sprintf($this->language->get('error_keyword'));
			}
		}

		if ($this->error && !isset($this->error['warning'])) {
			$this->error['warning'] = $this->language->get('error_warning');
		}

		return !$this->error;
	}

	protected function validateDelete() {
		if (!$this->user->hasPermission('modify', 'catalog/sproduct')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}

	protected function validateCopy() {
		if (!$this->user->hasPermission('modify', 'catalog/sproduct')) {
			$this->error['warning'] = $this->language->get('error_permission');
		}

		return !$this->error;
	}


    public function fastUpdate() {
        print_r($this->request->post);
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && !empty($this->request->post)){
            $this->load->model('catalog/sproduct');
            if(isset($this->request->post['name']) && isset($this->request->post['pk']) && isset($this->request->post['value'])) {
                $this->model_catalog_sproduct->fastUpdate($this->request->post['name'], $this->request->post['pk'], $this->request->post['value']);
            }
        }
    }
    public function editSproductSpecial() {
        if (($this->request->server['REQUEST_METHOD'] == 'POST') && !empty($this->request->post)){
            $this->load->model('catalog/sproduct');
            if(isset($this->request->post['name']) && isset($this->request->post['pk']) && isset($this->request->post['value'])) {
                $s =  $this->model_catalog_sproduct->priceFromListUpdate($this->request->post['pk'], $this->request->post['value']);
            }
        }
    }
    public function autocomplete_services() {
        $json = array();

        if (isset($this->request->get['filter_service'])) {
            $this->load->model('catalog/service');

            if (isset($this->request->get['filter_service'])) {
                $filter_service = $this->request->get['filter_service'];
            } else {
                $filter_service = '';
            }

            if (isset($this->request->get['limit'])) {
                $limit = $this->request->get['limit'];
            } else {
                $limit = 100;
            }

            $filter_data = array(
                'filter_name' => $filter_service,
                'start'        => 0,
                'limit'        => $limit
            );

            $results = $this->model_catalog_service->getServices($filter_data);

            foreach ($results as $result) {
                $json[] = array(
                    'service_id' => $result['service_id'],
                    'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8'))
                );
            }
        }

        $this->response->addHeader('Content-Type: application/json');
        $this->response->setOutput(json_encode($json));
    }


    public function autocomplete() {
		$json = array();

		if (isset($this->request->get['filter_name']) || isset($this->request->get['filter_model'])) {
			$this->load->model('catalog/sproduct');
			$this->load->model('catalog/option');

			if (isset($this->request->get['filter_name'])) {
				$filter_name = $this->request->get['filter_name'];
			} else {
				$filter_name = '';
			}

			if (isset($this->request->get['filter_model'])) {
				$filter_model = $this->request->get['filter_model'];
			} else {
				$filter_model = '';
			}

			if (isset($this->request->get['limit'])) {
				$limit = $this->request->get['limit'];
			} else {
				$limit = 5;
			}

			$filter_data = array(
				'filter_name'  => $filter_name,
				'filter_model' => $filter_model,
				'start'        => 0,
				'limit'        => $limit
			);

			$results = $this->model_catalog_sproduct->getSproducts($filter_data);

			foreach ($results as $result) {
				$option_data = array();

				$sproduct_options = $this->model_catalog_sproduct->getSproductOptions($result['sproduct_id']);

				foreach ($sproduct_options as $sproduct_option) {
					$option_info = $this->model_catalog_option->getOption($sproduct_option['option_id']);

					if ($option_info) {
						$sproduct_option_value_data = array();

						foreach ($sproduct_option['sproduct_option_value'] as $sproduct_option_value) {
							$option_value_info = $this->model_catalog_option->getOptionValue($sproduct_option_value['option_value_id']);

							if ($option_value_info) {
								$sproduct_option_value_data[] = array(
									'sproduct_option_value_id' => $sproduct_option_value['sproduct_option_value_id'],
									'option_value_id'         => $sproduct_option_value['option_value_id'],
									'name'                    => $option_value_info['name'],
									'price'                   => (float)$sproduct_option_value['price'] ? $this->currency->format($sproduct_option_value['price'], $this->config->get('config_currency')) : false,
									'price_prefix'            => $sproduct_option_value['price_prefix']
								);
							}
						}

						$option_data[] = array(
							'sproduct_option_id'    => $sproduct_option['sproduct_option_id'],
							'sproduct_option_value' => $sproduct_option_value_data,
							'option_id'            => $sproduct_option['option_id'],
							'name'                 => $option_info['name'],
							'type'                 => $option_info['type'],
							'value'                => $sproduct_option['value'],
							'required'             => $sproduct_option['required']
						);
					}
				}

				$json[] = array(
					'sproduct_id' => $result['sproduct_id'],
					'name'       => strip_tags(html_entity_decode($result['name'], ENT_QUOTES, 'UTF-8')),
					'model'      => $result['model'],
					'sku'        => $result['sku'],
					'option'     => $option_data,
					'price'      => $result['price']
				);
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}