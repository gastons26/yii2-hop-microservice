<?php
namespace hop\microservice\helpers;

use yii\helpers\FileHelper;

class MFileHelper extends FileHelper {

    public function contectToBase64($content) {
        return base64_decode($content, false);
    }
}