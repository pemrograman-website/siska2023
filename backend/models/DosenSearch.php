<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Dosen;

/**
 * DosenSearch represents the model behind the search form of `backend\models\Dosen`.
 */
class DosenSearch extends Dosen
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'agama_id', 'homebase_id', 'pendidikan_id', 'status_dosen_id', 'universitas_id', 'user_id'], 'integer'],
            [['nidn', 'nip', 'nama_lengkap', 'jenis_kelamin', 'tmp_lahir', 'tgl_lahir', 'no_hp', 'alamat', 'prov_id', 'kab_id', 'kec_id', 'kel_id', 'fakultas_asal', 'prodi_asal', 'foto_src', 'foto_web'], 'safe'],
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
        $query = Dosen::find();

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
            'tgl_lahir' => $this->tgl_lahir,
            'agama_id' => $this->agama_id,
            'homebase_id' => $this->homebase_id,
            'pendidikan_id' => $this->pendidikan_id,
            'status_dosen_id' => $this->status_dosen_id,
            'universitas_id' => $this->universitas_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'nidn', $this->nidn])
            ->andFilterWhere(['like', 'nip', $this->nip])
            ->andFilterWhere(['like', 'nama_lengkap', $this->nama_lengkap])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'tmp_lahir', $this->tmp_lahir])
            ->andFilterWhere(['like', 'no_hp', $this->no_hp])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'prov_id', $this->prov_id])
            ->andFilterWhere(['like', 'kab_id', $this->kab_id])
            ->andFilterWhere(['like', 'kec_id', $this->kec_id])
            ->andFilterWhere(['like', 'kel_id', $this->kel_id])
            ->andFilterWhere(['like', 'fakultas_asal', $this->fakultas_asal])
            ->andFilterWhere(['like', 'prodi_asal', $this->prodi_asal])
            ->andFilterWhere(['like', 'foto_src', $this->foto_src])
            ->andFilterWhere(['like', 'foto_web', $this->foto_web]);

        return $dataProvider;
    }
}
