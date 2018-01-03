<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "threads".
 *
 * @property string $id_thread
 * @property string $title
 * @property integer $count_displays
 * @property integer $state
 * @property string $date_begin
 * @property string $date_end
 * @property string $id_author
 * @property integer $id_section
 *
 * @property Posts[] $posts
 * @property Users $idAuthor
 * @property Sections $idSection
 */
class Thread extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'threads';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'date_begin', 'id_author', 'id_section'], 'required'],
            [['count_displays', 'state', 'id_author', 'id_section'], 'integer'],
            [['date_begin', 'date_end'], 'safe'],
            [['title'], 'string', 'max' => 300],
            [['id_author'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_author' => 'id_user']],
            [['id_section'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['id_section' => 'id_section']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_thread' => 'Id Thread',
            'title' => 'Title',
            'count_displays' => 'Count Displays',
            'state' => 'State',
            'date_begin' => 'Date Begin',
            'date_end' => 'Date End',
            'id_author' => 'Id Author',
            'id_section' => 'Id Section',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPosts()
    {
        return $this->hasMany(Posts::className(), ['id_thread' => 'id_thread']);
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
    public function getIdSection()
    {
        return $this->hasOne(Sections::className(), ['id_section' => 'id_section']);
    }
}
