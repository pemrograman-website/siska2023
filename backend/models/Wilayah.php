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
    public function getDosenByProvinsi()
    {
        return $this->hasMany(Dosen::class, ['prov_id' => 'kode']);
    }

    /**
     * Gets query for [[Dosens0]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDosenByKabupaten()
    {
        return $this->hasMany(Dosen::class, ['kab_id' => 'kode']);
    }

    /**
     * Gets query for [[Dosens1]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDosenByKecamatan()
    {
        return $this->hasMany(Dosen::class, ['kec_id' => 'kode']);
    }

    /**
     * Gets query for [[Dosens2]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getDosenByKelurahan()
    {
        return $this->hasMany(Dosen::class, ['kel_id' => 'kode']);
    }

    /*
        Untuk nge-list daftar wilayah:
            - Wilayah::list(), untuk nge-list provinsi
            - Wilayah::list($kode), untuk nge-list kab, kec, kel berdasarkan $kode parent-nya,
              misal: list('11'), untuk nge-list kabupaten yang ada di provinsi aceh (kode = 11)
                     list('11.01'), untuk nge-list kecamatan yang ada di kab aceh selatan (kode = 11.01)
                     list('11.01.01'), untuk nge-list kecamatan yang ada di kec bakongan (kode = 11.01.01)
    */
    public static function list($kode = 0)
    {
        $query = Wilayah::find();
        $panjangKode = strlen($kode);

        if ($kode == 0) {
            // nge-list provinsi
            // $query= 'SELECT * FROM wilayah WHERE LENGTH(kode)=2 ORDER BY nama ASC'
            $query->where(['LENGTH(kode)' => 2]);
        } else if ($panjangKode < 8) {
            // nge-list kabupaten dan kecamatan
            // $query= 'SELECT * FROM wilayah WHERE LENGTH(kode)=5 AND LEFT(kode,2)='$kode' ORDER BY nama ASC'
            // $query= 'SELECT * FROM wilayah WHERE LENGTH(kode)=8 AND LEFT(kode,5)='$kode' ORDER BY nama ASC'
            $query->where(['LENGTH(kode)' => $panjangKode + 3]);
            $query->andWhere(['LEFT(kode,' . $panjangKode . ')' => $kode]);
        } else {
            // nge-list kecamatan
            // $query= 'SELECT * FROM wilayah WHERE LENGTH(kode)=13 AND LEFT(kode,8)='$kode' ORDER BY nama ASC'
            $query->where(['LENGTH(kode)' => 13]);
            $query->andWhere(['LEFT(kode,' . $panjangKode . ')' => $kode]);
        }

        $query->orderBy([
            'nama' => SORT_ASC,
        ]);

        return $query->all(); // Menjalankan query di atas
    }
}
