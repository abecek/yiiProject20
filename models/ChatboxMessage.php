<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "chatbox_messages".
 *
 * @property string $id_message
 * @property string $content
 * @property string $date_message
 * @property string $id_author
 *
 * @property Bans[] $bans
 * @property Users $idAuthor
 */
class ChatboxMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'chatbox_messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'date_message', 'id_author'], 'required'],
            [['date_message'], 'safe'],
            [['id_author'], 'integer'],
            [['content'], 'string', 'max' => 300],
            [['id_author'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_author' => 'id_user']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_message' => 'Id Message',
            'content' => 'Content',
            'date_message' => 'Date Message',
            'id_author' => 'Id Author',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBans()
    {
        return $this->hasMany(Bans::className(), ['id_message' => 'id_message']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAuthor()
    {
        return $this->hasOne(Users::className(), ['id_user' => 'id_author']);
    }
}
