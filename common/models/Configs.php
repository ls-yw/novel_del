<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%configs}}".
 *
 * @property string $id
 * @property string $name
 * @property string $value
 * @property string $type
 */
class Configs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%configs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['name', 'value'], 'string', 'max' => 200],
            [['type'], 'string', 'max' => 10]
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
            'value' => 'Value',
            'type' => 'Type',
        ];
    }
}
