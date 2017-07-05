<?php
namespace frontend\controllers;

use Yii;
use frontend\models\Scene;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use frontend\helpers\Mycrypt;
use yii\web\Cookie;
use frontend\models\LoginForm;

/**
 * Site controller
 */
class BaseController extends Controller
{

     /**
     * 在程序执行之前，对访问的方法进行权限验证.
     * @param \yii\base\Action $action
     * @return bool
     * @throws ForbiddenHttpException
     */
    public function beforeAction($action)
    {



        $session = Yii::$app->session;
        $session->open();
        $customer = $session->get('_customer');
        // var_dump(isset($session['customer']));

        $cus_str = isset($_GET['cu']) ? $_GET['cu'] : NULL;
        $key = Yii::$app->params['KEY'];
        $iv  = Yii::$app->params['IV'];
        $branch  = Yii::$app->params['BRANCH'];


            if (isset($cus_str)) {

              if (isset($customer)) {


                $results = Mycrypt::_mcrypt_decrypt($cus_str, $key, $iv);

                if (!empty($results)) {
                  
                  if (count($results) == 6) {

                    $eid = $results[0];
                    $cid = $results[1];
                    $oid = $results[2];
                    $from = $results[5];
                    $account = $results[3];
                     //$cusid = file_get_contents(ENQUIRY_FIND_CUSTOMER_ID_LINK.'?pass=zheshimimi&eid='.$results[0]);
                    if ($from == 'Enq') {
                        if ($cid != 0) {
                          $eid = isset($results[0]) ? $results[0] : 0;
                          $oid = Scene::getOrderById($cid);
                          $cus = array('eid' => $results[0], 'cid'=> $cid, 'oid' => $oid, 'from' => 'Cms');
                        } else {
                          $cus = array('eid' => $eid, 'cid'=> $cid, 'oid' => $oid, 'from' => $from);
                        }
                    } else {
                      $eid = file_get_contents(Yii::$app->params['FIND_ENQUIRY_ID'].'?pass=zheshimimi&cid='.$cid);
                      $cus = array('eid' => $eid, 'cid'=> $cid, 'oid' => $oid, 'from' => $from);
                    }

                  } else if (count($results) == 4) {
                      $eid = file_get_contents(Yii::$app->params['FIND_ENQUIRY_ID'].'?pass=zheshimimi&cid='.$cid);
                      
                      $cus = array('eid' => $eid, 'cid'=> $cid, 'oid' => $oid, 'from' => 'Cms');
                  } else {
                    echo 'Wrong Link, please check it.';
                    return;
                  }

                  print_r($cus);

                  $model = new LoginForm();
                  $model->cno = $cid;
                  $model->username = $account;

                  if (Yii::$app->user->login($model->getUser(), 0)) {
                    $cookies = Yii::$app->response->cookies;
                    $cookie = new Cookie([
                        'name' => '_customer',
                        'value' => json_encode($cus),
                        'expire' => time() + 3600,
                    ]);
                    $cookies->add($cookie);

                    $session = Yii::$app->session;
                    $session->set('_customer', json_decode(json_encode($cus)));
                  }

                }

              } else {
                
                $results = Mycrypt::_mcrypt_decrypt($cus_str, $key, $iv);
                
                if (!empty($results)) {
                  if (count($results) == 6) {
                    $eid = $results[0];
                    $cid = $results[1];
                    $oid = $results[2];
                    $from = $results[5];
                    $account = $results[3];
                     //$cusid = file_get_contents(ENQUIRY_FIND_CUSTOMER_ID_LINK.'?pass=zheshimimi&eid='.$results[0]);
                    if ($from == 'Enq') {
                        if ($cid != 0) {
                          $oid = Scene::getOrderById($cid);
                          $cus = array('eid' => $eid, 'cid'=> $cid, 'oid' => $oid, 'from' => 'Cms');
                        } else {
                          $cus = array('eid' => $eid, 'cid'=> $cid, 'oid' => $oid, 'from' => $from);
                        }
                    } else {
                      $eid = file_get_contents(Yii::$app->params['FIND_ENQUIRY_ID'].'?pass=zheshimimi&cid='.$cid);
                      $cus = array('eid' => $eid, 'cid'=> $cid, 'oid' => $oid, 'from' => $from);
                    }

                  } else if (count($results) == 4) {
                      $eid = file_get_contents(Yii::$app->params['FIND_ENQUIRY_ID'].'?pass=zheshimimi&cid='.$cid);
                      
                      $cus = array('eid' => $eid, 'cid'=> $cid, 'oid' => $oid, 'from' => $from);
                  } else {
                    echo 'Wrong Link, please check it.';
                    return;
                  }

                  $model = new LoginForm();
                  $model->cno = $cid;
                  $model->username = $account;
                  if (Yii::$app->user->login($model->getUser(), 0)) {
                    $cookies = Yii::$app->response->cookies;
                    $cookie = new Cookie([
                        'name' => '_customer',
                        'value' => json_encode($cus),
                        'expire' => time() + 3600,
                    ]);
                    $cookies->add($cookie);

                    $session = Yii::$app->session;
                    $session->set('_customer', json_decode(json_encode($cus)));
                  }

                  


                 // $_SESSION[CUSTOMER] = $cus;
                  //setcookie(CUSTOMER, json_encode($cus), time() + 3600, PATH , ((DOMAIN == 'localhost') ? NULL : DOMAIN));


                  // $_SESSION[CLIENT] = $user;
                  // setcookie(CLIENT, json_encode($user), time() + 3600, PATH , ((DOMAIN == 'localhost') ? NULL : DOMAIN));

                } else {
                  
                }

              }

              
              $url = $_SERVER['REQUEST_URI'];

              $firstpos = strpos($url, "&cu");
              $firstpos1 = strpos($url, "?cu");
              
              if($firstpos !== false) {
                $url = substr($url,0,$firstpos);
                
                return $this->redirect(['index']);
              } else if ($firstpos1 !== false) {
                $url = substr($url,0,$firstpos1);

                // header( 'Location: ' . $_SERVER['SERVER_NAME'] . $url);
                return $this->redirect(['index']);
                // return $this->redirect(Url::toRoute('/login/login'));
              }
              
            }


            $session = Yii::$app->session;
            $customer = $session->get('_customer');
            if (!isset($customer)) {
               $cookie = Yii::$app->request->cookies;
               if ($cookie->has('_customer')) {
                  $session->set('_customer', json_decode($cookie->get('_customer')));
               }
            }

            if (Yii::$app->user->isGuest) {
                if ($this->action->id != 'login') {
                   return $this->redirect(['login']);
                }
            } else {
              if ($this->action->id == 'login') {
                   return $this->redirect(['index']);
                }
            }
            // print_r($_SESSION['CUSTOMER']);

            return 1;


            // if (isset($_SESSION[CUSTOMER])) {
            //   $bra = $branch;
            //   $eid = $_SESSION[CUSTOMER]->eid;
            //   $cid = $_SESSION[CUSTOMER]->cid;
            //   $oid = $_SESSION[CUSTOMER]->oid;
            //   $from = $_SESSION[CUSTOMER]->from;
              

            //   if ($cid != 0 && $oid != 0) {
            //     $myPdo = DbUtils::createPdoInst();
                
            //     $cond_vals = new stdClass();
            //     $cond_vals->c = 't.branch = :v1 and t.enquiry_id = :v2 and t.customer_id = 0 and t.order_id = 0';
            //     $cond_vals->v = array(':v1' => $bra, ':v2' => $eid);
            //     $opts = new stdClass();
            //     $opts->select_expr = 't.id, t.customer_id, t.order_id';
            //     $tmp1s = DbUtils::get($myPdo, TABLE_NAME_PREFIX . 'customer_emergency_contact', $cond_vals, NULL, NULL, NULL, NULL, $opts)->d;
            //     $tmp2s = DbUtils::get($myPdo, TABLE_NAME_PREFIX . 'customer_schedule_scene', $cond_vals, NULL, NULL, NULL, NULL, $opts)->d;
            //     $tmp3s = DbUtils::get($myPdo, TABLE_NAME_PREFIX . 'customer_scene_crew', $cond_vals, NULL, NULL, NULL, NULL, $opts)->d;
            //     $tmp4s = DbUtils::get($myPdo, TABLE_NAME_PREFIX . 'customer_scene_crew_finish', $cond_vals, NULL, NULL, NULL, NULL, $opts)->d;
            //     $tmp5s = DbUtils::get($myPdo, TABLE_NAME_PREFIX . 'customer_scene_sort', $cond_vals, NULL, NULL, NULL, NULL, $opts)->d;

            //     foreach ($tmp1s as $key => $value) {
            //        if ($value->customer_id == 0 && $value->order_id == 0) {
            //          $value->customer_id = $cid;
            //          $value->order_id = $oid;
            //          DbUtils::update($myPdo, TABLE_NAME_PREFIX . 'customer_emergency_contact', $value);
            //        }
                   
            //     }
            //     foreach ($tmp2s as $key => $value) {
            //        if ($value->customer_id == 0 && $value->order_id == 0) {
            //          $value->customer_id = $cid;
            //          $value->order_id = $oid;
            //          DbUtils::update($myPdo, TABLE_NAME_PREFIX . 'customer_schedule_scene', $value);
            //        }
            //     }
            //     foreach ($tmp3s as $key => $value) {
            //       if ($value->customer_id == 0 && $value->order_id == 0) {
            //          $value->customer_id = $cid;
            //          $value->order_id = $oid;
            //          DbUtils::update($myPdo, TABLE_NAME_PREFIX . 'customer_scene_crew', $value);
            //       }
            //     }
            //     foreach ($tmp4s as $key => $value) {
            //       if ($value->customer_id == 0 && $value->order_id == 0) {
            //         $value->customer_id = $cid;
            //         $value->order_id = $oid;
            //         DbUtils::update($myPdo, TABLE_NAME_PREFIX . 'customer_scene_crew_finish', $value);
            //       }
            //     }
            //     foreach ($tmp5s as $key => $value) {
            //       if ($value->customer_id == 0 && $value->order_id == 0) {
            //         $value->customer_id = $cid;
            //         $value->order_id = $oid;
            //         DbUtils::update($myPdo, TABLE_NAME_PREFIX . 'customer_scene_sort', $value);
            //       }
            //     }
            //   }
                
            // }

            // print_r($_SESSION[CUSTOMER]);



        //如果未登录，则直接返回
        // if(Yii::$app->user->isGuest){
        //     return $this->goHome();
        // }
        //获取路径
        // $path = Yii::$app->request->pathInfo;

        // //忽略列表
        // if (in_array($path, $this->ignoreList)) {
        //     return true;
        // }

        // if (Yii::$app->user->can($path)) {
        //     return true;
        // } else {
        //     throw new ForbiddenHttpException(Yii::t('app', 'message 401'));
        // }
    }
}
