<?php

namespace App\Services;

use App\Common\ResultUtils;
use App\Models\UserModel;

class UserServices extends BaseServices
{
    private $user;


    // construct
    function __construct()
    {
        parent::__construct();
        $this->user = new UserModel();
    }

    //get all users
    public function getAllUser()
    {
        return $this->user->findAll();
    }
    /**
     * Add user
     */
    public function addUserInfor($requestData)
    {
        $validate = $this->validateAddUser($requestData);
        dd($validate->getErrors());
        if($validate->getErrors()){
            return[
                'status'=>ResultUtils::STATUS_CODE_ERR,
            ];
        };
        dd('hêt');
    }
    private function validateAddUser($requestData)
    {
        $rule = [
            'email' => 'valid_email|is_unique[users.email]',
            'name' => 'max_length[100]',
            'password' => 'max_length[30]|min_length[6]',
            'password_confirm' => 'matches[password]'
        ];
        $messages = [
            'email' => [
                'valid_email' => 'Tài khoản {field} {value} không đúng định dạng !',
                'is_unique' => 'Email đã được đăng ký!'
            ],
            'name' => [
                'max_length' => 'Tên quá dài, vui lòng nhập {param} ký tự'
            ],
            'password' => [
                'max_length' => 'Mật khẩu quá dài, vui lòng nhập {param} ký tự',
                'min_length' => 'Mật khẩu ít nhất {param} ký tự'
            ],
            'password_confirm' => [
                'matches' => 'Mật khẩu không khớp vui lòng kiểm tra lại'
            ],

        ];
        $this->validation->setRules($rule, $messages);
        $this->validation->withRequest($requestData)->run();
    
        return $this->validation;
    }
}