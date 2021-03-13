<?php

namespace app\controllers;

use app\models\User;

class UserController extends AppController
{
    public function signupAction()
    {

        if (!empty($_POST)) {
            $user = new User();
            $data = $_POST;
            $user->load($data);

            if (!$user->validate($data) || !$user->checkUnique()) {
                $user->getErrors();
                $_SESSION['form_data'] = $data;
            } else {
                $user->attributes['password'] = password_hash($user->attributes['password'], PASSWORD_DEFAULT);

                if ($user->save('user')) {
                    $_SESSION['success'] = 'Success!';
                } else {
                    $_SESSION['success'] = 'Error!';
                }
            }

            redirect();
        }

        $this->setMeta('Register');
    }

    public function loginAction()
    {
        if (isset($_SESSION['user'])) {
            redirect(SITE_URL);
        }

        if (!empty($_POST)) {
            $user = new User();

            if ($user->login()) {
                redirect(SITE_URL);
            } else {
                $_SESSION['error'] = 'Username or password are entered incorrectly!';
            }
            redirect();
        }

        $this->setMeta('Login');
    }

    public function logoutAction()
    {
        if (isset($_SESSION['user'])) {
            unset($_SESSION['user']);
        }

        redirect();
    }
}