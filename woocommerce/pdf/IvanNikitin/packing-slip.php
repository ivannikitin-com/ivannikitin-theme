<?php 
global $wpo_wcpdf;
do_action( 'wpo_wcpdf_before_document', $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order );

// URL к папке шаблона
$template_url = get_stylesheet_directory_uri() . '/woocommerce/pdf/IvanNikitin/';

// Данные клиента
$client = customer_data();
?>
   <header class="txt-right">
		<img src="<?php echo $template_url ?>logo-215x99.png" style="width:215px;height:98px">	
	</header>
    <h2 class="brd-bott" align="center">АКТ № <?php $wpo_wcpdf->invoice_number(); ?> от <?php $wpo_wcpdf->order_date(); ?></h2>
    <br>
    <section class="brd-bott">
    	<table>
    		<tr>
    			<td>Исполнитель:</td>
    			<td><h4>Индивидуальный предприниматель Никитин Иван Геннадьевич</h4></td>
    		</tr>
    		<tr>
    			<td>Заказчик:</td>
    			<td><h4>
						<?php echo $client['name_company'] ?>,
						<?php if ( ! empty( $client['inn'] ) ): ?>
							ИНН <?php echo $client['inn'] ?>,
						<?php endif; ?>
						<?php if ( ! empty( $client['kpp'] ) ): ?>
							КПП <?php echo $client['kpp'] ?>,
						<?php endif; ?>					
				</h4></td>
    		</tr>
    	</table>
    <br>
<?php do_action( 'wpo_wcpdf_after_document_label', $wpo_wcpdf->export->template_type, $wpo_wcpdf->export->order ); ?>

<table class="brd txt-center">
		<thead>
	        <tr>
	           <td>№</td>
	            <td>Наименование работ, услуг</td>
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
				<?php $description_label = __( 'Description', 'wpo_wcpdf' ); // registering alternate label translation ?>
				<span class="item-name"><?php echo $item['name']; ?></span>
				<?php do_action( 'wpo_wcpdf_before_item_meta', $wpo_wcpdf->export->template_type, $item, $wpo_wcpdf->export->order  ); ?>
				<span class="item-meta"><?php echo $item['meta']; ?></span>

				<?php do_action( 'wpo_wcpdf_after_item_meta', $wpo_wcpdf->export->template_type, $item, $wpo_wcpdf->export->order  ); ?>
			</td>
			<td class="quantity"><?php echo $item['quantity']; ?></td>
			<td class="price"><?php echo $item['single_line_total']; ?></td>
			<td class="price"><?php echo $item['line_subtotal'];?></td>
		</tr>
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
           <br>
           <br>      
			<?php $total_val = $this->order->get_total(); ?>
             <p>Общая стоимость выполненных работ, оказанных услуг: <?php echo num2str( $total_val ); ?>  </p>
             <hr>
			<p>Заказчик не имеет претензий по срокам, качеству и объему товаров и услуг.</p>
 <div class="mrgLeft0 padTop clearfix">

</div>
<br>
<table width="100%" class="table_pack_slip">
    <tr>
        <td style="width:15%">Исполнитель: </td>
        <td style="width:35%"><b>ИП Никитин Иван Геннадьевич</b></td>
        <td style="width:15%">Заказчик:</td>
        <td style="width:35%"><b><?php echo $client['name_company'];?></b></td>
    </tr>
    <tr>
        <td>ИНН</td>
        <td> <span class="inn">501810901400</span></td>
         <td>ИНН</td>
         <td><?php echo $client['inn']; ?></td>

    </tr>
    <tr>
        <td> Адрес</td>
        <td>
            <span class="city">141067, Московская обл., г. Королев,
            мкр Болшево, ул. Комитетский Лес, д. 10, кв. 25</span>         
        </td>
        <td>Адрес</td>
        <td><?php echo $client['address']; ?></td>
    </tr>
    <tr>
        <td>Р/с</td>
        <td>
            <span class="text">40802810102680000003</span>
        </td>
        <td>Р/c</td>
        <td><?php echo $client['account']; ?></td>   
    </tr>
    <tr>
        <td>К/с</td>
        <td>
            <span class="text">40802810102680000003</span>
        </td>
                <td>К/с</td>
                <td>&nbsp;</td>
    </tr>
    <tr>
        <td>Банк</td>
        <td>
            <span class="text">АО "АЛЬФА-БАНК" г. МОСКВА</span>
        </td>
           <td>Банк</td>
           <td><?php echo $client['name_bank']; ?></td>
    </tr>
    <tr>
        <td>БИК</td>
        <td>
            <span class="text">044525593</span>
        </td>
                <td>БИК</td>
                <td><?php echo $client['blc']; ?></td>
    </tr>
    <tr>
        <td>Телефон</td>
        <td>
            <span class="text">+7 (495) 565-34-88</span>
        </td>
        <td>Телефон</td>
        <td><?php echo $client['phone']; ?></td>
    </tr>
	<tr>
        <td style="padding-top:40px;">Никитин И.Г.</td>
		<td style="position:relative;border-bottom: 1px solid #000">
			<img src="<?php echo $template_url ?>sign.png" alt="" style="width:4cm" />
			<img src="<?php echo $template_url ?>stamp.png" alt="" / style="width:45mm;position: absolute;top:5mm;left:0">
		</td>		
        <td>&nbsp;</td>
		<td style="border-bottom: 1px solid #000">&nbsp;</td>		
	</tr>
    <tr>
        <td>&nbsp;</td>
        <td style="text-align:center">подпись<br><br>МП</td>
        <td>&nbsp;</td>
        <td style="text-align:center">подпись<br><br>МП</td>
    </tr>	
</table>

