<?php 
namespace app\service;

use Yii;
use app\models\Orders as OrderModel;

/**
* order service
*/
class Orders extends OrderModel
{
    public $_totalPrice;
    public $start;
    public $end;

    public function rules(){
        return [
            [['status'],'safe'],
            ['start','default','value'=>date('Y-m-d',time() - 24* 60 * 60 *7 )],
            ['end','default','value'=>date('Y-m-d',time())],
        ];
    }

    public function setTotalPrice(){
        $this->_totalPrice = $this->total / 100;
    }

    public function getTotalPrice(){
        if (!$this->_totalPrice) {
            $this->setTotalPrice();
        }
        return $this->_totalPrice;
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
        $query = Orders::find();

        $this->load($params);
        $this->validate();

        $query->andFilterWhere([
            'status' => $this->status,
        ]);

        $start = strtotime($this->start);
        $end = strtotime($this->end);
        $query->andFilterWhere(['between', 'created_at', $start , $end]);
        
        return $query;
    }
}

 ?>