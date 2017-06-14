<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "schedulescene".
 *
 * @property integer $id
 * @property integer $schedule_id
 * @property integer $scene_id
 * @property string $name
 * @property integer $type
 * @property integer $show_traveltime
 * @property string $travel_from
 * @property string $travel_to
 * @property double $order
 */
class ScheduleScene extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'schedulescene';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['schedule_id', 'scene_id', 'type', 'show_traveltime'], 'integer'],
            [['order'], 'number'],
            [['name'], 'string', 'max' => 64],
            [['travel_from', 'travel_to'], 'string', 'max' => 32],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'schedule_id' => '行程ID',
            'scene_id' => 'Scene ID',
            'name' => 'scene名称',
            'type' => '0=scene,1=travel',
            'show_traveltime' => 'Show Traveltime',
            'travel_from' => 'Travel From',
            'travel_to' => 'Travel To',
            'order' => 'Order',
        ];
    }
}
