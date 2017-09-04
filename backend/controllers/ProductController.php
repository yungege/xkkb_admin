<?php
namespace backend\controllers;

use Yii;
use backend\models\Category;
use backend\models\Product;
use yii\web\NotFoundHttpException;
use yii\data\Pagination;
use yii\helpers\Html;


class ProductController extends BaseController {

    const PAGESIZE = 15;

    // 室外光缆系列
    public function actionIndex(){
        $fType = 1;
        $res = [];

        $this->getData($fType, $res);

        return $this->render('index', $res);
    }

    // 室内光缆系列
    public function actionSn(){
        $fType = 2;
        $res = [];

        $this->getData($fType, $res);

        return $this->render('index', $res);
    }

    // 数据中心系列
    public function actionSj(){
        $fType = 3;
        $res = [];

        $this->getData($fType, $res);

        return $this->render('index', $res);
    }

    // 光纤入户系列
    public function actionRh(){
        $fType = 4;
        $res = [];

        $this->getData($fType, $res);

        return $this->render('index', $res);
    }

    // 光纤跳线系列
    public function actionTx(){
        $fType = 5;
        $res = [];

        $this->getData($fType, $res);

        return $this->render('index', $res);
    }

    // 光传输设备
    public function actionCs(){
        $fType = 6;
        $res = [];

        $this->getData($fType, $res);

        return $this->render('index', $res);
    }

    // 综合布线
    public function actionBx(){
        $fType = 7;
        $res = [];

        $this->getData($fType, $res);

        return $this->render('index', $res);
    }

    // 安防监控
    // public function actionJk(){
    //     $fType = 8;
    //     $res = [];

    //     $this->getData($fType, $res);

    //     return $this->render('index', $res);
    // }

    protected function getData($fType, &$res){
        $model = new Product;

        $get = Yii::$app->request->get();
        $pn = (!is_numeric($get['page']) || (int)$get['page'] <= 0) ? 1 : $get['page'];
        $offset = ($pn - 1) * self::PAGESIZE;

        
        $sType = (int)$get['stype'];

        $count = $model->getProductCountByType($fType, $sType);

        $pages = new Pagination([
            'totalCount' => (int)$count,
            'pageSize' => self::PAGESIZE,
        ]);
        
        if($count > 0){
            $proList = $model->getProductListByType($fType, $sType, $offset);
        }

        $cateList = (new Category)->getSecondCategoryListById($fType);
        if(!empty($cateList)){
            $cateList = array_column((array)$cateList, null, 'id');
        }

        $res = [
            'pages' => $pages,
            'proList' => (array)$proList,
            'ctype' => (array)$cateList, 
            'ftype' => $fType,
        ];
    }

    public function actionDelete(){
        $id = (int)Yii::$app->request->post('id');
        if(empty($id)){
            $this->error();
        }

        $model = Product::findOne($id);
        if($model === null){
            $this->error();
        }

        $model->status = -9;
        $res = $model->save();

        if(false === $res)
            $this->error();
        else
            $this->out();

    }

    public function actionInsert(){
        $urlPreg = "/(((^https?:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)$/";
        $post = Yii::$app->request->post();
        $optype = Yii::$app->request->get('type');
        $id = Yii::$app->request->get('id');

        if(isset($optype) && $optype == 'update'){
            if(!isset($id) || !is_numeric($id)){
                $this->error();
            }
        }

        if(
            (empty($post['pro_first_type']) || !is_numeric($post['pro_first_type'])) ||
            (empty($post['pro_second_type']) || !is_numeric($post['pro_second_type']))

        ){
            $this->error('请选择分类');
        }

        $catModel = Category::find(['id'=>(int)$post['pro_second_type'], 'pid'=>(int)$post['pro_first_type']]);
        if($catModel === null){
            $this->error('分类无效');
        }

        $post['pro_name'] = trim($post['pro_name']);
        if(mb_strlen($post['pro_name']) < 1 || mb_strlen($post['pro_name']) > 16){
            $this->error('名称长度必须在1-16位之间');
        }

        $post['en_pro_name'] = trim($post['en_pro_name']);
        if(!preg_match("/\w+/",$post['en_pro_name'])){
            $this->error('请输入英文名称');
        }

        $post['pro_model'] = trim($post['pro_model']);
        if(empty($post['pro_model']) || !preg_match("/\w{1,25}/", $post['pro_model'])){
            $this->error('请填写型号,且只能为字母数字下划线');
        }

        $post['pro_fs_type'] = trim($post['pro_fs_type']);
        if(empty($post['pro_fs_type'])){
            $this->error('请填写敷设方式');
        }

        $post['en_pro_fs_type'] = trim($post['en_pro_fs_type']);
        if(!preg_match("/\w+/",$post['en_pro_fs_type'])){
            $this->error('请填写英文敷设方式');
        }

        $post['tag'] = trim($post['tag']);
        if(!empty($post['tag']) && (mb_strlen($post['tag']) > 25 || mb_strlen($post['tag']) <= 0)){
            $this->error('标签长度必须小于25个字');
        }

        $post['en_tag'] = trim($post['en_tag']);
        if(!empty($post['en_tag']) && !preg_match("/\w+/",$post['en_tag'])){
            $this->error('英文标签只能是数字和字母');
        }

        if(!preg_match($urlPreg, $post['pro_cover_pic'])){
            $this->error('请上传封面图片(一)');
        }

        if(!preg_match($urlPreg, $post['en_pro_cover_pic'])){
            $this->error('请上传英文封面图片(一)');
        }

        if(!preg_match($urlPreg, $post['pro_cover_pic_2'])){
            $this->error('请上传封面图片(二)');
        }

        if(!preg_match($urlPreg, $post['en_pro_cover_pic_2'])){
            $this->error('请上传英文封面图片(二)');
        }

        if(!preg_match($urlPreg, $post['pro_tec_params'])){
            $this->error('请上传技术参数图片');
        }

        if(!preg_match($urlPreg, $post['en_pro_tec_params'])){
            $this->error('请上传英文技术参数图片');
        }

        if(empty($post['pro_desc'])){
            $this->error('请填写产品描述');
        }

        if(empty($post['en_pro_desc'])){
            $this->error('请填写英文产品描述');
        }

        if($optype == 'update'){
            $model = Product::findOne((int)$id);
            if($model === null || $model->status == -9){
                $this->error('该产品已被删除.');
            }
        }
        else{
            $model = new Product;
        }

        $model->pro_name = Html::encode($post['pro_name']);
        $model->pro_desc = Html::encode($post['pro_desc']);
        $model->en_pro_name = Html::encode($post['en_pro_name']);
        $model->en_pro_desc = Html::encode($post['en_pro_desc']);
        $model->pro_tec_params = $post['pro_tec_params'];
        $model->pro_cover_pic = $post['pro_cover_pic'];
        $model->pro_cover_pic_2 = $post['pro_cover_pic_2'];
        $model->en_pro_tec_params = $post['en_pro_tec_params'];
        $model->en_pro_cover_pic = $post['en_pro_cover_pic'];
        $model->en_pro_cover_pic_2 = $post['en_pro_cover_pic_2'];
        $model->pro_model = Html::encode($post['pro_model']);
        $model->pro_fs_type = Html::encode($post['pro_fs_type']);
        $model->en_pro_fs_type = Html::encode($post['en_pro_fs_type']);
        $model->pro_first_type = $post['pro_first_type'];
        $model->pro_second_type = $post['pro_second_type'];
        $model->ctime = time();

        $model->tag = $post['tag'];
        $model->en_tag = $post['en_tag'];

        if(false === $model->save()){
            $this->error();
        }
        else{
            $this->out();
        }
    }

    public function actionUpdate(){
        $res = [];
        $fType = Yii::$app->request->get('ca_f');
        $sType = Yii::$app->request->get('ca_s');
        $id = Yii::$app->request->get('id');

        if(
            !is_numeric($fType) || $fType < 0 || 
            !is_numeric($sType) || $sType < 0 ||
            !is_numeric($id) || $id < 0
        ){
            throw new NotFoundHttpException('Page Not Found');
        }

        $model = Product::findOne($id);
        if(
            $model->status == -9 || 
            $fType != $model->pro_first_type || 
            $sType != $model->pro_second_type
        ){
            throw new NotFoundHttpException('Page Not Found');
        }

        $cateList = (new Category)->getSecondCategoryListById($fType);
        if(!empty($cateList)){
            $cateList = array_column((array)$cateList, null, 'id');
        }

        $res = [
            'info' => $model->toArray(),
            'ctype' => (array)$cateList, 
            'ca_f' => $fType,
            'ca_s' => $sType,
            'id' => $id,
        ];

        return $this->render('update', $res);
    }
}