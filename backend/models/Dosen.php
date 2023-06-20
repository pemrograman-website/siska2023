<?php

namespace backend\models;

use Yii;

use yii\web\UploadedFile;
use yii\web\ServerErrorHttpException;

/**
 * This is the model class for table "dosen".
 *
 * @property int $id
 * @property string|null $nidn_nip
 * @property string|null $nama_lengkap
 * @property string|null $jenis_kelamin
 * @property string|null $tmp_lahir
 * @property string|null $tgl_lahir
 * @property int $agama_id
 * @property int $homebase_id
 * @property string|null $no_hp
 * @property string|null $alamat
 * @property string $prov_id
 * @property string $kab_id
 * @property string $kec_id
 * @property string $kel_id
 * @property int $pendidikan_id
 * @property int $status_dosen_id
 * @property int $universitas_id
 * @property string|null $fakultas_asal
 * @property string|null $prodi_asal
 * @property string|null $foto_src
 * @property string|null $foto_web
 * @property int $user_id
 *
 * @property Agama $agama
 * @property Prodi $homebase
 * @property Wilayah $kab
 * @property Wilayah $kec
 * @property Wilayah $kel
 * @property Pendidikan $pendidikan
 * @property Wilayah $prov
 * @property StatusDosen $statusDosen
 * @property Universitas $universitas
 * @property User $user
 */
class Dosen extends \yii\db\ActiveRecord
{
    // Jenis Kelamin
    const LAKI_LAKI = 'L';
    const PEREMPUAN = 'P';

    // Variabel untuk menampung foto
    public $fotoBerkas;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'dosen';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['tgl_lahir'], 'safe'],
            [
                [
                    'agama_id', 'homebase_id', 'pendidikan_id', 'status_dosen_id',
                    'universitas_id', 'nama_lengkap', /*'user_id'*/
                ], 'required'
            ],
            [
                [
                    'agama_id', 'homebase_id', 'pendidikan_id', 'status_dosen_id',
                    'universitas_id', 'user_id'
                ], 'integer'
            ],
            [['nidn_nip'], 'string', 'max' => 10],
            [['nama_lengkap', 'prodi_asal'], 'string', 'max' => 50],
            [['jenis_kelamin'], 'string', 'max' => 1],
            [['tmp_lahir'], 'string', 'max' => 30],
            [['no_hp'], 'string', 'max' => 20],
            [['alamat'], 'string', 'max' => 100],
            [['prov_id', 'kab_id', 'kec_id', 'kel_id'], 'string', 'max' => 13],
            [['fakultas_asal', 'foto_src'], 'string', 'max' => 45],
            [['foto_web'], 'string', 'max' => 255],
            [['nidn_nip'], 'unique'],
            [
                ['agama_id'], 'exist', 'skipOnError' => true,
                'targetClass' => Agama::class,
                'targetAttribute' => ['agama_id' => 'id']
            ],
            [
                ['pendidikan_id'], 'exist', 'skipOnError' => true,
                'targetClass' => Pendidikan::class,
                'targetAttribute' => ['pendidikan_id' => 'id']
            ],
            [['homebase_id'], 'exist', 'skipOnError' => true, 'targetClass' => Prodi::class, 'targetAttribute' => ['homebase_id' => 'id']],
            [['status_dosen_id'], 'exist', 'skipOnError' => true, 'targetClass' => StatusDosen::class, 'targetAttribute' => ['status_dosen_id' => 'id']],
            [['universitas_id'], 'exist', 'skipOnError' => true, 'targetClass' => Universitas::class, 'targetAttribute' => ['universitas_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
            [['prov_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wilayah::class, 'targetAttribute' => ['prov_id' => 'kode']],
            [['kab_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wilayah::class, 'targetAttribute' => ['kab_id' => 'kode']],
            [['kec_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wilayah::class, 'targetAttribute' => ['kec_id' => 'kode']],
            [['kel_id'], 'exist', 'skipOnError' => true, 'targetClass' => Wilayah::class, 'targetAttribute' => ['kel_id' => 'kode']],

            // Berikan nilai default null untuk atribut yang menjadi foreign key
            [['prov_id', 'kab_id', 'kec_id', 'kel_id', 'user_id'], 'default', 'value' => null]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'nidn_nip' => 'NIDN / NIP',
            'nama_lengkap' => 'Nama Lengkap',
            'jenis_kelamin' => 'Jenis Kelamin',
            'tmp_lahir' => 'Tempat Lahir',
            'tgl_lahir' => 'Tanggal Lahir',
            'agama_id' => 'Agama',
            'homebase_id' => 'Homebase',
            'no_hp' => 'No HP',
            'alamat' => 'Alamat Lengkap',
            'prov_id' => 'Provinsi',
            'kab_id' => 'Kabupaten',
            'kec_id' => 'Kecamatan',
            'kel_id' => 'Kelurahan',
            'pendidikan_id' => 'Pendidikan Terakhir',
            'status_dosen_id' => 'Status Dosen',
            'universitas_id' => 'Universitas Asal',
            'fakultas_asal' => 'Fakultas Asal',
            'prodi_asal' => 'Program Studi Asal',
            'foto_src' => 'Foto Src',
            'foto_web' => 'Foto Web',
            'user_id' => 'User ID',
        ];
    }

    /**
     * Diturunkan dari ActiveRecord
     * Kita lakukan override
     */
    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if (!empty($this->tgl_lahir)) {
                $this->tgl_lahir = strtotime($this->tgl_lahir);
                $this->tgl_lahir = date('Y-m-d', $this->tgl_lahir);
            }
            return true;
        }

        return false;
    }

    /*
    * Method untuk validasi data secara manual
    *
    */
    public function validasiData()
    {
        // Jika validasi gagal, hentikan beritahu gagal validasinya
        if (!$this->validate()) {
            return false;
        }

        // Jika validasi berhasil, kirim true
        return true;
    }

    /**
     * Method untuk upload foto
     */

    /**
     * Mengambil foto dengan alamat path yang komplit 
     * @return string
     */
    public function getFotoWeb()
    {
        return !empty($this->foto_web) ? Yii::$app->params['fotoPath'] . '/' . $this->foto_web : null;
    }

    /**
     * Mengambil URL foto untuk menampilkan foto di web
     * params['fotoUrl'] diset di MahasiswaController
     * @return string
     */
    public function getFotoUrl()
    {
        return !empty($this->foto_web) ? Yii::$app->params['fotoUrl'] . '/' . $this->foto_web : null;
    }

    /**
     * Memproses unggah berkas
     *
     * @return mixed the uploaded image instance
     */
    public function uploadFoto()
    {
        // get the uploaded file instance. for multiple file uploads
        // the following data will return an array (you may need to use
        // getInstances method)
        $fotoInstance = UploadedFile::getInstance($this, 'fotoBerkas');

        // if no image was uploaded abort the upload
        if (empty($fotoInstance)) {
            return false;
        } else {
            if (empty($this->foto_web)) {
                // do nothing, krn sebelumnya tidak ada berkas
            } else {
                // hapus berkas lama dan ganti dengan berkas baru
                $file = $this->getFotoWeb();

                // check if file exists on server
                if (empty($file) || !file_exists($file)) {
                    throw new ServerErrorHttpException('Berkas tidak ditemukan di server');
                }

                // check if uploaded file can't be deleted on server
                if (!unlink($file)) {
                    throw new ServerErrorHttpException('Berkas di server tidak dapat dihapus');
                }
            }

            // simpan nama file yang asli
            $this->foto_src = $fotoInstance->name;

            // membuat nama file yang unik menggunakan teks acak (ini file yang akan diakses pada web)
            $tmp = explode(".", $fotoInstance->name);
            $ext = end($tmp);
            $this->foto_web = Yii::$app->security->generateRandomString(16) . ".$ext";

            // the uploaded image instance
            return $fotoInstance;
        }
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
     * Gets query for [[Homebase]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getHomebase()
    {
        return $this->hasOne(Prodi::class, ['id' => 'homebase_id']);
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
     * Gets query for [[Pendidikan]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPendidikan()
    {
        return $this->hasOne(Pendidikan::class, ['id' => 'pendidikan_id']);
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
     * Gets query for [[StatusDosen]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getStatusDosen()
    {
        return $this->hasOne(StatusDosen::class, ['id' => 'status_dosen_id']);
    }

    /**
     * Gets query for [[Universitas]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUniversitas()
    {
        return $this->hasOne(Universitas::class, ['id' => 'universitas_id']);
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
