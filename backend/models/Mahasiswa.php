<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "mahasiswa".
 *
 * @property int $id
 * @property string $nim
 * @property string $nama_lengkap
 * @property string|null $tmp_lahir
 * @property string|null $tgl_lahir
 * @property string|null $jenis_kelamin
 * @property int $agama_id
 * @property string|null $no_hp
 * @property string|null $alamat
 * @property string|null $prov_id
 * @property string|null $kab_id
 * @property string|null $kec_id
 * @property string|null $kel_id
 * @property int $kewarganegaraan_id
 * @property string|null $angkatan
 * @property string|null $nisn
 * @property int|null $npsn_sekolah_asal
 * @property string|null $foto_src
 * @property string|null $foto_web
 * @property int $prodi_id
 * @property int $user_id
 *
 * @property Agama $agama
 * @property Wilayah $kab
 * @property Wilayah $kec
 * @property Wilayah $kel
 * @property Negara $kewarganegaraan
 * @property Sekolah $npsnSekolahAsal
 * @property Prodi $prodi
 * @property Wilayah $prov
 * @property User $user
 */
class Mahasiswa extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mahasiswa';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nim', 'nama_lengkap', 'agama_id', 'kewarganegaraan_id', 'prodi_id', 'user_id'], 'required'],
            [['tgl_lahir'], 'safe'],
            [['agama_id', 'kewarganegaraan_id', 'npsn_sekolah_asal', 'prodi_id', 'user_id'], 'integer'],
            [['nim', 'nisn'], 'string', 'max' => 10],
            [['nama_lengkap', 'foto_src'], 'string', 'max' => 50],
            [['tmp_lahir'], 'string', 'max' => 30],
            [['jenis_kelamin'], 'string', 'max' => 1],
            [['no_hp'], 'string', 'max' => 15],
            [['alamat'], 'string', 'max' => 100],
            [['prov_id', 'kab_id', 'kec_id', 'kel_id'], 'string', 'max' => 13],
            [['angkatan'], 'string', 'max' => 4],
            [['foto_web'], 'string', 'max' => 255],
            [['nim'], 'unique'],
            [['agama_id'], 'exist', 'skipOnError' => true, 'targetClass' => Agama::class, 'targetAttribute' => ['agama_id' => 'id']],
            [['kab_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wilayah::class, 'targetAttribute' => ['kab_id' => 'kode']],
            [['kec_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wilayah::class, 'targetAttribute' => ['kec_id' => 'kode']],
            [['kel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wilayah::class, 'targetAttribute' => ['kel_id' => 'kode']],
            [['kewarganegaraan_id'], 'exist', 'skipOnError' => true, 'targetClass' => Negara::class, 'targetAttribute' => ['kewarganegaraan_id' => 'id']],
            [['prodi_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prodi::class, 'targetAttribute' => ['prodi_id' => 'id']],
            [['prov_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wilayah::class, 'targetAttribute' => ['prov_id' => 'kode']],
            [['npsn_sekolah_asal'], 'exist', 'skipOnError' => true, 'targetClass' => Sekolah::class, 'targetAttribute' => ['npsn_sekolah_asal' => 'npsn']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nim' => 'Nim',
            'nama_lengkap' => 'Nama Lengkap',
            'tmp_lahir' => 'Tmp Lahir',
            'tgl_lahir' => 'Tgl Lahir',
            'jenis_kelamin' => 'Jenis Kelamin',
            'agama_id' => 'Agama ID',
            'no_hp' => 'No Hp',
            'alamat' => 'Alamat',
            'prov_id' => 'Prov ID',
            'kab_id' => 'Kab ID',
            'kec_id' => 'Kec ID',
            'kel_id' => 'Kel ID',
            'kewarganegaraan_id' => 'Kewarganegaraan ID',
            'angkatan' => 'Angkatan',
            'nisn' => 'Nisn',
            'npsn_sekolah_asal' => 'Npsn Sekolah Asal',
            'foto_src' => 'Foto Src',
            'foto_web' => 'Foto Web',
            'prodi_id' => 'Prodi ID',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Gets query for [[Agama]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAgama()
    {
        return $this->hasOne(Agama::class, ['id' => 'agama_id']);
    }

    /**
     * Gets query for [[Kab]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKab()
    {
        return $this->hasOne(Wilayah::class, ['kode' => 'kab_id']);
    }

    /**
     * Gets query for [[Kec]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKec()
    {
        return $this->hasOne(Wilayah::class, ['kode' => 'kec_id']);
    }

    /**
     * Gets query for [[Kel]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKel()
    {
        return $this->hasOne(Wilayah::class, ['kode' => 'kel_id']);
    }

    /**
     * Gets query for [[Kewarganegaraan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKewarganegaraan()
    {
        return $this->hasOne(Negara::class, ['id' => 'kewarganegaraan_id']);
    }

    /**
     * Gets query for [[NpsnSekolahAsal]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getNpsnSekolahAsal()
    {
        return $this->hasOne(Sekolah::class, ['npsn' => 'npsn_sekolah_asal']);
    }

    /**
     * Gets query for [[Prodi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProdi()
    {
        return $this->hasOne(Prodi::class, ['id' => 'prodi_id']);
    }

    /**
     * Gets query for [[Prov]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getProv()
    {
        return $this->hasOne(Wilayah::class, ['kode' => 'prov_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }
}
