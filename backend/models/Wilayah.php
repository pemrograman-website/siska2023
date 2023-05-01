<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "wilayah".
 *
 * @property string $kode
 * @property string $nama
 *
 * @property Dosen[] $dosens
 * @property Dosen[] $dosens0
 * @property Dosen[] $dosens1
 * @property Dosen[] $dosens2
 */
class Wilayah extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'wilayah';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'nama'], 'required'],
            [['kode'], 'string', 'max' => 13],
            [['nama'], 'string', 'max' => 50],
            [['kode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'nama' => 'Nama',
        ];
    }

    /**
     * Gets query for [[Dosens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDosens()
    {
        return $this->hasMany(Dosen::class, ['prov_id' => 'kode']);
    }

    /**
     * Gets query for [[Dosens0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDosens0()
    {
        return $this->hasMany(Dosen::class, ['kab_id' => 'kode']);
    }

    /**
     * Gets query for [[Dosens1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDosens1()
    {
        return $this->hasMany(Dosen::class, ['kec_id' => 'kode']);
    }

    /**
     * Gets query for [[Dosens2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDosens2()
    {
        return $this->hasMany(Dosen::class, ['kel_id' => 'kode']);
    }
}
