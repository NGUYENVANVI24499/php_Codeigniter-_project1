<?php

namespace App\Controllers\Admin;
use App\Controllers\BaseController;

class HomeController extends BaseController
{

    public function index()
    {
        $data= [];
        $data = $this->loadMasterlayout($data,'Trang Chủ','admin/pages/home');
      
        return view('admin/admin', $data);
    }
}
