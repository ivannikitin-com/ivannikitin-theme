<?php
global $wpo_wcpdf;
do_action( 'wpo_wcpdf_before_document', $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order); 

// URL к папке шаблона
$template_url = get_stylesheet_directory_uri() . '/woocommerce/pdf/IvanNikitin/';
$template_path = get_stylesheet_directory() . '/woocommerce/pdf/IvanNikitin/';
// Данные клиента
$client = customer_data();
?>
	<?php do_action( 'wpo_wcpdf_before_order_data', $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order ); ?>
        <header>
        <div class="shop-name nbsp"><h3>Индивидуальный предприниматель Никитин Иван Геннадьевич</h3></div>
            <table class="head container">
                <tr>
                    <td class="shop-info">
                        <div class="shop-address">
							<?php $this->shop_address(); ?>
                        </div>
                    </td>
                    <td class="header">
						<img src="<?php echo $template_url ?>logo-215x99.png" style="width:215px;height:98px">						
                    </td>
                </tr>
            </table>		
        </header>
           <section>
            <table class="brd">
            <caption>Образец заполнения платежного поручения</caption>
            	<tbody>
                    <tr>
                        <td colspan="4" class="brd0">АО «Альфа-Банк» Москва</td>
                        <td>БИК</td>
                        <td style="width:25%">044525593</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="brd0"></td>
                        <td class="nbsp brdBot0">Сч. №</td>
                        <td style="width:25%">30101810200000000593</td>
                    </tr>
                    <tr>
                        <td colspan="4" class="brd0">Банк получателя</td>
                        <td class="brdTop0"></td>
                        <td></td>
                    </tr>
                	<tr>
                    	<td>ИНН</td>
                        <td style="width:25%">501810901400</td>
                        <td>КПП</td>
                        <td style="width:25%"></td>
                        <td class="brdBot0">Сч. №</td>
                        <td>40802810102680000003</td>
                    </tr>
                	<tr>
                    	<td colspan="4" class="brd0">Индивидуальный предприниматель Никитин Иван Геннадьевич</td>
                        <td class="brdTop0 brdBot0"></td>
                        <td class="brdBot0"></td>
                    </tr>
                	<tr>
                    	<td colspan="4" class="brdTop0">Получатель</td>
                        <td class="brd0"></td>
                        <td class="brdTop0"></td>
                    </tr>
                </tbody>
            </table>
        </section>
         <section class="brd-bott">
        	<h1 style="text-align:center">Счёт на оплату № <?php $wpo_wcpdf->invoice_number(); ?> от <?php $wpo_wcpdf->order_date(); ?></h1>
            <table>
            <tbody>
            	<tr>
                    <td>Поставщик:</td>
					<td>Индивидуальный предприниматель Никитин Иван Геннадьевич</td>
                </tr> 
                <tr>
					<td>Покупатель:</td>
					<td>
						<?php echo $client['name_company'] ?>
					</td>
				</tr>
            </tbody>
            </table>
        </section>
	<table class="brd txt-center">
		<thead>
	        <tr>
	           <td>№</td>
	            <td>Товары (работы, услуги)</td>
	            <td class="nbsp">Кол-во</td>
	            <td>Цена</td>
	            <td>Сумма</td>
	          </tr>
		</thead>
		<tbody>
		<?php 
		//вывод корзины

		$i = 1; //счётник
		$items = $wpo_wcpdf->get_order_items(); if( sizeof( $items ) > 0 ) : foreach( $items as $item_id => $item ) :
		 ?>

		<tr class="<?php echo apply_filters( 'wpo_wcpdf_item_row_class', $item_id, $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order, $item_id ); ?>">
			<td>
				<?php echo $i++; ?>
			</td>
			<td class="product">
				<div style="text-align:left">
				<span class="item-name"><?php echo $item['name']; ?></span>
				<?php do_action( 'wpo_wcpdf_before_item_meta', $wpo_wcpdf->export->template_type, $item, $wpo_wcpdf->export->order  ); ?>
				<span class="item-meta"><?php echo $item['meta']; ?></span>
				<?php do_action( 'wpo_wcpdf_after_item_meta', $wpo_wcpdf->export->template_type, $item, $wpo_wcpdf->export->order  ); ?>
				</div>	
			</td>
			<td class="quantity"><?php echo $item['quantity'] ?></td>
			<td class="price"><?php echo $item['single_line_total'] // Это стоимость товара С ВОЗМОЖНОЙ СКИДКОЙ ?></td>
			<td class="price"><?php echo $item['line_subtotal'] // line_total - Это стоимость всех товаров С ВОЗМОЖНОЙ СКИДКОЙ ?></td>
		</tr>
		<?php // file_put_contents( $template_path . 'item.log', var_export($item, true) )  ?>
		<?php endforeach; endif; ?>
			
		<?php 
		//вывод Сборов
		$items = $wpo_wcpdf->export->order->get_fees(); if( sizeof( $items ) > 0 ) : foreach( $items as $item_id => $item ) :
		 ?>

		<tr class="">
			<td>
				<?php echo $i++; ?>
			</td>
			<td class="product">
				<div style="text-align:left">
				<span class="item-name"><?php echo $item['name']; ?></span>
				</div>	
			</td>
			<td class="quantity"> </td>
			<td class="price"> </td>
			<td class="price"><?php echo $item['amount'] // line_total - Это стоимость всех товаров С ВОЗМОЖНОЙ СКИДКОЙ ?></td>
		</tr>
		<?php // file_put_contents( $template_path . 'item.log', var_export($item, true) )  ?>
		<?php endforeach; endif; ?>			
			
			
	</tbody>
	</table>
   <?php
	   $totals = $this->get_woocommerce_totals();
	   // file_put_contents( $template_path . 'totals.log', var_export($totals, true) );
	   $order_total = $totals['order_total']['value'];
   ?>
   <table width="100%">
	<tr>
			<td width="60%"></td>
			<td width="40%">
					<table width="100%">
						<?php if ( isset( $totals['discount'] ) ) : ?>
						<tr>
							<td align="center"><h4>Итого:</h4></td>
							<td align="right"><h4><?php echo $totals['cart_subtotal']['value'] ?></h4></td>							
						</tr>						
						<tr>
							<td align="center"><h4>Скидка:</h4></td>
							<td align="right"><h4><?php echo $totals['discount']['value'] ?></h4></td>							
						</tr>
						<?php endif ?>
						<tr>
							<td align="center"><h4>Итого к оплате:</h4></td>
							<td align="right"><h4><?php echo $order_total ?></h4></td>
						</tr>
						<tr>
							<td align="center"><h4>В том числе НДС:</h4></td>
							<td align="right"><h4>Без НДС</h4></td>
						</tr>						
					</table>
		</tr>
   </table>
   <?php $total_val = $this->order->get_total(); ?>
	 <p>Всего к оплате: <?php echo num2str( $total_val ) ?>  </p>
	 <hr>
     <footer>
            
         
	<table class="signing">
		<tr>
		<td class="txt-left">Поставщик</td>
		<td>Индивидуальный предприниматель</td>
		<td style="position:relative">
			<img src="<?php echo $template_url ?>sign.png" alt="" style="width:4cm" />
			<img src="<?php echo $template_url ?>stamp.png" alt="" / style="width:45mm;position: absolute;top:5mm;left:0">
		</td>
		<td>Никитин И.Г. </td>
		</tr>
		<tr>
			<td></td>
			<td class="brd-top"><small>должность</small></td>
			<td class="brd-top"><small>подпись</small></td>
			<td class="brd-top"><small>расшифровка подписи</small></td>
		</tr>
	</table>
 </footer>
