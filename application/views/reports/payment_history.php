<!DOCTYPE html>
<html lang="<?php echo trans('cldr'); ?>">
<head>
    <title><?php echo trans('payment_history'); ?></title>
    <link rel="stylesheet" href="<?php echo base_url(); ?>assets/<?php echo get_setting('system_theme', 'invoiceplane'); ?>/css/reports.css" type="text/css">
</head>
<body>

<h3 class="report_title">
    <?php echo trans('payment_history'); ?><br/>
    <small><?php echo $from_date . ' - ' . $to_date ?></small>
</h3>

<table>
    <tr>
        <th><?php echo trans('invoice'); ?></th>
        <th><?php echo trans('client'); ?></th>
		<th><?php echo trans('Codice Fiscale'); ?></th>
        <th><?php echo trans('Pagamento'); ?></th>
		<th class="amount"><?php echo trans('Totale fattura'); ?></th>
        <th class="amount"><?php echo trans('Totale pagato'); ?></th>
    </tr>
    <?php
    $sum = 0;

    foreach ($results as $result) {
        ?>
        <tr>
            <td><?php echo $result->invoice_number; ?> del <?php echo date_from_mysql($result->invoice_date_created, true); ?></td>
            <td><?php echo format_client($result); ?></td>
			<td>&ensp;<?php _htmlsc($result->client_tax_code); ?>&ensp;</td>
            <td><?php _htmlsc($result->payment_method_name); ?> il <?php echo date_from_mysql($result->payment_date, true); ?></td>
			<td class="amount"><?php echo format_currency($result->invoice_total);?></td>
            <td class="amount"><?php echo format_currency($result->payment_amount);
                $sum = $sum + $result->payment_amount; ?></td>
        </tr>
        <?php
    }

    if (!empty($results)) {
        ?>
		<tr></tr>
        <tr>
            <td colspan=5><b><?php echo trans('total'); ?></b></td>
            <td class="amount"><b><?php echo format_currency($sum); ?></b></td>
        </tr>
    <?php } ?>
</table>

</body>
</html>
