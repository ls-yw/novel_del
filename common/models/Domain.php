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
            [['domain', 'name', 'book_regular', 'author_regular', 'chapter_regular', 'content_regular','bookname_regular','descript_regular','paging_regular','is_open'], 'required'],
            [['domain','book_mark_id'], 'string', 'max' => 100],
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
            'domain' => '站点域名',
            'name' => '站点名称',
            'book_regular' => '小说规则',
            'author_regular' => '作者规则',
            'chapter_regular' => '章节规则',
            'content_regular' => '内容规则',
            'is_open' => '是否采集',
            'bookname_regular' => '小说名称规则',
            'descript_regular' => '简介规则',
            'paging_regular' => '上下章规则',
            'book_mark_id' => '小说URL子序号运算方式',
            'update_time' => 'Update Time',
            'create_time' => 'Create Time',
        ];
    }
}
