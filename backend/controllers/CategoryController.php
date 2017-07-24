<?php
namespace backend\controllers;

use Yii;
use backend\models\Category;
use yii\web\NotFoundHttpException;


class CategoryController extends BaseController {

    public function actionIndex(){
        $meauList = (new Category)->getCategoryList();
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

    

}