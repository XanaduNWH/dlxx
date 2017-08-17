<?php
$formatter = Yii::$app->formatter;
?>
<tr>
	<td><?= $model->author->username ?></td>
	<td><?= $formatter->asDatetime($model->created_at) ?><br /><?= $formatter->asRaw($model->content) ?></td>
</tr>
