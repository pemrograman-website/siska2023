<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "negara".
 *
 * @property int $id
 * @property string $kode
 * @property string $nama
 *
 * @property Mahasiswa[] $mahasiswas
 */
class Negara extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'negara';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nama'], 'required'],
            [['kode', 'nama'], 'string', 'max' => 45],
            [['kode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode',
            'nama' => 'Nama',
        ];
    }

    /**
     * Gets query for [[Mahasiswas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getMahasiswas()
    {
        return $this->hasMany(Mahasiswa::class, ['kewarganegaraan_id' => 'id']);
    }
}
