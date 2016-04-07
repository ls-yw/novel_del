<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%books}}".
 *
 * @property string $id
 * @property string $domain_id
 * @property string $name
 * @property string $description
 * @property string $author
 * @property string $create_time
 */
class Books extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%books}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['domain_id', 'name', 'description', 'author', 'create_time'], 'required'],
            [['domain_id'], 'integer'],
            [['create_time'], 'safe'],
            [['name'], 'string', 'max' => 100],
            [['description'], 'string', 'max' => 255],
            [['author'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'domain_id' => 'Domain ID',
            'name' => 'Name',
            'description' => 'Description',
            'author' => 'Author',
            'create_time' => 'Create Time',
        ];
    }
}
