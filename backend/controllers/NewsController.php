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

    public function actionXkkb(){
        $get = Yii::$app->request->get();
        $pn = (!is_numeric($get['page']) || (int)$get['page'] <= 0) ? 1 : $get['page'];
        $offset = ($pn - 1) * self::PAGESIZE;

        $list = [];
        $count = $this->newsModel->getNewsCountByType(10);
        if($count != 0){
            $list = $this->newsModel->getNewsListByType(10, $offset, self::PAGESIZE);
        }
        
        $pages = new Pagination([
            'totalCount' => (int)$count,
            'pageSize' => self::PAGESIZE,
        ]);

        return $this->render('xkkb', [
            'pages' => $pages,
            'newsList' => $list,
        ]);
    }


    public function actionUpdate(){
        $post = Yii::$app->request->post();
        if(!is_numeric($post['id']) || $post['id'] <= 0 || !in_array($post['type'], [1,2,3])){
            $this->error();
        }

        $status = $post['type'] == 1 ? 2 : ($post['type'] == 2 ? 1 : -9);
        $model = News::findOne($post['id']);
        if($model === null){
            $this->error();
        }

        $model->setScenario('delete');
        $model->status = $status;
        if($model->save()){
            $this->out();
        }
        else{
            $this->error();
        }
    }

    public function actionPublish(){
        return $this->render('publish', [
            
        ]);
    }
    

    

}