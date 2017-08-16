<?php

/* @var $this yii\web\View */
$title = 'Test Frontend!';

$this->title = $title;
?>
<div class="site-index">

    <div class="jumbotron">
        <h1><?= $title ?></h1>

		<p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::toRoute('country/index') ?>">Country List</a></p>
		<p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::toRoute('thread/index') ?>">Thread List</a></p>
		<p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::to('admin') ?>">Admin Modules</a></p>
    </div>
</div>
