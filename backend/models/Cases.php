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
            [['en_title', 'en_content', 'title', 'content', 'cover','status'], 'required', 'message'=> '数据填写有误！'],
            [['admin_id','status','ctime'], 'integer'],
            ['title', 'string', 'max'=>25],
            [['cover','en_title'], 'string', 'max'=>255],
            [['content','en_content'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return [
            'create' => ['title','content','cover','category','admin_id','en_title', 'en_content'],
            'update' => ['title','content','cover','en_title', 'en_content'],
            'delete' => ['status'],
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
            'en_title'  => '',
            'en_content'=> '',
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

        $query->where(['category' => $type,'status' => 1])->orderBy('ctime DESC');
        return $query->offset($offset)->limit($limit)->all();
    }
    

}