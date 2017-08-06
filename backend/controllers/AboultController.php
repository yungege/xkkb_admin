<?php
namespace backend\controllers;

use Yii;
use backend\models\Qualification;
use backend\models\Category;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use yii\helpers\Html;


class AboultController extends BaseController {

    const PAGESIZE = 10;

    protected $aboultModel;

    public function init(){
        parent::init();
        $this->aboultModel = new Qualification;
    }

    public function actionIndex(){
        $get = Yii::$app->request->get();
        $pn = (!is_numeric($get['page']) || (int)$get['page'] <= 0) ? 1 : $get['page'];
        $offset = ($pn - 1) * self::PAGESIZE;
        $list = [];
        $count = $this->aboultModel->getCount();
        if(!$count == 0){
            $list = $this->aboultModel->getListByPage($offset, self::PAGESIZE);
        }
        
        $pages = new Pagination([
            'totalCount' => (int)$count,
            'pageSize' => self::PAGESIZE,
        ]);

        return $this->render('index', [
            'pages' => $pages,
            'aboultList' => $list,
        ]);
    }

    public function actionDelete(){
        $id = (int)Yii::$app->request->post('id');
        $model = Qualification::findOne((int)$id);
        if($model === null){
            $this->error();
        }

        // $model->setScenario('delete');
        $model->status = -9;
        $res = $model->save();

        if(false === $res)
            $this->error();
        else
            $this->out();
    }

    public function actionPublish(){
        return $this->render('publish', [
            'type' => 'add',
        ]);
    }

    public function actionInsert(){
        $post = Yii::$app->request->post();
        // $get = Yii::$app->request->get();
        $urlPreg = "/(((^https?:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)$/";
        if(
            !preg_match($urlPreg, $post['img-val']) || 
            !preg_match($urlPreg, $post['thumb-val'])
        ){
            $this->error();
        }

        if(!empty($post['desc'])){
            $post['desc'] = Html::encode($post['desc']);
        }

        $model = new Qualification;
        // $model->scenario = 'create';
        
        $model->img         = $post['img-val'];
        $model->thumb       = $post['thumb-val'];
        $model->admin_id    = Yii::$app->user->id;
        $model->desc        = $post['desc'];
        $model->ctime       = time();

        $res = $model->save();
        if($res === false)
            $this->error();
        
        $this->out();
    }

    // public function actionEdit(){
    //     $id = Yii::$app->request->get('id');
    //     if(!is_numeric($id) || $id <= 0)
    //         throw new NotFoundHttpException("Page Not Found.");

    //     $info = Support::findOne($id);
    //     if($info === null)
    //         throw new NotFoundHttpException("Page Not Found.");
        
    //     return $this->render('publish', [
    //         'info' => $info->toArray(),
    //         'type' => 'update',
    //     ]);
    // }
    

}