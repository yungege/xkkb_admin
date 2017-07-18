<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;

class Banner extends ActiveRecord {

    public static function tableName()
    {
        return 'banner';
    }

    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'img' => 'IMG',
            'url' => 'URL',
            'sort' => 'SORT',
            'meau_color' => 'meauColor',
            'admin_id' => 'adminId',
            'status' => 'status',
            'ctime' => 'createTime',
        ];
    }

    public function getBannerList(){
        $sql = "SELECT * FROM `banner` WHERE `status` = 1 ORDER BY `sort`,`id` DESC";
        $list = Yii::$app->db->createCommand($sql)->queryAll();
        return $list;
    }

    // public function deleteMeauById(int $id){
    //     $meau = self::findOne($id);

    //     if($meau !== null){
    //         $meau->status = -9;
    //         return $meau->save();
    //     }

    //     return false;
    // }

}
