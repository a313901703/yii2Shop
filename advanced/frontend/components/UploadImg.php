<?php
namespace frontend\components;

use Yii;
use yii\web\UploadedFile;
use yii\helpers\ArrayHelper;
/**
* 图片上传，必须依赖于model
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
            if (!$file && !$model->isNewRecord ) {
                $model->$attribute = $model->getOldAttribute($attribute);
            }else{
                $model->$attribute = self::upload($file,$path,$filename);
                self::remove($model->getOldAttribute($attribute));
            }
        }else{
            $return['success'] = false;
            $return['msg'] = current(array_values($model->firstErrors));
        }
        return $return;
    }

    /**
     * [单个图片上传]
     * @param  [type] $model    
     * @param  [type] $_attr [上传的字段]
     * @param  [type] $attr  [实际字段]
     * @param  [type] $path      [上传路径]
     * @param  [type] $filename  [上传文件名]
     * @return [boolean]         [是否成功]
     */
    public static function uploadImgNew(&$model,$_attr,$attr,$path = '',$filename = ''){
        $file = $model->$_attr = UploadedFile::getInstance($model, $_attr);
        if (!$file) {
            
        }elseif($model->validate([$_attr])){
            //如果上传成功，删除旧文件并写入实际字段
            if ($model->$_attr = self::upload($file,$path,$filename)) {
                self::remove($model->$attr);
                $model->$attr = $model->$_attr;
            }
        }else
            return current(array_values($model->getFirstErrors()));
        return true;
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
        if (!is_dir($path)) 
            mkdir($path,'0777',true);  //允许创建多级目录
        
        $name = $filename.'_'.time();
        $path = $path.'/'.$name.'.' . $file->getExtension();
        if ($file->saveAs($path)) {
            return  Yii::getAlias(Yii::$app->params['uploadImgDir']).'/'.$name.'.' . $file->getExtension();
        }
        return '';
    }

    /**
     * 删除图片
     * @param  [type] $filename [description]
     * @return [type]           [description]
     */
    private static function remove($filename){
        if (!$filename) 
            return;
        $path = Yii::getAlias('@webroot').$filename;
        @unlink($path);
    }

    /**
     * [FileInput  返回常用参数]（太长了懒得写）
     * @param  [type] $attributes    [description]
     * @param  string $path          [description]
     * @param  array  $options       [description]
     * @param  array  $pluginOptions [description]
     * @return [type]                [description]
     */
    public static function getFileInput($attributes,$options = [],$pluginOptions =[],$path = ''){
        // if (empty($attributes)) {
        //     return [];
        // }
        $path = $path ?: Yii::getAlias('@web');
        if (is_array($attributes)) {
            foreach ($attributes as $key => $value) {
                $initialPreview[$key] = $path.$value;
            }
        }else{
            $initialPreview = $path.$attributes;
        }

        $defaultOptions = ['multiple' => false];
        $options = empty($options) ? $defaultOptions : array_merge($defaultOptions,$options);

        $defaultPluginOptions = [
            // 需要预览的文件格式
            'previewFileType' => 'image',
            // 预览的文件
            'initialPreview' => $initialPreview,
            // 需要展示的图片设置，比如图片的宽度等
            'initialPreviewConfig' => [],
            // 是否展示预览图
            'initialPreviewAsData' => true,
            //初始化图片预览大小
            'previewSettings' => ['image'=>['width'=>'100px','height'=>'100px']],
            // 异步上传的接口地址设置
            //'uploadUrl' => Url::toRoute(['/site/upload']),
            // 异步上传需要携带的其他参数，比如商品id等
            // 'uploadExtraData' => [
            //     'goods_id' => $model->id,
            // ],
            //'uploadAsync' => true,
            // 最少上传的文件个数限制
            'minFileCount' => 0,
            // 最多上传的文件个数限制
            'maxFileCount' => 1,
            // 是否显示移除按钮，指input上面的移除按钮，非具体图片上的移除按钮
            'showRemove' => true,
            // 是否显示上传按钮，指input上面的上传按钮，非具体图片上的上传按钮
            'showUpload' => false,
            //是否显示[选择]按钮,指input上面的[选择]按钮,非具体图片上的上传按钮
            'showBrowse' => true,
            // 展示图片区域是否可点击选择多文件
            'browseOnZoneClick' => true,
            // 如果要设置具体图片上的移除、上传和展示按钮，需要设置该选项
            'fileActionSettings' => [
                // 设置具体图片的查看属性为false,默认为true
                'showZoom' => true,
                // 设置具体图片的上传属性为true,默认为true
                'showUpload' => true,
                // 设置具体图片的移除属性为true,默认为true
                'showRemove' => true,
            ],
        ];
        $pluginOptions = empty($pluginOptions) ? $defaultPluginOptions : ArrayHelper::merge($defaultPluginOptions,$pluginOptions);
        return [
            'options' => $options,
            'pluginOptions' => $pluginOptions,
        ];
    }
}
