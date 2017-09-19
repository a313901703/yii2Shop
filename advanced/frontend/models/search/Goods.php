<?php

namespace app\models\search;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Goods as GoodsModel;

/**
 * Goods represents the model behind the search form about `app\models\Goods`.
 */
class Goods extends GoodsModel
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'good_cate', 'good_brand', 'recommend', 'show', 'freight', 'stock', 'alert', 'sort', 'integral', 'virtual_nums', 'volume', 'created_at', 'updated_at', 'created_by', 'updated_by'], 'integer'],
            [['name', 'short_name', 'keyword', 'seo_title', 'seo_keyword', 'seo_content', 'good_no'], 'safe'],
            [['weight', 'market_price', 'sale_price', 'cost'], 'number'],
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
        $query = GoodsModel::find();

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
            'weight' => $this->weight,
            'good_cate' => $this->good_cate,
            'good_brand' => $this->good_brand,
            'recommend' => $this->recommend,
            'show' => $this->show,
            'freight' => $this->freight,
            'market_price' => $this->market_price,
            'sale_price' => $this->sale_price,
            'cost' => $this->cost,
            'stock' => $this->stock,
            'alert' => $this->alert,
            'sort' => $this->sort,
            'integral' => $this->integral,
            'virtual_nums' => $this->virtual_nums,
            'volume' => $this->volume,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'short_name', $this->short_name])
            ->andFilterWhere(['like', 'keyword', $this->keyword])
            ->andFilterWhere(['like', 'seo_title', $this->seo_title])
            ->andFilterWhere(['like', 'seo_keyword', $this->seo_keyword])
            ->andFilterWhere(['like', 'seo_content', $this->seo_content])
            ->andFilterWhere(['like', 'good_no', $this->good_no]);

        return $dataProvider;
    }
}
