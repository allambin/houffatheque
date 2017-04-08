<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name
 * @property string $slug //FIXME unique in DB
 * @property string $code
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property BookCategories[] $bookCategories
 * @property Book[] $books
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'slug', 'code'], 'string', 'max' => 100],
            [['name', 'slug'], 'unique']
        ];
    }
    
    public function behaviors()
    {
        return [
            [
                'class' => SluggableBehavior::className(),
                // These parameters are optional, default values presented here:
                'attribute' => 'name', // If you want to make a slug from another attribute, set it here
                'slugAttribute' => 'slug', // Name of the attribute containing a slug
                'ensureUnique' => true, // Check if the slug value is unique, add number if not
            ],
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
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'code' => Yii::t('app', 'Code'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBooks()
    {
        return $this->hasMany(Book::className(), ['category_id' => 'id']);
    }
    
    public function beforeDelete() {
        if(count($this->books) > 0) {
            \Yii::$app->getSession()->setFlash('danger', Yii::t('app', 'The category still has books'));
            return false;
        }
        return parent::beforeDelete();
    }
    
    public function afterDelete() {
        \Yii::$app->getSession()->setFlash('success', Yii::t('app', 'The category has been deleted'));
        return parent::afterDelete();
    }
}
