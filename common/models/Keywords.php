<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%keywords}}".
 *
 * @property string $keyword
 * @property string $count
 * @property integer $is_hot
 */
class Keywords extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%keywords}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['keyword'], 'required'],
            [['count', 'is_hot'], 'integer'],
            [['keyword'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'keyword' => 'Keyword',
            'count' => 'Count',
            'is_hot' => 'Is Hot',
        ];
    }
}
