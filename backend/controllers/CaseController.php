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

    

}