<?php global 
$wpo_wcpdf; 

$title = '';
switch ( $wpo_wcpdf->export->template_type )
{
	case 'invoice':
		$title = 'Счет';
		break;
		
	case 'packing-slip':
		$title = 'Акт';
		break;		
		
	default:
		$title =  $wpo_wcpdf->get_template_name( $wpo_wcpdf->export->template_type );
		break;		
}
?>
<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title><?php echo $title  ?></title>
	<style type="text/css"><?php $wpo_wcpdf->template_styles(); ?></style>
	<style type="text/css"><?php do_action( 'wpo_wcpdf_custom_styles', $wpo_wcpdf->export->template_type ); ?></style>
</head>
<body class="<?php echo $wpo_wcpdf->export->template_type; ?>">
<?php echo $wpo_wcpdf->export->output_body; ?>
</body>
</html>