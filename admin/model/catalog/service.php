<?php
class ModelCatalogService extends Model {

	public function getServices_MF($data) {
		if( version_compare( VERSION, '1.5.5', '>=' ) ) {
			$sql = "SELECT cp.service_id AS service_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR ' &gt; ') AS name, c.parent_id, c.sort_order FROM " . DB_PREFIX . "service_path cp LEFT JOIN " . DB_PREFIX . "service c ON (cp.path_id = c.service_id) LEFT JOIN " . DB_PREFIX . "service_description cd1 ON (c.service_id = cd1.service_id) LEFT JOIN " . DB_PREFIX . "service_description cd2 ON (cp.service_id = cd2.service_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";

			if( ! empty( $data['filter_name'] ) ) {
				$sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
			}

			$sql .= " GROUP BY cp.service_id ORDER BY name";
		} else {
			$sql = "SELECT * FROM " . DB_PREFIX . "service c LEFT JOIN " . DB_PREFIX . "service_description cd ON (c.service_id = cd.service_id) WHERE cd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

			if( ! empty( $data['filter_name'] ) ) {
				$sql .= " AND LOWER(cd.name) LIKE '" . $this->db->escape( function_exists( 'mb_strtolower' ) ? mb_strtolower( $data['filter_name'], 'utf-8' ) : $data['filter_name'] ) . "%'";
			}

			$sql .= " GROUP BY c.service_id ORDER BY name";
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

	public function addService($data) {
		//$this->event->trigger('pre.admin.service.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "service SET parent_id = '" . (int)$data['parent_id'] . "', `bottom` = '" . (isset($data['bottom']) ? (int)$data['bottom'] : 0) . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', customer_group_id = '" . (int)$data['customer_group_id'] . "', date_modified = NOW(), date_added = NOW()");

		$service_id = $this->db->getLastId();

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "service SET image = '" . $this->db->escape($data['image']) . "' WHERE service_id = '" . (int)$service_id . "'");
		}

		if (isset($data['image_bg'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "service SET image_bg = '" . $this->db->escape($data['image_bg']) . "' WHERE service_id = '" . (int)$service_id . "'");
		}

		foreach ($data['service_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "service_description SET service_id = '" . (int)$service_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', description_short = '" . $this->db->escape($value['description_short']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$level = 0;

		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "service_path` WHERE service_id = '" . (int)$data['parent_id'] . "' ORDER BY `level` ASC");

		foreach ($query->rows as $result) {
			$this->db->query("INSERT INTO `" . DB_PREFIX . "service_path` SET `service_id` = '" . (int)$service_id . "', `path_id` = '" . (int)$result['path_id'] . "', `level` = '" . (int)$level . "'");

			$level++;
		}

		$this->db->query("INSERT INTO `" . DB_PREFIX . "service_path` SET `service_id` = '" . (int)$service_id . "', `path_id` = '" . (int)$service_id . "', `level` = '" . (int)$level . "'");

		if (isset($data['service_filter'])) {
			foreach ($data['service_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "service_filter SET service_id = '" . (int)$service_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		if (isset($data['service_store'])) {
			foreach ($data['service_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "service_to_store SET service_id = '" . (int)$service_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		// Set which layout to use with this service
		if (isset($data['service_layout'])) {
			foreach ($data['service_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "service_to_layout SET service_id = '" . (int)$service_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		if (isset($data['keyword'])) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'service_id=" . (int)$service_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('service');

		//$this->event->trigger('post.admin.service.add', $service_id);

		return $service_id;
	}

	public function editService($service_id, $data) {
		//$this->event->trigger('pre.admin.service.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "service SET parent_id = '" . (int)$data['parent_id'] . "', `bottom` = '" . (isset($data['bottom']) ? (int)$data['bottom'] : 0) . "', `top` = '" . (isset($data['top']) ? (int)$data['top'] : 0) . "', `column` = '" . (int)$data['column'] . "', sort_order = '" . (int)$data['sort_order'] . "', status = '" . (int)$data['status'] . "', customer_group_id = '" . (int)$data['customer_group_id'] . "', date_modified = NOW() WHERE service_id = '" . (int)$service_id . "'");

		if (isset($data['image'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "service SET image = '" . $this->db->escape($data['image']) . "' WHERE service_id = '" . (int)$service_id . "'");
		}

		if (isset($data['image_bg'])) {
			$this->db->query("UPDATE " . DB_PREFIX . "service SET image_bg = '" . $this->db->escape($data['image_bg']) . "' WHERE service_id = '" . (int)$service_id . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "service_description WHERE service_id = '" . (int)$service_id . "'");

		foreach ($data['service_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "service_description SET service_id = '" . (int)$service_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "', description = '" . $this->db->escape($value['description']) . "', description_short = '" . $this->db->escape($value['description_short']) . "', meta_title = '" . $this->db->escape($value['meta_title']) . "', meta_description = '" . $this->db->escape($value['meta_description']) . "', meta_keyword = '" . $this->db->escape($value['meta_keyword']) . "'");
		}

		// MySQL Hierarchical Data Closure Table Pattern
		$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "service_path` WHERE path_id = '" . (int)$service_id . "' ORDER BY level ASC");

		if ($query->rows) {
			foreach ($query->rows as $service_path) {
				// Delete the path below the current one
				$this->db->query("DELETE FROM `" . DB_PREFIX . "service_path` WHERE service_id = '" . (int)$service_path['service_id'] . "' AND level < '" . (int)$service_path['level'] . "'");

				$path = array();

				// Get the nodes new parents
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "service_path` WHERE service_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Get whats left of the nodes current path
				$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "service_path` WHERE service_id = '" . (int)$service_path['service_id'] . "' ORDER BY level ASC");

				foreach ($query->rows as $result) {
					$path[] = $result['path_id'];
				}

				// Combine the paths with a new level
				$level = 0;

				foreach ($path as $path_id) {
					$this->db->query("REPLACE INTO `" . DB_PREFIX . "service_path` SET service_id = '" . (int)$service_path['service_id'] . "', `path_id` = '" . (int)$path_id . "', level = '" . (int)$level . "'");

					$level++;
				}
			}
		} else {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "service_path` WHERE service_id = '" . (int)$service_id . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "service_path` WHERE service_id = '" . (int)$data['parent_id'] . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "service_path` SET service_id = '" . (int)$service_id . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "service_path` SET service_id = '" . (int)$service_id . "', `path_id` = '" . (int)$service_id . "', level = '" . (int)$level . "'");
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "service_filter WHERE service_id = '" . (int)$service_id . "'");

		if (isset($data['service_filter'])) {
			foreach ($data['service_filter'] as $filter_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "service_filter SET service_id = '" . (int)$service_id . "', filter_id = '" . (int)$filter_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "service_to_store WHERE service_id = '" . (int)$service_id . "'");

		if (isset($data['service_store'])) {
			foreach ($data['service_store'] as $store_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "service_to_store SET service_id = '" . (int)$service_id . "', store_id = '" . (int)$store_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "service_to_layout WHERE service_id = '" . (int)$service_id . "'");

		if (isset($data['service_layout'])) {
			foreach ($data['service_layout'] as $store_id => $layout_id) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "service_to_layout SET service_id = '" . (int)$service_id . "', store_id = '" . (int)$store_id . "', layout_id = '" . (int)$layout_id . "'");
			}
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'service_id=" . (int)$service_id . "'");

		if ($data['keyword']) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "url_alias SET query = 'service_id=" . (int)$service_id . "', keyword = '" . $this->db->escape($data['keyword']) . "'");
		}

		$this->cache->delete('service');

		//$this->event->trigger('post.admin.service.edit', $service_id);
	}

	public function deleteService($service_id) {
		//$this->event->trigger('pre.admin.service.delete', $service_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "service_path WHERE service_id = '" . (int)$service_id . "'");

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "service_path WHERE path_id = '" . (int)$service_id . "'");

		foreach ($query->rows as $result) {
			$this->deleteService($result['service_id']);
		}

		$this->db->query("DELETE FROM " . DB_PREFIX . "service WHERE service_id = '" . (int)$service_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "service_description WHERE service_id = '" . (int)$service_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "service_filter WHERE service_id = '" . (int)$service_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "service_to_store WHERE service_id = '" . (int)$service_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "service_to_layout WHERE service_id = '" . (int)$service_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "product_to_service WHERE service_id = '" . (int)$service_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "url_alias WHERE query = 'service_id=" . (int)$service_id . "'");

		$this->cache->delete('service');

		//$this->event->trigger('post.admin.service.delete', $service_id);
	}

	public function repairServices($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "service WHERE parent_id = '" . (int)$parent_id . "'");

		foreach ($query->rows as $service) {
			// Delete the path below the current one
			$this->db->query("DELETE FROM `" . DB_PREFIX . "service_path` WHERE service_id = '" . (int)$service['service_id'] . "'");

			// Fix for records with no paths
			$level = 0;

			$query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "service_path` WHERE service_id = '" . (int)$parent_id . "' ORDER BY level ASC");

			foreach ($query->rows as $result) {
				$this->db->query("INSERT INTO `" . DB_PREFIX . "service_path` SET service_id = '" . (int)$service['service_id'] . "', `path_id` = '" . (int)$result['path_id'] . "', level = '" . (int)$level . "'");

				$level++;
			}

			$this->db->query("REPLACE INTO `" . DB_PREFIX . "service_path` SET service_id = '" . (int)$service['service_id'] . "', `path_id` = '" . (int)$service['service_id'] . "', level = '" . (int)$level . "'");

			$this->repairServices($service['service_id']);
		}
	}

	public function getService($service_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT GROUP_CONCAT(cd1.name ORDER BY level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') FROM " . DB_PREFIX . "service_path cp LEFT JOIN " . DB_PREFIX . "service_description cd1 ON (cp.path_id = cd1.service_id AND cp.service_id != cp.path_id) WHERE cp.service_id = c.service_id AND cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY cp.service_id) AS path, (SELECT DISTINCT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'service_id=" . (int)$service_id . "') AS keyword FROM " . DB_PREFIX . "service c LEFT JOIN " . DB_PREFIX . "service_description cd2 ON (c.service_id = cd2.service_id) WHERE c.service_id = '" . (int)$service_id . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getServices($data = array()) {
		$sql = "SELECT cp.service_id AS service_id, GROUP_CONCAT(cd1.name ORDER BY cp.level SEPARATOR '&nbsp;&nbsp;&gt;&nbsp;&nbsp;') AS name, c1.parent_id, c1.sort_order FROM " . DB_PREFIX . "service_path cp LEFT JOIN " . DB_PREFIX . "service c1 ON (cp.service_id = c1.service_id) LEFT JOIN " . DB_PREFIX . "service c2 ON (cp.path_id = c2.service_id) LEFT JOIN " . DB_PREFIX . "service_description cd1 ON (cp.path_id = cd1.service_id) LEFT JOIN " . DB_PREFIX . "service_description cd2 ON (cp.service_id = cd2.service_id) WHERE cd1.language_id = '" . (int)$this->config->get('config_language_id') . "' AND cd2.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if (!empty($data['filter_name'])) {
			$sql .= " AND cd2.name LIKE '" . $this->db->escape($data['filter_name']) . "%'";
		}

		$sql .= " GROUP BY cp.service_id";

		$sort_data = array(
			'name',
			'sort_order'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY sort_order";
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

	public function getServiceDescriptions($service_id) {
		$service_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "service_description WHERE service_id = '" . (int)$service_id . "'");

		foreach ($query->rows as $result) {
			$service_description_data[$result['language_id']] = array(
				'name'              => $result['name'],
				'meta_title'        => $result['meta_title'],
				'meta_description'  => $result['meta_description'],
				'meta_keyword'      => $result['meta_keyword'],
				'description'       => $result['description'],
				'description_short' => $result['description_short']
			);
		}

		return $service_description_data;
	}

	public function getServiceCustomFields($service_id) {
		$query = $this->db->query("SELECT custom_field FROM " . DB_PREFIX . "service WHERE service_id = '" . (int)$service_id . "'");

		return $query->row['custom_field'];
	}

	public function editCustomFields($service_id, $data) {
		//$this->event->trigger('pre.admin.service.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "service SET custom_field = '" . $this->db->escape($data) . "', date_modified = NOW() WHERE service_id = '" . (int)$service_id . "'");

		$this->cache->delete('service');

		//$this->event->trigger('post.admin.service.edit', $service_id);
	}

	public function getServiceFilters($service_id) {
		$service_filter_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "service_filter WHERE service_id = '" . (int)$service_id . "'");

		foreach ($query->rows as $result) {
			$service_filter_data[] = $result['filter_id'];
		}

		return $service_filter_data;
	}

	public function getServiceStores($service_id) {
		$service_store_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "service_to_store WHERE service_id = '" . (int)$service_id . "'");

		foreach ($query->rows as $result) {
			$service_store_data[] = $result['store_id'];
		}

		return $service_store_data;
	}

	public function getServiceLayouts($service_id) {
		$service_layout_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "service_to_layout WHERE service_id = '" . (int)$service_id . "'");

		foreach ($query->rows as $result) {
			$service_layout_data[$result['store_id']] = $result['layout_id'];
		}

		return $service_layout_data;
	}

	public function getTotalServices() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "service");

		return $query->row['total'];
	}
	
	public function getTotalServicesByLayoutId($layout_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "service_to_layout WHERE layout_id = '" . (int)$layout_id . "'");

		return $query->row['total'];
	}	
}
