<?php
namespace app\components;

use Yii;
use yii\helpers\Json;

/**
* 
*/
class ExportExcel
{
    public static function export($header,$data,$title = 'test', $filename = ''){
        $filename = $filename ?: time().'.xls';

        $objectPHPExcel = new \PHPExcel();
        $objectPHPExcel->setActiveSheetIndex(0);
        $count = count($header);
        $maxColumn = \PHPExcel_Cell::stringFromColumnIndex($count);

        foreach ( $data as $n => $product ){
            //报表头的输出
            $objectPHPExcel->getActiveSheet()->mergeCells('B1:'.$maxColumn.'1');
            $objectPHPExcel->getActiveSheet()->setCellValue('B1',$title);

            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2',$title);
            $objectPHPExcel->setActiveSheetIndex(0)->getStyle('B1')->getFont()->setSize(24);
            $objectPHPExcel->setActiveSheetIndex(0)->getStyle('B1')
                ->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue('B2','日期：'.date("Y年m月j日"));
            $objectPHPExcel->setActiveSheetIndex(0)->setCellValue($maxColumn.'2','');
            $objectPHPExcel->setActiveSheetIndex(0)->getStyle($maxColumn.'2')
                ->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
                
            //表格头的输出
            $objectPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5);
            foreach ($header as $key => $value) {
                $column = \PHPExcel_Cell::stringFromColumnIndex($key+1);
                $objectPHPExcel->getActiveSheet()->getColumnDimension($column)->setWidth(20);
                $objectPHPExcel->setActiveSheetIndex(0)->setCellValue($column.'3',$value);
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle($column.'3')->getFont()->setSize(16);
            }
            unset($key,$value);
            
            //设置居中
            $objectPHPExcel->getActiveSheet()->getStyle('B3:'.$maxColumn.'3' )
                ->getAlignment()->setHorizontal(\PHPExcel_Style_Alignment::HORIZONTAL_CENTER);

            //设置边框
            $objectPHPExcel->getActiveSheet()->getStyle('B3:'.$maxColumn.'3' )
                ->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B3:'.$maxColumn.'3' )
                ->getBorders()->getLeft()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B3:'.$maxColumn.'3' )
                ->getBorders()->getRight()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B3:'.$maxColumn.'3' )
                ->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B3:'.$maxColumn.'3' )
                ->getBorders()->getVertical()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);

            //设置颜色
            $objectPHPExcel->getActiveSheet()->getStyle('B3:'.$maxColumn.'3')->getFill()
                ->setFillType(\PHPExcel_Style_Fill::FILL_SOLID)->getStartColor()->setARGB('FF66CCCC');
                    
            //}
            //明细的输出
            for ($i=1; $i <=$count ; $i++) { 
                $column = \PHPExcel_Cell::stringFromColumnIndex($i);
                $objectPHPExcel->getActiveSheet()->setCellValue($column.($n+4) ,array_shift($product));
                $objectPHPExcel->setActiveSheetIndex(0)->getStyle($column.($n+4))->getFont()->setSize(14);
            }
            //设置边框
            $currentRowNum = $n+4;
            $objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':'.$column.$currentRowNum )
                    ->getBorders()->getTop()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':'.$column.$currentRowNum )
                    ->getBorders()->getLeft()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':'.$column.$currentRowNum )
                    ->getBorders()->getRight()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':'.$column.$currentRowNum )
                    ->getBorders()->getBottom()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
            $objectPHPExcel->getActiveSheet()->getStyle('B'.($n+4).':'.$column.$currentRowNum )
                    ->getBorders()->getVertical()->setBorderStyle(\PHPExcel_Style_Border::BORDER_THIN);
        }

        //设置分页显示
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setHorizontalCentered(true);
        $objectPHPExcel->getActiveSheet()->getPageSetup()->setVerticalCentered(false);

        header('Content-Type : application/vnd.ms-excel');
        header("Content-Disposition:attachment;filename=$filename");
        $objWriter= \PHPExcel_IOFactory::createWriter($objectPHPExcel,'Excel5');
        $objWriter->save('php://output');
    }  
}
