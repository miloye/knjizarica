<?php
class ControllerCheckoutCart extends Controller {
	public function index() {
		$this->load->language('checkout/cart');

		$this->document->setTitle($this->language->get('heading_title'));

		$data['breadcrumbs'] = array();

		$data['breadcrumbs'][] = array(
			'href' => $this->url->link('common/home'),
			'text' => $this->language->get('text_home')
		);

		$data['breadcrumbs'][] = array(
			'href' => $this->url->link('checkout/cart'),
			'text' => $this->language->get('heading_title')
		);

		if ($this->cart->hasProducts() || !empty($this->session->data['vouchers'])) {
			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_recurring_item'] = $this->language->get('text_recurring_item');
			$data['text_next'] = $this->language->get('text_next');
			$data['text_next_choice'] = $this->language->get('text_next_choice');

			$data['column_image'] = $this->language->get('column_image');
			$data['column_name'] = $this->language->get('column_name');
			$data['column_model'] = $this->language->get('column_model');
			$data['column_quantity'] = $this->language->get('column_quantity');
			$data['column_price'] = $this->language->get('column_price');
			$data['column_total'] = $this->language->get('column_total');

			$data['button_update'] = $this->language->get('button_update');
			$data['button_remove'] = $this->language->get('button_remove');
			$data['button_shopping'] = $this->language->get('button_shopping');
			$data['button_checkout'] = $this->language->get('button_checkout');

			if (!$this->cart->hasStock() && (!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning'))) {
				$data['error_warning'] = $this->language->get('error_stock');
			} elseif (isset($this->session->data['error'])) {
				$data['error_warning'] = $this->session->data['error'];

				unset($this->session->data['error']);
			} else {
				$data['error_warning'] = '';
			}

			if ($this->config->get('config_customer_price') && !$this->customer->isLogged()) {
				$data['attention'] = sprintf($this->language->get('text_login'), $this->url->link('account/login'), $this->url->link('account/register'));
			} else {
				$data['attention'] = '';
			}

			if (isset($this->session->data['success'])) {
				$data['success'] = $this->session->data['success'];

				unset($this->session->data['success']);
			} else {
				$data['success'] = '';
			}

			$data['action'] = $this->url->link('checkout/cart/edit', '', true);

			if ($this->config->get('config_cart_weight')) {
				$data['weight'] = $this->weight->format($this->cart->getWeight(), $this->config->get('config_weight_class_id'), $this->language->get('decimal_point'), $this->language->get('thousand_point'));
			} else {
				$data['weight'] = '';
			}

			$this->load->model('tool/image');
			$this->load->model('tool/upload');

			$data['products'] = array();

			$products = $this->cart->getProducts();

			foreach ($products as $product) {
				$product_total = 0;

				foreach ($products as $product_2) {
					if ($product_2['product_id'] == $product['product_id']) {
						$product_total += $product_2['quantity'];
					}
				}

				if ($product['minimum'] > $product_total) {
					$data['error_warning'] = sprintf($this->language->get('error_minimum'), $product['name'], $product['minimum']);
				}

				if ($product['image']) {
					$image = $this->model_tool_image->resize($product['image'], $this->config->get('config_image_cart_width'), $this->config->get('config_image_cart_height'));
				} else {
					$image = '';
				}

				$option_data = array();

				foreach ($product['option'] as $option) {
					if ($option['type'] != 'file') {
						$value = $option['value'];
					} else {
						$upload_info = $this->model_tool_upload->getUploadByCode($option['value']);

						if ($upload_info) {
							$value = $upload_info['name'];
						} else {
							$value = '';
						}
					}

					$option_data[] = array(
						'name'  => $option['name'],
						'value' => (utf8_strlen($value) > 20 ? utf8_substr($value, 0, 20) . '..' : $value)
					);
				}

				// Display prices
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$price = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')));
				} else {
					$price = false;
				}

				// Display prices
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$total = $this->currency->format($this->tax->calculate($product['price'], $product['tax_class_id'], $this->config->get('config_tax')) * $product['quantity']);
				} else {
					$total = false;
				}

				$recurring = '';

				if ($product['recurring']) {
					$frequencies = array(
						'day'        => $this->language->get('text_day'),
						'week'       => $this->language->get('text_week'),
						'semi_month' => $this->language->get('text_semi_month'),
						'month'      => $this->language->get('text_month'),
						'year'       => $this->language->get('text_year'),
					);

					if ($product['recurring']['trial']) {
						$recurring = sprintf($this->language->get('text_trial_description'), $this->currency->format($this->tax->calculate($product['recurring']['trial_price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax'))), $product['recurring']['trial_cycle'], $frequencies[$product['recurring']['trial_frequency']], $product['recurring']['trial_duration']) . ' ';
					}

					if ($product['recurring']['duration']) {
						$recurring .= sprintf($this->language->get('text_payment_description'), $this->currency->format($this->tax->calculate($product['recurring']['price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax'))), $product['recurring']['cycle'], $frequencies[$product['recurring']['frequency']], $product['recurring']['duration']);
					} else {
						$recurring .= sprintf($this->language->get('text_payment_cancel'), $this->currency->format($this->tax->calculate($product['recurring']['price'] * $product['quantity'], $product['tax_class_id'], $this->config->get('config_tax'))), $product['recurring']['cycle'], $frequencies[$product['recurring']['frequency']], $product['recurring']['duration']);
					}
				}


				if(!defined('ROOT')) define('ROOT', str_replace('system/', 'tshirtecommerce', DIR_SYSTEM));
				if(!defined('DS')) define('DS', DIRECTORY_SEPARATOR);

				include_once ROOT . DS . 'includes' . DS . 'functions.php';

				$dg 	= new dg();
				$lang 	= $dg->lang();

				$data['tshirtecommerce_designer_cart_edit'] = $lang['designer_cart_edit'];
				$data['tshirtecommerce_printing_type'] 		= $lang['tshirtecommerce_printing_type'];

				if (isset($product['design']) && $product['design'] != false && isset($product['design']['rowid']))
				{					
					$design = $product['design'];
					$item 	= $this->db->query("SELECT product_id, design_product_id FROM `" . DB_PREFIX . "product` WHERE status = 1 AND product_id = '".$product['design']['product_id']."'");

					$design_product_id = 0;
					if ($item->num_rows) $design_product_id = $item->row['design_product_id'];

					$keys = explode(':', $design_product_id); //$design['color_hex']
					if(count($keys) > 1 && isset($keys[3]) && isset($design['color_hex'])) 
					{
						$keys[3] 			= $design['color_hex'];
						$design_product_id 	= $keys[0].':'.$keys[1].':'.$keys[2].':'.$keys[3];
					}
					$product['design']['design_product_id'] = $design_product_id;

					/* images */
					if (isset($design['images']))
					{
						$images = json_decode(str_replace('&quot;', '"', $design['images']), true);

						if (count($images) > 0)
						{
							if (isset($this->request->server['HTTPS']) && (($this->request->server['HTTPS'] == 'on') || ($this->request->server['HTTPS'] == '1')))
								$base_url = $this->config->get('config_ssl');
							else
								$base_url = $this->config->get('config_url');

							$img = '';
							foreach($images as $view => $src)
							{
								$img .= '<a href="'.$base_url.'/tshirtecommerce/'.$src.'"><img style="width:100px; margin:1%;" src="'.$base_url.'/tshirtecommerce/'.$src.'" alt="" title="" class="img-thumbnail"></a>';
							}
							$design_option = array(
								'name'	=> 'Images',
								'value'	=> '<br /><div>'.$img.'</div>'
							);
							$option_data[] = $design_option;
						}
					}

					/* colors */
					$design_option = array(
						'name'	=> 'Color',
						'value'	=> '<span title="'.$design['color_title'].'" style="background-color:#'.$design['color_hex'].';display:inline-block;border:1px solid #ccc;width:25px;height:25px;cursor:pointer;outline:1px solid #229BCA;margin-left 4px;"></span>'
					);
					$option_data[] = $design_option;
					
					/* options */
					if (isset($design['options']) && $design['options'] != '[]')
					{
						if (is_string($design['options'])) $design_options = json_decode( str_replace('&quot;', '"', $design['options']) );
						else $design_options = $design['options'];

						$html = '';
						for($i=0; $i<count($design_options); $i++)
						{
							if (empty($design_options[$i]['value'])) continue;

							if (is_string($design_options[$i]['value']) && $design_options[$i]['value'] != '')
							{
								// Fixed Printing type is empty
								if(empty($design_options[$i]['name']) && $design_options[$i]['type'] == 'printing')
									$design_options[$i]['name'] = $data['tshirtecommerce_printing_type']; //'Printing type'

								$html .= '<dt>'.$design_options[$i]['name'].': '.$design_options[$i]['value'].'</dt>';
							}
							elseif (count($design_options[$i]['value']) > 0)
							{
								$html .= '<dt>'.$design_options[$i]['name'].': </dt>';
								$html .=  '<dd>';

								foreach ($design_options[$i]['value'] as $name => $value)
								{
									if($design_options[$i]['type'] == 'checkbox')
									{
										$html .=  $value. '; ';
									}
									else
									{
										if($value != '0' && $value != 0)
											$html .=  $name.'  -  '.$value. '; ';
									}
								}
								$html .=  '</dd>';
							}
						}
						$design_option = array(
							'name'	=> 'Options',
							'value'	=> $html
						);
						$option_data[] = $design_option;
					}

					/* teams */
					if (isset($design['teams']) && isset($design['teams']['name']) )
					{
						$table = '<table class="table table-bordered">'
							. 		'<thead>'
							. 			'<tr>'
							. 				'<th>Name</th>'
							. 				'<th>Number</th>'
							. 				'<th>Sizes</th>'
							. 			'</tr>'
							. 		'</thead>'
							. 		'<tbody>';
							
						for($i=1; $i<=count($design['teams']['name']); $i++ )
						{
							$size = explode('::', $design['teams']['size'][$i]);
							$table .=	'<tr>'
								.			'<td>'.$design['teams']['name'][$i].'</td>'
								.			'<td>'.$design['teams']['number'][$i].'</td>'
								.			'<td>'.$size[0].'</td>'
								.		'</tr>';
						}
						$table .= '</tbody></table>';
						$design_option = array(
							'name'	=> 'Team',
							'value'	=> $table
						);
						$option_data[] = $design_option;
					}
				}
				else
				{
					$design = '';					
				}
			
				$data['products'][] = array(

				'order_id' 			=> (isset($product['design']['rowid']) ? $product['design']['rowid'] : 0),
				'parent_id' 		=> (isset($product['design']['product_id']) ? $product['design']['product_id'] : 0),
				'design_product_id' => (isset($design_product_id) ? $design_product_id : 0),
			
					'cart_id'   => $product['cart_id'],
					'thumb'     => $image,
					'name'      => $product['name'],
					'model'     => $product['model'],
					'option'    => $option_data,
					'recurring' => $recurring,
					'quantity'  => $product['quantity'],
					'stock'     => $product['stock'] ? true : !(!$this->config->get('config_stock_checkout') || $this->config->get('config_stock_warning')),
					'reward'    => ($product['reward'] ? sprintf($this->language->get('text_points'), $product['reward']) : ''),
					'price'     => $price,
					'total'     => $total,
					'href'      => $this->url->link('product/product', 'product_id=' . $product['product_id'])
				);
			}

			// Gift Voucher
			$data['vouchers'] = array();

			if (!empty($this->session->data['vouchers'])) {
				foreach ($this->session->data['vouchers'] as $key => $voucher) {
					$data['vouchers'][] = array(
						'key'         => $key,
						'description' => $voucher['description'],
						'amount'      => $this->currency->format($voucher['amount']),
						'remove'      => $this->url->link('checkout/cart', 'remove=' . $key)
					);
				}
			}

			// Totals
			$this->load->model('extension/extension');

			$total_data = array();
			$total = 0;
			$taxes = $this->cart->getTaxes();

			// Display prices
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$sort_order = array();

				$results = $this->model_extension_extension->getExtensions('total');

				foreach ($results as $key => $value) {
					$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
				}

				array_multisort($sort_order, SORT_ASC, $results);

				foreach ($results as $result) {
					if ($this->config->get($result['code'] . '_status')) {
						$this->load->model('total/' . $result['code']);

						$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
					}
				}

				$sort_order = array();

				foreach ($total_data as $key => $value) {
					$sort_order[$key] = $value['sort_order'];
				}

				array_multisort($sort_order, SORT_ASC, $total_data);
			}

			$data['totals'] = array();

			foreach ($total_data as $total) {
				$data['totals'][] = array(
					'title' => $total['title'],
					'text'  => $this->currency->format($total['value'])
				);
			}

			$data['continue'] = $this->url->link('common/home');

			$data['checkout'] = $this->url->link('checkout/checkout', '', 'SSL');

			$this->load->model('extension/extension');

			$data['checkout_buttons'] = array();

			$files = glob(DIR_APPLICATION . '/controller/total/*.php');

			if ($files) {
				foreach ($files as $file) {
					$extension = basename($file, '.php');

					$data[$extension] = $this->load->controller('total/' . $extension);
				}
			}

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/checkout/cart.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/checkout/cart.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/checkout/cart.tpl', $data));
			}
		} else {
			$data['heading_title'] = $this->language->get('heading_title');

			$data['text_error'] = $this->language->get('text_empty');

			$data['button_continue'] = $this->language->get('button_continue');

			$data['continue'] = $this->url->link('common/home');

			unset($this->session->data['success']);

			$data['column_left'] = $this->load->controller('common/column_left');
			$data['column_right'] = $this->load->controller('common/column_right');
			$data['content_top'] = $this->load->controller('common/content_top');
			$data['content_bottom'] = $this->load->controller('common/content_bottom');
			$data['footer'] = $this->load->controller('common/footer');
			$data['header'] = $this->load->controller('common/header');

			if (file_exists(DIR_TEMPLATE . $this->config->get('config_template') . '/template/error/not_found.tpl')) {
				$this->response->setOutput($this->load->view($this->config->get('config_template') . '/template/error/not_found.tpl', $data));
			} else {
				$this->response->setOutput($this->load->view('default/template/error/not_found.tpl', $data));
			}
		}
	}

	public function add() {
		$this->load->language('checkout/cart');

		$json = array();

		if (isset($this->request->post['product_id'])) {
			$product_id = (int)$this->request->post['product_id'];
		} else {
			$product_id = 0;
		}

		$this->load->model('catalog/product');

		$product_info = $this->model_catalog_product->getProduct($product_id);

		if ($product_info) {
			if (isset($this->request->post['quantity']) && ((int)$this->request->post['quantity'] >= $product_info['minimum'])) {
				$quantity = (int)$this->request->post['quantity'];
			} else {
				$quantity = $product_info['minimum'] ? $product_info['minimum'] : 1;
			}


				if(isset($this->request->post['design']) 
					&& isset($this->request->post['design']['option_oc']) 
					&& count($this->request->post['design']['option_oc']) > 0)
				{
					$_options 	= array();
					$options_oc = $this->request->post['design']['option_oc'];

					foreach($options_oc as $idx => $option)
					{
						if(!empty($option)) $_options[$idx] = $option;
					}
					$this->request->post['option'] = $_options;
				}
			
			if (isset($this->request->post['option'])) {
				$option = array_filter($this->request->post['option']);
			} else {
				$option = array();
			}

			$product_options = $this->model_catalog_product->getProductOptions($this->request->post['product_id']);

			foreach ($product_options as $product_option) {
				if ($product_option['required'] && empty($option[$product_option['product_option_id']])) {
					$json['error']['option'][$product_option['product_option_id']] = sprintf($this->language->get('error_required'), $product_option['name']);
				}
			}

			if (isset($this->request->post['recurring_id'])) {
				$recurring_id = $this->request->post['recurring_id'];
			} else {
				$recurring_id = 0;
			}

			$recurrings = $this->model_catalog_product->getProfiles($product_info['product_id']);

			if ($recurrings) {
				$recurring_ids = array();

				foreach ($recurrings as $recurring) {
					$recurring_ids[] = $recurring['recurring_id'];
				}

				if (!in_array($recurring_id, $recurring_ids)) {
					$json['error']['recurring'] = $this->language->get('error_recurring_required');
				}
			}

			if (!$json) {

				// Get tshirtecommerce information of product added
				if (isset($this->request->post['design']))
				{
					$design 			= $this->request->post['design'];
					$option['design'] 	= $design;
				}
				else
				{
					$str_design_product_id 	= '';
					$str_row_id 			= '';
					$str_color 				= '';
					$str_design 			= '';

					$this->load->model('tshirtecommerce/order');

					$tshirtecommerce_product = $this->model_tshirtecommerce_order->getProduct($this->request->post['product_id']);

					if(isset($tshirtecommerce_product['design_product_id']))
					{
						// Validate calculation of price
						$tshirtecommerce_split_arr = isset($tshirtecommerce_product['design_product_id']) ? explode(':', $tshirtecommerce_product['design_product_id']) : array();

						if(count($tshirtecommerce_split_arr) > 1)
						{
							$str_row_id 			= isset($tshirtecommerce_split_arr[0]) ? $tshirtecommerce_split_arr[0] : '';
							$str_design 			= isset($tshirtecommerce_split_arr[1]) ? $tshirtecommerce_split_arr[1] : '';
							$str_design_product_id 	= isset($tshirtecommerce_split_arr[2]) ? $tshirtecommerce_split_arr[2] : '';
							$str_color 				= isset($tshirtecommerce_split_arr[3]) ? $tshirtecommerce_split_arr[3] : '';
						}
						else
						{
							$str_design_product_id 	= $tshirtecommerce_product['design_product_id'];
						}
					}
					
					// Get Price of tshirtecommerce
					$tshirtecommerce_file 	= dirname(DIR_SYSTEM).'/tshirtecommerce/data/products.json';
					$tshirtecommerce_price 	= 0;

					if(file_exists($tshirtecommerce_file))
					{
						$string = file_get_contents($tshirtecommerce_file);

						if ($string != FALSE)
						{
							$tshirtecommerce_products = json_decode($string, TRUE);
							
							// Default product
							foreach($tshirtecommerce_products['products'] as $p)
							{
								if($p['id'] == $str_design_product_id)
								{
									$design 			= array();
									$design['rowid'] 	= (!empty($str_row_id)) ? $str_row_id : $str_design_product_id;

									if(!empty($str_row_id))
									{
										foreach($p['design']['color_hex'] as $idx => $color)
										{
											if($str_color == $color)
											{
												$design['color_hex'] 	= $str_color;
												$design['color_title'] 	= $p['design']['color_title'][$idx];

												break;
											}
										}
									}
									else
									{
										$design['color_hex'] 	= isset($p['design']['color_hex'][0]) 	? $p['design']['color_hex'][0] 		: '';
										$design['color_title'] 	= isset($p['design']['color_title'][0]) ? $p['design']['color_title'][0] 	: '';
									}

									$design['design_product_id'] 	= $p['id'];
									$design['images'] 				= '';
									$design['product_id'] 			= $tshirtecommerce_product['product_id'];
									$design['options'] 				= array();
									$design['options'][] 			= array('name' => 'Printing type', 'type' => 'printing', 'value' => $p['print_type']);

									if(!empty($str_row_id))
									{
										$str_design_product_title_img 	= isset($product_info['design_product_title_img']) 
											? (explode('::', $product_info['design_product_title_img'])) 
											: array();

										$oc_price_of_print 				= isset($str_design_product_title_img[2]) ? $str_design_product_title_img[2] : 0;
										
										$design['oc_price_of_print'] 	= $oc_price_of_print;
									}
									else
									{
										$design['oc_price_of_print'] 	= 0;
									}

									$option['design'] = $design;
								}
							}
						}
					}
				}
			
				$this->cart->add($this->request->post['product_id'], $quantity, $option, $recurring_id);

				$json['success'] = sprintf($this->language->get('text_success'), $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']), $product_info['name'], $this->url->link('checkout/cart'));

				// Unset all shipping and payment methods
				unset($this->session->data['shipping_method']);
				unset($this->session->data['shipping_methods']);
				unset($this->session->data['payment_method']);
				unset($this->session->data['payment_methods']);

				// Totals
				$this->load->model('extension/extension');

				$total_data = array();
				$total = 0;
				$taxes = $this->cart->getTaxes();

				// Display prices
				if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
					$sort_order = array();

					$results = $this->model_extension_extension->getExtensions('total');

					foreach ($results as $key => $value) {
						$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
					}

					array_multisort($sort_order, SORT_ASC, $results);

					foreach ($results as $result) {
						if ($this->config->get($result['code'] . '_status')) {
							$this->load->model('total/' . $result['code']);

							$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
						}
					}

					$sort_order = array();

					foreach ($total_data as $key => $value) {
						$sort_order[$key] = $value['sort_order'];
					}

					array_multisort($sort_order, SORT_ASC, $total_data);
				}

				$json['total'] = sprintf($this->language->get('text_items'), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), $this->currency->format($total));
			} else {
				$json['redirect'] = str_replace('&amp;', '&', $this->url->link('product/product', 'product_id=' . $this->request->post['product_id']));
			}
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function edit() {
		$this->load->language('checkout/cart');

		$json = array();

		// Update
		if (!empty($this->request->post['quantity'])) {
			foreach ($this->request->post['quantity'] as $key => $value) {
				$this->cart->update($key, $value);
			}

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['reward']);

			$this->response->redirect($this->url->link('checkout/cart'));
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}

	public function remove() {
		$this->load->language('checkout/cart');

		$json = array();

		// Remove
		if (isset($this->request->post['key'])) {
			$this->cart->remove($this->request->post['key']);

			unset($this->session->data['vouchers'][$this->request->post['key']]);

			$this->session->data['success'] = $this->language->get('text_remove');

			unset($this->session->data['shipping_method']);
			unset($this->session->data['shipping_methods']);
			unset($this->session->data['payment_method']);
			unset($this->session->data['payment_methods']);
			unset($this->session->data['reward']);

			// Totals
			$this->load->model('extension/extension');

			$total_data = array();
			$total = 0;
			$taxes = $this->cart->getTaxes();

			// Display prices
			if (($this->config->get('config_customer_price') && $this->customer->isLogged()) || !$this->config->get('config_customer_price')) {
				$sort_order = array();

				$results = $this->model_extension_extension->getExtensions('total');

				foreach ($results as $key => $value) {
					$sort_order[$key] = $this->config->get($value['code'] . '_sort_order');
				}

				array_multisort($sort_order, SORT_ASC, $results);

				foreach ($results as $result) {
					if ($this->config->get($result['code'] . '_status')) {
						$this->load->model('total/' . $result['code']);

						$this->{'model_total_' . $result['code']}->getTotal($total_data, $total, $taxes);
					}
				}

				$sort_order = array();

				foreach ($total_data as $key => $value) {
					$sort_order[$key] = $value['sort_order'];
				}

				array_multisort($sort_order, SORT_ASC, $total_data);
			}

			$json['total'] = sprintf($this->language->get('text_items'), $this->cart->countProducts() + (isset($this->session->data['vouchers']) ? count($this->session->data['vouchers']) : 0), $this->currency->format($total));
		}

		$this->response->addHeader('Content-Type: application/json');
		$this->response->setOutput(json_encode($json));
	}
}
