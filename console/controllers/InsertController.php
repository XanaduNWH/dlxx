<?php
namespace console\controllers;

use Yii;
use yii\console\Controller;

class InsertController extends Controller
{
	public function actionData()
	{
		$date = '2017/03/20 00:00:00';
		while (1)
		{
			$rows = [];
			$i = 0;

			while ($i < 10000) {
				$formarter = Yii::$app->formatter;
				$calledcount = rand(10, 300);
				$date = $formarter->asDatetime(strtotime($date.'+1 second'),'YYYY/MM/dd HH:mm:ss');
				for($x=0;$x<$calledcount;$x++){
					$rows[] = [$date, rand(1, 20), rand(1, 10), \Faker\Provider\Uuid::randomFloat(2,0.01,900.0000000000000)];	
				}
				$i = $i + $calledcount;
			}
			Yii::$app->db2
				->createCommand()
				->batchInsert(
					'exectime-info',
					[
						'datetime',
						'appid',
						'APIname',
						'time',
					],
					$rows
					)
			->execute()
			;
			Yii::$app->db2->close();
			unset($rows);
			// unset($date);
			echo '=';
		}
	}
}