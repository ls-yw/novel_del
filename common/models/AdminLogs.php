<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%admin_logs}}".
 *
 * @property string $username
 * @property string $password
 * @property string $ip
 * @property string $add_time
 */
class AdminLogs extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%admin_logs}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'ip', 'add_time'], 'required'],
            [['add_time'], 'safe'],
            [['username'], 'string', 'max' => 100],
            [['password'], 'string', 'max' => 50],
            [['ip'], 'string', 'max' => 15]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'username' => 'Username',
            'password' => 'Password',
            'ip' => 'Ip',
            'add_time' => 'Add Time',
        ];
    }
}
