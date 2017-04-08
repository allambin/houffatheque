<?php

namespace app\models;

use Yii;
use yii\db\ActiveRecord;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "event".
 *
 * @property integer $id
 * @property string $title
 * @property string $content
 * @property string $start_date
 * @property string $end_date
 * @property integer $is_published
 * @property integer $created_at
 * @property integer $updated_at
 */
class Event extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'event';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'content'], 'required'],
            [['content'], 'string'],
            [['start_date', 'end_date', 'created_at'], 'safe'],
            [['is_published', 'created_at', 'updated_at'], 'integer'],
            [['title'], 'string', 'max' => 45]
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
            'content' => Yii::t('app', 'Content'),
            'start_date' => Yii::t('app', 'Start Date'),
            'end_date' => Yii::t('app', 'End Date'),
            'is_published' => Yii::t('app', 'Is Published'),
            'created_at' => Yii::t('app', 'Created At'),
        ];
    }
    
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
    
    public function getStartDate() 
    {
        return '00-00-00 00:00:00';
    }
}
