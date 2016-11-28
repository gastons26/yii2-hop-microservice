<?php
namespace hop\microservice\console;

use hop\microservice\helpers\MFileHelper;
use yii\helpers\Json;

class RegistrationController extends \yii\console\Controller {

    public $module;
    /**
     * Main function which call from console to registrate service into HoP platform
     */
    public function actionRegister() {
        $this->writeMessage('Start registrate Microservice');

        $url  = $this->module->gatewayUrl.'/api/gateway/apps/register';

        $this->writeMessage('Convert file static file content to base64');
        $this->setFileContents();

        $this->writeMessage('create Microservice security ApiKey');
        $this->module->registrationConfig['unixTimeStamp'] = time();
        $this->module->registrationConfig['apiKey'] = $this->getSecurityApiKey();

        $data = $this->module->registrationConfig;

        $options = array(
            'http' => array(
                'header'  => "Content-Type: application/json\r\n",
                'method'  => 'POST',
                'content' => Json::encode($data)
            )
        );

        $this->writeMessage('POST microservice registration: '.$url);

        $context  = stream_context_create($options);
        $result = file_get_contents($url, false, $context);

        if ($result === FALSE) {
            $this->writeMessage('Microservice registration failed. Please check you application configuration');
            return false;
        }

        $this->writeMessage('Microservice successfully registrated: '.$this->module->registrationConfig['h2OApp']['host']);
    }

    private function writeMessage($message)
    {
        echo $message."\r\n";
    }

    private function getSecurityApiKey() {
        $data = $this->module->registrationConfig['h2OApp']['name'].':'.$this->module->registrationConfig['unixTimeStamp'];
        return base64_encode(hash_hmac('sha1', $data, $this->module->secretKey, true));
    }

    private function setFileContents() {
        if(isset($this->module->registrationConfig['h2OApp']['applicationStaticFiles'])) {
            $data = $this->module->registrationConfig['h2OApp']['applicationStaticFiles'];
            foreach ($data as $k => $value) {
                $value['fileContent'] = base64_encode(MFileHelper::getFileContent($this->module->angularPath, $value['fileName']));
            }
        }
    }
}