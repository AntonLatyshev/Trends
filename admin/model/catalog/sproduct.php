<?php
class ModelCatalogSproduct extends Model {
	public function addSproduct($data) {
		//$this->event->trigger('pre.admin.sproduct.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct SET
		model = '" . $this->db->escape($data['model']) . "',
		sku = '" . $this->db->escape($data['sku']) . "',
            promo_top_right = '" . (int)$data['promo_top_right'] . "',
            promo_top_left = '',
            promo_bottom_right = '',
            promo_bottom_left = '',
            promo_date_start = '" . $this->db->escape($data['promo_date_start']) . "',
            promo_date_end = '" . $this->db->escape($data['promo_date_end']) . "',
		upc = '" . $this->db->escape($data['upc']) . "', ean = '" . $this->db->escape($data['ean']) . "', jan = '" . $this->db->escape($data['jan']) . "', isbn = '" . $this->db->escape($data['isbn']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', location = '" . $this->db->escape($data['location']) . "', quantity = '" . (int)$data['quantity'] . "', minimum = '" . (int)$data['minimum'] . "', subtract = '" . (int)$data['subtract'] . "', stock_status_id = '" . (int)$data['stock_status_id'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int)$data['manufacturer_id'] . "', shipping = '" . (int)$data['shipping'] . "', price = '" . (float)$data['price'] . "', points = '" . (int)$data['points'] . "', weight = '" . (float)$data['weight'] . "', weight_class_id = '" . (int)$data['weight_class_id'] . "', length = '" . (float)$data['length'] . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', length_class_id = '" . (int)$data['length_class_id'] . "', status = '" . (int)$data['status'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_added = NOW()");

		$sproduct_id = $this->db->getLastId();
                
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "sproduct SET image = '" . $this->db->escape($data['image']) . "' WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		}
		
		if (isset($data['image_bg'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "sproduct SET image_bg = '" . $this->db->escape($data['image_bg']) . "' WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		}
		
		if (isset($data['image_list'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "sproduct SET image_list = '" . $this->db->escape($data['image_list']) . "' WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		}
		
		if (isset($data['image_nf'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "sproduct SET image_nf = '" . $this->db->escape($data['image_nf']) . "' WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		}
		
		if (isset($data['image_trigger'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "sproduct SET image_trigger = '" . $this->db->escape($data['image_trigger']) . "' WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		}
		
		if (isset($data['image_add'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "sproduct SET image_add = '" . $this->db->escape($data['image_add']) . "' WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		}

		foreach ($data['sproduct_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_description SET sproduct_id = '" . (int)$sproduct_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', description_short = '" . $this->db->escape($value['description_short']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		if (isset($data['sproduct_store'])) {
			foreach ($data['sproduct_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_to_store SET sproduct_id = '" . (int)$sproduct_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		if (isset($data['sproduct_attribute'])) {
			foreach ($data['sproduct_attribute'] as $sproduct_attribute) {
				if ($sproduct_attribute['attribute_id']) {
					foreach ($sproduct_attribute['sproduct_attribute_description'] as $language_id => $sproduct_attribute_description) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_attribute SET sproduct_id = '" . (int)$sproduct_id . "', attribute_id = '" . (int)$sproduct_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($sproduct_attribute_description['text']) . "'");
					}
				}
			}
		}

		if (isset($data['sproduct_option'])) {
			foreach ($data['sproduct_option'] as $sproduct_option) {
				if ($sproduct_option['type'] == 'select' || $sproduct_option['type'] == 'radio' || $sproduct_option['type'] == 'checkbox' || $sproduct_option['type'] == 'image') {
					if (isset($sproduct_option['sproduct_option_value'])) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_option SET sproduct_id = '" . (int)$sproduct_id . "', option_id = '" . (int)$sproduct_option['option_id'] . "', required = '" . (int)$sproduct_option['required'] . "'");

						$sproduct_option_id = $this->db->getLastId();

						foreach ($sproduct_option['sproduct_option_value'] as $sproduct_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_option_value SET sproduct_option_id = '" . (int)$sproduct_option_id . "', sproduct_id = '" . (int)$sproduct_id . "', option_id = '" . (int)$sproduct_option['option_id'] . "', option_value_id = '" . (int)$sproduct_option_value['option_value_id'] . "', quantity = '" . (int)$sproduct_option_value['quantity'] . "', subtract = '" . (int)$sproduct_option_value['subtract'] . "', price = '" . (float)$sproduct_option_value['price'] . "', price_prefix = '" . $this->db->escape($sproduct_option_value['price_prefix']) . "', points = '" . (int)$sproduct_option_value['points'] . "', points_prefix = '" . $this->db->escape($sproduct_option_value['points_prefix']) . "', weight = '" . (float)$sproduct_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($sproduct_option_value['weight_prefix']) . "'");
						}
					}
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_option SET sproduct_id = '" . (int)$sproduct_id . "', option_id = '" . (int)$sproduct_option['option_id'] . "', value = '" . $this->db->escape($sproduct_option['value']) . "', required = '" . (int)$sproduct_option['required'] . "'");
				}
			}
		}

		if (isset($data['sproduct_discount'])) {

			foreach ($data['sproduct_discount'] as $sproduct_discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_discount SET sproduct_id = '" . (int)$sproduct_id . "', customer_group_id = '" . (int)$sproduct_discount['customer_group_id'] . "', quantity = '" . (int)$sproduct_discount['quantity'] . "', priority = '" . (int)$sproduct_discount['priority'] . "', price = '" . (float)$sproduct_discount['price'] . "', date_start = '" . $this->db->escape($sproduct_discount['date_start']) . "', date_end = '" . $this->db->escape($sproduct_discount['date_end']) . "'");
                        }
		}

		if (isset($data['sproduct_special'])) {

			foreach ($data['sproduct_special'] as $sproduct_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_special SET sproduct_id = '" . (int)$sproduct_id . "', customer_group_id = '" . (int)$sproduct_special['customer_group_id'] . "', priority = '" . (int)$sproduct_special['priority'] . "', price = '" . (float)$sproduct_special['price'] . "', date_start = '" . $this->db->escape($sproduct_special['date_start']) . "', date_end = '" . $this->db->escape($sproduct_special['date_end']) . "'");
                        }
                }

		if (isset($data['sproduct_image'])) {
			foreach ($data['sproduct_image'] as $sproduct_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_image SET sproduct_id = '" . (int)$sproduct_id . "', image = '" . $this->db->escape($sproduct_image['image']) . "', sort_order = '" . (int)$sproduct_image['sort_order'] . "'");
				$sproduct_image_id = $this->db->getLastId();

				foreach ($sproduct_image['sproduct_image_description'] as $language_id => $sproduct_image_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_image_description SET sproduct_id = '" . (int)$sproduct_id . "', sproduct_image_id = '" . $sproduct_image_id . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($sproduct_image_description['text']) . "'");
				}
			}
		}

		if (isset($data['sproduct_services'])) {
			foreach ($data['sproduct_services'] as $sproduct_services) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_service SET sproduct_id = '" . (int)$sproduct_id . "', image = '" . $this->db->escape($sproduct_services['image']) . "', price_min = '" . (float)$sproduct_services['price_min'] . "', price_max = '" . (float)$sproduct_services['price_max'] . "', sort_order = '" . (int)$sproduct_services['sort_order'] . "'");
				$sproduct_service_id = $this->db->getLastId();

				foreach ($sproduct_services['sproduct_service_description'] as $language_id => $sproduct_service_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_service_description SET sproduct_id = '" . (int)$sproduct_id . "', sproduct_service_id = '" . $sproduct_service_id . "', language_id = '" . (int)$language_id . "', name = '" .  $this->db->escape($sproduct_service_description['name']) . "', additional = '" .  $this->db->escape($sproduct_service_description['additional']) . "', description = '" .  $this->db->escape(trim(html_entity_decode($sproduct_service_description['description']))) . "'");
				}
			}
		}

		if (isset($data['sproduct_tab_services'])) {
			foreach ($data['sproduct_tab_services'] as $sproduct_tab_services) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_tab_service SET sproduct_id = '" . (int)$sproduct_id . "', image = '" . $this->db->escape($sproduct_tab_services['image']) . "', price_min = '" . (float)$sproduct_tab_services['price_min'] . "', price_max = '" . (float)$sproduct_tab_services['price_max'] . "', sort_order = '" . (int)$sproduct_tab_services['sort_order'] . "'");
				$sproduct_tab_service_id = $this->db->getLastId();

				foreach ($sproduct_tab_services['sproduct_tab_service_description'] as $language_id => $sproduct_tab_service_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_tab_service_description SET sproduct_id = '" . (int)$sproduct_id . "', sproduct_tab_service_id = '" . $sproduct_tab_service_id . "', language_id = '" . (int)$language_id . "', name = '" .  $this->db->escape($sproduct_tab_service_description['name']) . "', additional = '" .  $this->db->escape($sproduct_tab_service_description['additional']) . "', description = '" .  $this->db->escape(trim(html_entity_decode($sproduct_tab_service_description['description']))) . "'");
				}
			}
		}

		if (isset($data['sproduct_download'])) {
			foreach ($data['sproduct_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_to_download SET sproduct_id = '" . (int)$sproduct_id . "', download_id = '" . (int)$download_id . "'");
			}
		}

		if (isset($data['sproduct_service'])) {
			foreach ($data['sproduct_service'] as $service_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_to_service SET sproduct_id = '" . (int)$sproduct_id . "', service_id = '" . (int)$service_id . "'");
			}
		}

		if (isset($data['sproduct_filter'])) {
			foreach ($data['sproduct_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_filter SET sproduct_id = '" . (int)$sproduct_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		if (isset($data['sproduct_related'])) {
			foreach ($data['sproduct_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_related WHERE sproduct_id = '" . (int)$sproduct_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_related SET sproduct_id = '" . (int)$sproduct_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_related WHERE sproduct_id = '" . (int)$related_id . "' AND related_id = '" . (int)$sproduct_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_related SET sproduct_id = '" . (int)$related_id . "', related_id = '" . (int)$sproduct_id . "'");
			}
		}

		if (isset($data['sproduct_reward'])) {
			foreach ($data['sproduct_reward'] as $customer_group_id => $sproduct_reward) {
				if ((int)$sproduct_reward['points'] > 0) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_reward SET sproduct_id = '" . (int)$sproduct_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$sproduct_reward['points'] . "'");
				}
			}
		}

		if (isset($data['sproduct_layout'])) {
			foreach ($data['sproduct_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_to_layout SET sproduct_id = '" . (int)$sproduct_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'sproduct_id=" . (int)$sproduct_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		if (isset($data['sproduct_recurrings'])) {
			foreach ($data['sproduct_recurrings'] as $recurring) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "sproduct_recurring` SET `sproduct_id` = " . (int)$sproduct_id . ", customer_group_id = " . (int)$recurring['customer_group_id'] . ", `recurring_id` = " . (int)$recurring['recurring_id']);
			}
		}

		$this->cache->delete('sproduct');

		//$this->event->trigger('post.admin.sproduct.add', $sproduct_id);

		return $sproduct_id;
	}

	public function editSproduct($sproduct_id, $data) {
		//$this->event->trigger('pre.admin.sproduct.edit', $data);

		$this->db->query("
			UPDATE
				" . DB_PREFIX . "sproduct
			SET
				model = '" . $this->db->escape($data['model']) . "',
				sku = '" . $this->db->escape($data['sku']) . "',
				upc = '" . $this->db->escape($data['upc']) . "',
				promo_top_right = '" . (int)$data['promo_top_right'] . "',
				promo_top_left = '',
				promo_bottom_right = '',
				promo_bottom_left = '',
				promo_date_start = '" . $this->db->escape($data['promo_date_start']) . "',
				promo_date_end = '" . $this->db->escape($data['promo_date_end']) . "',
				ean = '" . $this->db->escape($data['ean']) . "', jan = '" . $this->db->escape($data['jan']) . "', isbn = '" . $this->db->escape($data['isbn']) . "', mpn = '" . $this->db->escape($data['mpn']) . "', location = '" . $this->db->escape($data['location']) . "', quantity = '" . (int)$data['quantity'] . "', minimum = '" . (int)$data['minimum'] . "', subtract = '" . (int)$data['subtract'] . "', stock_status_id = '" . (int)$data['stock_status_id'] . "', date_available = '" . $this->db->escape($data['date_available']) . "', manufacturer_id = '" . (int)$data['manufacturer_id'] . "', shipping = '" . (int)$data['shipping'] . "', price = '" . (float)$data['price'] . "', points = '" . (int)$data['points'] . "', weight = '" . (float)$data['weight'] . "', weight_class_id = '" . (int)$data['weight_class_id'] . "', length = '" . (float)$data['length'] . "', width = '" . (float)$data['width'] . "', height = '" . (float)$data['height'] . "', length_class_id = '" . (int)$data['length_class_id'] . "', status = '" . (int)$data['status'] . "', tax_class_id = '" . (int)$data['tax_class_id'] . "', sort_order = '" . (int)$data['sort_order'] . "', date_modified = NOW() WHERE sproduct_id = '" . (int)$sproduct_id . "'");
                
		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "sproduct SET image = '" . $this->db->escape($data['image']) . "' WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		}
		
		if (isset($data['image_bg'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "sproduct SET image_bg = '" . $this->db->escape($data['image_bg']) . "' WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		}

		if (isset($data['image_list'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "sproduct SET image_list = '" . $this->db->escape($data['image_list']) . "' WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		}

		if (isset($data['image_nf'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "sproduct SET image_nf = '" . $this->db->escape($data['image_nf']) . "' WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		}

		if (isset($data['image_trigger'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "sproduct SET image_trigger = '" . $this->db->escape($data['image_trigger']) . "' WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		}

		if (isset($data['image_add'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "sproduct SET image_add = '" . $this->db->escape($data['image_add']) . "' WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_description WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		foreach ($data['sproduct_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_description SET sproduct_id = '" . (int)$sproduct_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', description_short = '" . $this->db->escape($value['description_short']) . "', tag = '" . $this->db->escape($value['tag']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_to_store WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		if (isset($data['sproduct_store'])) {
			foreach ($data['sproduct_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_to_store SET sproduct_id = '" . (int)$sproduct_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_attribute WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		if (!empty($data['sproduct_attribute'])) {
			foreach ($data['sproduct_attribute'] as $sproduct_attribute) {
				if ($sproduct_attribute['attribute_id']) {
					foreach ($sproduct_attribute['sproduct_attribute_description'] as $language_id => $sproduct_attribute_description) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_attribute SET sproduct_id = '" . (int)$sproduct_id . "', attribute_id = '" . (int)$sproduct_attribute['attribute_id'] . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($sproduct_attribute_description['text']) . "'");
					}
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_option WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_option_value WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		if (isset($data['sproduct_option'])) {
			foreach ($data['sproduct_option'] as $sproduct_option) {
				if ($sproduct_option['type'] == 'select' || $sproduct_option['type'] == 'radio' || $sproduct_option['type'] == 'checkbox' || $sproduct_option['type'] == 'image') {
					if (isset($sproduct_option['sproduct_option_value'])) {
						$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_option SET sproduct_option_id = '" . (int)$sproduct_option['sproduct_option_id'] . "', sproduct_id = '" . (int)$sproduct_id . "', option_id = '" . (int)$sproduct_option['option_id'] . "', required = '" . (int)$sproduct_option['required'] . "'");

						$sproduct_option_id = $this->db->getLastId();

						foreach ($sproduct_option['sproduct_option_value'] as $sproduct_option_value) {
							$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_option_value SET sproduct_option_value_id = '" . (int)$sproduct_option_value['sproduct_option_value_id'] . "', sproduct_option_id = '" . (int)$sproduct_option_id . "', sproduct_id = '" . (int)$sproduct_id . "', option_id = '" . (int)$sproduct_option['option_id'] . "', option_value_id = '" . (int)$sproduct_option_value['option_value_id'] . "', quantity = '" . (int)$sproduct_option_value['quantity'] . "', subtract = '" . (int)$sproduct_option_value['subtract'] . "', price = '" . (float)$sproduct_option_value['price'] . "', price_prefix = '" . $this->db->escape($sproduct_option_value['price_prefix']) . "', points = '" . (int)$sproduct_option_value['points'] . "', points_prefix = '" . $this->db->escape($sproduct_option_value['points_prefix']) . "', weight = '" . (float)$sproduct_option_value['weight'] . "', weight_prefix = '" . $this->db->escape($sproduct_option_value['weight_prefix']) . "', sproduct_option_image = '" . $sproduct_option_value['sproduct_option_image'] . "'");
						}
					}
				} else {
					$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_option SET sproduct_option_id = '" . (int)$sproduct_option['sproduct_option_id'] . "', sproduct_id = '" . (int)$sproduct_id . "', option_id = '" . (int)$sproduct_option['option_id'] . "', value = '" . $this->db->escape($sproduct_option['value']) . "', required = '" . (int)$sproduct_option['required'] . "'");
				}
			}
		}

                $this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_discount WHERE sproduct_id = '" . (int)$sproduct_id . "'");
                
                if (isset($data['sproduct_discount'])) {
                    

			foreach ($data['sproduct_discount'] as $sproduct_discount) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_discount SET sproduct_id = '" . (int)$sproduct_id . "', customer_group_id = '" . (int)$sproduct_discount['customer_group_id'] . "', quantity = '" . (int)$sproduct_discount['quantity'] . "', priority = '" . (int)$sproduct_discount['priority'] . "', price = '" . (float)$sproduct_discount['price'] . "', date_start = '" . $this->db->escape($sproduct_discount['date_start']) . "', date_end = '" . $this->db->escape($sproduct_discount['date_end']) . "'");  
                        }
		}
                
                $this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_special WHERE sproduct_id = '" . (int)$sproduct_id . "'");
                
		if (isset($data['sproduct_special'])) {
			foreach ($data['sproduct_special'] as $sproduct_special) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_special SET sproduct_id = '" . (int)$sproduct_id . "', customer_group_id = '" . (int)$sproduct_special['customer_group_id'] . "', priority = '" . (int)$sproduct_special['priority'] . "', price = '" . (float)$sproduct_special['price'] . "', date_start = '" . $this->db->escape($sproduct_special['date_start']) . "', date_end = '" . $this->db->escape($sproduct_special['date_end']) . "'");
                        }
		}
                
                
                
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_image WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_image_description WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		if (isset($data['sproduct_image'])) {
			foreach ($data['sproduct_image'] as $sproduct_image) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_image SET sproduct_id = '" . (int)$sproduct_id . "', image = '" . $this->db->escape($sproduct_image['image']) . "', sort_order = '" . (int)$sproduct_image['sort_order'] . "'");
				$sproduct_image_id = $this->db->getLastId();

				foreach ($sproduct_image['sproduct_image_description'] as $language_id => $sproduct_image_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_image_description SET sproduct_id = '" . (int)$sproduct_id . "', sproduct_image_id = '" . $sproduct_image_id . "', language_id = '" . (int)$language_id . "', text = '" .  $this->db->escape($sproduct_image_description['text']) . "'");
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_service WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_service_description WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		
		if (isset($data['sproduct_services'])) {
			foreach ($data['sproduct_services'] as $sproduct_services) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_service SET sproduct_id = '" . (int)$sproduct_id . "', image = '" . $this->db->escape($sproduct_services['image']) . "', price_min = '" . (float)$sproduct_services['price_min'] . "', price_max = '" . (float)$sproduct_services['price_max'] . "', sort_order = '" . (int)$sproduct_services['sort_order'] . "'");
				$sproduct_service_id = $this->db->getLastId();

				foreach ($sproduct_services['sproduct_service_description'] as $language_id => $sproduct_service_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_service_description SET sproduct_id = '" . (int)$sproduct_id . "', sproduct_service_id = '" . $sproduct_service_id . "', language_id = '" . (int)$language_id . "', name = '" .  $this->db->escape($sproduct_service_description['name']) . "', additional = '" .  $this->db->escape($sproduct_service_description['additional']) . "', description = '" .  $this->db->escape(trim(html_entity_decode($sproduct_service_description['description']))) . "'");
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_tab_service WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_tab_service_description WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		if (isset($data['sproduct_tab_services'])) {
			foreach ($data['sproduct_tab_services'] as $sproduct_tab_services) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_tab_service SET sproduct_id = '" . (int)$sproduct_id . "', image = '" . $this->db->escape($sproduct_tab_services['image']) . "', price_min = '" . (float)$sproduct_tab_services['price_min'] . "', price_max = '" . (float)$sproduct_tab_services['price_max'] . "', sort_order = '" . (int)$sproduct_tab_services['sort_order'] . "'");
				$sproduct_tab_service_id = $this->db->getLastId();

				foreach ($sproduct_tab_services['sproduct_tab_service_description'] as $language_id => $sproduct_tab_service_description) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_tab_service_description SET sproduct_id = '" . (int)$sproduct_id . "', sproduct_tab_service_id = '" . $sproduct_tab_service_id . "', language_id = '" . (int)$language_id . "', name = '" .  $this->db->escape($sproduct_tab_service_description['name']) . "', additional = '" .  $this->db->escape($sproduct_tab_service_description['additional']) . "', description = '" .  $this->db->escape(trim(html_entity_decode($sproduct_tab_service_description['description']))) . "'");
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_to_download WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		if (isset($data['sproduct_download'])) {
			foreach ($data['sproduct_download'] as $download_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_to_download SET sproduct_id = '" . (int)$sproduct_id . "', download_id = '" . (int)$download_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_to_service WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		if (isset($data['sproduct_service'])) {
			foreach ($data['sproduct_service'] as $service_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_to_service SET sproduct_id = '" . (int)$sproduct_id . "', service_id = '" . (int)$service_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_filter WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		if (isset($data['sproduct_filter'])) {
			foreach ($data['sproduct_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_filter SET sproduct_id = '" . (int)$sproduct_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_related WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_related WHERE related_id = '" . (int)$sproduct_id . "'");

		if (isset($data['sproduct_related'])) {
			foreach ($data['sproduct_related'] as $related_id) {
				$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_related WHERE sproduct_id = '" . (int)$sproduct_id . "' AND related_id = '" . (int)$related_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_related SET sproduct_id = '" . (int)$sproduct_id . "', related_id = '" . (int)$related_id . "'");
				$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_related WHERE sproduct_id = '" . (int)$related_id . "' AND related_id = '" . (int)$sproduct_id . "'");
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_related SET sproduct_id = '" . (int)$related_id . "', related_id = '" . (int)$sproduct_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_reward WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		if (isset($data['sproduct_reward'])) {
			foreach ($data['sproduct_reward'] as $customer_group_id => $value) {
				if ((int)$value['points'] > 0) {
					$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_reward SET sproduct_id = '" . (int)$sproduct_id . "', customer_group_id = '" . (int)$customer_group_id . "', points = '" . (int)$value['points'] . "'");
				}
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_to_layout WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		if (isset($data['sproduct_layout'])) {
			foreach ($data['sproduct_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "sproduct_to_layout SET sproduct_id = '" . (int)$sproduct_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'sproduct_id=" . (int)$sproduct_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'sproduct_id=" . (int)$sproduct_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->db->query("DELETE FROM `" . DB_PREFIX . "sproduct_recurring` WHERE sproduct_id = " . (int)$sproduct_id);

		if (isset($data['sproduct_recurring'])) {
			foreach ($data['sproduct_recurring'] as $sproduct_recurring) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "sproduct_recurring` SET `sproduct_id` = " . (int)$sproduct_id . ", customer_group_id = " . (int)$sproduct_recurring['customer_group_id'] . ", `recurring_id` = " . (int)$sproduct_recurring['recurring_id']);
			}
		}

		$this->cache->delete('sproduct');

		//$this->event->trigger('post.admin.sproduct.edit', $sproduct_id);
	}

	/*code start*/
	public function getPromoTags($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "promo_tags";

			$sort_data = array(
				'promo_text',
				'sort_order'
			);

			if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
				$sql .= " ORDER BY " . $data['sort'];
			} else {
				$sql .= " ORDER BY promo_tags_id";
			}

			if (isset($data['order']) && ($data['order'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}

			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}

				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}

			$query = $this->db->query($sql);

			return $query->rows;
		} else {
			$promotags_data = $this->cache->get('promotags');

			if (!$promotags_data) {
				$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "promo_tags ORDER BY promo_tags_id");

				$promotags_data = $query->rows;

				$this->cache->set('promotags', $promotags_data);
			}

			return $promotags_data;
		}
	}
	/*code end*/

	public function copySproduct($sproduct_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "sproduct p LEFT JOIN " . DB_PREFIX . "sproduct_description pd ON (p.sproduct_id = pd.sproduct_id) WHERE p.sproduct_id = '" . (int)$sproduct_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		if ($query->num_rows) {
			$data = $query->row;

			$data['sku'] = '';
			$data['upc'] = '';
			$data['viewed'] = '0';
			$data['keyword'] = '';
			$data['status'] = '0';

			$data['sproduct_attribute'] = $this->getSproductAttributes($sproduct_id);
			$data['sproduct_description'] = $this->getSproductDescriptions($sproduct_id);
			$data['sproduct_discount'] = $this->getSproductDiscounts($sproduct_id);
			$data['sproduct_filter'] = $this->getSproductFilters($sproduct_id);
			$data['sproduct_image'] = $this->getSproductImages($sproduct_id);
			$data['sproduct_services'] = $this->getSproductsServices($sproduct_id);
			$data['sproduct_tab_services'] = $this->getSproductsTabServices($sproduct_id);
			$data['sproduct_option'] = $this->getSproductOptions($sproduct_id);
			$data['sproduct_related'] = $this->getSproductRelated($sproduct_id);
			$data['sproduct_reward'] = $this->getSproductRewards($sproduct_id);
			$data['sproduct_special'] = $this->getSproductSpecials($sproduct_id);
			$data['sproduct_service'] = $this->getSproductServices($sproduct_id);
			$data['sproduct_download'] = $this->getSproductDownloads($sproduct_id);
			$data['sproduct_layout'] = $this->getSproductLayouts($sproduct_id);
			$data['sproduct_store'] = $this->getSproductStores($sproduct_id);
			$data['sproduct_recurrings'] = $this->getRecurrings($sproduct_id);

			$this->addSproduct($data);
		}
	}

	public function deleteSproduct($sproduct_id) {
		//$this->event->trigger('pre.admin.sproduct.delete', $sproduct_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_attribute WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_description WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_discount WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_filter WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_image WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_image_description WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_service WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_service_description WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_tab_service WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_tab_service_description WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_option WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_option_value WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_related WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_related WHERE related_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_reward WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_special WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_to_service WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_to_download WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_to_layout WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_to_store WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE sproduct_id = '" . (int)$sproduct_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "sproduct_recurring WHERE sproduct_id = " . (int)$sproduct_id);
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'sproduct_id=" . (int)$sproduct_id . "'");

		$this->cache->delete('sproduct');

		//$this->event->trigger('post.admin.sproduct.delete', $sproduct_id);
	}

	public function getPoductCustomFields($sproduct_id) {
		$query = $this->db->query("SELECT custom_field FROM " . DB_PREFIX . "sproduct WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		return $query->row['custom_field'];
	}

	public function editCustomFields($sproduct_id, $data) {
		//$this->event->trigger('pre.admin.sproduct.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "sproduct SET custom_field = '" . $this->db->escape($data) . "', date_modified = NOW() WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		$this->cache->delete('sproduct');

		//$this->event->trigger('post.admin.sproduct.edit', $sproduct_id);
	}

	public function getSproduct($sproduct_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'sproduct_id=" . (int)$sproduct_id . "') AS keyword FROM " . DB_PREFIX . "sproduct p LEFT JOIN " . DB_PREFIX . "sproduct_description pd ON (p.sproduct_id = pd.sproduct_id) WHERE p.sproduct_id = '" . (int)$sproduct_id . "' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

    function getManufacturerById($manufacturer_id){
        $sproduct_manufacturer_name = array();
        $query = $this->db->query("SELECT name FROM " . DB_PREFIX . "manufacturer WHERE manufacturer_id  = '" . (int)$manufacturer_id . "'");
        foreach ($query->rows as $result) {
            $sproduct_manufacturer_name = $result['name'];
        }

        return $sproduct_manufacturer_name;

    }

	public function getSproducts($data = array()) {
        $sql = "SELECT * FROM " . DB_PREFIX . "sproduct p LEFT JOIN " . DB_PREFIX . "sproduct_description pd ON (p.sproduct_id = pd.sproduct_id) ";

        if (!empty($data['filter_service_id'])) {

            //echo "SELECT service_id FROM " . DB_PREFIX . "service_description WHERE name = '" . $data['filter_service'] . "' LIMIT 1";

            // $service_id = $this->db->query("SELECT service_id FROM " . DB_PREFIX . "service_description WHERE name = '" . $data['filter_service'] . "' LIMIT 1")->row['service_id'];
            $sql .= " LEFT JOIN " . DB_PREFIX . "sproduct_to_service pc ON (p.sproduct_id = pc.sproduct_id)";
        }

        $sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') ."'";

        if (!empty($data['filter_service_id'])) {
            $sql .= " AND pc.service_id = '" . $data['filter_service_id'] . "'";
        }

        if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		if (!empty($data['filter_model'])) {
			$sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
		}

		if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
			$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}

		if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
			$sql .= " AND p.quantity = '" . (int)$data['filter_quantity'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}
		
		$sql .= " GROUP BY p.sproduct_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'p.price',
			'p.quantity',
			'p.status',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY pd.name";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC";
		} else {
			$sql .= " ASC";
		}

		if (isset($data['start']) || isset($data['limit'])) {
			if ($data['start'] < 0) {
				$data['start'] = 0;
			}

			if ($data['limit'] < 1) {
				$data['limit'] = 20;
			}

			$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
		}

		$query = $this->db->query($sql);

		return $query->rows;
	}

	public function getSproductsByServiceId($service_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct p LEFT JOIN " . DB_PREFIX . "sproduct_description pd ON (p.sproduct_id = pd.sproduct_id) LEFT JOIN " . DB_PREFIX . "sproduct_to_service p2c ON (p.sproduct_id = p2c.sproduct_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p2c.service_id = '" . (int)$service_id . "' ORDER BY pd.name ASC");

		return $query->rows;
	}

	public function getSproductDescriptions($sproduct_id) {
		$sproduct_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_description WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		foreach ($query->rows as $result) {
			$sproduct_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description'],
				'description_short'      => $result['description_short'],
				'meta_title'       => $result['meta_title'],
				'meta_description' => $result['meta_description'],
				'meta_keyword'     => $result['meta_keyword'],
				'tag'              => $result['tag']
			);
		}

		return $sproduct_description_data;
	}

	public function getSproductServices($sproduct_id) {
		$sproduct_service_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_to_service WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		foreach ($query->rows as $result) {
			$sproduct_service_data[] = $result['service_id'];
		}

		return $sproduct_service_data;
	}

	public function getSproductFilters($sproduct_id) {
		$sproduct_filter_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_filter WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		foreach ($query->rows as $result) {
			$sproduct_filter_data[] = $result['filter_id'];
		}

		return $sproduct_filter_data;
	}

	public function getSproductAttributes($sproduct_id) {
		$sproduct_attribute_data = array();

		$sproduct_attribute_query = $this->db->query("SELECT attribute_id FROM " . DB_PREFIX . "sproduct_attribute WHERE sproduct_id = '" . (int)$sproduct_id . "' GROUP BY attribute_id");

		foreach ($sproduct_attribute_query->rows as $sproduct_attribute) {
			$sproduct_attribute_description_data = array();

			$sproduct_attribute_description_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_attribute WHERE sproduct_id = '" . (int)$sproduct_id . "' AND attribute_id = '" . (int)$sproduct_attribute['attribute_id'] . "'");

			foreach ($sproduct_attribute_description_query->rows as $sproduct_attribute_description) {
				$sproduct_attribute_description_data[$sproduct_attribute_description['language_id']] = array('text' => $sproduct_attribute_description['text']);
			}

			$sproduct_attribute_data[] = array(
				'attribute_id'                  => $sproduct_attribute['attribute_id'],
				'sproduct_attribute_description' => $sproduct_attribute_description_data
			);
		}

		return $sproduct_attribute_data;
	}

	public function getSproductOptions($sproduct_id) {
		$sproduct_option_data = array();

		$sproduct_option_query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "sproduct_option` po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN `" . DB_PREFIX . "option_description` od ON (o.option_id = od.option_id) WHERE po.sproduct_id = '" . (int)$sproduct_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		foreach ($sproduct_option_query->rows as $sproduct_option) {
			$sproduct_option_value_data = array();

			$sproduct_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_option_value WHERE sproduct_option_id = '" . (int)$sproduct_option['sproduct_option_id'] . "'");

			foreach ($sproduct_option_value_query->rows as $sproduct_option_value) {
				$sproduct_option_value_data[] = array(
					'sproduct_option_value_id' => $sproduct_option_value['sproduct_option_value_id'],
					'option_value_id'         => $sproduct_option_value['option_value_id'],
					'quantity'                => $sproduct_option_value['quantity'],
					'subtract'                => $sproduct_option_value['subtract'],
					'price'                   => $sproduct_option_value['price'],
					'price_prefix'            => $sproduct_option_value['price_prefix'],
					'points'                  => $sproduct_option_value['points'],
					'points_prefix'           => $sproduct_option_value['points_prefix'],
					'weight'                  => $sproduct_option_value['weight'],
					'weight_prefix'           => $sproduct_option_value['weight_prefix'],
                    'sproduct_option_image'	  => $sproduct_option_value['sproduct_option_image']
				);
			}

			$sproduct_option_data[] = array(
				'sproduct_option_id'    => $sproduct_option['sproduct_option_id'],
				'sproduct_option_value' => $sproduct_option_value_data,
				'option_id'            => $sproduct_option['option_id'],
				'name'                 => $sproduct_option['name'],
				'type'                 => $sproduct_option['type'],
				'value'                => $sproduct_option['value'],
				'required'             => $sproduct_option['required']
			);
		}

		return $sproduct_option_data;
	}

	public function getSproductImages($sproduct_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_image WHERE sproduct_id = '" . (int)$sproduct_id . "' ORDER BY sort_order ASC");
		
		$sproduct_images = $query->rows;

		foreach ($sproduct_images as $key => $sproduct_image) {
			$sproduct_image_description = $this->getSproductImagesDescription($sproduct_image['sproduct_image_id']);

			$sproduct_images[$key]['sproduct_image_description'] = $sproduct_image_description;
		}

		return $sproduct_images;
	}

	public function getSproductImagesDescription($sproduct_image_id) {
		$sproduct_image_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_image_description WHERE sproduct_image_id = '" . (int)$sproduct_image_id . "'");

		foreach ($query->rows as $result) {
			$sproduct_image_description_data[$result['language_id']] = array(
				'text' => $result['text'],
			);
		}

		return $sproduct_image_description_data;
	}

	public function getSproductDiscounts($sproduct_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_discount WHERE sproduct_id = '" . (int)$sproduct_id . "' ORDER BY quantity, priority, price");

		return $query->rows;
	}

	public function getSproductSpecials($sproduct_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_special WHERE sproduct_id = '" . (int)$sproduct_id . "' ORDER BY priority, price");

		return $query->rows;
	}

	public function getSproductRewards($sproduct_id) {
		$sproduct_reward_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_reward WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		foreach ($query->rows as $result) {
			$sproduct_reward_data[$result['customer_group_id']] = array('points' => $result['points']);
		}

		return $sproduct_reward_data;
	}

	public function getSproductDownloads($sproduct_id) {
		$sproduct_download_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_to_download WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		foreach ($query->rows as $result) {
			$sproduct_download_data[] = $result['download_id'];
		}

		return $sproduct_download_data;
	}

	public function getSproductStores($sproduct_id) {
		$sproduct_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_to_store WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		foreach ($query->rows as $result) {
			$sproduct_store_data[] = $result['store_id'];
		}

		return $sproduct_store_data;
	}

	public function getSproductLayouts($sproduct_id) {
		$sproduct_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_to_layout WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		foreach ($query->rows as $result) {
			$sproduct_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $sproduct_layout_data;
	}

	public function getSproductRelated($sproduct_id) {
		$sproduct_related_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_related WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		foreach ($query->rows as $result) {
			$sproduct_related_data[] = $result['related_id'];
		}

		return $sproduct_related_data;
	}

	public function getRecurrings($sproduct_id) {
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "sproduct_recurring` WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		return $query->rows;
	}

	public function getTotalSproducts($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.sproduct_id) AS total FROM " . DB_PREFIX . "sproduct p LEFT JOIN " . DB_PREFIX . "sproduct_description pd ON (p.sproduct_id = pd.sproduct_id)";

        if (!empty($data['filter_service_id'])) {
            // $cat_id = $this->db->query("SELECT service_id FROM " . DB_PREFIX . "service_description WHERE name = '" . $data['filter_service_id'] . "' LIMIT 1")->row['service_id'];
            $sql .= " LEFT JOIN " . DB_PREFIX . "sproduct_to_service pc ON (p.sproduct_id = pc.sproduct_id)";
        }


        $sql .= " WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND pd.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

        if (!empty($data['filter_service_id'])) {
            $sql .= " AND pc.service_id = '" . $data['filter_service_id'] . "'";
        }

		if (!empty($data['filter_model'])) {
			$sql .= " AND p.model LIKE '" . $this->db->escape($data['filter_model']) . "%'";
		}

		if (isset($data['filter_price']) && !is_null($data['filter_price'])) {
			$sql .= " AND p.price LIKE '" . $this->db->escape($data['filter_price']) . "%'";
		}

		if (isset($data['filter_quantity']) && !is_null($data['filter_quantity'])) {
			$sql .= " AND p.quantity = '" . (int)$data['filter_quantity'] . "'";
		}

		if (isset($data['filter_status']) && !is_null($data['filter_status'])) {
			$sql .= " AND p.status = '" . (int)$data['filter_status'] . "'";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalSproductsByTaxClassId($tax_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sproduct WHERE tax_class_id = '" . (int)$tax_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalSproductsByStockStatusId($stock_status_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sproduct WHERE stock_status_id = '" . (int)$stock_status_id . "'");

		return $query->row['total'];
	}

	public function getTotalSproductsByWeightClassId($weight_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sproduct WHERE weight_class_id = '" . (int)$weight_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalSproductsByLengthClassId($length_class_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sproduct WHERE length_class_id = '" . (int)$length_class_id . "'");

		return $query->row['total'];
	}

	public function getTotalSproductsByDownloadId($download_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sproduct_to_download WHERE download_id = '" . (int)$download_id . "'");

		return $query->row['total'];
	}

	public function getTotalSproductsByManufacturerId($manufacturer_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sproduct WHERE manufacturer_id = '" . (int)$manufacturer_id . "'");

		return $query->row['total'];
	}

    public function fastUpdate($field, $sproduct_id, $field_value) {
        switch ($field) {
            case 'sproduct_name':
                $sql = "Update " . DB_PREFIX . "sproduct_description Set name = '{$this->db->escape($field_value)}' Where sproduct_id = " . (int)$sproduct_id . " And language_id = " . (int)$this->config->get('config_language_id');
                break;
            case 'sproduct_model':
                $sql = "Update " . DB_PREFIX . "sproduct Set model = '{$this->db->escape($field_value)}' Where sproduct_id = " . (int)$sproduct_id;
                break;
            case 'sproduct_price':
                $sql = "Update " . DB_PREFIX . "sproduct Set price = {$this->db->escape($field_value)} Where sproduct_id = " . (int)$sproduct_id;
                break;
            case 'sproduct_special':
                $sql = "Update " . DB_PREFIX . "sproduct_special Set price = '{$this->db->escape($field_value)}' Where sproduct_id = " . (int)$sproduct_id;
                break;
            case 'sproduct_quantity':
                $sql = "Update " . DB_PREFIX . "sproduct Set quantity = " . (int)$this->db->escape($field_value) . " Where sproduct_id = " . (int)$sproduct_id;
                break;
            case 'sproduct_sort_order':
                $sql = "Update " . DB_PREFIX . "sproduct Set sort_order = " . (int)$this->db->escape($field_value) . " Where sproduct_id = " . (int)$sproduct_id;
                break;
            case 'sproduct_status':
                $sql = "Update " . DB_PREFIX . "sproduct Set stock_status_id = " . (int)$this->db->escape($field_value) . " Where sproduct_id = " . (int)$sproduct_id;
                break;
            case 'sproduct_promo_tag':
                $sql = "Update " . DB_PREFIX . "sproduct Set promo_top_right = " . (int)$this->db->escape($field_value) . " Where sproduct_id = " . (int)$sproduct_id;
                break;
            case 'percent_special':
                $sql = "Update " . DB_PREFIX . "sproduct_special Set percent = " . (int)$this->db->escape($field_value) . " Where sproduct_id = " . (int)$sproduct_id;
                break;
            case 'sproduct_on':
                $sql = "Update " . DB_PREFIX . "sproduct Set status = " . (int)$this->db->escape($field_value) . " Where sproduct_id = " . (int)$sproduct_id;
                break;
            default:
                $sql = false;
                break;
        }

        $this->db->query($sql);
        return (bool)$this->db->countAffected();
    }

	public function getTotalSproductsByAttributeId($attribute_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sproduct_attribute WHERE attribute_id = '" . (int)$attribute_id . "'");

		return $query->row['total'];
	}

	public function getTotalSproductsByOptionId($option_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sproduct_option WHERE option_id = '" . (int)$option_id . "'");

		return $query->row['total'];
	}

	public function getTotalSproductsByProfileId($recurring_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sproduct_recurring WHERE recurring_id = '" . (int)$recurring_id . "'");

		return $query->row['total'];
	}

	public function getTotalSproductsByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "sproduct_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}

	public function getSproductsServices($sproduct_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_service WHERE sproduct_id = '" . (int)$sproduct_id . "' ORDER BY sort_order ASC");

		$sproduct_services = $query->rows;

		foreach ($sproduct_services as $key => $sproduct_service) {
			$sproduct_service_description = $this->getSproductsServiceDescriptions($sproduct_service['sproduct_service_id']);

			$sproduct_services[$key]['sproduct_service_description'] = $sproduct_service_description;
		}

		return $sproduct_services;
	}

	public function getSproductsServiceDescriptions($sproduct_service_id) {
		$sproduct_service_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_service_description WHERE sproduct_service_id = '" . (int)$sproduct_service_id . "'");

		foreach ($query->rows as $result) {
			$sproduct_service_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description'],
				'additional'       => $result['additional'],
			);
		}

		return $sproduct_service_description_data;
	}

	public function getSproductsTabServices($sproduct_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_tab_service WHERE sproduct_id = '" . (int)$sproduct_id . "' ORDER BY sort_order ASC");

		$sproduct_tab_services = $query->rows;

		foreach ($sproduct_tab_services as $key => $sproduct_tab_service) {
			$sproduct_tab_service_description = $this->getSproductsTabServiceDescriptions($sproduct_tab_service['sproduct_tab_service_id']);

			$sproduct_tab_services[$key]['sproduct_tab_service_description'] = $sproduct_tab_service_description;
		}

		return $sproduct_tab_services;
	}

	public function getSproductsTabServiceDescriptions($sproduct_tab_service_id) {
		$sproduct_tab_service_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_tab_service_description WHERE sproduct_tab_service_id = '" . (int)$sproduct_tab_service_id . "'");

		foreach ($query->rows as $result) {
			$sproduct_tab_service_description_data[$result['language_id']] = array(
				'name'             => $result['name'],
				'description'      => $result['description'],
				'additional'       => $result['additional'],
			);
		}

		return $sproduct_tab_service_description_data;
	}
}
