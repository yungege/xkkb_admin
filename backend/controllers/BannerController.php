<?php
namespace backend\controllers;

use Yii;
use backend\models\Banner;
use yii\web\NotFoundHttpException;


class BannerController extends BaseController {

    public function actionIndex(){
        $bannerList = (new Banner)->getBannerList();

        return $this->render('index', [
            'bannerList' => (array)$bannerList,
        ]);
    }

    public function actionAdd(){
        return $this->render('add');
    }

    public function actionUpdate(){
        $banner = (new Banner)->getBannerInfo();

        return $this->render('update', [
            'banner' => (array)$banner,
        ]);
    }

    

}