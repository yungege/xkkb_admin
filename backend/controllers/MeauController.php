<?php
namespace backend\controllers;

use Yii;
use backend\models\Meau;


class MeauController extends BaseController {


    public function actionDelete(){
        $id = Yii::$app->request->post('id');
        if(!preg_match("/\d+/", $id))
            $this->error();

        $res = (new Meau)->deleteMeauById((int)$id);
        if($res === false)
            $this->error();
        else
            $this->out();
        
    }

}