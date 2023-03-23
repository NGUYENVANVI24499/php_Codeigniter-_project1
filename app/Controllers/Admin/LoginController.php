<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;
use App\Services\LoginService;
use App\Common\ResultUtils;

class LoginController extends BaseController
{

    /**
     * @var Service
     */
    private $service;
    public function __construct(){
        $this->service = new LoginService();
    }
    public function index()
    {
        if(session()->has('user_login')){
            return redirect('admin/home');
        }
        return view('login');
    }
    public function login()
    {
        $result = $this->service->hasLoginUser($this->request);
      
        if($result['status'] === ResultUtils::STATUS_CODE_OK){
            return redirect("admin/home");
        }elseif($result['status'] === ResultUtils::STATUS_CODE_ERR){
            return redirect("login")->with($result['masageCode'],$result['messages']);
        }
        return redirect("home");
    }
   public function logout()
   {
        $this->service->logoutUser();
        return redirect('login');
   }
}
