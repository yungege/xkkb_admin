<?php
namespace backend\controllers;

use Yii;
use backend\models\Support;
use backend\models\Category;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;


class SupportController extends BaseController {

    const PAGESIZE = 10;

    protected $supportModel;

    public function init(){
        parent::init();
        $this->supportModel = new Support;
    }

    public function actionIndex(){
        $get = Yii::$app->request->get();
        $pn = (!is_numeric($get['page']) || (int)$get['page'] <= 0) ? 1 : $get['page'];
        $offset = ($pn - 1) * self::PAGESIZE;
        $list = [];
        $count = $this->supportModel->getSupportCount();
        if(!$count == 0){
            $list = $this->supportModel->getSupportList($offset, self::PAGESIZE);
        }
        
        $pages = new Pagination([
            'totalCount' => (int)$count,
            'pageSize' => self::PAGESIZE,
        ]);

        return $this->render('index', [
            'pages' => $pages,
            'supportList' => $list,
        ]);
    }

    public function actionDelete(){
        $id = (int)Yii::$app->request->post('id');
        $model = Support::findOne((int)$id);
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
            
        ]);
    }

    public function actionInsert(){
        $post = Yii::$app->request->post();
        $get = Yii::$app->request->get();
        $urlPreg = "/(((^https?:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)$/";
        if(
            (mb_strlen($post['title']) > 30 || mb_strlen($post['title']) < 4) ||
            (mb_strlen($post['desc']) > 200 || mb_strlen($post['desc']) < 20) ||
            !preg_match($urlPreg, $post['pic-val']) || 
            empty($post['editorValue'])
        ){
            $this->error();
        }

        if(isset($get['action']) && $get['action'] == 'update'){
            if(!is_numeric($get['id']) || $get['id'] <= 0){
                $this->error();
            }

            $model = Support::findOne((int)$get['id']);
            if(null === $model){
                $this->error();
            }

            $model->scenario = 'update';
        }
        else{
            $model = new Support;
            $model->scenario = 'create';
        }

        $post['content']    = $post['editorValue'];
        $post['pic']        = $post['pic-val'];
        $post['category']   = 11;

        $model->load(['Support' => $post]);
        if($model->validate() && $model->save()){
            $this->out();
        }

        $this->error();
    }

    public function actionEdit(){
        $id = Yii::$app->request->get('id');
        if(!is_numeric($id) || $id <= 0)
            throw new NotFoundHttpException("Page Not Found.");

        $info = Support::findOne($id);
        if($info === null)
            throw new NotFoundHttpException("Page Not Found.");
        
        return $this->render('publish', [
            'info' => $info->toArray(),
            'type' => 'update',
        ]);
    }
    

}