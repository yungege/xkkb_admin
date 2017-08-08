<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;

class Product extends ActiveRecord {

    public static function tableName()
    {
        return 'product';
    }

    public function getProductCountByType(int $ftype = 0, int $stype = 0){
        $model = self::find();
        $model->where(['status' => 1]);

        if($ftype > 0){
            $model->andWhere(['pro_first_type' => (int)$ftype]);
        }

        if($stype > 0){
            $model->andWhere(['pro_second_type' => (int)$stype]);
        }

        return $model->count();
    }

    public function getProductListByType(int $ftype = 0, int $stype = 0, int $offset = 0, int $limit = 15){
        $model = self::find();
        $model->where(['status' => 1]);

        if($ftype > 0){
            $model->andWhere(['pro_first_type' => (int)$ftype]);
        }

        if($stype > 0){
            $model->andWhere(['pro_second_type' => (int)$stype]);
        }

        return $model->orderBy('ctime DESC')
            ->offset($offset)
            ->limit($limit)
            ->all();
    }

}