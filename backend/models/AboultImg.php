<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use \yii\db\ActiveRecord;

class AboultImg extends ActiveRecord {

    public static function tableName()
    {
        return 'aboult_img';
    }

    public function getImgCountByType(int $type){
        return (self::find())->where([
            'type' => $type,
            'status' => 1
            ])->count();
    }

    public function getImgListByType(int $type, int $offset = 0, int $limit = 10){
        $query = self::find();

        $query->where(['type' => $type,'status' => 1])->orderBy('ctime DESC');
        return $query->offset($offset)->limit($limit)->all();
    }
}