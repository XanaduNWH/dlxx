<?php

namespace frontend\modules\Thread;

/**
 * Thred module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'frontend\modules\Thread\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
		\Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
