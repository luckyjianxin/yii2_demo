<?php
namespace backend\models;

use yii\base\Model;
use common\models\User;
/**
 * Signup form
 */
class UserUpdateForm extends Model
{
    public $id;
    public $username;
    public $email;
    public $password;
    public $status;
    public $type;

    public function __construct($id) {
        $this->id = $id;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        $rules =  [
            [['username'], 'safe'],
            ['email', 'filter', 'filter' => 'trim'],
            // ['email', 'required'],
            ['email', 'email'],
            ['email', 'string', 'max' => 255],
            // ['email', 'unique', 'targetClass' => '\common\models\User', 'filter' => ['<>','id',$this->id], 'message' => 'This email address has already been taken.'],
            // ['password', 'required'],
            ['password', 'string', 'skipOnEmpty' => true],
            ['password', 'string', 'min' => 6],

            [['status','type'], 'required'],

            // ['confirm_password', 'string', 'skipOnEmpty' => true],
            // ['confirm_password', 'compare','compareAttribute'=>'password','message'=>'confirm password is not same as password', 'operator' => '==='],
        ];        

        return $rules;
    }

    /**
     * Signs user up.
     *
     * @return User|null the saved model or null if saving fails
     */
    public function updateUser($id)
    {
  
        if (!$this->validate()) {
            return null;
        }

        $model = User::findOne($id);
        $model->email = $this->email;
        if ($this->password) {
           $model->setPassword($this->password);
           $model->generateAuthKey(); 
        }
        $model->status = $this->status;
        $model->type = $this->type;
        
        
        // print_r($model);

        
        if ($model->save()) {
            return $model;
        }
        return null;
    }
}
