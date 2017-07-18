<?php
namespace backend\models;

use Yii;
use yii\base\Model;
use yii\behaviors\TimestampBehavior;
use \yii\db\ActiveRecord;

class Meau extends ActiveRecord {

    public static function tableName()
    {
        return 'meau_index';
    }

    // public function behaviors()
    // {
    //     return [
    //         'timestamp' => [
    //             'class'      => TimestampBehavior::className(),
    //             'attributes' => [
    //                 ActiveRecord::EVENT_BEFORE_INSERT => ['ctime'],
    //             ],
    //         ],
    //     ];
    // }

    // public function rules()
    // {
    //     return [
    //         ['url', 'url', 'defaultScheme' => 'http', 'required'],
    //         ['meau', 'string', 'length' => [2, 4]],
    //         ['show', 'safe'],
    //         ['show_limit', 'integer', 'value' => 8],
    //         ['admin_id', 'integer'],
    //         ['status', 'in', 'range' => [1, -9], 'value' => 1],
    //         [['ctime','sort'], 'integer'],
    //     ];
    // }

    // public function scenarios()
    // {
    //     return [
    //         'add'   => [
    //             'url',
    //             'meau',
    //             'show',
    //             'show_limit',
    //             'admin_id',
    //             'sort',
    //             'status',
    //             'ctime'
    //         ],
    //         'update' => [
    //             'url',
    //             'meau',
    //             'show',
    //             'sort',
    //             'status',
    //         ],
    //         'del' => [
    //             'status',
    //         ],
    //     ];
    // }

    public function attributeLabels()
    {
        return [
            'id'            => 'ID',
            'url'           => 'URL',
            'meau'          => '导航名称',
            'show'          => '下拉菜单',
            'show_limit'    => '下拉菜单数量限制',
            'admin_id'      => '管理员',
            'sort'          => '排序',
            'status'        => '当前状态',
            'ctime'         => '创建时间',
        ];
    }

    public function getMeauList(){
        $sql = "SELECT * FROM meau_index WHERE `status` = 1 ORDER BY sort,id DESC";
        $list = Yii::$app->db->createCommand($sql)->queryAll();
        return $list;
    }

    public function deleteMeauById(int $id){
        $meau = self::findOne($id);

        if($meau !== null){
            $meau->status = -9;
            return $meau->save();
        }

        return false;
    }

}