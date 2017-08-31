<?php
namespace backend\controllers;

use Yii;
use backend\models\AboultImg;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;


class ImgController extends BaseController {

    const PAGESIZE = 10;

    protected $imgModel;

    public function init(){
        parent::init();
        $this->imgModel = new AboultImg;
    }

    public function actionIndex(){
        $type = 1;
        $res = $this->getData($type);

        return $this->render('index', $res);
    }

    public function actionCk(){
        $type = 2;
        $res = $this->getData($type);

        return $this->render('index', $res);
    }

    public function actionAdd(){

        return $this->render('add');
    }

    protected function getData(int $type){
        $get = Yii::$app->request->get();
        $pn = (!is_numeric($get['page']) || (int)$get['page'] <= 0) ? 1 : $get['page'];
        $offset = ($pn - 1) * self::PAGESIZE;

        $list = [];
        $count = $this->imgModel->getImgCountByType($type);
        if($count != 0){
            $list = $this->imgModel->getImgListByType($type, $offset, self::PAGESIZE);
        }
        
        $pages = new Pagination([
            'totalCount' => (int)$count,
            'pageSize' => self::PAGESIZE,
        ]);

        return [
            'pages' => $pages,
            'imgs' => $list,
        ];
    }

    public function actionInsert(){
        $urlPreg = "/(((^https?:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)$/";
        $post = Yii::$app->request->post();

        if(!in_array($post['type'], [1,2])){
            $this->error('请选择分类');
        }

        if(empty($post['img-val']) || !preg_match($urlPreg, $post['img-val'])){
            $this->error('请选择图片');
        }

        $model = new AboultImg;

        $model->img = $post['img-val'];
        $model->type = $post['type'];
        $model->ctime = time();

        if(false === ($model->save())){
            $this->error();
        }

        $this->out();
    }

    public function actionDelete(){
        $id = (int)Yii::$app->request->post('id');
        if(empty($id)) $this->error();

        $model = AboultImg::findOne($id);
        if($model === null) $this->error();

        $model->status = -9;
        if(false === ($model->save())){
            $this->error();
        }

        $this->out();
    }
    

}