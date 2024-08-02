<?php

namespace App\Controllers;

use App\Models\UserModel;
use CodeIgniter\Controller;


class AuthController extends BaseController
{
   
    public function login()
    {
        return view('login');
    }

    public function loginPost()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        $data = $model->where('username', $username)->first();

        if ($data) {
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);

            if ($authenticatePassword) {
                $ses_data = [
                    'id' => $data['id'],
                    'username' => $data['username'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/admin');
            } else {
                $session->setFlashdata('msg', 'Password Incorrecto.');
                return redirect()->to('/login');
            }
        } else {
            $session->setFlashdata('msg', 'Usuario No encontrado.');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/login');
    }
   
    /* public function login()
    {
        helper(['form']);
        echo view('login');
    }

    public function loginAuth()
    {
        $session = session();
        $model = new UserModel();
        $username = $this->request->getVar('username');
        $password = $this->request->getVar('password');
        //echo password_hash("caso12", PASSWORD_DEFAULT)."\n";
        $data = $model->where('username', $username)->first();
        //var_dump($data);die;
        if($data){
            $pass = $data['password'];
            $verify_pass = password_verify($password, $pass);
            if($verify_pass){
                $ses_data = [
                    'id'       => $data['id'],
                    'username' => $data['username'],
                    'email'    => $data['email'],
                    'logged_in'=> TRUE
                ];
                $session->set($ses_data);
                return redirect()->to('/admin');
            }else{
                $session->setFlashdata('msg', 'Contraseña incorrecta.');
                return redirect()->to('/login');
            }
        }else{
            $session->setFlashdata('msg', 'Usuario no encontrado.');
            return redirect()->to('/login');
        }
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/login');
    }*/
}