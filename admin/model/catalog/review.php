<?php
class ModelCatalogReview extends Model {
	public function addReview($data) {
		//$this->event->trigger('pre.admin.review.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "review SET author = '" . $this->db->escape($data['author']) . "', email = '" . $this->db->escape($data['email']) . "', product_id = '" . (int)$data['product_id'] . "', likes = '" . (int)$data['like'] . "', dislike = '" . (int)$data['dislike'] . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', rating = '" . (int)$data['rating'] . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		$review_id = $this->db->getLastId();

		$this->cache->delete('product');

		//$this->event->trigger('post.admin.review.add', $review_id);

		return $review_id;
	}

	public function addReviewAnswer($data) {
		//$this->event->trigger('pre.admin.review.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "review_answers SET review_id = '". (int)$data['review_id'] ."', author = '" . $this->db->escape($data['author']) . "', email = '" . $this->db->escape($data['email']) . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', status = '" . (int)$data['status'] . "', date_added = NOW()");

		$answer_id = $this->db->getLastId();

		$this->cache->delete('product');

		//$this->event->trigger('post.admin.review.add', $review_id);

		return $answer_id;
	}

	public function editReview($review_id, $data) {
		//$this->event->trigger('pre.admin.review.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "review SET author = '" . $this->db->escape($data['author']) . "', email = '" . $this->db->escape($data['email']) . "', product_id = '" . (int)$data['product_id'] . "', likes = '" . (int)$data['like'] . "', dislike = '" . (int)$data['dislike'] . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', rating = '" . (int)$data['rating'] . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE review_id = '" . (int)$review_id . "'");

		$this->cache->delete('product');

		//$this->event->trigger('post.admin.review.edit', $review_id);
	}

	public function editReviewAnswer($answer_id, $data) {
		//$this->event->trigger('pre.admin.review.edit', $data);

		$this->db->query("UPDATE " . DB_PREFIX . "review_answers SET author = '" . $this->db->escape($data['author']) . "', email = '" . $this->db->escape($data['email']) . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', status = '" . (int)$data['status'] . "', date_modified = NOW() WHERE answer_id = '" . (int)$answer_id . "'");

		$this->cache->delete('product');

		//$this->event->trigger('post.admin.review.edit', $review_id);
	}

	public function deleteReview($review_id) {
		//$this->event->trigger('pre.admin.review.delete', $review_id);

		$this->db->query("DELETE FROM " . DB_PREFIX . "review WHERE review_id = '" . (int)$review_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "review_answers WHERE review_id = '" . (int)$review_id . "'");
		$this->db->query("DELETE FROM " . DB_PREFIX . "review_score WHERE review_id = '" . (int)$review_id . "'");

		$this->cache->delete('product');

		//$this->event->trigger('post.admin.review.delete', $review_id);
	}

	public function deleteReviewAnswer($answer_id){
		$this->db->query("DELETE FROM " . DB_PREFIX . "review_answers WHERE answer_id = '" . (int)$answer_id . "'");
	}

	public function getReview($review_id) {
		$query = $this->db->query("SELECT DISTINCT *, (SELECT pd.name FROM " . DB_PREFIX . "product_description pd WHERE pd.product_id = r.product_id AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "') AS product FROM " . DB_PREFIX . "review r WHERE r.review_id = '" . (int)$review_id . "'");

		return $query->row;
	}

	public function getReviewAnswer($answer_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "review_answers ra WHERE ra.answer_id = '" . (int)$answer_id . "'");

		return $query->row;
	}

	public function getReviewAnswers($review_id){
		$query = $this->db->query("SELECT DISTINCT ra.answer_id, ra.review_id ,ra.author, ra.email, ra.text, ra.status, ra.date_added FROM " . DB_PREFIX . "review_answers ra LEFT JOIN " . DB_PREFIX . "review r ON(ra.review_id = r.review_id) WHERE r.review_id = '". (int)$review_id ."' ORDER BY ra.answer_id ASC ");

		if($query->num_rows){
			return $query->rows;
		} else {
			return false;
		}
	}

	public function getReviews($data = array()) {
		$sql = "SELECT r.review_id, pd.name, r.author, r.email, r.rating, r.likes, r.dislike, r.status, r.date_added, (SELECT COUNT(*) FROM " . DB_PREFIX . "review_answers ra WHERE ra.review_id = r.review_id AND ra.`status` = 0) as answer_new FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product_description pd ON (r.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if(!empty($data['filter_product_id'])){
			$sql .= " AND r.product_id = '". (int)$data['filter_product_id'] ."'";
		}

		if(isset($data['filter_status'])){
			$sql .= " AND r.status = '". (int)$data['filter_status'] ."'";
		}

		if(!empty($data['filter_author'])){
			$sql .= " AND r.author LIKE '%". $this->db->escape($data['filter_author']) ."%'";
		}

		if(!empty($data['filter_product'])){
			$sql .= " AND pd.name LIKE '%". $this->db->escape($data['filter_product']) ."%'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$sort_data = array(
			'r.author',
			'r.rating',
			'r.status',
			'r.date_added',
			'answer_new'
		);

		if (isset($data['sort']) && in_array($data['sort'], $sort_data)) {
			$sql .= " ORDER BY " . $data['sort'];
		} else {
			$sql .= " ORDER BY r.date_added";
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

	public function getTotalReviews($data = array()) {

		$sql = "SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product_description pd ON (r.product_id = pd.product_id) WHERE pd.language_id = '" . (int)$this->config->get('config_language_id') . "'";

		if(!empty($data['filter_product_id'])){
			$sql .= " AND r.product_id = '". (int)$data['filter_product_id'] ."'";
		}

		if(isset($data['filter_status'])){
			$sql .= " AND r.status = '". (int)$data['filter_status'] ."'";
		}

		if(!empty($data['filter_author'])){
			$sql .= " AND r.author LIKE '%". $this->db->escape($data['filter_author']) ."%'";
		}

		if(!empty($data['filter_product'])){
			$sql .= " AND pd.name LIKE '%". $this->db->escape($data['filter_product']) ."%'";
		}

		if (!empty($data['filter_date_added'])) {
			$sql .= " AND DATE(r.date_added) = DATE('" . $this->db->escape($data['filter_date_added']) . "')";
		}

		$query = $this->db->query($sql);

		return $query->row['total'];
	}

	public function getTotalReviewsAwaitingApproval() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review WHERE status = '0'");

		return $query->row['total'];
	}

	public function getNewAnswer($review_id) {
		$query = $this->db->query("SELECT ra.review_id FROM " . DB_PREFIX . "review_answers ra WHERE ra.review_id = '" . $review_id . "' AND ra.`status` = 0");
		if($query->row){
			return 1;
		}
		return false;
	}
}