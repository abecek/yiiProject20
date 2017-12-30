<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "sections".
 *
 * @property integer $id_section
 * @property string $name
 * @property string $description
 * @property integer $child_of
 *
 * @property Section $childOf
 * @property Section[] $sections
 * @property Threads[] $threads
 */
class Section extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'sections';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['child_of'], 'integer'],
            [['name'], 'string', 'max' => 50],
            [['description'], 'string', 'max' => 250],
            [['child_of'], 'exist', 'skipOnError' => true, 'targetClass' => Section::className(), 'targetAttribute' => ['child_of' => 'id_section']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id_section' => 'Id Section',
            'name' => 'Name',
            'description' => 'Description',
            'child_of' => 'Child Of',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChildOf()
    {
        return $this->hasOne(Section::className(), ['id_section' => 'child_of']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSections()
    {
        return $this->hasMany(Section::className(), ['child_of' => 'id_section']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getThreads()
    {
        return $this->hasMany(Threads::className(), ['id_section' => 'id_section']);
    }
}
