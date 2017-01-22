<?php
namespace frontend\components;

use Yii;
use yii\web\UploadedFile;

/**
* 
*/
class UploadImg
{
    /**
     * [单个图片上传]
     * @param  [type] $model    
     * @param  [type] $attribute [上传的字段]
     * @param  [type] $path      [上传路径]
     * @param  [type] $filename  [上传文件名]
     * @return [boolean]         [是否成功]
     */
    public static function uploadImg(&$model,$attribute,$path = '',$filename = ''){
        $return['success'] = true;
        $file = $model->$attribute = UploadedFile::getInstance($model, $attribute);
        if ($model->validate()) {
            $model->$attribute = self::upload($file,$path,$filename);
        }else{
            $return['success'] = false;
            $return['msg'] = current(array_values($model->errors));
        }
        return $return;
    }
    /**
     * [多图片上传]
     * @param  [type] $model    
     * @param  [type] $attribute [上传的字段]
     * @param  [type] $path      [上传路径]
     * @param  [type] $filename  [上传文件名]
     * @return [boolean]         [是否成功]
     */
    public function uploadImgs($file,$attribute,$path = '',$filename = ''){
        
    }

    /**
     * [图片上传]
     * @param  [type] $file
     * @param  [type] $path     [上传路径]
     * @param  [type] $filename [上传文件名]
     */
    private static function upload($file,$path,$filename){
        $path = $path ?: Yii::getAlias(Yii::$app->params['uploadImgPath']);
        if (!is_dir($path)) {
            mkdir($path,'0777',true);  //允许创建多级目录
        }
        $name = $filename.'_'.time();
        $path = $path.'/'.$name.'.' . $file->getExtension();
        if ($file->saveAs($path)) {
            return  Yii::getAlias(Yii::$app->params['uploadImgDir']).'/'.$name.'.' . $file->getExtension();
        }
    }
}