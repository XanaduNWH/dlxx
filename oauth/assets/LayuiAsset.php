<?php
namespace oauth\assets;

use yii\web\AssetBundle;

class LayuiAsset extends AssetBundle {
	public $basePath = '@webroot';
	public $baseUrl = '@web';
	public $css = [
		'layui/css/layui.css',
	];
	public $js = [
		'layui/layui.js'
	];
}