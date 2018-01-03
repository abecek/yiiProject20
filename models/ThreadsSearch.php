<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Thread;

/**
 * ThreadsSearch represents the model behind the search form of `app\models\Thread`.
 */
class ThreadsSearch extends Thread
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id_thread', 'count_displays', 'state', 'id_author', 'id_section'], 'integer'],
            [['title', 'date_begin', 'date_end'], 'safe'],
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
        $query = Thread::find();

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
            'id_thread' => $this->id_thread,
            'count_displays' => $this->count_displays,
            'state' => $this->state,
            'date_begin' => $this->date_begin,
            'date_end' => $this->date_end,
            'id_author' => $this->id_author,
            'id_section' => $this->id_section,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title]);

        return $dataProvider;
    }
}
