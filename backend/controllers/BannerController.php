<?php
namespace backend\controllers;

use Yii;
use backend\models\Banner;
use yii\web\NotFoundHttpException;


class BannerController extends BaseController {

    public function actionIndex(){
        $bannerList = (new Banner)->getBannerList();

        return $this->render('index', [
            'bannerList' => (array)$bannerList,
        ]);
    }

    public function actionAdd(){
        return $this->render('add');
    }

    public function actionInsert(){
        $data = Yii::$app->request->post();
        $id = (int)Yii::$app->request->get('id');
        $urlPreg = "/(((^https?:(?:\/\/)?)(?:[-;:&=\+\$,\w]+@)?[A-Za-z0-9.-]+|(?:www.|[-;:&=\+\$,\w]+@)[A-Za-z0-9.-]+)((?:\/[\+~%\/.\w-_]*)?\??(?:[-\+=&;%@.\w_]*)#?(?:[\w]*))?)$/";

        if(empty($data['img'])){
            $this->error('请上传图片.');
        }

        if(empty($data['meau_color'])){
            $this->error('请输入菜单颜色.');
        }

        if(!preg_match($urlPreg, $data['url'])){
            $this->error('请输入合法的URL.');
        }

        if(!is_numeric($data['sort']) || $data['sort'] <= 0){
            $this->error('排序必须为大于0的整数.');
        }

        // update
        if(!empty($id)){
            $model = Banner::findOne($id);
            if($model === null){
                $this->error('修改Banner失败.');
            }
        }
        else{
            $model = new Banner;
            $model->ctime = time();
            $model->admin_id = Yii::$app->user->id;
        }

        $model->img = $data['img'];
        $model->url = $data['url'];
        $model->sort = $data['sort'];
        $model->meau_color = $data['meau_color'];

        $res = $model->save();
        if($res === false){
            $this->error();
        }
        else{
            $this->out();
        }
    }

    public function actionUpdate(){
        $id = $id = Yii::$app->request->get('id');
        if(empty($id) || !preg_match("/\d+/", $id))
            throw new NotFoundHttpException();

        $banner = (new Banner)->getBannerInfoById((int)$id);

        if(empty($banner)) throw new NotFoundHttpException();

        return $this->render('update', [
            'banner' => (array)$banner,
        ]);
    }

    public function actionDelete(){
        $id = Yii::$app->request->post('id');
        if(!preg_match("/\d+/", $id))
            $this->error();

        $res = (new Banner)->deleteBannerById((int)$id);
        if($res === false)
            $this->error();
        else
            $this->out();
    }

    

}