<?php 

namespace backend\assets;

use yii\web\AssetBundle;

/**
 * vue包
 */
class VueAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'https://unpkg.com/element-ui/lib/theme-chalk/index.css',
    ];
    public $js = [
    	'https://cdn.jsdelivr.net/npm/vue/dist/vue.js',
    	'https://unpkg.com/element-ui/lib/index.js',

    ];
    public $jsOptions = ['position' => \yii\web\View::POS_HEAD];
}
