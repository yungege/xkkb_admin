<?php
namespace backend\controllers;

use Yii;
use backend\models\Meau;

class MeauController extends BaseController {

    public function actionDelete(){
        $id = Yii::$app->request->get;
        print_r($id);exit;
        $meauList = (new Meau)->getMeauList();

        return $this->render('meau', [
            'meauList' => (array)$meauList,
        ]);
    }

}