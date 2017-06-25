<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Mailhistory;

/**
 * MailhistorySearch represents the model behind the search form about `common\models\Mailhistory`.
 */
class MailhistorySearch extends Mailhistory
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'enquiry_id', 'customer_id', 'type'], 'integer'],
            [['mail_from', 'mail_to', 'subject', 'content', 'attachements', 'operator', 'info', 'create_at'], 'safe'],
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
        $query = Mailhistory::find()->orderBy('create_at DESC');

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

        // if (!is_null($this->create_at) && strpos($this->create_at, ' - ') !== false ) {
        //     list($start_date, $end_date) = explode(' - ', $this->create_at);
        //     $query->andFilterWhere(['between', 'create_at', strtotime($start_date.' 00:00:00'), strtotime($end_date.' 23:59:59')]);
        // }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'enquiry_id' => $this->enquiry_id,
            'customer_id' => $this->customer_id,
            'type' => $this->type,
        ]);


        $query->andFilterWhere(['like', 'mail_from', $this->mail_from])
            ->andFilterWhere(['like', 'mail_to', $this->mail_to])
            ->andFilterWhere(['like', 'subject', $this->subject])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'attachements', $this->attachements])
            ->andFilterWhere(['like', 'operator', $this->operator])
            ->andFilterWhere(['like', 'info', $this->info]);

        return $dataProvider;
    }
}
