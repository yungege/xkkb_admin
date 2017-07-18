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
        $urlPreg = "";
        if(
            empty($post['meau']) || 
            mb_strlen($post['meau']) > 6 ||
            !preg_match($urlPreg, $post['url']) ||
            !is_numeric($post['sort']) ||
            $post['sort'] > 8 || 
            $post['sort'] < 1 ||
        ){
            $this->error('参数错误.');
        }

        // 下拉菜单
        foreach ($variable as $key => $value) {
            # code...
        }
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