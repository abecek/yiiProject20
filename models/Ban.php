<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "bans".
 *
 * @property string $id_ban
 * @property string $date_expire
 * @property string $ip_number
 * @property string $description
 * @property string $id_user
 * @property string $id_giver
 * @property string $id_post
 * @property string $id_message
 *
 * @property Users $idGiver
 * @property ChatboxMessages $idMessage
 * @property Posts $idPost
 * @property Users $idUser
 */
class Ban extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'bans';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_expire'], 'safe'],
            [['id_user', 'id_giver'], 'required'],
            [['id_user', 'id_giver', 'id_post', 'id_message'], 'integer'],
            [['ip_number'], 'string', 'max' => 15],
            [['description'], 'string', 'max' => 300],
            [['id_giver'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_giver' => 'id_user']],
            [['id_message'], 'exist', 'skipOnError' => true, 'targetClass' => ChatboxMessages::className(), 'targetAttribute' => ['id_message' => 'id_message']],
            [['id_post'], 'exist', 'skipOnError' => true, 'targetClass' => Posts::className(), 'targetAttribute' => ['id_post' => 'id_post']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_user' => 'id_user']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_ban' => 'Id Ban',
            'date_expire' => 'Date Expire',
            'ip_number' => 'Ip Number',
            'description' => 'Description',
            'id_user' => 'Id User',
            'id_giver' => 'Id Giver',
            'id_post' => 'Id Post',
            'id_message' => 'Id Message',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdGiver()
    {
        return $this->hasOne(Users::className(), ['id_user' => 'id_giver']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdMessage()
    {
        return $this->hasOne(ChatboxMessages::className(), ['id_message' => 'id_message']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdPost()
    {
        return $this->hasOne(Posts::className(), ['id_post' => 'id_post']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdUser()
    {
        return $this->hasOne(Users::className(), ['id_user' => 'id_user']);
    }
}
