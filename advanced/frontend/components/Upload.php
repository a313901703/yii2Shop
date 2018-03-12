<?php
namespace frontend\components;

use Yii;

use yii\base\Action;
use yii\base\Exception;
use yii\base\UserException;
use yii\helpers\Json;
use yii\web\UploadedFile;
/**
* 
*/
class Upload
{
    //文件路径
    public $filePath;
    //文件名
    public $fileName;
    /**
     * [上传的格式]
     */
    public $extensions = ['gif', 'jpg', 'jpeg', 'png', 'swf', 'txt', 'csv', 'doc', 'docx', 'zip', 'flv', 'mp4'];

    public function run()
    {
        try
        {
            $file = UploadedFile::getInstanceByName('Filedata');
            if($file->hasError)
                throw new HttpException(Yii::t('global','upload_file_fail').'('.$file->error.')');
            $extensions = ['gif', 'jpg', 'jpeg', 'png', 'swf', 'txt', 'csv', 'doc', 'docx', 'zip', 'flv', 'mp4'];
            if (!in_array($file->extension, $extensions))
                throw new HttpException(Yii::t('global','illegal_file_type'));
            if(in_array($file->extension, ['gif', 'jpg', 'jpeg', 'png','swf']))
            {
                list($width, $height) = getimagesize($file->tempName);
                $sizename = $width.'x'.$height;
            }
            else
                $sizename = null;
            $upload_data_dir = CONFIG_SET_BASE_PATH . '/../../upload/tmp';
            $file_name = time().rand(10000,99999) . '.' . $file->extension;
            if(!$file->saveAs($upload_data_dir . '/' . $file_name))
                throw new HttpException(Yii::t('global','mobile_file_fail'));
            $this->returnInfo([
                'file' => $file_name,
                'name' => $file->name,
                'sizename' => $sizename,
                'size' => $file->size,
                'up_user' => Yii::$app->user->realname,
                'up_time' => date('Y-m-d H:i:s'),
                'upload_data_dir'=> $upload_data_dir
            ]);
        }
        catch(\Exception $e)
        {
            $this->returnInfo(['emsg'=>$e->getMessage()], FAIL_RET);
        }
    }
}