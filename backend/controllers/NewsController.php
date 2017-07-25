<?php
namespace backend\controllers;

use Yii;
use backend\models\News;
use backend\models\Category;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;


class NewsController extends BaseController {

    const PAGESIZE = 10;

    protected $categoryModel;
    protected $newsModel;

    public function init(){
        parent::init();
        $this->categoryModel = new Category;
        $this->newsModel = new News;
    }

    public function actionIndex(){
        $get = Yii::$app->request->get();
        $pn = (!is_numeric($get['page']) || (int)$get['page'] <= 0) ? 1 : $get['page'];
        $offset = ($pn - 1) * self::PAGESIZE;

        $list = [];
        $count = $this->newsModel->getNewsCountByType(9);
        if($count != 0){
            $list = $this->newsModel->getNewsListByType(9, $offset, self::PAGESIZE);
        }
        
        $pages = new Pagination([
            'totalCount' => (int)$count,
            'pageSize' => self::PAGESIZE,
        ]);

        return $this->render('index', [
            'pages' => $pages,
            'newsList' => $list,
        ]);
    }

    

    

}