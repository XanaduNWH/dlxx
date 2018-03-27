<?php

namespace api\modules\users;

/**
 * Thred module definition class
 */
class Module extends \yii\base\Module
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'api\modules\users\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
		// \Yii::configure($this, require(__DIR__ . '/config.php'));
    }
}
