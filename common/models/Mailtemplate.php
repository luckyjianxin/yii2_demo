<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mailtemplate".
 *
 * @property integer $id
 * @property integer $type
 * @property string $subject
 * @property string $content
 * @property string $create_at
 */
class Mailtemplate extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mailtemplate';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['type'], 'integer'],
            [['content'], 'string'],
            [['create_at'], 'safe'],
            [['subject'], 'string', 'max' => 128],
            [['type', 'subject'], 'required'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'type' => 'Type',
            'subject' => 'Subject',
            'content' => 'Content',
            'create_at' => 'Created',
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if($insert) {
                $this->create_at = date("Y-m-d");
            }
            return true;
        } else {
            return false;
        }
    }

}
