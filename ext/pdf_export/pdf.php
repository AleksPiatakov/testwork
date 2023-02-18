<?php

require(DIR_WS_INCLUDES . '/tfpdf/tfpdf_mysql.php');
//if(tep_db_num_rows($listing_query)>500) $listing_sql .= " limit 500";
$pdf_page = $_GET['page'] ?: '1';
$pdf_offset = ($pdf_page - 1) * $row_by_page;
$listing_sql .= " limit " . $pdf_offset . "," . $row_by_page . "";
$pdf = new PDF_MySQL_Table();
$prop = array('HeaderColor' => array(36, 139, 203), 'color1' => array(255, 255, 255), 'color2' => array(255, 255, 255), 'padding' => 2);
$pdf->Table($listing_sql, $prop);
$pdf->Output();

exit();
