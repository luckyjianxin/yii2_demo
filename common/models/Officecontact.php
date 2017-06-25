<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "officecontact".
 *
 * @property integer $id
 * @property string $branch
 * @property string $address
 * @property double $lat
 * @property double $lon
 */
class Officecontact extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'officecontact';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['lat', 'lon'], 'number'],
            [['branch', 'address'], 'required'],
            [['branch'], 'string', 'max' => 64],
            [['address'], 'string', 'max' => 128],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'branch' => 'Branch',
            'address' => 'Address',
            'lat' => 'Lat',
            'lon' => 'Lon',
        ];
    }
}
