<?php
namespace common\models;

use yii\validators\Validator;

class cellphoneValidator extends Validator
{
	public function validateAttribute($model, $attribute)
	{
		if ($model->$attribute != '13900000000') {
			$this->addError($model, $attribute, 'Cellphone must be 13900000000.');
		}
	}
}