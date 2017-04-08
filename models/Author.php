<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "author".
 *
 * @property integer $id
 * @property string $fullname
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Book[] $books
 */
class Author extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'author';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['fullname'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['fullname'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'fullname' => Yii::t('app', 'Fullname'),
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
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['author_id' => 'id']);
    }
    
    public function beforeDelete() {
        if(count($this->books) > 0) {
            \Yii::$app->getSession()->setFlash('danger', Yii::t('app', 'The author still has books'));
            return false;
        }
        return parent::beforeDelete();
    }
    
    public function afterDelete() {
        \Yii::$app->getSession()->setFlash('success', Yii::t('app', 'The author has been deleted'));
        return parent::afterDelete();
    }
}
