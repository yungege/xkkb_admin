<?php
namespace backend\controllers;

use Yii;
use backend\models\Meau;


class MeauController extends BaseController {

    public function actionIndex(){
        $meauList = (new Meau)->getMeauList();

        return $this->render('index', [
            'meauList' => (array)$meauList,
        ]);
    }

    public function actionUpdate(){
        return $this->render('update');
    }

    public function actionAdd(){
        return $this->render('add');
    }

    public function actionInsert(){
        $post = Yii::$app->request->post();
        echo "<pre>";print_r($post);exit;
    }

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