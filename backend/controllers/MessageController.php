<?php
namespace backend\controllers;

use Yii;
use backend\models\Message;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;


class MessageController extends BaseController {

    const PAGESIZE = 15;

    protected $msgModel;

    public function init(){
        parent::init();
        $this->msgModel = new Message;
    }

    public function actionIndex(){
        $get = Yii::$app->request->get();
        $pn = (!is_numeric($get['page']) || (int)$get['page'] <= 0) ? 1 : $get['page'];
        $offset = ($pn - 1) * self::PAGESIZE;

        $list = [];
        $count = $this->msgModel->getMsgCount();
        if($count != 0){
            $list = $this->msgModel->getMsgList($offset, self::PAGESIZE);
        }
        
        $pages = new Pagination([
            'totalCount' => (int)$count,
            'pageSize' => self::PAGESIZE,
        ]);

        return $this->render('index', [
            'pages' => $pages,
            'list' => $list,
        ]);
    }
    

}