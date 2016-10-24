<?php

/* user_functions: authenticate - login - register */

function authenticate($application)
{

    if (!isset($_COOKIE[COOKIE_WG1])) {
        $_SESSION['urlRedirect'] = $application->request()->getPathInfo();
        $application->flash('error', 'Login required');
        $application->redirect('/');
    }

    $cookiestring = decrypt($_COOKIE[COOKIE_WG1]);
    $usercookie = explode(':', $cookiestring);

    global $useremail, $userid, $usertype;
    $useremail = $usercookie[1];
    $userid = $usercookie[2];
    $usertype = $usercookie[3];
}

function userlogin($application, $checkauth)
{

    if ($checkauth === 'LOGOUT') {
        session_destroy();
        if (isset($_COOKIE[COOKIE_WG1])) {
            setcookie(COOKIE_WG1, "", time() - 3600, '/', DOMAIN);
        }
        $UrlRedirect = $application->request()->getPathInfo();
        $application->redirect('/');
    }

    $emailadd = $application->request()->post('emailadd');
    if (!isValidEmail($emailadd)) {
        $application->flash('login_valid', 'Please enter valid Email Address');
        $application->redirect('/');
    }
    $userpwd = $application->request()->post('userpwd');
    if ($emailadd != '' && $userpwd != '') {
        $sql = "SELECT `id`, `usertype` FROM `users` WHERE `status`=1 AND `emailadd`=:emailadd AND `userpwd`=:userpwd LIMIT 0,1 ";

        try {

            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam("emailadd", $emailadd, PDO::PARAM_STR);
            $stmt->bindParam("userpwd", md5($userpwd), PDO::PARAM_STR);
            $stmt->execute();
            $user = $stmt->fetchObject();
            $db = null;

            $redirectUrl = '/';
            if ($user) {
                $redirectUrl = '/dashboard/';

                $userid = $user->id;
                $usertype = $user->usertype;

                $cookietime = strtotime('+2 years');

                $cookiestring = APP_SALT . ':' . $emailadd . ':' . $userid . ':' . $usertype . '';
                $cookiestring = encrypt($cookiestring);

                setcookie(COOKIE_WG1, $cookiestring, $cookietime, "/", DOMAIN);
            } else {
                $application->flash('login_mand', 'Please enter correct email or password.');
                $application->redirect('/');
            }

            $application->redirect($redirectUrl);
        } catch (PDOException $e) {
            error_log($e->getMessage(), 3, '/var/tmp/php.log');
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    } else {
        $application->flash('login_mand', 'Please Enter Email Address and Password');
        $application->redirect('/');
    }
}

if (!function_exists('encrypt')) {

    function encrypt($text)
    {
        return trim(base64_encode(mcrypt_encrypt(MCRYPT_RIJNDAEL_256, APP_SALT, $text, MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND))));
    }

}

if (!function_exists('decrypt')) {

    function decrypt($text)
    {
        return trim(mcrypt_decrypt(MCRYPT_RIJNDAEL_256, APP_SALT, base64_decode($text), MCRYPT_MODE_ECB, mcrypt_create_iv(mcrypt_get_iv_size(MCRYPT_RIJNDAEL_256, MCRYPT_MODE_ECB), MCRYPT_RAND)));
    }

}

function Insertintouserprofile($name, $email, $password,$phone)
{

    $sql = "INSERT INTO `users`(`realname`, `emailadd`, `userpwd`,`phoneno`, `created`, `usertype`, `status`) VALUES (:name,:email,:password,:phoneno,NOW(),'1','1')";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':name', $name, PDO::PARAM_STR);
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
        $stmt->bindParam(':phoneno', $phone, PDO::PARAM_STR);
        $stmt->execute();
        # Affected Rows?
        $msg = $stmt->rowCount(); // 1
    } catch (PDOException $e) {
        $msg = '{"error":{"text":' . $e->getMessage() . '}}';
    }
    return $msg;
}

function getparametersvalform($fields)
{
    $req_param = array();
    $req_param = $_POST;
    return $req_param;
}

function registerUser()
{
    global $application;
    $redirectUrl = '/dashboard/';
    $get_params = getparametersvalform(array('name', 'emailadd', 'userpwd','phone'));
    extract($get_params);
    if(checkuseravailbyid($emailadd)==TRUE){
    if ($userpwd != '' && $emailadd != '') {
        if (isValidEmail($emailadd)) {
            $insert_id = Insertintouserprofile($name, $emailadd, md5($userpwd),$phone);
            if (is_numeric($insert_id) && $insert_id > 0) {
                userlogin($application, 'LOGIN');
            }
        } else {
            $application->flash('reg_valid', 'Please enter valid Email Address');
            $application->redirect('/');
        }
    } else {
        $application->flash('reg_mand', 'Please Enter Email Address and Password');
        $application->redirect('/');
    }
    }  else {
        $application->flash('reg_avail', 'This email is not available.');
        $application->redirect('/');
    }
}

function forgetpassword() {
    global $application;
    $error = array();
    $emailadd = $application->request()->post('emailadd');
    if (!isValidEmail($emailadd)) {
        $error['valid'] = TRUE;
    }
    checkemailavail($emailadd);
}

function checkemailavail($emailadd) {
    global $application,$APP_ROOT_URL;
    $sql = "SELECT `id`,`userpwd`,`realname` FROM `users` WHERE `status`=1 AND `emailadd`=:emailadd";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':emailadd', $emailadd, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetchObject();
        if ($user) {
            $token = $user->userpwd;
            $name = $user->realname;
            if ($token) {
                //$application->redirect("/setpassword?mail=$emailadd&passkey=$token");
                $subject=DOMAIN." - Reset Password";
                $message="Dear $name,<br><br>It seems you have forgotten your password. Please <a href='".$APP_ROOT_URL."/setpassword?mail=$emailadd&passkey=$token'>click here</a> to reset your password.<br><br> Do let us know if you face any problem in resetting your password<br><br>Best Regards,<br>Team ".DOMAIN."<br>".EMAIL_INFO;
                $header="";
                //mail ($emailadd,$subject,$message,$header);
                sendMail($emailadd,$subject,$message,'jobseekerpwfg');
                $application->flash('set','Your forgot password link has been sent.');
                $application->redirect('/');
            } else {
                $application->flash('valid', 'Email Address is not registered');
                $application->redirect('/');
            }
        }
    } catch (PDOException $e) {
        $msg = '{"error":{"text":' . $e->getMessage() . '}}';
    }
}

function updatepass($application, $email, $passkey) {
    global $application;
    $error = array();
    $error['message']=false;
    $error['update']=FALSE;
    $get_params = getparametersvalform(array('npassword', 'cnpassword'));
    extract($get_params);
    if ($npassword != $cnpassword) {
        $error['message'] = true;
    } else {
        $sql = "UPDATE `users` SET `userpwd`=:npwd WHERE `userpwd`=:passkey AND `emailadd`=:mail";
        try {
            $db = getConnection();
            $stmt = $db->prepare($sql);
            $stmt->bindParam(':npwd', md5($npassword), PDO::PARAM_STR);
            $stmt->bindParam(':passkey', $passkey, PDO::PARAM_STR);
            $stmt->bindParam(':mail', $email, PDO::PARAM_STR);
            $stmt->execute();
            # Affected Rows?
            $msg = $stmt->rowCount(); // 1
            $error['update'] = true;
        } catch (PDOException $e) {
            error_log($e->getMessage(), 3, '/var/tmp/php.log');
            echo '{"error":{"text":' . $e->getMessage() . '}}';
        }
    }
    if ($error['message'] == true) {
        $application->flash('message', 'Password not matched');
        $application->redirect('/setpassword');
    }
    if ($error['update']) {
        $application->flash('update', 'Password updated Sucessfully');
        $application->redirect('/');
    }
    
}

function sendMail($email, $subject, $message, $mailcat = 'nwml')
{
    $to = $toname = $email;
    $html = $text = $message;
    sendMailByManDrill($to, $toname, $subject, $html, $text, EMAIL_INFO, $mailcat);
    
}

function sendMailByManDrill($to, $toname = '', $subject, $html, $text = '', $replyto = EMAIL_INFO, $mailcat = 'odml', $mailfrom = FROM, $mailfromname = FROMNAME)
{
    $array_data = (object) array(
                'key' => MANDRILL_KEY,
                'message' => (object) array(
                    'html' => $html,
                    'text' => $text,
                    
                    'subject' => $subject,
                    'from_email' => $mailfrom,
                    'from_name' => $mailfromname,
                    'to' => array(
                        (object) array(
                            'email' => $to,
                            'name' => $toname,
                        ),
                    ),
                    'headers' => (object) array(
                        'Reply-to' => $replyto
                    ),
                    'track_opens' => true,
                    'track_clicks' => true,
                    'auto_text' => true,
                    'url_strip_qs' => true,
                    'tags' => array(
                        $mailcat
                    ),
                ),
    );
    // echo '<pre>'; print_r($array_data); echo '</pre>';
    $string_data = json_encode($array_data);
    $log_msg = date('c') . " - MANDRILL_REQUEST - " . "$string_data" . "\n" . "\n";
    // writelogfile(MANDRILL_ERR_LOG, $log_msg);
    $session = curl_init(MANDRILL_URL);
    curl_setopt($session, CURLOPT_POST, true);
    curl_setopt($session, CURLOPT_POSTFIELDS, $string_data);
    curl_setopt($session, CURLOPT_HEADER, false);
    curl_setopt($session, CURLOPT_ENCODING, 'UTF-8');
    curl_setopt($session, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($session, CURLOPT_SSL_VERIFYPEER, false);
    $response = curl_exec($session);
    curl_close($session);
    $log_msg = date('c') . " - MANDRILL_RESPONSE - " . "$response" . "\n" . "\n";
    // writelogfile(MANDRILL_ERR_LOG, $log_msg);
    $results = json_decode($response, true);
    if ((isset($results['status'])) && ($results['status'] === 'error')) {
        $log_msg = date('c') . " - MANDRILL_REQUEST - " . "$string_data" . "\n" . "\n";
        // writelogfile(MANDRILL_ERR_LOG, $log_msg);
        $log_msg = date('c') . " - MANDRILL_RESPONSE - " . "$response" . "\n" . "\n";
        // writelogfile(MANDRILL_ERR_LOG, $log_msg);
    }
    // echo '<pre>'; print_r($results); echo '</pre>';
    //return $results;
    return true;
    //
}

function checkuseravailbyid($emailadd) {
    global $application, $APP_ROOT_URL;
    $sql = "SELECT `id` FROM `users` WHERE `emailadd`=:emailadd";
    try {
        $db = getConnection();
        $stmt = $db->prepare($sql);
        $stmt->bindParam(':emailadd', $emailadd, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch();
        if($user){
            return false;
        }else{
            return true;
        }
    } catch (PDOException $e) {
        $msg = '{"error":{"text":' . $e->getMessage() . '}}';
    }
}



##
