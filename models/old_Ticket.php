<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tickets".
 *
 * @property integer $id
 * @property integer $user_id
 * @property string $title
 * @property string $text
 * @property integer $status
 * @property integer $created_date
 */
class Ticket extends \yii\db\ActiveRecord
{
	const STATUS_OPEN  = 0;
	const STATUS_CLOSE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'tickets';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['status', 'created_date', 'user_id'], 'integer'],
            [['title', 'text', 'user_id'], 'required'],
            [['text'], 'string'],
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'text' => 'Text',
            'status' => 'Status',
            'created_date' => 'Created Date',
        ];
    }

    public function getUser()
    {
        return $this->hasOne(Users::className(), ['id' => 'user_id']);
    }
}
