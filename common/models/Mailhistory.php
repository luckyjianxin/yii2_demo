<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mailhistory".
 *
 * @property integer $id
 * @property integer $enquiry_id
 * @property integer $customer_id
 * @property integer $type
 * @property string $mail_from
 * @property string $mail_to
 * @property string $subject
 * @property string $content
 * @property string $attachements
 * @property string $operator
 * @property string $info
 * @property string $create_at
 */
class Mailhistory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'mailhistory';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['enquiry_id', 'customer_id', 'type'], 'integer'],
            [['content'], 'string'],
            [['create_at'], 'safe'],
            [['mail_from', 'subject'], 'string', 'max' => 128],
            [['mail_to', 'attachements'], 'string', 'max' => 512],
            [['operator', 'info'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'enquiry_id' => 'Enquiry ID',
            'customer_id' => 'Customer ID',
            'type' => 'Type',
            'mail_from' => 'Mail From',
            'mail_to' => 'Mail To',
            'subject' => 'Subject',
            'content' => 'Content',
            'attachements' => 'Attachements',
            'operator' => 'Operator',
            'info' => 'Info',
            'create_at' => 'Create At',
        ];
    }
}
