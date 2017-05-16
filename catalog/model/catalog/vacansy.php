<?php
class ModelCatalogVacansy extends Model {
	
	public function getTotalVacansies() {
		$sql = "SELECT COUNT(DISTINCT vacansy_id) AS total FROM " . DB_PREFIX . "vacansies WHERE status = 1";

		$query = $this->db->query($sql);

		return $query->row['total'];
	}
	
	public function getVacansies($data = array()) {

		$sql = "SELECT va.vacansy_id, va.vac_date, vad.vac_city, vad.vac_name, vad.vac_schort_text, vad.vac_requirements FROM " . DB_PREFIX . "vacansies va "
			. "LEFT JOIN " . DB_PREFIX . "vacansies_description vad ON (vad.vacansy_id = va.vacansy_id) "
			. "WHERE va.status = 1 AND vad.language_id = '" . (int)$this->config->get('config_language_id')
			. "' ORDER BY vad.vac_city, vad.vac_name";
		
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

	public function getVacansyCities() {
		$vacansy_cities = array();
		
		$sql = "SELECT DISTINCT vad.vac_city as city FROM " . DB_PREFIX . "vacansies va "
			. "LEFT JOIN " . DB_PREFIX . "vacansies_description vad ON (vad.vacansy_id = va.vacansy_id) "
			. "WHERE va.status = 1 AND vad.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		$query = $this->db->query($sql);

		foreach ($query->rows as $result) {
			$vacansy_cities[] = $result['city'];
		}

		return $vacansy_cities;
	}
	
	public function getVacansy($vacansy_id) {
		
		$sql = "SELECT va.vacansy_id, va.vac_date, vad.* FROM " . DB_PREFIX . "vacansies va "
			. "LEFT JOIN " . DB_PREFIX . "vacansies_description vad ON (vad.vacansy_id = va.vacansy_id) "
			. "WHERE va.vacansy_id = '".$vacansy_id."' AND vad.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY vad.vac_name";
		
		$query = $this->db->query($sql);
		
		return $query->row;
	}
	
	public function getAllVacansyId() {
		$sql = "SELECT va.vacansy_id FROM " . DB_PREFIX . "vacansies va "
			. "LEFT JOIN " . DB_PREFIX . "vacansies_description vad ON (vad.vacansy_id = va.vacansy_id) "
			. "WHERE va.status = '1' AND vad.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY vad.vac_name";
		
		$query = $this->db->query($sql);
		$return_mass = array();
		
		foreach ($query->rows as $value) {
			$return_mass[] = $value['vacansy_id'];
		}
		
		return $return_mass;
	}

}
