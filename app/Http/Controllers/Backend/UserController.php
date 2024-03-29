<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceService;
use App\Http\Requests\StoreUserRequest;


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

    public function store(StoreUserRequest $request) {
        if($this->userService->create($request)) {
            return redirect()->route('user.index')->with('success', 'User Created Successfully');
        }
        return redirect()->route('user.index')->with('error', 'User Created Unsuccessfully .Something went wrong');
    }
}
