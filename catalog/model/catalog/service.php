<?php
class ModelCatalogService extends Model {

    public function getServicePath($service_id){
        $path = '';
        $service = $this->db->query("SELECT c.parent_id, c.service_id FROM " . DB_PREFIX . "service c WHERE c.service_id = " .(int)($service_id));

        if($service->row['parent_id'] != 0){
            $path .= $this->getServicePath($service->row['parent_id']) . '_';
        }

        $path .= $service->row['service_id'];

        return $path;
    }

	public function getService($service_id) {
		$query = $this->db->query("SELECT DISTINCT * FROM " . DB_PREFIX . "service c LEFT JOIN " . DB_PREFIX . "service_description cd ON (c.service_id = cd.service_id) LEFT JOIN " . DB_PREFIX . "service_to_store c2s ON (c.service_id = c2s.service_id) WHERE c.service_id = '" . (int)$service_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

		return $query->row;
	}

	public function getServices($parent_id = 0) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "service c LEFT JOIN " . DB_PREFIX . "service_description cd ON (c.service_id = cd.service_id) LEFT JOIN " . DB_PREFIX . "service_to_store c2s ON (c.service_id = c2s.service_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND cd.language_id = '" . (int)$this->config->get('config_language_id') . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "'  AND c.status = '1' ORDER BY c.sort_order, LCASE(cd.name)");

		return $query->rows;
	}

	public function getServiceFilters($service_id) {
		$implode = array();

		$query = $this->db->query("SELECT filter_id FROM " . DB_PREFIX . "service_filter WHERE service_id = '" . (int)$service_id . "'");

		foreach ($query->rows as $result) {
			$implode[] = (int)$result['filter_id'];
		}

		$filter_group_data = array();

		if ($implode) {
			$filter_group_query = $this->db->query("SELECT DISTINCT f.filter_group_id, fgd.name, fg.sort_order FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_group fg ON (f.filter_group_id = fg.filter_group_id) LEFT JOIN " . DB_PREFIX . "filter_group_description fgd ON (fg.filter_group_id = fgd.filter_group_id) WHERE f.filter_id IN (" . implode(',', $implode) . ") AND fgd.language_id = '" . (int)$this->config->get('config_language_id') . "' GROUP BY f.filter_group_id ORDER BY fg.sort_order, LCASE(fgd.name)");

			foreach ($filter_group_query->rows as $filter_group) {
				$filter_data = array();

				$filter_query = $this->db->query("SELECT DISTINCT f.filter_id, fd.name FROM " . DB_PREFIX . "filter f LEFT JOIN " . DB_PREFIX . "filter_description fd ON (f.filter_id = fd.filter_id) WHERE f.filter_id IN (" . implode(',', $implode) . ") AND f.filter_group_id = '" . (int)$filter_group['filter_group_id'] . "' AND fd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY f.sort_order, LCASE(fd.name)");

				foreach ($filter_query->rows as $filter) {
					$filter_data[] = array(
						'filter_id' => $filter['filter_id'],
						'name'      => $filter['name']
					);
				}

				if ($filter_data) {
					$filter_group_data[] = array(
						'filter_group_id' => $filter_group['filter_group_id'],
						'name'            => $filter_group['name'],
						'filter'          => $filter_data
					);
				}
			}
		}

		return $filter_group_data;
	}

	public function getServiceLayoutId($service_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "service_to_layout WHERE service_id = '" . (int)$service_id . "' AND store_id = '" . (int)$this->config->get('config_store_id') . "'");

		if ($query->num_rows) {
			return $query->row['layout_id'];
		} else {
			return 0;
		}
	}

	public function getTotalServicesByServiceId($parent_id = 0) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "service c LEFT JOIN " . DB_PREFIX . "service_to_store c2s ON (c.service_id = c2s.service_id) WHERE c.parent_id = '" . (int)$parent_id . "' AND c2s.store_id = '" . (int)$this->config->get('config_store_id') . "' AND c.status = '1'");

		return $query->row['total'];
	}
}