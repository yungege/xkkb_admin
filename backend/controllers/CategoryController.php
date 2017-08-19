<?php
namespace backend\controllers;

use Yii;
use backend\models\Category;
use yii\web\NotFoundHttpException;


class CategoryController extends BaseController {

    // 【产品】分类
    public function actionIndex(){
        $meauList = (new Category)->getCategoryListByType(1);
        $meauList = self::rootTree(array_column($meauList, null, 'id'));

        return $this->render('index', [
            'meauList' => (array)$meauList,
        ]);
    }

    // 【应用案例】分类
    public function actionAboult(){
        $meauList = (new Category)->getCategoryListByType(5);
        $meauList = self::rootTree(array_column($meauList, null, 'id'));

        return $this->render('index', [
            'meauList' => (array)$meauList,
        ]);
    }

    // 【新闻动态】分类
    public function actionNews(){
        $meauList = (new Category)->getCategoryListByType(2);
        $meauList = self::rootTree(array_column($meauList, null, 'id'));

        return $this->render('index', [
            'meauList' => (array)$meauList,
        ]);
    }

    // 【技术支持】分类
    public function actionSupport(){
        $meauList = (new Category)->getCategoryListByType(3);
        $meauList = self::rootTree(array_column($meauList, null, 'id'));

        return $this->render('index', [
            'meauList' => (array)$meauList,
        ]);
    }

    public static function rootTree(Array $items, $childName = 'sub', $key = true){
        foreach ($items as $item) {
            if ($key) {
                $items[$item['pid']][$childName][$item['id']] = &$items[$item['id']];
            } else {
                $items[$item['pid']][$childName][] = &$items[$item['id']];
            }
        }

        return isset($items[0][$childName]) ? $items[0][$childName] : array();
    } 

    public function actionDelete(){
        $id = (int)Yii::$app->request->get('id');
        if(empty($id)){
            $this->error();
        }

        $model = Category::findOne($id);
        if($model === null){
            $this->error();
        }

        $model->setScenario('delete');
        $model->status = -9;
        $res = $model->save();

        if(false === $res)
            $this->error();
        else
            $this->out();

    }

    public function actionAdd(){
        $post = Yii::$app->request->post();

        if(
            (mb_strlen($post['cate_name']) < 2 || mb_strlen($post['cate_name']) > 16) ||
            (!preg_match("/\w{2,24}/", $post['en_cate_name'])) ||
            (!is_numeric($post['pid']) || $post['pid'] < 1) ||
            (!is_numeric($post['type']) || $post['type'] < 1) ||
            (!is_numeric($post['cate_level']) || $post['cate_level'] != 1)
        ){
            $this->error();
        }

        $cateExists = Category::findOne((int)$post['pid']);
        if($cateExists === null || $cateExists->status != 1){
            $this->error();
        }

        $post['cate_level'] = 2;
        $post['admin_id']   = Yii::$app->user->id;

        $model = new Category;
        $model->scenario = 'createSecondLeval';
        
        $model->load(['Category' => $post]);
        if($model->validate() && $model->save()){
            $this->out();
        }

        $this->error();
    }   

    public function actionEdit(){
        $post = Yii::$app->request->post();

        if(
            (mb_strlen($post['cate_name']) < 2 || mb_strlen($post['cate_name']) > 16) ||
            (!preg_match("/\w{2,24}/", $post['en_cate_name'])) ||
            (!is_numeric($post['id']) || $post['id'] < 1) ||
            (!is_numeric($post['cate_level']) || !in_array($post['cate_level'], [1,2])) ||
            (!is_numeric($post['type']) || $post['type'] < 1)
        ){
            $this->error();
        }

        if($post['cate_level'] == 1){
            if(!is_numeric($post['cate_sort']) || $post['cate_sort'] < 0){
                $this->error();
            }
        }

        $model = Category::findOne((int)$post['id']);
        if($model === null || $model->status != 1){
            $this->error();
        }

        $model->scenario = 'updateSecondLeval';
        $post['cate_sort'] = (int)$post['cate_sort'];
        
        $model->load(['Category' => $post]);
        if($model->validate() && $model->save()){
            $this->out();
        }

        $this->error();
    } 

}