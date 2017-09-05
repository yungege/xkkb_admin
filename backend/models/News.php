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
            [['en_title','en_desc','en_content','desc','title','content','cover','status','tags','category','admin_id'], 'required', 'message'=> '数据填写有误！'],
            [['admin_id','status','ctime','category'], 'integer'],
            ['title', 'string', 'max'=>50],
            [['cover','desc','tags','en_title'], 'string', 'max'=>255],
            [['content','en_desc','en_content'], 'safe'],
        ];
    }

    public function scenarios()
    {
        return [
            'create' => ['category','desc','title','content','cover','tags','admin_id','en_title','en_desc','en_content'],
            'update' => ['category','desc','title','content','cover','tags','admin_id','status','en_title','en_desc','en_content'],
            'delete' => ['status'],
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
            'en_title'  => '',
            'en_desc'   => '',
            'en_content' => '',
        ];
    }

    public function getNewsCountByType(int $type){
        return (self::find())->where([
            'category' => $type
            ])->andWhere(['<>', 'status', -9])->count();
    }

    public function getNewsListByType(int $type, int $offset = 0, int $limit = 10){
        $query = self::find();

        $query->where(['category' => $type])->andWhere(['<>', 'status', -9]);
        $query->orderBy('ctime DESC');
        return $query->offset($offset)->limit($limit)->all();
    }
    

}