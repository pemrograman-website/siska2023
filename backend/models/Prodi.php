<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "prodi".
 *
 * @property int $id
 * @property string|null $kode
 * @property string|null $nama
 * @property int $fakultas_id
 *
 * @property Fakultas $fakultas
 */
class Prodi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'prodi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['fakultas_id', 'kode', 'nama'], 'required'],
            [['fakultas_id'], 'integer'],
            [['kode'], 'string', 'max' => 10],
            [['nama'], 'string', 'max' => 50],
            [['fakultas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Fakultas::class, 'targetAttribute' => ['fakultas_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'kode' => 'Kode Program Studi',
            'nama' => 'Nama Program Studi',
            'fakultas_id' => 'Fakultas',
        ];
    }

    /**
     * Gets query for [[Fakultas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getFakultas()
    {
        return $this->hasOne(Fakultas::class, ['id' => 'fakultas_id']);
    }

    /**
     * Mengembalikan daftar Fakultas (id dan nama)
     */
    public static function list()
    {
        return Prodi::find()->all();
    }
}
