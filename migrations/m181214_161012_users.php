<?php

use yii\db\Migration;

/**
 * Class m181214_161012_users
 * миграция создания таблицы юзерей ..* 
 * 
 */
class m181214_161012_users extends Migration
{

    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->createTable('users',[
            'id'=>$this->primaryKey()->comment('Ключик юзеря'),
            'authkey'=>$this->string(32)->notNull()->comment('Authkey для входа через куки'),
            'name'=>$this->string(20)->notNull()->comment('Ник'),
            'fn'=>$this->string(30)->notNull()->comment('Имя'),
            'ln'=>$this->string(30)->notNull()->comment('Фамилия'),
            'mail'=>$this->string(30)->notNull()->comment('Мыло'),
            'pass'=>$this->string(60)->notNull()->comment('Пароль'),
        ]);
        $this->createIndex('iname','users',['name'],true);
        $this->createIndex('iak','users',['authkey'],true);
        $this->createIndex('imail','users',['mail'],true);

    }

    public function down()
    {
        //echo "m181214_161012_users cannot be reverted.\n";
        $this->droptable('users');
        return true;

        //return false;
    }
    
}
