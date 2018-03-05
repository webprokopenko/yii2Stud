<?php
/**
 * Created by PhpStorm.
 * User: Ivan
 * Date: 3/5/18
 * Time: 8:06 PM
 */

require_once ('./../vendor/');

require_once ('PHPExcel/Writer/Excel5.php');

$xls = new PHPExcel();

$xls->setActiveSheetIndex(0);

$sheet = $xls->getActiveSheet();

$sheet->setTitle('Title ');

$sheet->setCellValue('A1', 'Value this cell');

$sheet->mergeCells('A1:H1');

header('Expires: Mon, 8 Apr 2018 05:11:00 GmT');
header('Last-Modified: '. gmdate('D,d M YH:i:s'). "GMT");
header('Content-type: application/vnd.ms-excell');
header('Content-Disposition: attachment; filename=test.xls');

$objWrite = new PHPExcel_Writer_Excel5($xls);
$objWrite->save('php://output');
