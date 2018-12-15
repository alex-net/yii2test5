<?php

namespace app\models;

use Yii;

/**
 * Класс UserIdentity ...
 * 
 * @property int $id Идентификатор пользователя
 * @property string $authkey cookies ключ 
 * @property string $name Ник нейм
 * @property string $fn Имя
 * @property string $ln Фамилия
 * @property string $mail Почта
 * @property string $pass пароль
 */


class User extends \yii\db\ActiveRecord implements \yii\web\IdentityInterface
{
    public static function tableName()
    {
        return 'users';
    }
    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne($id);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {

        return null;
    }

    /**
     * Finds user by username
     *
     * @param string $username
     * @return static|null
     */
    public static function findByUsername($username)
    {
        return static::findOne(['name'=>$username]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return $this->authkey;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->authkey === $authKey;
    }

    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return Yii::$app->security->validatePassword($password,$this->pass);
    }

    /**
     * проверка существования записи в таблице по полю со значением
     * @param  string $field Имя поля в котором надо искаь 
     * @param  [type] $value Значение которое надо найти в поле .. 
     * @return boolean        Результат поиска = если нашли - вернули true
     */
    public static function UserByExists($field,$value)
    {
        //return false;
        return static::find()->where([$field=>$value])->exists();
    }

    public function beforeSave($ins)
    {
        if (!parent::beforeSave($ins))
            return false;
        if ($this->isNewRecord)
            $this->authkey=Yii::$app->security->generateRandomString(32);
        
        $this->pass=$this->pass?Yii::$app->security->generatePasswordHash($this->pass):$this->oldAtributes['pass'] ;
        return true;
    }

    /**
     * вернуть username
     */
    public function getUsername()
    {
        return $this->fn.' '.$this->ln;
    }
}   
