<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%domain}}".
 *
 * @property string $id
 * @property string $domain
 * @property string $name
 * @property string $book_regular
 * @property string $author_regular
 * @property string $chapter_regular
 * @property string $content_regular
 * @property string $update_time
 * @property string $create_time
 */
class Domain extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%domain}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['domain', 'name', 'book_regular', 'author_regular', 'chapter_regular', 'content_regular', 'update_time', 'create_time'], 'required'],
            [['update_time', 'create_time'], 'safe'],
            [['domain'], 'string', 'max' => 100],
            [['name'], 'string', 'max' => 50],
            [['book_regular', 'author_regular', 'chapter_regular', 'content_regular'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'domain' => 'Domain',
            'name' => 'Name',
            'book_regular' => 'Book Regular',
            'author_regular' => 'Author Regular',
            'chapter_regular' => 'Chapter Regular',
            'content_regular' => 'Content Regular',
            'update_time' => 'Update Time',
            'create_time' => 'Create Time',
        ];
    }
}
