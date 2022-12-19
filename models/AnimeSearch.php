<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Anime;

/**
 * AnimeSearch represents the model behind the search form of `app\models\Anime`.
 */
class AnimeSearch extends Anime
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['idAnime', 'duration', 'categoryId','ratingId'], 'integer'],
            [['Name', 'animeGenre', 'dateAdded', 'description', 'releaseDate', 'animeImage'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
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
        $query = Anime::find();

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
            'idAnime' => $this->idAnime,
            'dateAdded' => $this->dateAdded,
            'duration' => $this->duration,
            'releaseDate' => $this->releaseDate,
            'categoryId' => $this->categoryId,
            'typeId' => $this->typeId,
            'ratingId' => $this->ratingId,
        ]);

        $query->andFilterWhere(['like', 'Name', $this->Name])
            ->andFilterWhere(['like', 'animeGenre', $this->animeGenre])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'animeImage', $this->animeImage]);

        return $dataProvider;
    }
}
