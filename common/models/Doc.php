<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "doc".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $tags
 * @property string $author_id
 * @property string $category
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 */
class Doc extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'doc';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content', 'tags', 'author_id', 'category', 'created_at', 'updated_at'], 'required'],
            [['content'], 'string'],
            [['status', 'created_at', 'updated_at'], 'integer'],
            [['title', 'tags', 'category'], 'string', 'max' => 255],
            [['author_id'], 'string', 'max' => 10],
            [['title'], 'unique']
        ];
    }
    
    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => '标题',
            'content' => '内容',
            'tags' => '标签(逗号分隔)',
            'author_id' => '作者',
            'category' => '分类',
            'status' => '状态',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
