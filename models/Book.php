<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "book".
 *
 * @property integer $id
 * @property string $title
 * @property string $ISBN
 * @property string $year
 * @property integer $category_id
 * @property integer $author_id
 * @property integer $publisher_id
 * @property integer $collection_id
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Author $author
 * @property Category $category
 * @property Collection $collection
 * @property Publisher $publisher
 */
class Book extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'book';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'category_id'], 'required'],
            [['year'], 'safe'],
            [['category_id', 'author_id', 'publisher_id', 'collection_id','created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 255],
            [['ISBN'], 'string', 'max' => 45]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title' => Yii::t('app', 'Title'),
            'ISBN' => Yii::t('app', 'Isbn'),
            'year' => Yii::t('app', 'Year'),
            'category_id' => Yii::t('app', 'Category'),
            'author_id' => Yii::t('app', 'Author'),
            'publisher_id' => Yii::t('app', 'Publisher'),
            'collection_id' => Yii::t('app', 'Collection'),
        ];
    }
    
    /**
     * Add some behaviours :
     * - Timestamp
     * @return type
     */
    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::className(),
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
                'value' => function() { return date('U'); }
            ]
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(Author::className(), ['id' => 'author_id']);
    }
    
    public function getAuthorFullname() {
        return isset($this->author->fullname) ? $this->author->fullname : '' ;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCollection()
    {
        return $this->hasOne(Collection::className(), ['id' => 'collection_id']);
    }
    
    public function getCollectionName() {
        return isset($this->collection->name) ? $this->collection->name : '';
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPublisher()
    {
        return $this->hasOne(Publisher::className(), ['id' => 'publisher_id']);
    }
    
    public function getPublisherName() {
        return isset($this->publisher->name) ? $this->publisher->name : '';
    }
}
