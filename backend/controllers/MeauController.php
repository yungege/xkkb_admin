<?php
namespace backend\controllers;

use Yii;
use backend\models\Meau;
use yii\web\NotFoundHttpException;


class MeauController extends BaseController {

    public function actionIndex(){
        $meauList = (new Meau)->getMeauList();
        foreach ($meauList as &$mv) {
            if(false === strpos($mv['url'], 'zh_cn')){
                $mv['en_url'] = $mv['url'] . '/en';
            }
            else{
                $mv['en_url'] = str_replace('zh_cn', 'en', $mv['url']);
            }
        }

        return $this->render('index', [
            'meauList' => (array)$meauList,
        ]);
    }

    public function actionUpdate(){
        $id = (int)Yii::$app->request->get('id');
        if(!$id) throw new NotFoundHttpException('页面不存在.');

        $meau = Meau::findOne($id);
        if($meau === null) throw new NotFoundHttpException('页面不存在.');
        $meau = $meau->toArray();
        if(!empty($meau['show']))
            $meau['show'] = unserialize($meau['show']);
        else
            $meau['show'] = [];

        return $this->render('update', ['meau' => $meau]);
    }

    public function actionAdd(){
        return $this->render('add');
    }

    public function actionInsert(){
        $meauCount = (Meau::find())->where(['status' => 1])->count();
        if($meauCount > 8){
            $this->error('最多只能配置8个菜单.');
        }

        $post = Yii::$app->request->post();
        $get = Yii::$app->request->get();

        $urlPreg = "/(((^https?:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)$/";
        if(
            empty($post['meau']) || 
            mb_strlen($post['meau']) > 12 ||
            empty($post['en_meau']) || 
            mb_strlen($post['en_meau']) > 24 ||
            !preg_match($urlPreg, $post['url']) ||
            !is_numeric($post['sort']) ||
            $post['sort'] > 8 || 
            $post['sort'] < 1
        ){
            $this->error('参数错误.');
        }

        if(empty($get['option']) || empty($get['id'])){
            $flag = 'add';
            $hasOne = (Meau::find())->where(['meau' => addslashes($post['meau']),'status'=>1])->one();
            if($hasOne !== null){
                $this->error('已存在名称为【'.$post['meau'].'】的菜单.');
            }
        }
        else{
            $flag = 'update';
            if($get['option'] != 'update' || empty((int)$get['id'])){
                $this->error('参数错误.');
            }

            $obj = Meau::findOne((int)$get['id']);
            if($obj === null){
                $this->error('修改失败.');
            }
        }
        

        // 下拉菜单
        $selectMeau = [];

        for($i = 1; $i <= 8; $i++){
            $picIndex = 'pic-'.$i;
            if(
                !empty($post[$picIndex]['url']) &&
                !empty($post[$picIndex]['title']) &&
                mb_strlen($post[$picIndex]['title']) >= 1 &&
                mb_strlen($post[$picIndex]['title']) <= 12 &&
                !empty($post[$picIndex]['en_title']) &&
                mb_strlen($post[$picIndex]['en_title']) >= 1 &&
                mb_strlen($post[$picIndex]['en_title']) <= 24 &&
                preg_match($urlPreg, $post[$picIndex]['link'])
            ){
                $post[$picIndex]['url'] = $post[$picIndex]['url']; 
                $selectMeau[] = $post[$picIndex];
            }
        } 

        if($flag == 'add'){
            $model = new Meau;
            $model->ctime = time();
        }
        else{
            $model = &$obj;
        }

        $model->url           = $post['url'];
        $model->meau          = htmlspecialchars($post['meau']);
        $model->en_meau       = htmlspecialchars($post['en_meau']);
        $model->show          = !empty($selectMeau) ? serialize($selectMeau) : '';
        $model->admin_id      = Yii::$app->user->id;
        $model->sort          = (int)$post['sort'];

        $res = $model->save();
        if($res === false)
            $this->error('操作失败.');
        else
            $this->out();
    }

    public function actionDelete(){
        $id = Yii::$app->request->post('id');
        if(!preg_match("/\d+/", $id))
            $this->error();

        $res = (new Meau)->deleteMeauById((int)$id);
        if($res === false)
            $this->error();
        else
            $this->out();
    }

    

}