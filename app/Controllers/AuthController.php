<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class AuthController extends BaseController
{

    public function __construct()
    {
        helper(['url', 'form']);
    }

    public function index()
    {
        return view('auth/login');
    }

    public function check()
    {
        $validation = $this->validate([
            'username' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib Diisi username Anda !',
                ],
            ],
            'password' => [
                'rules' => 'required',
                'errors' => [
                    'required' => 'Wajib Mengisi Password !',
                ],
            ],
        ]);

        if (!$validation) {
            return view('auth/login', ['validation' => $this->validator]);
        } else {
            $username = $this->request->getPost('username');
            $password = $this->request->getPost('password');

            $UserModel = new UserModel();
            $UserInfo = $UserModel->where('username', $username)->first();
            $check_password = md5($password);
            if ($UserInfo) {
                if ($check_password == $UserInfo['password']) {
                    $user_id = $UserInfo['id'];
                    session()->set('loggedUser', $user_id);
                    return redirect()->to('/');
                } else {
                    session()->setFlashdata('fail', 'Password Anda Salah ! Silahkan Periksa Kembali');
                    return redirect()->back();
                }
            } else {
                session()->setFlashdata('fail', 'Username dan Password Anda Salah ! Silahkan Periksa Kembali');
                return redirect()->back();

            }

        }

    }

    public function logout()
    {
        if (session()->has('loggedUser')) {
            session()->remove('loggedUser');
            return redirect()->to('/auth/login')->with('out', 'Account User sudah Keluar');
        }
    }

}