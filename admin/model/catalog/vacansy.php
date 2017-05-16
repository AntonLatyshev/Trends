<?php
class ModelCatalogVacansy extends Model {

	public function getVacansies($data = array()) {
		$sql = "SELECT va.*, vad.vac_name, vad.vac_city FROM " . DB_PREFIX . "vacansies va "
				. "LEFT JOIN " . DB_PREFIX . "vacansies_description vad ON (va.vacansy_id = vad.vacansy_id) "
				. "WHERE vad.language_id = '" . (int)$this->config->get('config_language_id') . "' "
				. "ORDER BY vad.vac_city, vad.vac_name";

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
	
	public function getTotalVacansies() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "vacansies");

		return $query->row['total'];
	}	
	
	public function getVacansy($vacansy_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vacansies va "
				. "LEFT JOIN " . DB_PREFIX . "vacansies_description vad ON (vad.vacansy_id = va.vacansy_id) "
				. "WHERE va.vacansy_id = '" . (int)$vacansy_id . "' AND vad.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}
	
	public function getVacansyDescriptions($vacansy_id) {
		$vacansy_description_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "vacansies_description WHERE vacansy_id = '" . (int)$vacansy_id . "'");

		foreach ($query->rows as $result) {
			$vacansy_description_data[$result['language_id']] = array(
				'vac_city'         => $result['vac_city'],
				'vac_name'         => $result['vac_name'],
				'vac_requirements' => $result['vac_requirements'],
				'vac_conditions'   => $result['vac_conditions'],
				'vac_schort_text'  => $result['vac_schort_text']
			);
		}

		return $vacansy_description_data;
	}

	public function getVacansyCities() {
		$vacansy_cities = array();

		$query = $this->db->query("SELECT DISTINCT vac_city as city, language_id FROM " . DB_PREFIX . "vacansies_description");

		foreach ($query->rows as $result) {
			$vacansy_cities[$result['language_id']][] = $result['city'];
		}
		
		return $vacansy_cities;
	}
	
	public function editVacansy($vacansy_id, $data) {

		$this->db->query("UPDATE " . DB_PREFIX . "vacansies SET status = '" . (int)$data['status'] . "', vac_date = NOW() WHERE vacansy_id = '" . (int)$vacansy_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "vacansies_description WHERE vacansy_id = '" . (int)$vacansy_id . "'");

		foreach ($data['vacansy_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "vacansies_description SET "
					. "vacansy_id = '" . (int)$vacansy_id . "', "
					. "language_id = '" . (int)$language_id . "', "
					. "vac_name = '" . $this->db->escape($value['vac_name']) . "', "
					. "vac_city = '" . $this->db->escape($value['vac_city']) . "', "
					. "vac_schort_text = '" . $this->db->escape($value['vac_schort_text']) . "', "
					. "vac_requirements = '" . $this->db->escape($value['vac_requirements']) . "', "
					. "vac_conditions = '" . $this->db->escape($value['vac_conditions']) . "'");
		}

	}
	
	public function getVacansyKeyword($vacansy_id) {
		$query = $this->db->query("SELECT keyword FROM " . DB_PREFIX . "url_alias WHERE query = 'vacansy_id=" . (int)$vacansy_id . "'");
		if(isset($query->row['keyword'])){
			return $query->row['keyword'];
		}
		else{
			return false;
		}
	}
	
	public function addVacansy($data) {
		$this->db->query("INSERT INTO " . DB_PREFIX . "vacansies SET status = '" . (int)$data['status'] . "', vac_date = NOW()");
		$vacansy_id = $this->db->getLastId();

		foreach ($data['vacansy_description'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "vacansies_description SET "
					. "vacansy_id = '" . (int)$vacansy_id . "', "
					. "language_id = '" . (int)$language_id . "', "
					. "vac_name = '" . $this->db->escape($value['vac_name']) . "', "
					. "vac_city = '" . $this->db->escape($value['vac_city']) . "', "
					. "vac_requirements = '" . $this->db->escape($value['vac_requirements']) . "', "
					. "vac_conditions = '" . $this->db->escape($value['vac_conditions']) . "', "
					. "vac_schort_text = '" . $this->db->escape($value['vac_schort_text']) . "'");
		}
		return $vacansy_id;
	}
	
	public function deleteVacansy($vacansy_id) {

		$this->db->query("DELETE FROM " . DB_PREFIX . "vacansies WHERE vacansy_id = '" . (int)$vacansy_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "vacansies_description WHERE vacansy_id = '" . (int)$vacansy_id . "'");

		return true;
	}
}
