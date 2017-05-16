<?php
class ModelCatalogReview extends Model {
	public function addReview($product_id, $data) {
		$this->event->trigger('pre.review.add', $data);

		$this->db->query("INSERT INTO " . DB_PREFIX . "review SET author = '" . $this->db->escape($data['name']) . "', email = '" . $this->db->escape($data['email']) . "', customer_id = '" . (int)$this->customer->getId() . "', product_id = '" . (int)$product_id . "', text = '" . $this->db->escape($data['text']) . "', rating = '" . (int)$data['review-condition'] . "', date_added = NOW()");

		$review_id = $this->db->getLastId();

		if ($this->config->get('config_review_mail')) {
			$this->load->language('mail/review');
			$this->load->model('catalog/product');

			$product_info = $this->model_catalog_product->getProduct($product_id);

			$subject = sprintf($this->language->get('text_subject'), html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));

			$message  = $this->language->get('text_waiting') . "\n";
			$message .= sprintf($this->language->get('text_product'), html_entity_decode($product_info['name'], ENT_QUOTES, 'UTF-8')) . "\n";
			$message .= sprintf($this->language->get('text_reviewer'), html_entity_decode($data['name'], ENT_QUOTES, 'UTF-8')) . "\n";
			$message .= sprintf($this->language->get('text_rating'), $data['review-condition']) . "\n";
			$message .= $this->language->get('text_review') . "\n";
			$message .= html_entity_decode($data['text'], ENT_QUOTES, 'UTF-8') . "\n\n";

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->config->get('config_email'));
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject($subject);
			$mail->setText($message);
			$mail->send();

			// Send to additional alert emails
			$emails = explode(',', $this->config->get('config_mail_alert'));

			foreach ($emails as $email) {
				if ($email && preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $email)) {
					$mail->setTo($email);
					$mail->send();
				}
			}
		}

		$this->event->trigger('post.review.add', $review_id);
	}

	public function getScoreByProduct($product_id, $review_id){
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "review_score WHERE customer_id = '".(int)$this->customer->getId()."' AND product_id = '".(int)$product_id."' AND review_id = '".(int)$review_id."'");

		if($query->row){
			return $query->row;
		} else {
			return false;
		}
	}

	public function addScoreReview($data = array()){

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "review_score WHERE customer_id = '".(int)$data['customer_id']."' AND product_id = '".(int)$data['product_id']."' AND review_id = '".(int)$data['review_id']."'")->row;

		if($query){
			if($query['likes'] && !$query['dislike'] && !$data['likes'] && $data['dislike']){
				$this->db->query("UPDATE " . DB_PREFIX . "review SET likes = (likes - 1), dislike = (dislike + 1) WHERE review_id = '" . (int)$data['review_id'] . "' AND product_id = '".(int)$data['product_id']."'");
				$this->db->query("UPDATE " . DB_PREFIX . "review_score SET dislike = '".(int)$data['dislike']."', likes = '".(int)$data['likes']."' WHERE customer_id = '".(int)$data['customer_id']."' AND product_id = '".(int)$data['product_id']."' AND review_id = '".(int)$data['review_id']."' ");
			} else if(!$query['likes'] && $query['dislike'] && $data['likes'] && !$data['dislike']){
				$this->db->query("UPDATE " . DB_PREFIX . "review SET likes = (likes + 1), dislike = (dislike - 1) WHERE review_id = '" . (int)$data['review_id'] . "' AND product_id = '".(int)$data['product_id']."'");
				$this->db->query("UPDATE " . DB_PREFIX . "review_score SET dislike = '".(int)$data['dislike']."', likes = '".(int)$data['likes']."' WHERE customer_id = '".(int)$data['customer_id']."' AND product_id = '".(int)$data['product_id']."' AND review_id = '".(int)$data['review_id']."' ");
			}
		} else {
			$this->db->query("INSERT INTO " . DB_PREFIX . "review_score SET dislike = '".(int)$data['dislike']."', likes = '".(int)$data['likes']."', customer_id = '".(int)$data['customer_id']."', product_id = '".(int)$data['product_id']."', review_id = '".(int)$data['review_id']."'");
			if($data['likes'] && !$data['dislike']){
				$this->db->query("UPDATE " . DB_PREFIX . "review SET likes = (likes + 1) WHERE review_id = '" . (int)$data['review_id'] . "' AND product_id = '".(int)$data['product_id']."'");
			} else if(!$data['likes'] && $data['dislike']){
				$this->db->query("UPDATE " . DB_PREFIX . "review SET dislike = (dislike + 1) WHERE review_id = '" . (int)$data['review_id'] . "' AND product_id = '".(int)$data['product_id']."'");
			}
		}

	}

	public function addReviewAnswer($data){
		$this->db->query("INSERT INTO " . DB_PREFIX . "review_answers SET review_id = '". (int)$data['review-id'] ."', author = '" . $this->db->escape($data['name']) . "', email = '" . $this->db->escape($data['email']) . "', text = '" . $this->db->escape(strip_tags($data['text'])) . "', date_added = NOW()");

		$answer_id = $this->db->getLastId();

		return $answer_id;
	}

	public function getReviewsByProductId($product_id, $start = 0, $limit = 20) {
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 20;
		}

		$query = $this->db->query("SELECT r.review_id, r.author, r.rating, r.text, p.product_id, pd.name, p.price, p.image, r.date_added, r.likes, r.dislike FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND p.status = '1' AND r.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY r.date_added DESC LIMIT " . (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getReviewAnswerByProductId($review_id, $start = 0, $limit = 20){
		if ($start < 0) {
			$start = 0;
		}

		if ($limit < 1) {
			$limit = 20;
		}

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "review_answers WHERE review_id = '". (int)$review_id ."' AND status = '1' ORDER BY answer_id ASC LIMIT ". (int)$start . "," . (int)$limit);

		return $query->rows;
	}

	public function getTotalReviewsByProductId($product_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review r LEFT JOIN " . DB_PREFIX . "product p ON (r.product_id = p.product_id) LEFT JOIN " . DB_PREFIX . "product_description pd ON (p.product_id = pd.product_id) WHERE p.product_id = '" . (int)$product_id . "' AND p.date_available <= NOW() AND p.status = '1' AND r.status = '1' AND pd.language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}

	public function getTotalReviewsAnswerByProductId($review_id) {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "review_answers WHERE review_id = '" . (int)$review_id . "'  AND status = '1'");

		return $query->row['total'];
	}
}