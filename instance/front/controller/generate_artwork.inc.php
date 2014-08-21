<?php

$file_id = $_REQUEST['fid'];

$item_data = qs("select * from order_print_files where id = '{$file_id}' ");

$file_name = "{$item_data['line_item_id']}-{$item_data['file_description']}.pdf";

header("Content-type:application/pdf");
header("Content-Disposition:attachment;filename={$file_name}");
readfile($item_data['file_url']);
die;
