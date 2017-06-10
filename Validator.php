<?php

class Validator
{
    public $enter_email_msg = 'Введите e-mail';
    public $incorrect_email_msg = 'Не корректный e-mail';
    public $enter_payeer_msg = 'Введите номер кошелька';
    public $incorrect_payeer_msg = 'Не корректный номер кошелька';
    public $enter_login_msg = 'Введите логин';
    public $incorrect_login_msg = 'Не корректный логин';
    public $min_length_login_msg = 'Минимальное кол-во символов: ';
    public $max_length_login_msg = 'Максимальное кол-во символов: ';
    public $enter_password_msg = 'Введите пароль';
    public $incorrect_password_msg = 'Не корректный пароль';
    public $min_length_password_msg = 'Минимальное кол-во символов: ';
    public $max_length_password_msg = 'Максимальное кол-во символов: ';
    public $enter_num_msg = 'Введите номер';
    public $incorrect_num_msg = 'Не корректный номер';
    public $min_length_num_msg = 'Минимальное кол-во символов: ';
    public $max_length_num_msg = 'Максимальное кол-во символов: ';
	
	public $test = 'test';
	public $test2 = 'test2';
	public $test3 = 'test3';
	
	public brch = '';

    public function email($data, $len1 = 50, $len2 = 20, $len3 = 15)
    {
        $email = str_replace(" ", "", $data);
        $pattern_email = '/[a-zA-Z0-9\-\_]{1,' . $len1 . '}[@]{1}[a-zA-Z0-9]{2,' . $len2 . '}[\.]{1}[a-zA-Z0-9]{2,' . $len3 . '}/';
        if (!preg_match($pattern_email, $email, $result_email)) {
            if ($data == null) {
                $_SESSION['error_email_validator'] = $this->enter_email_msg;
            } else {
                $_SESSION['error_email_validator'] = $this->incorrect_email_msg;
            }
        } else {
            return $result_email[0];
        }

        return false;

    }

    public function payeer($data, $len = 15)
    {
        $payeer = str_replace(" ", "", $data);
        $pattern_payeer = '/[P]{1}[0-9]{' . $len . '}/';
        if (!preg_match($pattern_payeer, $payeer, $result_payeer)) {
            if ($data == null) {
                $_SESSION['error_payeer_validator'] = $this->enter_payeer_msg;
            } else {
                $_SESSION['error_payeer_validator'] = $this->incorrect_payeer_msg;
            }
        } else {
            return $result_payeer[0];
        }

        return false;

    }

    public function login($data, $len1 = 4, $len2 = 15)
    {
        $login = str_replace(" ", "", $data);
        $pattern_login = '/[a-zA-Z0-9]{' . $len1 . ', ' . $len2 . '}/';
        if (strlen($data) < $len1) {
            $_SESSION['error_login_validator'] = $this->min_length_login_msg . $len1;
        }
        if (strlen($data) > $len2) {
            $_SESSION['error_login_validator'] = $this->max_length_login_msg . $len2;
        }
        if (!preg_match($pattern_login, $login, $result_login)) {
            if ($data == null) {
                $_SESSION['error_login_validator'] = $this->enter_login_msg;
            } else {
                $_SESSION['error_login_validator'] = $this->incorrect_login_msg;
            }
        } else {
            return $result_login[0];
        }

        return false;

    }

    public function password($data, $len1 = 6, $len2 = 30)
    {
        $password = str_replace(" ", "", $data);
        $pattern_password = '/[.]{' . $len1 . ', ' . $len2 . '}/';
        if (strlen($data) < $len1) {
            $_SESSION['error_password_validator'] = $this->min_length_password_msg . $len1;
        }
        if (strlen($data) > $len2) {
            $_SESSION['error_password_validator'] = $this->max_length_password_msg . $len2;
        }
        if (!preg_match($pattern_password, $password, $result_password)) {
            if ($data == null) {
                $_SESSION['error_password_validator'] = $this->enter_password_msg;
            } else {
                $_SESSION['error_password_validator'] = $this->incorrect_password_msg;
            }
        } else {
            return $result_password[0];
        }

        return false;

    }

    public function num($data, $len1 = 4, $len2 = 30)
    {
        $num = str_replace(" ", "", $data);
        $pattern_num = '/[0-9]{' . $len1 . ', ' . $len2 . '}/';
        if (strlen($data) < $len1) {
            $_SESSION['error_num_validator'] = $this->min_length_num_msg . $len1;
        }
        if (strlen($data) > $len2) {
            $_SESSION['error_num_validator'] = $this->max_length_num_msg . $len2;
        }
        if (!preg_match($pattern_num, $num, $result_num)) {
            if ($data == null) {
                $_SESSION['error_num_validator'] = $this->enter_num_msg;
            } else {
                $_SESSION['error_num_validator'] = $this->incorrect_num_msg;
            }
        } else {
            return $result_num[0];
        }

        return false;

    }

    public function custom($data, $pattern, $name = 'custom', $enterMsg = 'Введите данные', $incorrectMsg = 'Не корректные данные')
    {
        $custom = str_replace(" ", "", $data);
        if (!preg_match($pattern, $custom, $result_custom)) {
            if ($data == null) {
                $_SESSION['error_' . $name . '_validator'] = $enterMsg;
            } else {
                $_SESSION['error_' . $name . '_validator'] = $incorrectMsg;
            }
        } else {
            return $result_custom[0];
        }

        return false;

    }



    public static function isEmailError()
    {
        if (isset($_SESSION['error_email_validator'])) {
            return true;
        }
        return false;
    }


    public static function isPayeerError()
    {
        if (isset($_SESSION['error_payeer_validator'])) {
            return true;
        }
        return false;
    }


    public static function isLoginError()
    {
        if (isset($_SESSION['error_login_validator'])) {
            return true;
        }
        return false;
    }


    public static function isPasswordError()
    {
        if (isset($_SESSION['error_password_validator'])) {
            return true;
        }
        return false;
    }


    public static function isNumError()
    {
        if (isset($_SESSION['error_num_validator'])) {
            return true;
        }
        return false;
    }


    public static function isCustomError($name)
    {
        if (isset($_SESSION['error_' . $name . '_validator'])) {
            return true;
        }
        return false;
    }


    public static function printErrorEmailMessage()
    {
        return $_SESSION['error_email_validator'];
    }


    public static function printErrorPayeerMessage()
    {
        return $_SESSION['error_payeer_validator'];
    }


    public static function printErrorLoginMessage()
    {
        return $_SESSION['error_login_validator'];
    }


    public static function printErrorPasswordMessage()
    {
        return $_SESSION['error_password_validator'];
    }


    public static function printErrorNumMessage()
    {
        return $_SESSION['error_num_validator'];
    }


    public static function printErrorCustomMessage($name)
    {
        return $_SESSION['error_' . $name . '_validator'];
    }


    public static function destroyValidate($identy)
    {
        switch ($identy) {
            case 'email':
                unset($_SESSION['error_email_validator']);
                break;
            case 'payeer':
                unset($_SESSION['error_payeer_validator']);
                break;
            case 'login':
                unset($_SESSION['error_login_validator']);
                break;
            case 'password':
                unset($_SESSION['error_password_validator']);
                break;
            case 'num':
                unset($_SESSION['error_num_validator']);
                break;
        }
    }


    public static function destroyValidateMass($arr)
    {
        foreach ($arr as $k => $v) {
            unset($_SESSION['error_'.$v.'_validator']);
        }
    }


    public static function destroyCustomValidate($name)
    {
        unset($_SESSION['error_' . $name . '_validator']);
    }


    public static function startValidate()
    {
        session_start();
    }


    public function setEnterEmailMsg($enter_email_msg)
    {
        $this->enter_email_msg = $enter_email_msg;
    }


    public function setIncorrectEmailMsg($incorrect_email_msg)
    {
        $this->incorrect_email_msg = $incorrect_email_msg;
    }


    public function setEnterPayeerMsg($enter_payeer_msg)
    {
        $this->enter_payeer_msg = $enter_payeer_msg;
    }


    public function setIncorrectPayeerMsg($incorrect_payeer_msg)
    {
        $this->incorrect_payeer_msg = $incorrect_payeer_msg;
    }


    public function setEnterLoginMsg($enter_login_msg)
    {
        $this->enter_login_msg = $enter_login_msg;
    }


    public function setIncorrectLoginMsg($incorrect_login_msg)
    {
        $this->incorrect_login_msg = $incorrect_login_msg;
    }


    public function setMinLengthLoginMsg($min_length_login_msg)
    {
        $this->min_length_login_msg = $min_length_login_msg;
    }


    public function setMaxLengthLoginMsg($max_length_login_msg)
    {
        $this->max_length_login_msg = $max_length_login_msg;
    }


    public function setEnterPasswordMsg($enter_password_msg)
    {
        $this->enter_password_msg = $enter_password_msg;
    }


    public function setIncorrectPasswordMsg($incorrect_password_msg)
    {
        $this->incorrect_password_msg = $incorrect_password_msg;
    }


    public function setMinLengthPasswordMsg($min_length_password_msg)
    {
        $this->min_length_password_msg = $min_length_password_msg;
    }


    public function setMaxLengthPasswordMsg($max_length_password_msg)
    {
        $this->max_length_password_msg = $max_length_password_msg;
    }


    public function setEnterNumMsg($enter_num_msg)
    {
        $this->enter_num_msg = $enter_num_msg;
    }


    public function setIncorrectNumMsg($incorrect_num_msg)
    {
        $this->incorrect_num_msg = $incorrect_num_msg;
    }


    public function setMinLengthNumMsg($min_length_num_msg)
    {
        $this->min_length_num_msg = $min_length_num_msg;
    }


    public function setMaxLengthNumMsg($max_length_num_msg)
    {
        $this->max_length_num_msg = $max_length_num_msg;
    }


}