<?php

namespace app\models;

use yii\base\NotSupportedException;
use yii\db\ActiveRecord;
use yii\helpers\Security;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "tbl_user".
 *
 * @property integer $id_user
 * @property string $username
 * @property string $password_hash
 * @property string $gender
 * @property string $auth_key
 * @property string $email
 * @property datetime $date_register
 * @property string $signature
 * @property integer $is_active
 */

class User extends ActiveRecord implements IdentityInterface
{

    public $password;

    //
    private $_user = false;
    public $rememberMe = true;


    public static function tableName(){
        return 'users';
    }

    public function getPrimaryKey($asArray = false)
    {
        return 'id_user';
    }

    public function rules()
    {
        return [
            [['username', 'password','email', 'gender'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
        ];
    }

    public function attributeLabels()
    {
        return [
            'idUser' => 'Id',
            'username' => 'Username',
            'password' => 'Password',
            'email' => 'Email',
            'dateRegister' => 'Register date',
            'signature' => 'Signature',
            'isActive' => 'is_active',
        ];
    }

    /**
     * Logs in a user using the provided username and password.
     * @return boolean whether the user is logged in successfully
     */
    public function login() {
        //if ($this->validate()) {
            return \Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        //} else {
        //    return false;
        //}
    }

    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser() {
        if ($this->_user === false) {
            $this->_user = self::findByUsername($this->username);
        }

        return $this->_user;
    }


    public static function findIdentity($id)
    {
        return self::findOne($id);
    }

    public static function findByUsername($username)
    {
        return self::findOne(['username' => $username]);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['access_token' => $token]);
        //throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }


    public static function findByPasswordResetToken($token)
    {
        $expire = \Yii::$app->params['user.passwordResetTokenExpire'];
        $parts = explode('_', $token);
        $timestamp = (int) end($parts);
        if ($timestamp + $expire < time()) {
            // token expired
            return null;
        }

        return static::findOne([
            'password_reset_token' => $token
        ]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->id_user;
    }

    /**
     * @inheritdoc
     */
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    /**
     * @inheritdoc
     */
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    /**
     * Validates password
     *
     * @param  string  $password password to validate
     * @return boolean if password provided is valid for current user
     */
    public function validatePassword($password)
    {

        if($this->password !== null){
            return \Yii::$app->security->validatePassword($password, $this->password);
        }
        else{
            var_dump(\Yii::$app->security->validatePassword($password, $this->password_hash));
            exit;

            return \Yii::$app->security->validatePassword($password, $this->password_hash);
        }

    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = \Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Security::generateRandomKey();
    }

    /**
     * Generates new password reset token
     */
    public function generatePasswordResetToken()
    {
        $this->password_reset_token = Security::generateRandomKey() . '_' . time();
    }

    /**
     * Removes password reset token
     */
    public function removePasswordResetToken()
    {
        $this->password_reset_token = null;
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->password_hash = \Yii::$app->security->generatePasswordHash($this->password);
                $this->date_register = new \yii\db\Expression('NOW()');
                $this->auth_key = \Yii::$app->security->generateRandomString();
            }
            return true;
        }
        return false;
    }



}
