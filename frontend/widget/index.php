<?php
$cus_str = isset($_GET['cu']) ? $_GET['cu'] : NULL;
$key = $config['params']['KEY'];
$iv  = $config['params']['IV'];
$branch  = $config['params']['BRANCH'];

if (isset($cus_str)) {

  if (isset($_SESSION[CUSTOMER])) {

    $results = _mcrypt_decrypt($cus_str, $key, $iv);

    if (!empty($results)) {
      
      if (count($results) == 6) {

        $cusid = $results[1];
        $oid = $results[2];
        $from = $results[5];
         //$cusid = file_get_contents(ENQUIRY_FIND_CUSTOMER_ID_LINK.'?pass=zheshimimi&eid='.$results[0]);
        if ($from == 'Enq') {
            if ($cusid != 0) {
              $myPdo = DbUtils::createPdoInstOther();
              $oid = _foundCustomerOrder($myPdo, $cusid);

              $cus = new stdClass();  
              $cus->bra = $branch;
              $cus->eid = $results[0];
              $cus->cid = $cusid;
              $cus->oid = $oid;
              $cus->account = isset($results[3]) ? $results[3] : 'Client';
              $cus->type = isset($results[4]) ? $results[4] : 'Client';
              $cus->from = 'Cms';
            } else {
              $cus = new stdClass();  
              $cus->bra = $branch;
              $cus->eid = $results[0];
              $cus->cid = isset($results[1]) ? $results[1] : '0';
              $cus->oid = isset($results[2]) ? $results[2] : '0';
              $cus->account = isset($results[3]) ? $results[3] : 'Client';
              $cus->type = isset($results[4]) ? $results[4] : 'Client';
              $cus->from = isset($results[5]) ? $results[5] : 'Cms';
            }
        } else {
          $cus = new stdClass();  
          $cus->bra = $branch;
          $cus->eid = $results[0];
          $cus->cid = isset($results[1]) ? $results[1] : '0';
          $cus->oid = isset($results[2]) ? $results[2] : '0';
          $cus->account = isset($results[3]) ? $results[3] : 'Client';
          $cus->type = isset($results[4]) ? $results[4] : 'Client';
          $cus->from = isset($results[5]) ? $results[5] : 'Cms';
        }

      } else if (count($results) == 4) {
          $cus = new stdClass();  
          $cus->bra = $branch;
          $cus->eid = file_get_contents(FIND_ENQUIRY_LINK.'?pass=zheshimimi&cid='.$results[0]);
          $cus->cid = isset($results[0]) ? $results[0] : '0';
          $cus->oid = isset($results[1]) ? $results[1] : '0';
          $cus->account = isset($results[2]) ? $results[2] : 'Client';
          $cus->type = isset($results[3]) ? $results[3] : 'Client';
          $cus->from = 'Cms';
      } else {
        echo 'Wrong Link, please check it.';
        return;
      }

        $_SESSION[CUSTOMER] = $cus;
        setcookie(CUSTOMER, json_encode($cus), time() + 3600, PATH , ((DOMAIN == 'localhost') ? NULL : DOMAIN));

    }

  } else {
    
    $results = _mcrypt_decrypt($cus_str, $key, $iv);
	
    if (!empty($results)) {

      if (count($results) == 6) {
         $cusid = $results[1];
         $oid = $results[2];
         $from = $results[5];
         //$cusid = file_get_contents(ENQUIRY_FIND_CUSTOMER_ID_LINK.'?pass=zheshimimi&eid='.$results[0]);
         if ($from == 'Enq') {
            if ($cusid != 0) {
              $myPdo = DbUtils::createPdoInstOther();
              $oid = _foundCustomerOrder($myPdo, $cusid);

              $cus = new stdClass();  
              $cus->bra = $branch;
              $cus->eid = $results[0];
              $cus->cid = $cusid;
              $cus->oid = $oid;
              $cus->account = isset($results[3]) ? $results[3] : 'Client';
              $cus->type = isset($results[4]) ? $results[4] : 'Client';
              $cus->from = 'Cms';
           } else {
              $cus = new stdClass();  
              $cus->bra = $branch;
              $cus->eid = $results[0];
              $cus->cid = isset($results[1]) ? $results[1] : '0';
              $cus->oid = isset($results[2]) ? $results[2] : '0';
              $cus->account = isset($results[3]) ? $results[3] : 'Client';
              $cus->type = isset($results[4]) ? $results[4] : 'Client';
              $cus->from = isset($results[5]) ? $results[5] : 'Cms';
           }
        } else {
          $cus = new stdClass();  
          $cus->bra = $branch;
          $cus->eid = $results[0];
          $cus->cid = isset($results[1]) ? $results[1] : '0';
          $cus->oid = isset($results[2]) ? $results[2] : '0';
          $cus->account = isset($results[3]) ? $results[3] : 'Client';
          $cus->type = isset($results[4]) ? $results[4] : 'Client';
          $cus->from = isset($results[5]) ? $results[5] : 'Cms';
        }
      } else if (count($results) == 4) {
          $cus = new stdClass();  
          $cus->bra = $branch;
          $cus->eid = file_get_contents(FIND_ENQUIRY_LINK.'?pass=zheshimimi&cid='.$results[0]);
          $cus->cid = isset($results[0]) ? $results[0] : '0';
          $cus->oid = isset($results[1]) ? $results[1] : '0';
          $cus->account = isset($results[2]) ? $results[2] : 'Client';
          $cus->type = isset($results[3]) ? $results[3] : 'Client';
          $cus->from = 'Cms';
      } else {
        echo 'Wrong Link, please check it.';
        return;
      }

      print_r(json_encode($cus));

      Yii::$app->session->setFlash('CUSTOMER', json_encode($cus));
     // $_SESSION[CUSTOMER] = $cus;
      //setcookie(CUSTOMER, json_encode($cus), time() + 3600, PATH , ((DOMAIN == 'localhost') ? NULL : DOMAIN));


      // $_SESSION[CLIENT] = $user;
      // setcookie(CLIENT, json_encode($user), time() + 3600, PATH , ((DOMAIN == 'localhost') ? NULL : DOMAIN));

    } else {
      if (isset($_COOKIE[CUSTOMER])) {
        // $_SESSION[CLIENT] = json_decode($_COOKIE[CLIENT]);
        $_SESSION[CUSTOMER] = json_decode($_COOKIE[CUSTOMER]);
      }
    }

  }

  $url = $_SERVER['REQUEST_URI'];

  $firstpos = strpos($url, "&cu");
  $firstpos1 = strpos($url, "?cu");
  
  if($firstpos !== false) {
    $url = substr($url,0,$firstpos);
    
    header( 'Location: ' . $_SERVER['SERVER_NAME'] . $url);
    return;
  } else if ($firstpos1 !== false) {
    $url = substr($url,0,$firstpos1);
    echo $_SERVER['SERVER_NAME'] . $url;
    header( 'Location: ' . $_SERVER['SERVER_NAME'] . $url);
    return;
  }
  
}


if (isset($_SESSION[CUSTOMER])) {
  $bra = $branch;
  $eid = $_SESSION[CUSTOMER]->eid;
  $cid = $_SESSION[CUSTOMER]->cid;
  $oid = $_SESSION[CUSTOMER]->oid;
  $from = $_SESSION[CUSTOMER]->from;
  

  if ($cid != 0 && $oid != 0) {
    $myPdo = DbUtils::createPdoInst();
    
    $cond_vals = new stdClass();
    $cond_vals->c = 't.branch = :v1 and t.enquiry_id = :v2 and t.customer_id = 0 and t.order_id = 0';
    $cond_vals->v = array(':v1' => $bra, ':v2' => $eid);
    $opts = new stdClass();
    $opts->select_expr = 't.id, t.customer_id, t.order_id';
    $tmp1s = DbUtils::get($myPdo, TABLE_NAME_PREFIX . 'customer_emergency_contact', $cond_vals, NULL, NULL, NULL, NULL, $opts)->d;
    $tmp2s = DbUtils::get($myPdo, TABLE_NAME_PREFIX . 'customer_schedule_scene', $cond_vals, NULL, NULL, NULL, NULL, $opts)->d;
    $tmp3s = DbUtils::get($myPdo, TABLE_NAME_PREFIX . 'customer_scene_crew', $cond_vals, NULL, NULL, NULL, NULL, $opts)->d;
    $tmp4s = DbUtils::get($myPdo, TABLE_NAME_PREFIX . 'customer_scene_crew_finish', $cond_vals, NULL, NULL, NULL, NULL, $opts)->d;
    $tmp5s = DbUtils::get($myPdo, TABLE_NAME_PREFIX . 'customer_scene_sort', $cond_vals, NULL, NULL, NULL, NULL, $opts)->d;

    foreach ($tmp1s as $key => $value) {
       if ($value->customer_id == 0 && $value->order_id == 0) {
         $value->customer_id = $cid;
         $value->order_id = $oid;
         DbUtils::update($myPdo, TABLE_NAME_PREFIX . 'customer_emergency_contact', $value);
       }
       
    }
    foreach ($tmp2s as $key => $value) {
       if ($value->customer_id == 0 && $value->order_id == 0) {
         $value->customer_id = $cid;
         $value->order_id = $oid;
         DbUtils::update($myPdo, TABLE_NAME_PREFIX . 'customer_schedule_scene', $value);
       }
    }
    foreach ($tmp3s as $key => $value) {
      if ($value->customer_id == 0 && $value->order_id == 0) {
         $value->customer_id = $cid;
         $value->order_id = $oid;
         DbUtils::update($myPdo, TABLE_NAME_PREFIX . 'customer_scene_crew', $value);
      }
    }
    foreach ($tmp4s as $key => $value) {
      if ($value->customer_id == 0 && $value->order_id == 0) {
        $value->customer_id = $cid;
        $value->order_id = $oid;
        DbUtils::update($myPdo, TABLE_NAME_PREFIX . 'customer_scene_crew_finish', $value);
      }
    }
    foreach ($tmp5s as $key => $value) {
      if ($value->customer_id == 0 && $value->order_id == 0) {
        $value->customer_id = $cid;
        $value->order_id = $oid;
        DbUtils::update($myPdo, TABLE_NAME_PREFIX . 'customer_scene_sort', $value);
      }
    }
  }
    
}

print_r($_SESSION[CUSTOMER]);

return;

function _mcrypt_decrypt($str, $privateKey, $iv) {
  $results = array();


  if (isset($str)) {
    $encryptedData = base64_decode($str);
    $decrypted = mcrypt_decrypt(MCRYPT_RIJNDAEL_128, $privateKey, $encryptedData, MCRYPT_MODE_CBC, $iv);
    $results = explode('-', trim($decrypted));
  }

  return $results;
}






