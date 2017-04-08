<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Book;

/**
 * BookSearch represents the model behind the search form about `app\models\Book`.
 */
class BookSearch extends Book
{
    public $author;
    public $publisher;
    public $collection;
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['title', 'ISBN', 'year', 'author', 'publisher', 'collection'], 'safe'],
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
        $query = Book::find();
        $query->joinWith(['collection', 'category', 'publisher', 'author']);

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'defaultOrder' => [
                    'author' => SORT_ASC,
                ]
            ],
        ]);
        
        $dataProvider->sort->attributes['author'] = [
            'asc' => ['author.fullname' => SORT_ASC],
            'desc' => ['author.fullname' => SORT_DESC],
            'default' => SORT_ASC
        ];
        
        $dataProvider->sort->attributes['publisher'] = [
            'asc' => ['publisher.name' => SORT_ASC],
            'desc' => ['publisher.name' => SORT_DESC],
        ];
        
        $dataProvider->sort->attributes['collection'] = [
            'asc' => ['collection.name' => SORT_ASC],
            'desc' => ['collection.name' => SORT_DESC],
        ];
        
        if(!empty($params['category'])) {
            $query->andFilterWhere([
                'category.id' => $params['category']
            ]);
        }
        
        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if(!empty($params['letter'])) {
            $query->andFilterWhere(['like', 'author.fullname', $params['letter'] . '%', false]);
        }
        
        if(!empty($params['search'])) {
            $simplesearch = $params['search'];
            $query->orFilterWhere(['like', 'title', $simplesearch]);
            $query->orFilterWhere(['like', 'collection.name', $simplesearch]);
            $query->orFilterWhere(['like', 'publisher.name', $simplesearch]);
            $query->orFilterWhere(['like', 'author.fullname', $simplesearch]);

        }
        
        $query->andFilterWhere([
            'id' => $this->id,
            'year' => $this->year,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'publisher.name', $this->publisher])
            ->andFilterWhere(['like', 'author.fullname', $this->author])
            ->andFilterWhere(['like', 'collection.name', $this->collection]);

        return $dataProvider;
    }
}
