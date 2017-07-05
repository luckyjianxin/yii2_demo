<?php
namespace frontend\models;


use common\models\User;
use Yii;
use yii\base\Model;
use yii\web\Cookie;

/**
 * Login form
 */
class LoginForm extends Model
{
    public $cno;
    public $username;
    public $password;
    public $rememberMe = true;

    /**
     * @var User
     */
    private $_user;


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            // username and password are both required
            [['cno', 'password'], 'required'],
            // password is validated by validatePassword()
            ['password', 'validatePassword'],
            // rememberMe must be a boolean value
            ['rememberMe', 'boolean'],
        ];
    }

    /**
     * Validates the password.
     * This method serves as the inline validation for password.
     *
     * @param string $attribute the attribute currently being validated
     * @param array $params the additional name-value pairs given in the rule
     */
    public function validatePassword($attribute, $params)
    {
        if (!$this->hasErrors()) {
            $user = $this->getUser();
            if (!$user || !$user->validatePassword($this->password)) {
                $this->addError($attribute, 'Incorrect username or password.');
            }
        }
    }

    /**
     * Logs in a user using the provided username and password.
     *
     * @return boolean whether the user is logged in successfully
     */
    public function login()
    {

        $cno = $this->cno;
        $branch = Yii::$app->params['BRANCH'];

        $sql = "select e_oid as id from ns_v1customer where e_oid = '{$cno}'";
        $customers = Yii::$app->db1->createCommand($sql)->queryAll();

        // var_dump(empty($customers));

        if (empty($customers)) {
            return 1;
        } else {

          $sql = "select e_oid as oid from ns_v1myorder where customerId = '{$cno}' and disposalstatus=0";
          $orders = Yii::$app->db1->createCommand($sql)->queryAll();
          if (empty($orders)) {
            return 11;
          } else {
              $oid = $orders[0]['oid'];
              $password = $this->password;
              $sql = "select account from ns_v1user where password = '{$password}' and (type='Admin' or type = 'Manager' or type = 'Manager Assistant') ";
              $users = Yii::$app->db1->createCommand($sql)->queryAll();
              
              if (empty($users)) {

                $sqlp = "select user_account from ns_produce where branch='{$branch}' and customerId='{$cno}' and user_password = '{$password}' and (pi_model='Photographer' or pi_model = 'Videographer') and user_allow_login = 1";
                $users1 = Yii::$app->db2->createCommand($sqlp)->queryAll();


                if (empty($users1)) {
                    return 2;
                } else {
                    $this->username = $users[0]['account'];
                    if (Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0)) {
                        $cus = array('eid' => $eid, 'cid'=> $cno, 'oid' => $oid);
                        $cookies = Yii::$app->response->cookies;
                        $cookie = new Cookie([
                            'name' => '_customer',
                            'value' => json_encode($cus),
                            'expire' => ($this->rememberMe ? time() + 3600 * 24 * 30 : time() + 3600),
                        ]);
                        $cookies->add($cookie);

                        $session = Yii::$app->session;
                        $session->set('_customer', json_decode(json_encode($cus)));
                    }
                }
              } else {
                $this->username = $users[0]['account'];
                $eid = file_get_contents(Yii::$app->params['FIND_ENQUIRY_ID'] . '?pass=zheshimimi&cid='.$cno);
                if (Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0)) {
                    $cus = array('eid' => $eid, 'cid'=> $cno, 'oid' => $oid, 'from' => 'Cms');
                    $cookies = Yii::$app->response->cookies;
                    $cookie = new Cookie([
                        'name' => '_customer',
                        'value' => json_encode($cus),
                        'expire' => ($this->rememberMe ? time() + 3600 * 24 * 30 : time() + 3600),
                    ]);
                    $cookies->add($cookie);

                    $session = Yii::$app->session;
                    $session->set('_customer', json_decode(json_encode($cus)));
                }
              }
          }
       }
          
        // if ($this->validate()) {
        //     return Yii::$app->user->login($this->getUser(), $this->rememberMe ? 3600 * 24 * 30 : 0);
        // } else {
        //     return false;
        // }
    }
    /**
     * Finds user by [[username]]
     *
     * @return User|null
     */
    public function getUser()
    {
        if ($this->_user === null) {
            $this->_user = User::findByUsername($this->username);
        }

        return $this->_user;
    }
}
