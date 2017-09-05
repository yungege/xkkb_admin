<?php
namespace backend\controllers;

use Yii;
use backend\models\News;
use backend\models\Category;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;


class NewsController extends BaseController {

    const PAGESIZE = 10;

    public static $cate = [
        9 => '行业新闻',
        10 => '新科凯邦',
    ];

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
    
    public function actionInsert(){
        $post = Yii::$app->request->post();
        $get = Yii::$app->request->get();
        $urlPreg = "/(((^https?:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)$/";
        if(
            !isset(self::$cate[$post['category']]) ||
            (mb_strlen($post['title']) > 50 || mb_strlen($post['title']) < 6) ||
            (mb_strlen($post['desc']) > 200 || mb_strlen($post['desc']) < 20) ||
            !preg_match($urlPreg, $post['cover-val']) || 
            empty($post['content']) ||
            empty($post['en_content']) ||
            empty($post['en_desc']) ||
            empty($post['en_title']) 
        ){
            $this->error();
        }

        if(isset($get['action']) && $get['action'] == 'update'){
            if(!is_numeric($get['id']) || $get['id'] <= 0){
                $this->error();
            }

            $model = News::findOne((int)$get['id']);
            if(null === $model){
                $this->error();
            }

            $model->scenario = 'update';
            $post['status']     = 2;
        }
        else{
            $model = new News;
            $model->scenario = 'create';
        }

        $post['cover']      = $post['cover-val'];
        $post['tags']       = self::$cate[$post['category']];
        $post['admin_id']   = Yii::$app->user->id;

        $model->load(['News' => $post]);
        if($model->validate() && $model->save()){
            $this->out();
        }

        $this->error();
    
    }

    public function actionEdit(){
        $id = Yii::$app->request->get('id');
        if(!is_numeric($id) || $id <= 0)
            throw new NotFoundHttpException("Page Not Found.");

        $info = News::findOne($id);
        if($info === null)
            throw new NotFoundHttpException("Page Not Found.");
        
        return $this->render('publish', [
            'info' => $info->toArray(),
            'type' => 'update',
        ]);
    }
    

}