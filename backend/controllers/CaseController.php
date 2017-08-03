<?php
namespace backend\controllers;

use Yii;
use backend\models\Cases;
use backend\models\Category;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;


class CaseController extends BaseController {

    const PAGESIZE = 10;

    public static $cate = [
        16 => '应用案例',
    ];

    protected $categoryModel;
    protected $caseModel;

    public function init(){
        parent::init();
        $this->categoryModel = new Category;
        $this->caseModel = new Cases;
    }

    public function actionIndex(){
        $get = Yii::$app->request->get();
        $pn = (!is_numeric($get['page']) || (int)$get['page'] <= 0) ? 1 : $get['page'];
        $offset = ($pn - 1) * self::PAGESIZE;

        $list = [];
        $count = $this->caseModel->getCaseCountByType(16);
        if($count != 0){
            $list = $this->caseModel->getCaseListByType(16, $offset, self::PAGESIZE);
        }
        
        $pages = new Pagination([
            'totalCount' => (int)$count,
            'pageSize' => self::PAGESIZE,
        ]);

        return $this->render('index', [
            'pages' => $pages,
            'caseList' => $list,
        ]);
    }

    public function actionDelete(){
        $id = Yii::$app->request->post('id');
        $model = Cases::findOne((int)$id);
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

    public function actionPublish(){
        return $this->render('publish', [
            'action' => 'add',
        ]);
    }

    public function actionInsert(){
        $post = Yii::$app->request->post();
        $get = Yii::$app->request->get();

        $urlPreg = "/(((^https?:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)$/";
        if(
            (mb_strlen($post['title']) > 30 || mb_strlen($post['title']) < 4) ||
            !preg_match($urlPreg, $post['cover-val']) || 
            empty($post['editorValue'])
        ){
            $this->error();
        }

        if(isset($get['action']) && $get['action'] == 'update'){
            if(!is_numeric($get['id']) || $get['id'] <= 0){
                $this->error();
            }

            $model = Cases::findOne((int)$get['id']);
            if(null === $model){
                $this->error();
            }

            $model->scenario = 'update';
        }
        else{
            $model = new Cases;
            $model->scenario = 'create';
            $model->admin_id = Yii::$app->user->id;
        }

        $post['content']    = $post['editorValue'];
        $post['cover']      = $post['cover-val'];
        $post['category']   = 16;

        $model->load(['Cases' => $post]);
        if($model->validate() && $model->save()){
            $this->out();
        }

        $this->error();
    }

    public function actionEdit(){
        $id = Yii::$app->request->get('id');
        if(!is_numeric($id) || $id <= 0)
            throw new NotFoundHttpException("Page Not Found.");

        $info = Cases::findOne($id);
        if($info === null)
            throw new NotFoundHttpException("Page Not Found.");

        return $this->render('publish', [
            'info' => $info->toArray(),
            'action' => 'update',
        ]);
    }

}