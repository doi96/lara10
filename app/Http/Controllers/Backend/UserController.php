<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Interfaces\UserServiceInterface as UserService;
use App\Repositories\Interfaces\ProvinceRepositoryInterface as ProvinceRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserController extends Controller
{
    protected $userService;
    protected $provinceService;
    protected $userRepository;

    public function __construct(
        UserService $userService, 
        ProvinceRepository $provinceRepository,
        UserRepository $userRepository
    ) {
        $this->userService = $userService;
        $this->provinceRepository = $provinceRepository;
        $this->userRepository = $userRepository;
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
        $config['method'] = 'create';
        $provinces = $this->provinceRepository->all();

        $template = 'backend.user.store';
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

    public function edit($id) {
        $user = $this->userRepository->findById($id);
        $config['seo'] = config('apps.user');
        $config['method'] = 'edit';
        $provinces = $this->provinceRepository->all();

        $template = 'backend.user.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'provinces',
            'user'
        ));
    }

    public function update(UpdateUserRequest $request,$id) {
        if($this->userService->update($id, $request)) {
            return redirect()->route('user.index')->with('success', 'User Updated Successfully');
        }
        return redirect()->route('user.index')->with('error', 'User Updated Unsuccessfully .Something went wrong');
    }

    public function delete($id) {
        $config['seo'] = config('apps.user');
        $user = $this->userRepository->findById($id);
        $template = 'backend.user.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'user'
        ));
    }
}
