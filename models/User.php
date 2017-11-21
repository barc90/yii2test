<?php

namespace app\models;

use Yii;
use \yii\db\ActiveRecord;

/**
 * This is the model class for table "users".
 *
 * @property integer $id
 * @property integer $auth_key 
 * @property string $username
 * @property string $password
 * @property integer $role
 */

class User extends ActiveRecord implements \yii\web\IdentityInterface
{
    const ROLE_ADMIN = 1;
	const ROLE_USER  = 2;

	public static $roles = [
		
	];
    
	public static function tableName()
    {
        return 'users';
    }

	public function rules()
    {
        return [
            [['role'], 'integer'],
            [['username', 'password'], 'required'],
            [['username', 'password'], 'string'],
            [['username'], 'string', 'max' => 255],
        ];
    }

	public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'username' => 'Username',
            'password' => 'Password',
            'role' => 'Role'
        ];
    }

    /**
     * @inheritdoc
     */
    public static function findIdentity($id)
    {
    	return static::findOne($id);
    }

    /**
     * @inheritdoc
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
		return static::findOne(['username' => $username]);
    }

    /**
     * @inheritdoc
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }


	/**
     * Generates "remember me" authentication key
     */

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }

    /**
     * @inheritdoc
     */

    public function getAuthKey() {
		return $this->auth_key;
	}
  
    /**
     * @inheritdoc
     */


	/**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password = Yii::$app->security->generatePasswordHash($password);
    }

	/**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password, $this->password);
    }

    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

}
