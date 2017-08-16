<?php

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Test Backend!</h1>

		<p><a class="btn btn-lg btn-success" href="<?= \yii\helpers\Url::toRoute('rbac/index') ?>">RBAC Managment</a></p>
    </div>
</div>