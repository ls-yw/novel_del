<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace frontend\assets;

use yii\web\AssetBundle;

/**
 * @author Qiang Xue <qiang.xue@gmail.com>
 * @since 2.0
 */
class AppAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $css = [
        'static/css/book.css',
        'static/css/artdialog.css',
    ];
    public $js = [
        'static/js/jquery.min.js',
    	'static/js/tongji.js',
    	'static/js/bootstrap.min.js',
        'static/js/common.js',
        'static/js/artDialog.js',
    	'static/js/book.js',
    ];
    public $depends = [
        //'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
    ];
}
