<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/1999/REC-html401-19991224/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<title><?php echo $title; ?></title>
</head>
<body style="font-family: Arial, Helvetica, sans-serif; font-size: 12px; color: #000000;">
<div style="width: 680px;"><a href="<?php echo $store_url; ?>" title="<?php echo $store_name; ?>"><img src="<?php echo $logo; ?>" alt="<?php echo $store_name; ?>" style="margin-bottom: 20px; border: none;" /></a>
  <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $text_greeting; ?></p>
  <?php if ($customer_id) { ?>
  <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $text_link; ?></p>
  <p style="margin-top: 0px; margin-bottom: 20px;"><a href="<?php echo $link; ?>"><?php echo $link; ?></a></p>
  <?php } ?>
  <?php if ($download) { ?>
  <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $text_download; ?></p>
  <p style="margin-top: 0px; margin-bottom: 20px;"><a href="<?php echo $download; ?>"><?php echo $download; ?></a></p>
  <?php } ?>
  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">
    <thead>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;" colspan="2"><?php echo $text_order_detail; ?></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><b><?php echo $text_order_id; ?></b> <?php echo $order_id; ?><br />
          <b><?php echo $text_date_added; ?></b> <?php echo $date_added; ?><br />
          <b><?php echo $text_payment_method; ?></b> <?php echo $payment_method; ?><br />
          <?php if ($shipping_method) { ?>
          <b><?php echo $text_shipping_method; ?></b> <?php echo $shipping_method; ?>
          <?php } ?></td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><b><?php echo $text_email; ?></b> <?php echo $email; ?><br />
          <b><?php echo $text_telephone; ?></b> <?php echo $telephone; ?><br />
          <b><?php echo $text_ip; ?></b> <?php echo $ip; ?><br />
          <b><?php echo $text_order_status; ?></b> <?php echo $order_status; ?><br /></td>
      </tr>
    </tbody>
  </table>
  <?php if ($comment) { ?>
  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">
    <thead>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;"><?php echo $text_instruction; ?></td>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $comment; ?></td>
      </tr>
    </tbody>
  </table>
  <?php } ?>
  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">
    <thead>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;"><?php echo $text_payment_address; ?></td>
        <?php if ($shipping_address) { ?>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;"><?php echo $text_shipping_address; ?></td>
        <?php } ?>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $payment_address; ?></td>
        <?php if ($shipping_address) { ?>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $shipping_address; ?></td>
        <?php } ?>
      </tr>
    </tbody>
  </table>
  <table style="border-collapse: collapse; width: 100%; border-top: 1px solid #DDDDDD; border-left: 1px solid #DDDDDD; margin-bottom: 20px;">
    <thead>
      <tr>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;"><?php echo $text_product; ?></td>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: left; padding: 7px; color: #222222;"><?php echo $text_model; ?></td>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: right; padding: 7px; color: #222222;"><?php echo $text_quantity; ?></td>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: right; padding: 7px; color: #222222;"><?php echo $text_price; ?></td>
        <td style="font-size: 12px; border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; background-color: #EFEFEF; font-weight: bold; text-align: right; padding: 7px; color: #222222;"><?php echo $text_total; ?></td>
      </tr>
    </thead>
    <tbody>
      <?php foreach ($products as $product) { ?>
      <tr>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $product['name']; ?>
          <?php foreach ($product['option'] as $option) { ?>
          <br />
          &nbsp;<small> - <?php echo $option['name']; ?>: <?php echo $option['value']; ?></small>

				<?php } ?>
				<br />
				<?php if ( isset($product['design']) && $product['design'] != false)
				{ 
					$design = $product['design'];

					/* Show link for download design */
					if(isset($design->design_product_id) && !empty($design->design_product_id))
					{
						$_temp_arr = explode(':', $design->design_product_id);
						if(count($_temp_arr) > 1)
						{
							$_key = $_temp_arr[0].':'.$_temp_arr[1].':'.$_temp_arr[2].':'.$design->color_hex;

							echo '<br /><p>';

							echo "<a href='".$base_url."index.php?route=tshirtecommerce/designer&product_id=".$_temp_arr[2]. '&parent_id=' . $design->product_id ."&cart_id=".$design->rowid."' title='' target='_blank'><strong>".$tshirtecommerce_designer_cart_edit."</strong></a>";

							if(isset($tshirtecommerce_downloadable) && $tshirtecommerce_downloadable == 1 && (!isset($design->images) || empty($design->images)))
							{
								echo ' '.$tshirtecommerce_label_or_download_design.': ';

								echo "<a title='".$tshirtecommerce_link_title_download."' target='_blank' href='".$base_url."/tshirtecommerce/design.php?idea=1&key=".$_key."&view=front'><strong>".$tshirtecommerce_view_front."</strong></a><span> - </span>";

								echo "<a title='".$tshirtecommerce_link_title_download."' target='_blank' href='".$base_url."/tshirtecommerce/design.php?idea=1&key=".$_key."&view=back'><strong>".$tshirtecommerce_view_back."</strong></a><span> - </span>";

								echo "<a title='".$tshirtecommerce_link_title_download."' target='_blank' href='".$base_url."/tshirtecommerce/design.php?idea=1&key=".$_key."&view=left'><strong>".$tshirtecommerce_view_left."</strong></a><span> - </span>";

								echo "<a title='".$tshirtecommerce_link_title_download."' target='_blank' href='".$base_url."/tshirtecommerce/design.php?idea=1&key=".$_key."&view=right'><strong>".$tshirtecommerce_view_right."</strong></a>";
							}
							echo '</p>';
						}
						else
						{
							if(isset($design->images) && !empty($design->images))
							{
								echo '<br /><p>';

								echo "<a href='".$base_url."index.php?route=tshirtecommerce/designer&product_id=".$design->design_product_id."&parent_id=".$design->product_id."&cart_id=".$design->rowid."' title='' target='_blank'><strong>".$tshirtecommerce_designer_cart_edit."</strong></a>";

								echo '</p>';
							}
						}
					}
					if(isset($design->color_title))
					{ ?>
						<p style='height:25px;width:auto'><strong>Color:</strong></p>
						<p title='<?php echo $design->color_title; ?>' style='background-color:#<?php echo $design->color_hex ?>; height:25px; width:25px;border: 1px solid #cdcdcd;outline: 1px solid #229BCA;margin: 2px;'></p>
						<br />
					<?php }

					/* options */
					if (isset($design->options) && $design->options != '[]')
					{
						if (is_string($design->options))
							$design_options = json_decode( str_replace('&quot;', '"', $design->options) );
						else
							$design_options = $design->options;

						$html = '';
						if (count($design_options))
						{
							foreach($design_options as $option)
							{					
								if (isset($option->value))
								{
									if (is_string($option->value) && $option->value != '')
									{
										// Fixed Printing type is empty
										if(empty($option->name) && $option->type == 'printing')
											$option->name = $tshirtecommerce_printing_type; //'Printing type'

										$html .= '<p><strong>'.$option->name.': '.$option->value.'</strong></p>';
									}
									else if (count($option->value) > 0)
									{
										$html .= '<p><strong>'.$option->name.':</strong> </p>';

										foreach ($option->value as $name => $value)
										{
											if($value != '0' && $value != 0) $html .=  $name.'  -  '.$value. '; ';
										}
									}
								}
							}
						}
						echo $html;
					}
					/* teams */
					if (isset($design->teams) && isset($design->teams->name) )
					{
						$teams = json_decode( json_encode($design->teams), true );
						$table = '<table class="table table-bordered">'
							. 		'<thead>'
							. 			'<tr>'
							. 				'<th>'.$ts_designer_clipart_edit_name.'</th>'
							. 				'<th>'.$ts_designer_clipart_edit_number.'</th>'
							. 				'<th>'.$tshirtecommerce_head_text_sizes.'</th>'
							. 			'</tr>'
							. 		'</thead>'
							. 		'<tbody>';
						for($i=1; $i<=count($teams['name']); $i++ )
						{
							$size = explode('::', $teams['size'][$i]);
							$table .=	'<tr>'
								.			'<td>'.$teams['name'][$i].'</td>'
								.			'<td>'.$teams['number'][$i].'</td>'
								.			'<td>'.$size[0].'</td>'
								.		'</tr>';
						}
						$table .= '</tbody></table>';
						echo $table;
					}

					/* images */
					if (isset($design->images))
					{
						$images = json_decode(str_replace('&quot;', '"', $design->images), true);
						if (count($images) > 0)
						{								
							$img = '';
							foreach($images as $view => $src)
							{
								$img .= '<center style="float:left;background-color: #fff;margin:2px;border: 1px solid #ddd;border-radius: 4px;display: inline-block;line-height: 1.42857;transition: all 0.2s ease-in-out 0s;padding: 4px;">';

								$img .= '<a target="_blank" href="'.$base_url.'/tshirtecommerce/'.$src.'" title="">';

								$img .= '<img style="width:70px;height:auto" src="'.$base_url.'/tshirtecommerce/'.$src.'" alt="" width="70px" />';

								if(isset($tshirtecommerce_downloadable) && $tshirtecommerce_downloadable == 1 && isset($product['store_temp']) && count($product['store_temp']) == 0)
								{
									$img .= '<br /><a href="'.$base_url.'/tshirtecommerce/design.php?key='.$design->rowid.'&view='.$view.'" target="_blank" title="'.$tshirtecommerce_link_title_download.'">'.$tshirtecommerce_link_text_download.'</a>';
								}

								$img .= '</a>';
								$img .= '</center>';
							}
							echo $img;
						}
					} ?>
			
          <?php } ?></td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $product['model']; ?></td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;"><?php echo $product['quantity']; ?></td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;"><?php echo $product['price']; ?></td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;"><?php echo $product['total']; ?></td>
      </tr>
      <?php } ?>
      <?php foreach ($vouchers as $voucher) { ?>
      <tr>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"><?php echo $voucher['description']; ?></td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: left; padding: 7px;"></td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;">1</td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;"><?php echo $voucher['amount']; ?></td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;"><?php echo $voucher['amount']; ?></td>
      </tr>
      <?php } ?>
    </tbody>
    <tfoot>
      <?php foreach ($totals as $total) { ?>
      <tr>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;" colspan="4"><b><?php echo $total['title']; ?>:</b></td>
        <td style="font-size: 12px;	border-right: 1px solid #DDDDDD; border-bottom: 1px solid #DDDDDD; text-align: right; padding: 7px;"><?php echo $total['text']; ?></td>
      </tr>
      <?php } ?>
    </tfoot>
  </table>
  <p style="margin-top: 0px; margin-bottom: 20px;"><?php echo $text_footer; ?></p>
</div>
</body>
</html>
