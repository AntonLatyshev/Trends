<?php
class ControllerModuleFaqTestimonial extends Controller {

	private $error = array();

	public function index() {
		$this->language->load('module/faq_testimonial');

		$data['heading_title'] = $this->language->get('heading_title');
		$data['entry_submit'] = $this->language->get('entry_submit');
		$data['entry_author_name'] = $this->language->get('entry_author_name');
		$data['entry_author_mail'] = $this->language->get('entry_author_mail');
		$data['entry_faq'] = $this->language->get('entry_faq');
		$data['error_email'] = $this->language->get('error_email');

		$data['text_success'] = $this->language->get('text_success');
		$data['text_empty'] = $this->language->get('text_empty');
		$data['text_form_title'] = $this->language->get('text_form_title');
		$data['button_more'] = $this->language->get('button_more');

		$this->load->model('fido/faq_testimonial');

		$data['action'] = $this->url->link('information/information', 'information_id=15', 'SSL');

		if(($this->request->server['REQUEST_METHOD'] == 'POST') && $this->validate()){
			$this->model_fido_faq_testimonial->addFaq($this->request->post);
			$this->session->data['success'] = true;

			// HTML Mail
			$data = array();
			$html = '';
			// Style
			$data['color_text'] = $this->config->get('config_mail_color_text');
			$data['color_background'] = $this->config->get('config_mail_color_background');

			// Text
			$data['text_store']  = $this->language->get('config_name');
			$data['mail_logo']  = HTTP_SERVER . 'image/' . $this->config->get('config_mail_logo');
			$data['mail_background']  = HTTP_SERVER . 'image/' . $this->config->get('config_mail_background');
			$data['mail_background_footer']  = HTTP_SERVER . 'image/' . $this->config->get('config_mail_background_footer');
			$data['config_name']  = $this->config->get('config_name');
			$data['date'] = date('j/m/Y') . ' в ' . date('H:i');

			$data['author'] = html_entity_decode($this->request->post['author_name'], ENT_QUOTES, 'UTF-8');
			$data['email'] = html_entity_decode($this->request->post['author_mail'], ENT_QUOTES, 'UTF-8');
			$data['title'] = nl2br(strip_tags(html_entity_decode($this->request->post['title'], ENT_QUOTES, 'UTF-8')));

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/mail/reviews.tpl')) {
				$html = $this->load->view($this->config->get('config_template') . '/template/mail/reviews.tpl', $data);
			} else {
				$html = $this->load->view('default/template/mail/reviews.tpl', $data);
			}

			$mail = new Mail();
			$mail->protocol = $this->config->get('config_mail_protocol');
			$mail->parameter = $this->config->get('config_mail_parameter');
			$mail->smtp_hostname = $this->config->get('config_mail_smtp_hostname');
			$mail->smtp_username = $this->config->get('config_mail_smtp_username');
			$mail->smtp_password = html_entity_decode($this->config->get('config_mail_smtp_password'), ENT_QUOTES, 'UTF-8');
			$mail->smtp_port = $this->config->get('config_mail_smtp_port');
			$mail->smtp_timeout = $this->config->get('config_mail_smtp_timeout');

			$mail->setTo($this->config->get('config_email'));
			$mail->setFrom($this->request->post['author_mail']);
			$mail->setSender(html_entity_decode($this->config->get('config_name'), ENT_QUOTES, 'UTF-8'));
			$mail->setSubject('Добавлен новый вопрос');
			$mail->setHtml($html);
			$mail->send();
			
			$this->response->redirect($this->url->link('information/information', 'information_id=15', 'SSL'));
		}

		$data['error_author_name'] = '';
		if (isset($this->error['author_name'])) {
			$data['error_author_name'] = $this->error['author_name'];
			unset($this->error['author_name']);
		}

		$data['error_author_email'] = '';
		if (isset($this->error['author_mail'])) {
			$data['error_author_email'] = $this->error['author_mail'];
			unset($this->error['author_mail']);
		}

		$data['error_title'] = '';
		if (isset($this->error['title'])) {
			$data['error_title'] = $this->error['title'];
			unset($this->error['title']);
		}

		$data['success'] = false;
		if (isset($this->session->data['success'])){
			$data['success'] = true;
			unset($this->session->data['success']);
		}

		if (isset($this->request->post['author_name']))
			$data['author_name'] = $this->request->post['author_name'];
		else
			$data['author_name'] = $this->customer->getFirstName();

		if (isset($this->request->post['author_mail']))
			$data['author_mail'] = $this->request->post['author_mail'];
		else
			$data['author_mail'] = $this->customer->getEmail();

		$data['title'] = '';
		if (isset($this->request->post['title']))
			$data['title'] = $this->request->post['title'];

		

		if (isset($this->request->get['topic'])) {
			$parts = explode('_', (string)$this->request->get['topic']);
		} else {
			$parts = array();
		}

		if (isset($parts[0])) {
			$data['topic_id'] = $parts[0];
		} else {
			$data['topic_id'] = 0;
		}

		if (isset($parts[1])) {
			$data['child_id'] = $parts[1];
		} else {
			$data['child_id'] = 0;
		}

		// Get topic #START
		// ================
		$data['topics'] = array();

		$topics = $this->model_fido_faq_testimonial->getTopicList();

		foreach ($topics as $topic) {

			$children_data = array();

			$children = $this->model_fido_faq_testimonial->getTopics($topic['topic_id']);

			foreach ($children as $child) {
				$children_data[] = array(
					'faq_id'      	=> $child['faq_id'],
					'title'       	=> strip_tags(html_entity_decode($child['title'], ENT_QUOTES, 'UTF-8')),
					'description'	=> html_entity_decode($child['description'], ENT_QUOTES, 'UTF-8'),
				);
			}

			$data['topics'][] = array(
				'topic_id'	=> $topic['topic_id'],
				'faqs'		=> $children_data,
				'name'		=> strip_tags(html_entity_decode($topic['name'], ENT_QUOTES, 'UTF-8')),
			);
		}
		// ==============
		// Get topic #END

		$data['faqs'] = array();

		$faqs = $this->model_fido_faq_testimonial->getTopics(0);

		foreach ($faqs as $faq) {
			$children_data = array();

			$children = $this->model_fido_faq_testimonial->getTopics($faq['faq_id']);

			foreach ($children as $child) {
				$data = array(
					'filter_faq_id'  => $child['faq_id'],
					'filter_sub_faq' => true
				);

				$children_data[] = array(
					'faq_id'      => $child['faq_id'],
					'title'       => strip_tags(html_entity_decode($child['title'], ENT_QUOTES, 'UTF-8')),
					'href'        => $this->url->link('information/faq', 'topic=' . $faq['faq_id'] . '_' . $child['faq_id'])
				);
			}

			$data['faqs'][] = array(
				'faq_id'		=> $faq['faq_id'],
				'title'			=> strip_tags(html_entity_decode($faq['title'], ENT_QUOTES, 'UTF-8')),
				'description'	=> html_entity_decode($faq['description'], ENT_QUOTES, 'UTF-8'),
				'author_name'	=> $faq['author_name'],
				'moderator_name'=> $faq['moderator_name'],
				'children'		=> $children_data,
				'href'			=> $this->url->link('information/faq_testimonial', 'topic=' . $faq['faq_id'])
			);
		}

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/module/faq_testimonial.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/module/faq_testimonial.tpl', $data);
		} else {
			return $this->load->view('default/template/module/faq_testimonial.tpl', $data);
		}
  	}

	private function validate(){
		if ((strlen(trim(utf8_decode($this->request->post['author_name']))) < 2) || (strlen(trim(utf8_decode($this->request->post['author_name']))) > 20)) {
			$this->error['author_name'] = $this->language->get('error_author_name');
		}
		if ((strlen(utf8_decode($this->request->post['title'])) < 5) || (strlen(utf8_decode($this->request->post['title'])) > 500)) {
			$this->error['title'] = $this->language->get('error_title');
		}
		if (!preg_match('/^[^\@]+@.*.[a-z]{2,15}$/i', $this->request->post['author_mail'])) {
			$this->error['author_mail'] = $this->language->get('error_email');
		}

		if (!$this->error) {
			return TRUE;
		} else {
			return FALSE;
		}
	}




}