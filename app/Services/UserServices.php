<?php

namespace App\Services;

use App\Common\ResultUtils;
use App\Models\UserModel;
use Exception;
class UserServices extends BaseServices
{
    private $user;


    // construct
    function __construct()
    {
        parent::__construct();
        $this->user = new UserModel();
        $this->user->protect(false);
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

        if ($validate->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'masageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => $validate->getErrors()
            ];
        };
        $dataSave = $requestData->getPost();
        unset($dataSave['password_confirm']);
        $dataSave['password']= password_hash($dataSave['password'],PASSWORD_BCRYPT);
        try {
            $this->user->save($dataSave);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'masageCode' => ResultUtils::MESSAGE_CODE_OK,
                'messages' => ['succes' => 'Thêm dữ liệu thành công']
            ];
        } catch (Exception $e) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'masageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => ['err' => $e->getMessage()]
            ];
        }

    }
    public function getUserByID($idUser){
        return $this->user->where('id',$idUser)->first();
    }

    public function updateUserInfo($requestData){
        $validate = $this->validateEditUser($requestData);
        if ($validate->getErrors()) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'masageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => $validate->getErrors()
            ];
        };
      
         $dataSave = $requestData->getPost();
        if(!empty($dataSave['change_password'])){
            unset($dataSave['change_password']);
            unset($dataSave['password_confirm']);
            $dataSave['password']=password_hash($dataSave['password'],PASSWORD_BCRYPT);
        }
        else{
            unset($dataSave['password']);
            unset($dataSave['password_confirm']);

        }
     
        try {
            $this->user->save($dataSave);
            return [
                'status' => ResultUtils::STATUS_CODE_OK,
                'masageCode' => ResultUtils::MESSAGE_CODE_OK,
                'messages' => ['succes' => 'Thêm dữ liệu thành công']
            ];
        } catch (Exception $e) {
            return [
                'status' => ResultUtils::STATUS_CODE_ERR,
                'masageCode' => ResultUtils::MESSAGE_CODE_ERR,
                'messages' => ['err' => $e->getMessage()]
            ];
        }
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

    private function validateEditUser($requestData)
    {
        $rule = [
            'email' => 'valid_email|is_unique[users.email,id,'.$requestData->getPost()['id'].']',
            'name' => 'max_length[100]',
        ];
        $messages = [
            'email' => [
                'valid_email' => 'Tài khoản {field} {value} không đúng định dạng !',
                'is_unique' => 'Email đã được đăng ký!'
            ],
            'name' => [
                'max_length' => 'Tên quá dài, vui lòng nhập {param} ký tự'
            ],
        ];
        if(!empty( $requestData->getPost()['change_password'])){
            $rule['password'] ='max_length[30]|min_length[6]';
            $rule['password_confirm'] = 'matches[password]';
            $messages['password']=[
                'max_length' => 'Mật khẩu quá dài, vui lòng nhập {param} ký tự',
                'min_length' => 'Mật khẩu ít nhất {param} ký tự'
            ];
            $messages['password_confirm'] =[
                'matches' => 'Mật khẩu không khớp vui lòng kiểm tra lại'
            ];
        }
        $this->validation->setRules($rule, $messages);
        $this->validation->withRequest($requestData)->run();

        return $this->validation;
    }

   
}