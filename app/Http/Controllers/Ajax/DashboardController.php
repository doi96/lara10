<?php

namespace App\Http\Controllers\Ajax;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;

class DashboardController extends Controller
{
    protected $userService;

    public function __construct(UserService $userService) {
        $this->userService = $userService;
    }

    public function changeStatus(Request $request) {
        $post = $request->input();
        $serviceInterfacecNamespace = 'App\Services\\' .ucfirst($post['model']) . 'Service';
        if (class_exists($serviceInterfacecNamespace)) {
            $serviceInstance = app($serviceInterfacecNamespace);
        }

        $flag = $serviceInstance->updateStatus($post);
        return response()-> json(['flag' => $flag]);
    }

    public function changeStatusAll(Request $request) {
        $post = $request->input();
        $serviceInterfacecNamespace = 'App\Services\\' .ucfirst($post['model']) . 'Service';
        if (class_exists($serviceInterfacecNamespace)) {
            $serviceInstance = app($serviceInterfacecNamespace);
        }

        $flag = $serviceInstance->updateStatusAll($post);
        return response()-> json(['flag' => $flag]);
    }
}
