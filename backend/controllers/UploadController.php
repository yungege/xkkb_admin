<?php
namespace backend\controllers;

use Yii;

class UploadController extends BaseController {

    public $imgExt = [
        'image/png',
        'image/jpg',
        'image/jpeg',
        'image/gif',
        'image/bmp',
    ];

    public $picsize = 2097152;

    public $enableCsrfValidation = false;

    public function getUploadDir(){
        $dir = dirname(Yii::$app->basePath).'/statics/upload/'.date('Y_m_d');
        $rootDir = dirname(Yii::$app->basePath);
        $fileDir = '/statics/upload/'.date('Y_m_d');

        if(!file_exists($rootDir.$fileDir)){
            @mkdir($dir, 0777, true);
        }
        return [
            'rootPath' => $rootDir,
            'filePath' => $fileDir,
            'totalPath' => $rootDir.$fileDir,
        ];
    }

    public function actionImg(){
        $dir = $this->getUploadDir();
        $file = $_FILES['file'];

        if(empty($file))
            $this->error('没有文件被上传.');

        if(!in_array($file['type'], $this->imgExt))
            $this->error('图片格式错误.');

        if($file['size'] > $this->picsize)
            $this->error('文件大小不能2M.');

        $fileName = md5($file['name']).explode('.',microtime(true))[1].'.'.pathinfo($file['name'], PATHINFO_EXTENSION);
        $filePath = $dir['totalPath'] . '/' . $fileName;

        $res = move_uploaded_file($file['tmp_name'], $filePath);
        if($res === false)
            $this->error('文件上传失败.');
        else
            $this->out(['url' => $dir['filePath'].'/'.$fileName]);
    }

    

}