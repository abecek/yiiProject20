<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "posts".
 *
 * @property string $id_post
 * @property string $content
 * @property string $date_post
 * @property integer $is_deleted
 * @property string $id_thread
 * @property string $id_author
 *
 * @property Bans[] $bans
 * @property Users $idAuthor
 * @property Threads $idThread
 */
class Posts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'posts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['content', 'date_post', 'id_thread', 'id_author'], 'required'],
            [['date_post'], 'safe'],
            [['is_deleted', 'id_thread', 'id_author'], 'integer'],
            [['content'], 'string', 'max' => 4000],
            [['id_author'], 'exist', 'skipOnError' => true, 'targetClass' => Users::className(), 'targetAttribute' => ['id_author' => 'id_user']],
            [['id_thread'], 'exist', 'skipOnError' => true, 'targetClass' => Threads::className(), 'targetAttribute' => ['id_thread' => 'id_thread']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_post' => 'Id Post',
            'content' => 'Content',
            'date_post' => 'Date Post',
            'is_deleted' => 'Is Deleted',
            'id_thread' => 'Id Thread',
            'id_author' => 'Id Author',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBans()
    {
        return $this->hasMany(Bans::className(), ['id_post' => 'id_post']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdAuthor()
    {
        return $this->hasOne(Users::className(), ['id_user' => 'id_author']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIdThread()
    {
        return $this->hasOne(Threads::className(), ['id_thread' => 'id_thread']);
    }
}
