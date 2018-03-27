<?php

use yii\helpers\Html;
use oauth\assets\LayuiAsset;

LayuiAsset::register($this);

$this->beginPage();
?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<?php $this->beginBody() ?>
	<div class="wrap">
		<div class="container">
			<?= $content ?>
		</div>
	</div>
</body>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; XanaduNWH <?= date('Y') ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</html>
<?php $this->endPage() ?>
