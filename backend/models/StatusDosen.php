<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "status_dosen".
 *
 * @property int $id
 * @property string $keterangan
 *
 * @property Dosen[] $dosens
 */
class StatusDosen extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'status_dosen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['keterangan'], 'required'],
            [['keterangan'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'keterangan' => 'Keterangan',
        ];
    }

    /**
     * Gets query for [[Dosens]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDosens()
    {
        return $this->hasMany(Dosen::class, ['status_dosen_id' => 'id']);
    }

    /**
     * Mengembalikan daftar StatusDosen (id dan nama)
     */
    public static function list()
    {
        return StatusDosen::find()->all();
    }
}
