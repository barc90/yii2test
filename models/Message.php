<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "messages".
 *
 * @property integer $id
 * @property integer $reply_id
 * @property string $title
 * @property string $text
 * @property integer $status
 * @property integer $created_date
 */
class Message extends \yii\db\ActiveRecord
{
	const STATUS_LOW    = 0;
	const STATUS_NORMAL = 1;
	const STATUS_HIGH   = 2;

	private static $statuses = [
        '0' => 'Low',
		'1' => 'Normal',
        '2' => 'High'
    ];
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'messages';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['reply_id', 'status', 'created_date'], 'integer'],
            [['title', 'text'], 'required'],
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
            'reply_id' => 'Reply ID',
            'title' => 'Title',
            'text' => 'Text',
            'status' => 'Status',
            'created_date' => 'Created Date',
        ];
    }
}
