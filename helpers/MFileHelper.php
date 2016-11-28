<?php
namespace hop\microservice\helpers;

use yii\helpers\FileHelper;

class MFileHelper extends FileHelper {

    public static function getFileContent($path, $filename)
    {
        if(is_array($filename))
        {
            return self::getFiles($path, $filename)[0];
        }
        return self::getFiles($path, [$filename])[0];
    }

    public static function getFiles($path, $files)
    {
        return self::findFiles(\Yii::getAlias($path), [
            'only' => $files,
            'except' => ['*.php', '*.exe'],
            'recursive' => true,
        ]);
    }

    public static function getFileBasenames($files) {

        foreach ($files as $key => $value) {
            $files[$key] = basename($value);
        }
        return $files;
    }
}