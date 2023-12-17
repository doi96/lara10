<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;

class UserController extends Controller
{
    protected $userService;
    protected $provinceService;

    public function __construct(UserService $userService, ProvinceService $provinceRepository) {
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
    }

    public function index() {
        $users = $this->userService->paginate();

        $config = $this->config();

        $config['seo'] = config('apps.user');

        $template = 'backend.user.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'users'
        ));

    }

    public function create() {

        $config['seo'] = config('apps.user');

        $provinces = $this->provinceRepository->all();

        $template = 'backend.user.create';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'provinces'
        ));
    }
    
    private function config () {
        return [
            'js' => [],
            'css' => []
        ];
    }
}
