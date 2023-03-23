<?php

namespace App\Services;

use App\Common\ResultUtils;
use App\Models\UserModel;
use Exception;


class LoginService extends BaseServices
{
    private $user;


    // construct
    function __construct()
    {
        parent::__construct();
        $this->user = new UserModel();
        $this->user->protect(false);
    }

    public function hasLoginUser($requestData)
    {
        $validate= $this->validateLogin($requestData);
        if($validate->getErrors()){
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'masageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => $validate->getErrors()
            ];
        }
        $params = $requestData->getPost();
        $user = $this->user->where('email',$params['email'])->first();
       if(!$user){
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'masageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'messages' => ['notExits'=>'emai chua duoc dang ky']
        ];
       };

       if(!password_verify($params['password'],$user['password'])){
        return [
            'status' => ResultUtils::STATUS_CODE_ERR,
            'masageCode' => ResultUtils::MESSAGE_CODE_ERR,
            'messages' => ['wrongPass'=>'Mat khau sai']
        ];
       }
       $session = session();

       unset($user['password']);

       $session->set('user_login',$user);
       return [
        'status' => ResultUtils::STATUS_CODE_OK,
        'masageCode' => ResultUtils::MESSAGE_CODE_OK,
        'messages' => null
    ];

    }
    private function  validateLogin($requestData)
    {
        $rule = [
            'email'     => 'valid_email',
            'password'  => 'max_length[30]|min_length[6]',
        ];
        $messages = [
            'name' => [
                'valid_email' =>'tai khoan {filed} {value} khong ton tai',
            ],
            'password' => [
                'max_length' =>'qua dai',
                'min_length' =>'mat khau phai gon 6 ky tu',
            ]
        ];
        $this->validation->setRules($rule, $messages);
        $this->validation->withRequest($requestData)->run();
        return $this->validation;
    }
    public function logoutUser()
    {
        $session = session();
        $session->destroy();
    }
}