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

    // 【关于我们】分类
    public function actionAboult(){
        $meauList = (new Category)->getCategoryListByType(4);
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

    

}