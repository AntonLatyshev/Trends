<?php
class ModelCatalogSproduct extends Model {
	public function updateViewed($sproduct_id) {
		$this->db->query("UPDATE " . DB_PREFIX . "sproduct SET viewed = (viewed + 1) WHERE sproduct_id = '" . (int)$sproduct_id . "'");
	}

	public function getSproduct($sproduct_id) {

		$query = $this->db->query("SELECT DISTINCT *, p.sproduct_id AS sproduct_id_custom, pd.name AS name, p.image, m.name AS manufacturer, p.custom_field,
(SELECT price FROM " . DB_PREFIX . "sproduct_discount pd2 WHERE pd2.sproduct_id = p.sproduct_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount,
(SELECT price FROM " . DB_PREFIX . "sproduct_special ps WHERE ps.sproduct_id = p.sproduct_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special,
(SELECT points FROM " . DB_PREFIX . "sproduct_reward pr WHERE pr.sproduct_id = p.sproduct_id AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "') AS reward,
(SELECT ss.name FROM " . DB_PREFIX . "stock_status ss WHERE ss.stock_status_id = p.stock_status_id AND ss.language_id = '" . (int)$this->config->get('config_language_id') . "') AS stock_status,
(SELECT wcd.unit FROM " . DB_PREFIX . "weight_class_description wcd WHERE p.weight_class_id = wcd.weight_class_id AND wcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS weight_class,
(SELECT lcd.unit FROM " . DB_PREFIX . "length_class_description lcd WHERE p.length_class_id = lcd.length_class_id AND lcd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS length_class,
		p.sort_order

		FROM " . DB_PREFIX . "sproduct p
		LEFT JOIN " . DB_PREFIX . "sproduct_description pd
			ON (p.sproduct_id = pd.sproduct_id)
		LEFT JOIN " . DB_PREFIX . "sproduct_to_store p2s
			ON (p.sproduct_id = p2s.sproduct_id)

		LEFT JOIN " . DB_PREFIX . "manufacturer m
			ON (p.manufacturer_id = m.manufacturer_id)

		LEFT JOIN " . DB_PREFIX . "sproduct_to_service p2c
			ON ( p.sproduct_id = p2c.sproduct_id)

		LEFT JOIN " . DB_PREFIX . "service pcat
			ON (p2c.service_id = pcat.service_id)

			WHERE p.sproduct_id = '" . (int)$sproduct_id . "'
			AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'
			AND p.status = '1' AND p.date_available <= NOW()
			AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
			AND (pcat.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' OR ISNULL(pcat.customer_group_id) OR pcat.customer_group_id = '1')

			");

		if ($query->num_rows) {
			return array(
				'sproduct_id'      => $query->row['sproduct_id_custom'],
				'name'             => $query->row['name'],
				'description'      => $query->row['description'],
				'description_short'      => $query->row['description_short'],
				'meta_title'       => $query->row['meta_title'],
				'meta_description' => $query->row['meta_description'],
				'meta_keyword'     => $query->row['meta_keyword'],
				'tag'              => $query->row['tag'],
				'model'            => $query->row['model'],
				'sku'              => $query->row['sku'],
				'upc'              => $query->row['upc'],
				'ean'              => $query->row['ean'],
				'jan'              => $query->row['jan'],
				'isbn'             => $query->row['isbn'],
				'mpn'              => $query->row['mpn'],
				'location'         => $query->row['location'],
				'quantity'         => $query->row['quantity'],
				'stock_status'     => $query->row['stock_status'],
				'image'            => $query->row['image'],
				'image_bg'         => $query->row['image_bg'],
				'image_list'       => $query->row['image_list'],
				'image_nf'         => $query->row['image_nf'],
				'image_trigger'    => $query->row['image_trigger'],
				'image_add'        => $query->row['image_add'],
				'manufacturer_id'  => $query->row['manufacturer_id'],
				'manufacturer'     => $query->row['manufacturer'],
				'price'            => ($query->row['discount'] ? $query->row['discount'] : $query->row['price']),
				'special'          => $query->row['special'],
				'reward'           => $query->row['reward'],
				'points'           => $query->row['points'],
				'tax_class_id'     => $query->row['tax_class_id'],
				'date_available'   => $query->row['date_available'],
				'weight'           => $query->row['weight'],
				'weight_class_id'  => $query->row['weight_class_id'],
				'length'           => $query->row['length'],
				'width'            => $query->row['width'],
				'height'           => $query->row['height'],
				'length_class_id'  => $query->row['length_class_id'],
				'subtract'         => $query->row['subtract'],
				'minimum'          => $query->row['minimum'],
				'sort_order'       => $query->row['sort_order'],
				'status'           => $query->row['status'],
				'date_added'       => $query->row['date_added'],
				'date_modified'    => $query->row['date_modified'],
				'viewed'           => $query->row['viewed'],
				'promo_date_start'   => $query->row['promo_date_start'],
				'promo_date_end'     => $query->row['promo_date_end'],
				'promo_top_left'     => $query->row['promo_top_left'],
				'promo_top_right'    => $query->row['promo_top_right'],
				'promo_bottom_right' => $query->row['promo_bottom_right'],
				'promo_bottom_left'  => $query->row['promo_bottom_left'],
				'custom_field'       => $query->row['custom_field'],
			);
		} else {
			return false;
		}
	}

	public function getSproducts($data = array()) {

		$user_customer_group_id = $this->config->get('config_customer_group_id');

		$sql = "SELECT p.sproduct_id, (SELECT price FROM " . DB_PREFIX . "sproduct_discount pd2 WHERE pd2.sproduct_id = p.sproduct_id AND pd2.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND pd2.quantity = '1' AND ((pd2.date_start = '0000-00-00' OR pd2.date_start < NOW()) AND (pd2.date_end = '0000-00-00' OR pd2.date_end > NOW())) ORDER BY pd2.priority ASC, pd2.price ASC LIMIT 1) AS discount, (SELECT price FROM " . DB_PREFIX . "sproduct_special ps WHERE ps.sproduct_id = p.sproduct_id AND ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW())) ORDER BY ps.priority ASC, ps.price ASC LIMIT 1) AS special";


		if (!empty($data['filter_service_id'])) {
			if (!empty($data['filter_sub_service'])) {
				$sql .= " FROM " . DB_PREFIX . "service_path cp LEFT JOIN " . DB_PREFIX . "sproduct_to_service p2c ON (cp.service_id = p2c.service_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "sproduct_to_service p2c";
			}

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "sproduct_filter pf ON (p2c.sproduct_id = pf.sproduct_id) LEFT JOIN " . DB_PREFIX . "sproduct p ON (pf.sproduct_id = p.sproduct_id)";
			} else {
				$sql .= " LEFT JOIN " . DB_PREFIX . "sproduct p ON (p2c.sproduct_id = p.sproduct_id)";
			}
		} else {
			$sql .= " FROM " . DB_PREFIX . "sproduct p";
		}

		if (!empty($data['filter_service_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "service pcat ON (p2c.service_id = pcat.service_id) LEFT JOIN " . DB_PREFIX . "sproduct_description pd ON (p.sproduct_id = pd.sproduct_id) LEFT JOIN " . DB_PREFIX . "sproduct_to_store p2s ON (p.sproduct_id = p2s.sproduct_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
		} else {
			$sql .= " LEFT JOIN " . DB_PREFIX . "sproduct_to_service p2c ON (p.sproduct_id = p2c.sproduct_id) LEFT JOIN " . DB_PREFIX . "service pcat ON (p2c.service_id = pcat.service_id) LEFT JOIN " . DB_PREFIX . "sproduct_description pd ON (p.sproduct_id = pd.sproduct_id) LEFT JOIN " . DB_PREFIX . "sproduct_to_store p2s ON (p.sproduct_id = p2s.sproduct_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
		}

		$sql .= " AND (pcat.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' OR ISNULL(pcat.customer_group_id) OR pcat.customer_group_id = '1')";

        $sql .= " AND p.in_series = '0'";

		if (!empty($data['filter_service_id'])) {
			if (!empty($data['filter_sub_service'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_service_id'] . "'";
			} else {
				$sql .= " AND p2c.service_id = '" . (int)$data['filter_service_id'] . "'";
			}

			if (!empty($data['filter_filter'])) {
				$implode = array();

				$filters = explode(',', $data['filter_filter']);

				foreach ($filters as $filter_id) {
					$implode[] = (int)$filter_id;
				}

				$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
			}
		}

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$sql .= "pd.tag LIKE '%" . $this->db->escape($data['filter_tag']) . "%'";
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			$sql .= ")";
		}
                
		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		$sql .= " GROUP BY p.sproduct_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'p.quantity',
			'p.price',
			'rating',
			'p.sort_order',
			'p.date_added'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} elseif ($data['sort'] == 'p.price') {
				$sql .= " ORDER BY (CASE WHEN special IS NOT NULL THEN special WHEN discount IS NOT NULL THEN discount ELSE p.price END)";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(pd.name) DESC";
		} else {
			$sql .= " ASC, LCASE(pd.name) ASC";
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

		$sproduct_data = array();

		/*if( in_array( __FUNCTION__, array( 'getSproducts', 'getTotalSproducts', 'getSproductSpecials', 'getTotalSproductSpecials' ) ) ) {
			if( ! empty( $this->request->get['mfp'] ) || ( NULL != ( $mfSettings = $this->config->get('mega_filter_settings') ) && ! empty( $mfSettings['in_stock_default_selected'] ) ) ) {
				$this->load->model( 'module/mega_filter' );

				$sql = MegaFilterCore::newInstance( $this, $sql )->getSQL( __FUNCTION__ );
			}
		}*/

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$sproduct_data[$result['sproduct_id']] = $this->getSproduct($result['sproduct_id']);
		}

		return $sproduct_data;
	}

	public function getSproductSpecials($data = array()) {
		$sql = "SELECT DISTINCT ps.sproduct_id, (SELECT AVG(rating) FROM " . DB_PREFIX . "review r1 WHERE r1.sproduct_id = ps.sproduct_id AND r1.status = '1' GROUP BY r1.sproduct_id) AS rating FROM " . DB_PREFIX . "sproduct_special ps LEFT JOIN " . DB_PREFIX . "sproduct p ON (ps.sproduct_id = p.sproduct_id) LEFT JOIN " . DB_PREFIX . "sproduct_description pd ON (p.sproduct_id = pd.sproduct_id)

		LEFT JOIN " . DB_PREFIX . "sproduct_to_service p2c
			ON (p.sproduct_id = p2c.sproduct_id)
		LEFT JOIN " . DB_PREFIX . "service pcat
			ON (p2c.service_id = pcat.service_id)

		LEFT JOIN " . DB_PREFIX . "sproduct_to_store p2s
			ON (p.sproduct_id = p2s.sproduct_id)
			WHERE p.status = '1'
			AND p.date_available <= NOW()
			AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
			AND (ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' OR ps.customer_group_id = '1')
			AND (pcat.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' OR ISNULL(pcat.customer_group_id) OR pcat.customer_group_id = '1')
			AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW())
			AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW()))
			GROUP BY ps.sproduct_id";

		$sort_data = array(
			'pd.name',
			'p.model',
			'ps.price',
			'rating',
			'p.sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			if ($data['sort'] == 'pd.name' || $data['sort'] == 'p.model') {
				$sql .= " ORDER BY LCASE(" . $data['sort'] . ")";
			} else {
				$sql .= " ORDER BY " . $data['sort'];
			}
		} else {
			$sql .= " ORDER BY p.sort_order";
		}

		if (isset($data['order']) && ($data['order'] == 'DESC')) {
			$sql .= " DESC, LCASE(pd.name) DESC";
		} else {
			$sql .= " ASC, LCASE(pd.name) ASC";
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

		$sproduct_data = array();

		if( in_array( __FUNCTION__, array( 'getSproducts', 'getTotalSproducts', 'getSproductSpecials', 'getTotalSproductSpecials' ) ) ) {
			if( ! empty( $this->request->get['mfp'] ) || ( NULL != ( $mfSettings = $this->config->get('mega_filter_settings') ) && ! empty( $mfSettings['in_stock_default_selected'] ) ) ) {
				$this->load->model( 'module/mega_filter' );

				$sql = MegaFilterCore::newInstance( $this, $sql )->getSQL( __FUNCTION__ );
			}
		}

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$sproduct_data[$result['sproduct_id']] = $this->getSproduct($result['sproduct_id']);
		}

		return $sproduct_data;
	}

	public function getLatestSproducts($limit) {
		$sproduct_data = $this->cache->get('sproduct.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);

		if (!$sproduct_data) {
			$query = $this->db->query("SELECT p.sproduct_id FROM " . DB_PREFIX . "sproduct p
			LEFT JOIN " . DB_PREFIX . "sproduct_to_service p2c
				ON (p.sproduct_id = p2c.sproduct_id)
			LEFT JOIN " . DB_PREFIX . "service pcat
				ON (p2c.service_id = pcat.service_id)
			LEFT JOIN " . DB_PREFIX . "sproduct_to_store p2s
				ON (p.sproduct_id = p2s.sproduct_id)
				WHERE p.status = '1'
				AND p.date_available <= NOW()
				AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
				AND (pcat.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' OR ISNULL(pcat.customer_group_id) OR pcat.customer_group_id = '1')
				ORDER BY p.date_added DESC
				LIMIT " . (int)$limit);

			foreach ($query->rows as $result) {
				$sproduct_data[$result['sproduct_id']] = $this->getSproduct($result['sproduct_id']);
			}

			$this->cache->set('sproduct.latest.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $sproduct_data);
		}

		return $sproduct_data;
	}

	public function getPopularSproducts($limit) {
		$sproduct_data = array();

		$query = $this->db->query("SELECT p.sproduct_id FROM " . DB_PREFIX . "sproduct p LEFT JOIN " . DB_PREFIX . "sproduct_to_store p2s ON (p.sproduct_id = p2s.sproduct_id) WHERE p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "' ORDER BY p.viewed DESC, p.date_added DESC LIMIT " . (int)$limit);

		foreach ($query->rows as $result) {
			$sproduct_data[$result['sproduct_id']] = $this->getSproduct($result['sproduct_id']);
		}

		return $sproduct_data;
	}

	public function getBestSellerSproducts($limit) {
		$sproduct_data = $this->cache->get('sproduct.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit);

		if (!$sproduct_data) {
			$sproduct_data = array();

			$query = $this->db->query("SELECT op.sproduct_id, SUM(op.quantity) AS total FROM " . DB_PREFIX . "order_sproduct op LEFT JOIN `" . DB_PREFIX . "order` o ON (op.order_id = o.order_id) LEFT JOIN `" . DB_PREFIX . "sproduct` p ON (op.sproduct_id = p.sproduct_id)
			LEFT JOIN " . DB_PREFIX . "sproduct_to_store p2s
				ON (p.sproduct_id = p2s.sproduct_id)

			LEFT JOIN " . DB_PREFIX . "sproduct_to_service p2c
				ON (p.sproduct_id = p2c.sproduct_id)
			LEFT JOIN " . DB_PREFIX . "service pcat
				ON (p2c.service_id = pcat.service_id)

				WHERE o.order_status_id > '0'
				AND p.status = '1'
				AND p.date_available <= NOW()
				AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
				AND (pcat.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' OR ISNULL(pcat.customer_group_id) OR pcat.customer_group_id = '1')
				GROUP BY op.sproduct_id
				ORDER BY total DESC
				LIMIT " . (int)$limit);

			foreach ($query->rows as $result) {
				$sproduct_data[$result['sproduct_id']] = $this->getSproduct($result['sproduct_id']);
			}

			$this->cache->set('sproduct.bestseller.' . (int)$this->config->get('config_language_id') . '.' . (int)$this->config->get('config_store_id') . '.' . $this->config->get('config_customer_group_id') . '.' . (int)$limit, $sproduct_data);
		}

		return $sproduct_data;
	}

	public function getSproductAttributes($sproduct_id) {
		$sproduct_attribute_group_data = array();

		$sproduct_attribute_group_query = $this->db->query("SELECT ag.attribute_group_id, agd.name FROM " . DB_PREFIX . "sproduct_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_group ag ON (a.attribute_group_id = ag.attribute_group_id) LEFT JOIN " . DB_PREFIX . "attribute_group_description agd ON (ag.attribute_group_id = agd.attribute_group_id) WHERE pa.sproduct_id = '" . (int)$sproduct_id . "' AND agd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY ag.attribute_group_id ORDER BY ag.sort_order, agd.name");

		foreach ($sproduct_attribute_group_query->rows as $sproduct_attribute_group) {
			$sproduct_attribute_data = array();

			$sproduct_attribute_query = $this->db->query("SELECT a.attribute_id, ad.name, pa.text FROM " . DB_PREFIX . "sproduct_attribute pa LEFT JOIN " . DB_PREFIX . "attribute a ON (pa.attribute_id = a.attribute_id) LEFT JOIN " . DB_PREFIX . "attribute_description ad ON (a.attribute_id = ad.attribute_id) WHERE pa.sproduct_id = '" . (int)$sproduct_id . "' AND a.attribute_group_id = '" . (int)$sproduct_attribute_group['attribute_group_id'] . "' AND ad.language_id = '" . (int)$this->config->get('config_language_id') . "' AND pa.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY a.sort_order, ad.name");

			foreach ($sproduct_attribute_query->rows as $sproduct_attribute) {
				$sproduct_attribute_data[] = array(
					'attribute_id' => $sproduct_attribute['attribute_id'],
					'name'         => $sproduct_attribute['name'],
					'text'         => $sproduct_attribute['text']
				);
			}

			$sproduct_attribute_group_data[] = array(
				'attribute_group_id' => $sproduct_attribute_group['attribute_group_id'],
				'name'               => $sproduct_attribute_group['name'],
				'attribute'          => $sproduct_attribute_data
			);
		}

		return $sproduct_attribute_group_data;
	}

	public function getSproductOptions($sproduct_id) {
		$sproduct_option_data = array();

		$sproduct_option_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_option po LEFT JOIN `" . DB_PREFIX . "option` o ON (po.option_id = o.option_id) LEFT JOIN " . DB_PREFIX . "option_description od ON (o.option_id = od.option_id) WHERE po.sproduct_id = '" . (int)$sproduct_id . "' AND od.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY o.sort_order");

		foreach ($sproduct_option_query->rows as $sproduct_option) {
			$sproduct_option_value_data = array();

			$sproduct_option_value_query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_option_value pov LEFT JOIN " . DB_PREFIX . "option_value ov ON (pov.option_value_id = ov.option_value_id) LEFT JOIN " . DB_PREFIX . "option_value_description ovd ON (ov.option_value_id = ovd.option_value_id) WHERE pov.sproduct_id = '" . (int)$sproduct_id . "' AND pov.sproduct_option_id = '" . (int)$sproduct_option['sproduct_option_id'] . "' AND ovd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY ov.sort_order");

			foreach ($sproduct_option_value_query->rows as $sproduct_option_value) {
				$sproduct_option_value_data[] = array(
					'sproduct_option_value_id' => $sproduct_option_value['sproduct_option_value_id'],
					'option_value_id'         => $sproduct_option_value['option_value_id'],
					'name'                    => $sproduct_option_value['name'],
					'image'                   => $sproduct_option_value['image'],
					'quantity'                => $sproduct_option_value['quantity'],
					'subtract'                => $sproduct_option_value['subtract'],
					'price'                   => $sproduct_option_value['price'],
					'price_prefix'            => $sproduct_option_value['price_prefix'],
					'points'        		  => $sproduct_option_value['points'],
					'points_prefix' 		  => $sproduct_option_value['points_prefix'],
					'weight'                  => $sproduct_option_value['weight'],
					'weight_prefix'           => $sproduct_option_value['weight_prefix'],
                    'sproduct_option_image'    => $sproduct_option_value['sproduct_option_image']
				);
			}

			$sproduct_option_data[] = array(
				'sproduct_option_id'    => $sproduct_option['sproduct_option_id'],
				'sproduct_option_value' => $sproduct_option_value_data,
				'option_id'            => $sproduct_option['option_id'],
				'name'                 => $sproduct_option['name'],
				'sproduct_page'         => isset($sproduct_option['sproduct_page']) ? ((int)$sproduct_option['sproduct_page']) : '',
				'type'                 => $sproduct_option['type'],
				'style'                 => $sproduct_option['style'],
				'value'                => $sproduct_option['value'],
				'required'             => $sproduct_option['required']
			);
		}

		return $sproduct_option_data;
	}

	public function getSproductDiscounts($sproduct_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_discount WHERE sproduct_id = '" . (int)$sproduct_id . "' AND customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' AND quantity > 1 AND ((date_start = '0000-00-00' OR date_start < NOW()) AND (date_end = '0000-00-00' OR date_end > NOW())) ORDER BY quantity ASC, priority ASC, price ASC");

		return $query->rows;
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

	/*code start*/
	public function getPromo($sproduct_id,$promo_tags_id) {
		$query = $this->db->query("SELECT pt.promo_tags_id, pt.promo_text, pti.image
	    							FROM
	    								" . DB_PREFIX . "promo_tags pt
	    								JOIN " . DB_PREFIX . "promo_tags_images pti ON pti.promo_tags_id = pt.promo_tags_id
	    							WHERE pt.promo_tags_id = '" . (int)$promo_tags_id . "'
	    							AND   pti.language_id = '" . $this->config->get('config_language_id') . "'");


		/*  die("SELECT pt.promo_text, pt.image, pt.pimage
                                        FROM
                                            " . DB_PREFIX . "promo_tags pt,
                                            " . DB_PREFIX . "sproduct p
                                        WHERE pt.promo_tags_id = '" . (int)$promo_tags_id . "'
                                            AND p.sproduct_id = '" . (int)$sproduct_id . "'"); */
		return $query->row;
	}
	/*code end*/

	public function getSproductRelated($sproduct_id) {
		$sproduct_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_related pr LEFT JOIN " . DB_PREFIX . "sproduct p ON (pr.related_id = p.sproduct_id)

		LEFT JOIN " . DB_PREFIX . "sproduct_to_service p2c
			ON (p.sproduct_id = p2c.sproduct_id)
		LEFT JOIN " . DB_PREFIX . "service pcat
			ON (p2c.service_id = pcat.service_id)

		LEFT JOIN " . DB_PREFIX . "sproduct_to_store p2s
			ON (p.sproduct_id = p2s.sproduct_id)
			WHERE pr.sproduct_id = '" . (int)$sproduct_id . "'
			AND p.status = '1'
			AND p.date_available <= NOW()
			AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
			AND (pcat.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' OR ISNULL(pcat.customer_group_id) OR pcat.customer_group_id = '1')");

		foreach ($query->rows as $result) {
			$sproduct_data[$result['related_id']] = $this->getSproduct($result['related_id']);
		}

		return $sproduct_data;
	}

	public function getSproductLayoutId($sproduct_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_to_layout WHERE sproduct_id = '" . (int)$sproduct_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;
		}
	}

	public function getServices($sproduct_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "sproduct_to_service WHERE sproduct_id = '" . (int)$sproduct_id . "'");

		return $query->rows;
	}

	public function getService($service_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "service c LEFT JOIN " . DB_PREFIX . "service_description cd ON (c.service_id = cd.service_id) LEFT JOIN " . DB_PREFIX . "service_to_store c2s ON (c.service_id = c2s.service_id) WHERE c.service_id = '" . (int)$service_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

		return $query->row;
	}

	public function getServicesBySproductId($sproduct_id) {
		$query = $this->db->query("SELECT pc.*, (!ISNULL(t1.parent_id) + !ISNULL(t2.parent_id) + !ISNULL(t3.parent_id) + !ISNULL(t4.parent_id) + !ISNULL(t5.parent_id))*1000 + IF(t1.sort_order>0,(1000-t1.sort_order),0) + IF(t2.sort_order>0,(1000-t2.sort_order),0) + IF(t3.sort_order>0,(1000-t3.sort_order),0) + IF(t4.sort_order>0,(1000-t4.sort_order),0) + IF(t5.sort_order>0,(1000-t5.sort_order),0) AS d FROM " . DB_PREFIX . "sproduct_to_service pc LEFT JOIN " . DB_PREFIX . "service t1 ON t1.service_id = pc.service_id LEFT JOIN " . DB_PREFIX . "service t2 ON t1.parent_id = t2.service_id LEFT JOIN " . DB_PREFIX . "service t3 ON t2.parent_id = t3.service_id LEFT JOIN " . DB_PREFIX . "service t4 ON t3.parent_id = t4.service_id LEFT JOIN " . DB_PREFIX . "service t5 ON t4.parent_id = t5.service_id WHERE sproduct_id = '" . (int)$sproduct_id . "' ORDER BY d DESC");

		return $query->rows;
	}

	public function getTotalSproducts($data = array()) {
		$sql = "SELECT COUNT(DISTINCT p.sproduct_id) AS total";

		if (!empty($data['filter_service_id'])) {
			if (!empty($data['filter_sub_service'])) {
				$sql .= " FROM " . DB_PREFIX . "service_path cp LEFT JOIN " . DB_PREFIX . "sproduct_to_service p2c ON (cp.service_id = p2c.service_id)";
			} else {
				$sql .= " FROM " . DB_PREFIX . "sproduct_to_service p2c";
			}

			if (!empty($data['filter_filter'])) {
				$sql .= " LEFT JOIN " . DB_PREFIX . "sproduct_filter pf ON (p2c.sproduct_id = pf.sproduct_id) LEFT JOIN " . DB_PREFIX . "sproduct p ON (pf.sproduct_id = p.sproduct_id)";
			} else {
				$sql .= " LEFT JOIN " . DB_PREFIX . "sproduct p ON (p2c.sproduct_id = p.sproduct_id)";
			}
		} else {
			$sql .= " FROM " . DB_PREFIX . "sproduct p";
		}

		if (!empty($data['filter_service_id'])) {
			$sql .= " LEFT JOIN " . DB_PREFIX . "service pcat ON (p2c.service_id = pcat.service_id) LEFT JOIN " . DB_PREFIX . "sproduct_description pd ON (p.sproduct_id = pd.sproduct_id) LEFT JOIN " . DB_PREFIX . "sproduct_to_store p2s ON (p.sproduct_id = p2s.sproduct_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
		} else {
			$sql .= " LEFT JOIN " . DB_PREFIX . "sproduct_to_service p2c ON (p.sproduct_id = p2c.sproduct_id) LEFT JOIN " . DB_PREFIX . "service pcat ON (p2c.service_id = pcat.service_id) LEFT JOIN " . DB_PREFIX . "sproduct_description pd ON (p.sproduct_id = pd.sproduct_id) LEFT JOIN " . DB_PREFIX . "sproduct_to_store p2s ON (p.sproduct_id = p2s.sproduct_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND p.status = '1' AND p.date_available <= NOW() AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'";
		}

		$sql .= " AND (pcat.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' OR ISNULL(pcat.customer_group_id) OR pcat.customer_group_id = '1')";

        $sql .= " AND p.in_series = '0'";

		if (!empty($data['filter_service_id'])) {
			if (!empty($data['filter_sub_service'])) {
				$sql .= " AND cp.path_id = '" . (int)$data['filter_service_id'] . "'";
			} else {
				$sql .= " AND p2c.service_id = '" . (int)$data['filter_service_id'] . "'";
			}

			if (!empty($data['filter_filter'])) {
				$implode = array();

				$filters = explode(',', $data['filter_filter']);

				foreach ($filters as $filter_id) {
					$implode[] = (int)$filter_id;
				}

				$sql .= " AND pf.filter_id IN (" . implode(',', $implode) . ")";
			}
		}

		if (!empty($data['filter_name']) || !empty($data['filter_tag'])) {
			$sql .= " AND (";

			if (!empty($data['filter_name'])) {
				$implode = array();

				$words = explode(' ', trim(preg_replace('/\s+/', ' ', $data['filter_name'])));

				foreach ($words as $word) {
					$implode[] = "pd.name LIKE '%" . $this->db->escape($word) . "%'";
				}

				if ($implode) {
					$sql .= " " . implode(" AND ", $implode) . "";
				}

				if (!empty($data['filter_description'])) {
					$sql .= " OR pd.description LIKE '%" . $this->db->escape($data['filter_name']) . "%'";
				}
			}

			if (!empty($data['filter_name']) && !empty($data['filter_tag'])) {
				$sql .= " OR ";
			}

			if (!empty($data['filter_tag'])) {
				$sql .= "pd.tag LIKE '%" . $this->db->escape(utf8_strtolower($data['filter_tag'])) . "%'";
			}

			if (!empty($data['filter_name'])) {
				$sql .= " OR LCASE(p.model) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.sku) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.upc) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.ean) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.jan) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.isbn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
				$sql .= " OR LCASE(p.mpn) = '" . $this->db->escape(utf8_strtolower($data['filter_name'])) . "'";
			}

			$sql .= ")";
		}
                
		if (!empty($data['filter_manufacturer_id'])) {
			$sql .= " AND p.manufacturer_id = '" . (int)$data['filter_manufacturer_id'] . "'";
		}

		/*if( in_array( __FUNCTION__, array( 'getSproducts', 'getTotalSproducts', 'getSproductSpecials', 'getTotalSproductSpecials' ) ) ) {
			if( ! empty( $this->request->get['mfp'] ) || ( NULL != ( $mfSettings = $this->config->get('mega_filter_settings') ) && ! empty( $mfSettings['in_stock_default_selected'] ) ) ) {
				$this->load->model( 'module/mega_filter' );

				$sql = MegaFilterCore::newInstance( $this, $sql )->getSQL( __FUNCTION__ );
			}
		}*/

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	
	
    public function getServiceBySproduct($pr_id) {
        $query = $this->db->query("SELECT pc.service_id, pd.name FROM " . DB_PREFIX . "sproduct_to_service pc "
            . "LEFT JOIN " . DB_PREFIX . "service_description pd ON (pd.service_id = pc.service_id) "
            . "WHERE pc.sproduct_id = '".$pr_id."'");

        return $query->row;
    }

    public function getManufacturerBySproduct($pr_id) {
        $query = $this->db->query("SELECT p.manufacturer_id, m.name FROM " . DB_PREFIX . "sproduct p "
            . "LEFT JOIN " . DB_PREFIX . "manufacturer m ON (p.manufacturer_id = m.manufacturer_id) "
            . "WHERE p.sproduct_id = '".$pr_id."'");

        return $query->row;
    }


    public function getProfiles($sproduct_id) {
		return $this->db->query("SELECT `pd`.* FROM `" . DB_PREFIX . "sproduct_recurring` `pp` JOIN `" . DB_PREFIX . "recurring_description` `pd` ON `pd`.`language_id` = " . (int)$this->config->get('config_language_id') . " AND `pd`.`recurring_id` = `pp`.`recurring_id` JOIN `" . DB_PREFIX . "recurring` `p` ON `p`.`recurring_id` = `pd`.`recurring_id` WHERE `sproduct_id` = " . (int)$sproduct_id . " AND `status` = 1 AND `customer_group_id` = " . (int)$this->config->get('config_customer_group_id') . " ORDER BY `sort_order` ASC")->rows;
	}

	public function getProfile($sproduct_id, $recurring_id) {
		return $this->db->query("SELECT * FROM `" . DB_PREFIX . "recurring` `p` JOIN `" . DB_PREFIX . "sproduct_recurring` `pp` ON `pp`.`recurring_id` = `p`.`recurring_id` AND `pp`.`sproduct_id` = " . (int)$sproduct_id . " WHERE `pp`.`recurring_id` = " . (int)$recurring_id . " AND `status` = 1 AND `pp`.`customer_group_id` = " . (int)$this->config->get('config_customer_group_id'))->row;
	}

	public function getTotalSproductSpecials() {
		$sql = "SELECT COUNT(DISTINCT ps.sproduct_id) AS total FROM " . DB_PREFIX . "sproduct_special ps
		LEFT JOIN " . DB_PREFIX . "sproduct p
			ON (ps.sproduct_id = p.sproduct_id)
		LEFT JOIN " . DB_PREFIX . "sproduct_to_store p2s
			ON (p.sproduct_id = p2s.sproduct_id)
			WHERE p.status = '1'
			AND p.date_available <= NOW()
			AND p2s.store_id = '" . (int)$this->config->get('config_store_id') . "'
			AND (ps.customer_group_id = '" . (int)$this->config->get('config_customer_group_id') . "' OR ps.customer_group_id = '1')
			AND ((ps.date_start = '0000-00-00' OR ps.date_start < NOW()) AND (ps.date_end = '0000-00-00' OR ps.date_end > NOW()))";

		if( ! empty( $this->request->get['mfp'] ) || ( NULL != ( $mfSettings = $this->config->get('mega_filter_settings') ) && ! empty( $mfSettings['in_stock_default_selected'] ) ) ) {
			$this->load->model( 'module/mega_filter' );

			$sql = MegaFilterCore::newInstance( $this, $sql )->getSQL( __FUNCTION__ );
		}

		$query = $this->db->query( $sql );

		if (isset($query->row['total'])) {
			return $query->row['total'];
		} else {
			return 0;
		}
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
