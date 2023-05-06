<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Mahasiswa;

/**
 * MahasiswaSearch represents the model behind the search form of `backend\models\Mahasiswa`.
 */
class MahasiswaSearch extends Mahasiswa
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'agama_id', 'kewarganegaraan_id', 'npsn_sekolah_asal', 'prodi_id', 'user_id'], 'integer'],
            [['nim', 'nama_lengkap', 'tmp_lahir', 'tgl_lahir', 'jenis_kelamin', 'no_hp', 'alamat', 'prov_id', 'kab_id', 'kec_id', 'kel_id', 'angkatan', 'nisn', 'foto_src', 'foto_web'], 'safe'],
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
        $query = Mahasiswa::find();

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
            'kewarganegaraan_id' => $this->kewarganegaraan_id,
            'npsn_sekolah_asal' => $this->npsn_sekolah_asal,
            'prodi_id' => $this->prodi_id,
            'user_id' => $this->user_id,
        ]);

        $query->andFilterWhere(['like', 'nim', $this->nim])
            ->andFilterWhere(['like', 'nama_lengkap', $this->nama_lengkap])
            ->andFilterWhere(['like', 'tmp_lahir', $this->tmp_lahir])
            ->andFilterWhere(['like', 'jenis_kelamin', $this->jenis_kelamin])
            ->andFilterWhere(['like', 'no_hp', $this->no_hp])
            ->andFilterWhere(['like', 'alamat', $this->alamat])
            ->andFilterWhere(['like', 'prov_id', $this->prov_id])
            ->andFilterWhere(['like', 'kab_id', $this->kab_id])
            ->andFilterWhere(['like', 'kec_id', $this->kec_id])
            ->andFilterWhere(['like', 'kel_id', $this->kel_id])
            ->andFilterWhere(['like', 'angkatan', $this->angkatan])
            ->andFilterWhere(['like', 'nisn', $this->nisn])
            ->andFilterWhere(['like', 'foto_src', $this->foto_src])
            ->andFilterWhere(['like', 'foto_web', $this->foto_web]);

        return $dataProvider;
    }
}
