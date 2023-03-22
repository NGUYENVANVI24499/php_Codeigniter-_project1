<?php

namespace App\Controllers\Admin;

use App\Controllers\BaseController;
use App\Services\UserServices;

class UserController extends BaseController
{
    /** 
     * @var $Service
     * 
     */
    private $service;

    public function __construct()
    {
        $this->service = new UserServices();
    }


    public function index()
    {
        $data = [];
        $cssFile = ['https://cdn.datatables.net/1.10.22/css/jquery.dataTables.min.css'];
        $jsFile = [
            'http://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js',
            base_url() . '/assets/admin/js/datatable.js'
        ];
        $dataLayout['users'] = $this->service->getAllUser();
        $data = $this->loadMasterlayout($data, 'Trang chủ / Tài khoản', 'admin/pages/user/user-list', $dataLayout, $cssFile, $jsFile);

        return view('admin/admin', $data);
    }
    public function add()
    {
        $data = [];
        $data = $this->loadMasterlayout($data, 'Trang chu/ Them', 'admin/pages/user/add-user');
        return view('admin/admin', $data);
    }
    public function create(){
        $result = $this->service->addUserInfor($this->request);
        return redirect()->back()->withInput()->with($result['masageCode'],$result['messages']);
    }
    public function edit($id){
        $user = $this->service->getUserByID($id);
        if(!$user){
            return redirect('error/404');
        }
        $jsFile =[
            base_url() . '/assets/admin/js/event.js'
        ];
        $data =[];
        $dataLayout['user'] = $user;
        $data = $this->loadMasterlayout([],'sua','admin/pages/user/edit-user', $dataLayout,[], $jsFile);
        return view('admin/admin', $data);
    }
    public function update(){
        $result = $this->service->updateUserInfo($this->request);
        return redirect()->back()->withInput()->with($result['masageCode'],$result['messages']);
    }
}