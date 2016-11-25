<?php
namespace hop\microservice\console;

class RegistrationController extends \yii\console\Controller {

    /**
     * Main function which call from console to registrate service into HoP platform
     */
    public function actionRegister() {
        echo 'start registration';
        $config = $this->module->registrationConfig;

    }
}