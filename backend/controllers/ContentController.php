<?php
namespace backend\controllers;

use Yii;
use backend\models\Meau;

class ContentController extends BaseController {

    public function actionMeau(){
        $meauList = (new Meau)->getMeauList();

        return $this->render('meau', [
            'meauList' => (array)$meauList,
        ]);
    }

}