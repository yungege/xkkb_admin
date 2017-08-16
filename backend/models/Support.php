<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;

class Support extends ActiveRecord {

    public static function tableName()
    {
        return 'support';
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
            [['en_title','en_desc','en_content','desc','title','category','pic','status','url'], 'required', 'message'=> '数据填写有误！'],
            [['category','status','ctime'], 'integer'],
            ['title', 'string', 'max'=>25],
            [['pic','url','en_title'], 'string', 'max'=>255],
            [['desc','content','en_desc','en_content'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return [
            'create' => ['desc','content','title','category','pic','en_title','en_desc','en_content'],
            'update' => ['desc','content','title','category','pic','en_title','en_desc','en_content'],
            'delete' => ['status'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'id'        => '',
            'title'     => '',
            'desc'      => '',
            'content'   => '',
            'category'  => '',
            'pic'       => '',
            'url'       => '',
            'status'    => '',
            'ctime'     => '',
            'en_title'  => '',
            'en_desc'   => '',
            'en_content'=> '',
        ];
    }

    public function getSupportCount(){
        return (self::find())->where([
            'status' => 1]
            )->count();
    }

    public function getSupportList(int $offset = 0, int $limit = 10){
        $query = self::find();

        $query->where(['status' => 1])
            ->select(['id','pic','title','en_title','ctime','url','category']);
        return $query->offset($offset)->limit($limit)->all();
    }
    
    public function getInfoById(int $id){
        return self::findOne($id)->toArray();
    }
}