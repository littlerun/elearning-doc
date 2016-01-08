<?php

namespace common\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Doc as DocModel;

/**
 * Doc represents the model behind the search form about `common\models\Doc`.
 */
class Doc extends DocModel
{
    
    private $globalSearch;
    
    function getGlobalSearch() {
        return $this->globalSearch;
    }

    function setGlobalSearch($globalSearch) {
        $this->globalSearch = $globalSearch;
    }

        /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'content','globalSearch', 'tags', 'author_id', 'category'], 'safe'],
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
        $query = DocModel::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->orFilterWhere(['like', 'title', $this->globalSearch])
            ->orFilterWhere(['like', 'content', $this->globalSearch])
            ->orFilterWhere(['like', 'tags', $this->globalSearch])
            ->orFilterWhere(['like', 'author_id', $this->globalSearch])
            ->orFilterWhere(['like', 'category', $this->globalSearch]);

        return $dataProvider;
    }
}
