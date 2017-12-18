<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel frontend\models\thread\ThreadSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Threads');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="thread-index">

	<h1><?= Html::encode($this->title) ?></h1>
	<?php // echo $this->render('_search', ['model' => $searchModel]); ?>

	<p>
		<?= Html::a(Yii::t('app', 'Create Thread'), ['create'], ['class' => 'btn btn-success']) ?>
	</p>
<?php Pjax::begin(); ?>	<?= GridView::widget([
		'dataProvider' => $dataProvider,
		'filterModel' => $searchModel,
		'formatter' => [
			'class' => 'yii\i18n\Formatter',
			'nullDisplay' => '<i><font color=red>无</font></i>',
			'dateFormat' => 'YYYY年MM月dd日',
			'datetimeFormat' => 'YYYY年MM月dd日 HH:mm:ss',
			'timeFormat' => 'HH:mm:ss',
			'locale' => 'zh-CN',
			'defaultTimeZone' => 'Asia/Shanghai',
		],
		'columns' => [
			['class' => 'yii\grid\SerialColumn'],

			// 'id',
			// 'author_id',
			'title',
			'author_name',
			'created_at:datetime',
			'lc:datetime',
			// 'updated_at:datetime',
			// 'status',
			// 'title',
			// 'content:ntext',
			'comments_count',

			['class' => 'yii\grid\ActionColumn'],
		],
	]); ?>
<?php Pjax::end(); ?>
</div>
