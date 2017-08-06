<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;

class Qualification extends ActiveRecord {

    public static function tableName()
    {
        return 'qualification';
    }

    public function attributeLabels()
    {
        return [
            'id'        => 'ID',
            'img'       => 'IMG',
            'thumb'     => '缩略图',
            'desc'      => '说明',
            'admin_id'  => 'adminId',
            'status'    => 'status',
            'ctime'     => 'createTime',
        ];
    }

    public function getList(){
        $sql = "SELECT * FROM `qualification` WHERE `status` = 1 ORDER BY `id` DESC";
        $list = Yii::$app->db->createCommand($sql)->queryAll();
        return $list;
    }

    public function deleteBannerById(int $id){
        $meau = self::findOne($id);

        if($meau !== null){
            $meau->status = -9;
            return $meau->save();
        }

        return false;
    }

    public function getCount(){
        $sql = "SELECT count(1) AS `num` FROM `qualification` WHERE `status` = 1 ORDER BY `id` DESC";
        $count = Yii::$app->db->createCommand($sql)->queryOne();
        return (int)$count['num'];
    }

    public function getListByPage(int $offset = 0, int $limit = 10){
        $sql = "SELECT * FROM `qualification` WHERE `status` = 1 ORDER BY `id` DESC LIMIT :offset,:lim";
        $list = Yii::$app->db
            ->createCommand($sql)
            ->bindValue(':offset', $offset)
            ->bindValue(':lim', $limit)
            ->queryAll();
        return $list;
    }

}
