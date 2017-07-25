<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;

class News extends ActiveRecord {

    public static function tableName()
    {
        return 'news';
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
            [['desc','title', 'content', 'cover','status','tags'], 'required', 'message'=> '数据填写有误！'],
            [['admin_id','status','ctime'], 'integer'],
            ['title', 'string', 'max'=>25],
            [['cover','desc','tags'], 'string', 'max'=>255],
            ['content', 'safe'],
        ];
    }

    public function scenarios()
    {
        return [
            'create' => ['desc','title','content','cover','tags'],
            'update' => ['desc','title','content','cover','status','tags'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'        => '',
            'title'     => '',
            'desc'      => '',
            'tags'      => '',
            'content'   => '',
            'cover'     => '',
            'category'  => '',
            'admin_id'  => '',
            'status'    => '',
            'ctime'     => '',
        ];
    }

    public function getNewsCountByType(int $type){
        return (self::find())->where([
            'category' => $type,
            'status' => 1]
            )->count();
    }

    public function getNewsListByType(int $type, int $offset = 0, int $limit = 10){
        $query = self::find();

        $query->where(['category' => $type,'status' => 1]);
        return $query->offset($offset)->limit($limit)->all();
    }
    

}