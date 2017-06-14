<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "schedule".
 *
 * @property integer $id
 * @property string $name
 * @property integer $is_default
 */
class Schedule extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schedule';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['is_default'], 'integer'],
            [['name'], 'string', 'max' => 64],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'is_default' => 'Default',
        ];
    }

    public function afterDelete() {
        parent::afterDelete();

        $count = Schedule::find()  
                        ->where(['is_default' => 1])  
                        ->count();

        if ($count == 0) {
            $sche = Schedule::find()->orderBy('id')->limit(1)->one();
            $sche->is_default = 1;
            $sche->save();
        }
    }

}
