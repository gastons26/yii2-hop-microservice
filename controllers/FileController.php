<?php

namespace hop\microservice\controllers;

use hop\microservice\helpers\MFileHelper;
use yii\web\NotFoundHttpException;


class FileController extends \yii\rest\Controller
{
    public function behaviors()
    {
        return [
            [
                'class' => \yii\filters\ContentNegotiator::className(),
                'formats' => [
                    'application/json' => \yii\web\Response::FORMAT_JSON,
                ],
            ],
        ];
    }

    public function actionLazy($name)
    {
        try {
            $files = MFileHelper::getFiles(\Yii::getAlias($this->module->angularPath), [$name]);

            if (count($files) < 1) {
                throw new NotFoundHttpException("File not found");
            }

            $object = new \stdClass();
            $object->name = $name;
            $object->content = file_get_contents($files[0]);

            return $object;
        } catch(Exception $ex) {
            //TODO need to switch on logger
            throw new NotFoundHttpException("File not found");
        }
    }

    public function actionJavascript()
    {
        try {
            $files = MFileHelper::getFiles(\Yii::getAlias($this->module->angularScriptPath), ["*.js"]);
            return MFileHelper::getFileBasenames($files);
        } catch(Exception $ex) {
            //TODO need to switch on logger
            throw new NotFoundHttpException("Files not found");
        }

    }

    public function actionCss()
    {
        try {
    $files = MFileHelper::getFiles(\Yii::getAlias($this->module->angularStylePath), ["*.css"]);
    return MFileHelper::getFileBasenames($files);
} catch(Exception $ex) {
    //TODO need to switch on logger
    throw new NotFoundHttpException("Files not found");
}
}
}