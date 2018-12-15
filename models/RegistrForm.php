<?php 

namespace app\models;

use Yii;


/**
 * форма регистрации 
 */
class RegistrForm extends \yii\base\Model
{
	/**
	 * Ник = 
	 * Должен содержать только латинские буквы и цифры, начинаться должен с латинской буквы.
	 * Заглавные и прописные символы не различаются, сохранятется в том регистре, в котором был введен.
	 * Проверяется на существование (в БД) без обновления страницы.
	 * @var string
	 */
	public $name;
	/**
	 * имя 
	 * Допустимы только русские буквы.
	 * @var string
	 */
	public $fn;
	/**
	 * фамилия 
	 * Допустимы только русские буквы.
	 * @var string
	 */
	public $ln;
	/**
	 * Электронная почта
	 * Введенное значение должно быть корректным адресом e-mail
	 * Проверяется на существование (в БД) без обновления страницы.
	 * @var string
	 */
	public $mail;
	/**
	 * пароль Не меньше 5 произвольных символов. 
	 * @var [type]
	 */
	public $pass;

	public function attributeLabels()
	{
		return [
			'name'=>'Никнейм',
			'fn'=>'Имя',
			'ln'=>'Фамилия',
			'mail'=>'Электронная почта',
			'pass'=>'Пароль',
		];
	}

	public function rules()
	{
		return [
			[['name','fn','ln','mail','pass'],'required'],
			['name','string','max'=>20],
			['name','userexists','params'=>['chekfield'=>'name','mess'=>'Человек с таким никнеймом уже зарегистрирован']],
			['mail','userexists','params'=>['chekfield'=>'mail','mess'=>'На этот ящик уже зарегистрирован аккаунт']],
			[['fn','ln','mail'],'string','max'=>30],
			['name','match','pattern'=>'#^[a-z]+[a-z0-9]*$#i'],
			[['ln','fn'],'match','pattern'=>'#^[а-яё]*$#iu'],
			['mail','email'],
			['pass','string','min'=>5,'tooShort'=>'Пожалуйста, выдумайте пароль длиннее 5 символов'],
		];
	}

	/**
	 * проверка существования поля .. 
	 */
	public function userexists($attr,$param)
	{
		// идем юзерей 
		if (User::UserByExists($param['chekfield'],$this->$attr))
			$this->addError($attr,$param['mess']);
	}

	 /**
     * регистрация юзера ..
     */
    public function registrUser($formdata)
    {
        if (!$this->load($formdata) || !$this->validate())
            return false;

        $u=new User($this->attributes);
        return $u->save();
    }



}
