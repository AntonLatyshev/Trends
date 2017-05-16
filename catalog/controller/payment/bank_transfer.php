<?php
class ControllerPaymentBankTransfer extends Controller {
	public function index() {
		$this->load->language('payment/bank_transfer');

		$data['text_instruction'] = $this->language->get('text_instruction');
		$data['text_description'] = $this->language->get('text_description');
		$data['text_payment'] = $this->language->get('text_payment');
		$data['text_loading'] = $this->language->get('text_loading');

		$data['button_confirm'] = $this->language->get('button_confirm');

		$data['bank'] = nl2br($this->config->get('bank_transfer_bank' . $this->config->get('config_language_id')));

		$data['continue'] = $this->url->link('checkout/success');

		if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/payment/bank_transfer.tpl')) {
			return $this->load->view($this->config->get('config_template') . '/template/payment/bank_transfer.tpl', $data);
		} else {
			return $this->load->view('default/template/payment/bank_transfer.tpl', $data);
		}
	}

	public function confirm() {
		if ($this->session->data['payment_method']['code'] == 'bank_transfer') {
			// Add model
			$this->load->model('account/activity');
			$this->load->model('account/customer');
			$this->load->model('account/customer_group');

			/**
			 *
			 * Register customer
			 *
			 */
			if ( $this->customer->isLogged() ) {
				$activity_data = array(
					'customer_id' => $this->customer->getId(),
					'name'        => $this->customer->getFirstName() . ' ' . $this->customer->getLastName(),
					'order_id'    => $this->session->data['order_id']
				);

				$this->model_account_activity->addActivity('order_account', $activity_data);
			} else {
				$activity_data = array(
					'name'     => $this->session->data['guest']['firstname'],
					'order_id' => $this->session->data['order_id']
				);

				$this->model_account_activity->addActivity('order_guest', $activity_data);
			}

			if ( !empty($this->session->data['account']) && ($this->session->data['account'] == 'register' && !$this->customer->isLogged()) ) {
				$customer_id = $this->model_account_customer->addCustomerCheckout($this->session->data['guest']);

				// Customer Group
				if ( isset($this->session->data['guest']['customer_group_id']) && is_array($this->config->get('config_customer_group_display')) && in_array($this->session->data['guest']['customer_group_id'], $this->config->get('config_customer_group_display'))) {
					$customer_group_id = $this->session->data['guest']['customer_group_id'];
				} else {
					$customer_group_id = $this->config->get('config_customer_group_id');
				}

				// Clear any previous login attempts for unregistered accounts.
				$this->model_account_customer->deleteLoginAttempts($this->session->data['guest']['email']);

				$this->session->data['account'] = 'register';

				$customer_group_info = $this->model_account_customer_group->getCustomerGroup($customer_group_id);

				if ($customer_group_info && !$customer_group_info['approval']) {
					$this->customer->login($this->session->data['guest']['email'], $this->session->data['guest']['password']);
				} else {
					$json['redirect'] = $this->url->link('account/success');
				}

				$activity_data = array(
					'customer_id' => $customer_id,
					'name'        => $this->session->data['guest']['firstname']
				);

				$this->model_account_activity->addActivity('register', $activity_data);

			}
			
			$this->load->language('payment/bank_transfer');

			$this->load->model('checkout/order');

			$comment  = $this->language->get('text_instruction') . "\n\n";
			$comment .= $this->config->get('bank_transfer_bank' . $this->config->get('config_language_id')) . "\n\n";
			$comment .= $this->language->get('text_payment');

			$this->model_checkout_order->addOrderHistory($this->session->data['order_id'], $this->config->get('bank_transfer_order_status_id'), $comment, true);
		}
	}
}