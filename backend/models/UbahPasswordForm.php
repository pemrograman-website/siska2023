<?php

namespace backend\models;

use Yii;
use yii\base\Model;

use common\models\User;
use yii\web\ServerErrorHttpException;

/**
 * This is the model class for table "status_dosen".
 *
 * @property int $id
 * @property string $keterangan
 *
 * @property Dosen[] $dosens
 */
class UbahPasswordForm extends Model
{
    // Atribut yang muncul di Form
    public $password_lama;
    public $password_baru;
    public $password_ulang;

    // Atribut untuk menampung objek User
    protected $user;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['password_lama', 'password_baru', 'password_ulang'], 'required'],
            [['password_lama', 'password_baru', 'password_ulang'], 'string', 'max' => 45],

            // Untuk memvalidasi apakah password lama yang dimasukkan benar
            ['password_lama', 'validasiPassword'],

            // Untuk memvalidasi apakah password_baru sama dengan password_ulang
            ['password_baru', 'compare', 'compareAttribute' => 'password_ulang', 'message' => "Password baru dan ulangi password baru tidak sama"],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'password_lama' => 'Password Lama',
            'password_baru' => 'Password Baru',
            'password_ulang' => 'Ulangi Password Baru',
        ];
    }

    public function validasiPassword($attribute, $params)
    {
        // Ambil objek User yang sesuai dengan user yang login
        $this->user = User::findIdentity(Yii::$app->user->identity->id);

        if (!$this->user->validatePassword($this->password_lama)) {
            $this->addError($attribute, 'Password lama yang dimasukkan salah');
        }
    }

    public function ubahPassword()
    {
        $this->user->setPassword($this->password_baru);

        if (!$this->user->save()) {
            throw new ServerErrorHttpException("Password tidak bisa diubah. Silahkan ulang lagi atau hubungi admin");
        }

        return true;
    }
}
