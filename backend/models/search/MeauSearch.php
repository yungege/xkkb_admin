<?php

namespace backend\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Meau;
use common\libs\Tree;

/**
 * MenuSearch represents the model behind the search form about `backend\models\Menu`.
 */
class MeauSearch extends Meau
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        // return [
        //     [['id', 'reg_ip', 'last_login_time', 'last_login_ip', 'status', 'created_at', 'updated_at'], 'integer'],
        //     [['username', 'auth_key', 'password_hash', 'email'], 'safe'],
        // ];

        return [
            [['meau','url','show'], 'safe'],
            [['show_limit','admin_id','status','ctime'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Meau::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status' => 1,
        ]);

        $query->andFilterWhere(['like', 'meau', $this->meau]);

        $query->orderBy(['id' => SORT_DESC]);


        $arr = $query->asArray()->all();

        $treeObj = new Tree(\yii\helpers\ArrayHelper::toArray($arr));
        $treeObj->icon = ['&nbsp;&nbsp;&nbsp;│ ', '&nbsp;&nbsp;&nbsp;├─ ', '&nbsp;&nbsp;&nbsp;└─ '];
        $treeObj->nbsp = '&nbsp;&nbsp;&nbsp;';
        $dataProvider = new \yii\data\ArrayDataProvider([
            'allModels' => $treeObj->getGridTree(),
            'pagination' => [
                'pageSize' => 20,
            ],
        ]);

        return $dataProvider;
    }
}
