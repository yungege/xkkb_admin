<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;

class Message extends ActiveRecord {

    public static function tableName()
    {
        return 'message';
    }

    public function getMsgCount(){
        return (self::find())->count();
    }

    public function getMsgList(int $offset = 0, int $limit = 10){
        $query = self::find();

        $query->orderBy('ctime DESC');
        return $query->offset($offset)->limit($limit)->all();
    }
    

}