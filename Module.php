<?php

namespace hop\microservice;

use Yii;
use yii\base\BootstrapInterface;

class Module extends \yii\base\Module implements BootstrapInterface
{
    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'hop\microservice\controllers';

    /**
     * @var string - application secret key
     */
    public $secretKey = "";

    /**
     * @var array => application registration infromation
     */
    public $registrationConfig;

    /**
     * @var string path where locates Angular front-end application. Default to webroot
     */
    public $angularPath = '@webroot';

    /**
     * @var string path where locates Angular javascript boot files. Default to webroot
     */
    public $angularScriptPath = '@webroot';

    /**
     * @var string path where locates Angular css stylesheet files. Default to webroot
     */
    public $angularStylePath = '@webroot';

    /**
     * @var string gateway microservice URL
     */
    public $gatewayUrl = 'http://localhost:9003';

    /**
     * @inheritdoc
     */
    public function bootstrap($app)
    {
        if ($app instanceof \yii\console\Application) {
            \Yii::setAlias('webroot',dirname($_SERVER['SCRIPT_FILENAME']));

            $app->controllerMap[$this->id] = [
                'class' => 'hop\microservice\console\RegistrationController',
                'module' => $this,
            ];
        } else {
            $app->getUrlManager()->addRules([
                ['class' => 'yii\web\UrlRule', 'pattern' => 'api/'.$this->id.'/ping', 'route' => $this->id.'/main/ping'],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'api/'.$this->id.'/lazy', 'route' => $this->id.'/file/lazy'],

                ['class' => 'yii\web\UrlRule', 'pattern' => 'api/'.$this->id.'/boot/files/javascript', 'route' => $this->id.'/file/javascript'],
                ['class' => 'yii\web\UrlRule', 'pattern' => 'api/'.$this->id.'/boot/files/css', 'route' => $this->id.'/file/css'],

                ['class' => 'yii\web\UrlRule', 'pattern' => $this->id.'/fello', 'route' => $this->id.'/default/ping'],
            ], false);
        }
    }

}
