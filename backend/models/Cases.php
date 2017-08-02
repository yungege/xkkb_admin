<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;

class Cases extends ActiveRecord {

    public static function tableName()
    {
        return 'case';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class'      => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['ctime'],
                ],
            ],
        ];
    }

    public function rules()
    {
        return [
            [['title', 'content', 'cover','status'], 'required', 'message'=> '数据填写有误！'],
            [['admin_id','status','ctime'], 'integer'],
            ['title', 'string', 'max'=>25],
            ['cover', 'string', 'max'=>255],
            ['content', 'safe'],
        ];
    }

    public function scenarios()
    {
        return [
            'create' => ['title','content','cover'],
            'update' => ['title','content','cover','status'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'        => '',
            'title'     => '',
            'content'   => '',
            'cover'     => '',
            'category'  => '',
            'admin_id'  => '',
            'status'    => '',
            'ctime'     => '',
        ];
    }

    public function getCaseCountByType(int $type){
        return (self::find())->where([
            'category' => $type,
            'status' => 1]
            )->count();
    }

    public function getCaseListByType(int $type, int $offset = 0, int $limit = 10){
        $query = self::find();

        $query->where(['category' => $type,'status' => 1]);
        return $query->offset($offset)->limit($limit)->all();
    }
    

}