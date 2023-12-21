<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;

    public function __construct(
        UserCatalogueService $userCatalogueService, 
    ) {
        $this->userCatalogueService = $userCatalogueService;
    }

    public function index(Request $request) {
        echo 123;die();
        $users = $this->userCatalogueService->paginate($request);
        $config = $this->config();

        $config['seo'] = config('apps.user');

        $template = 'backend.user.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'users'
        ));

    }

    // public function create() {

    //     $config['seo'] = config('apps.user');
    //     $config['method'] = 'create';
    //     $provinces = $this->provinceRepository->all();

    //     $template = 'backend.user.catalogue.store';
    //     return view('backend.dashboard.layout', compact(
    //         'template',
    //         'config',
    //         'provinces'
    //     ));
    // }
    
    // private function config () {
    //     return [
    //         'js' => [],
    //         'css' => []
    //     ];
    // }

    // public function store(StoreUserRequest $request) {
    //     if($this->userCatalogueService->create($request)) {
    //         return redirect()->route('user.index')->with('success', 'User Created Successfully');
    //     }
    //     return redirect()->route('user.index')->with('error', 'User Created Unsuccessfully .Something went wrong');
    // }

    // public function edit($id) {
    //     $user = $this->userCatalogueRepository->findById($id);
    //     $config['seo'] = config('apps.user');
    //     $config['method'] = 'edit';
    //     $provinces = $this->provinceRepository->all();

    //     $template = 'backend.user.catalogue.store';
    //     return view('backend.dashboard.layout', compact(
    //         'template',
    //         'config',
    //         'provinces',
    //         'user'
    //     ));
    // }

    // public function update(UpdateUserRequest $request,$id) {
    //     if($this->userCatalogueService->update($id, $request)) {
    //         return redirect()->route('user.index')->with('success', 'User Updated Successfully');
    //     }
    //     return redirect()->route('user.index')->with('error', 'User Updated Unsuccessfully .Something went wrong!');
    // }

    // public function delete($id) {
    //     $config['seo'] = config('apps.user');
    //     $user = $this->userCatalogueRepository->findById($id);
    //     $template = 'backend.user.catalogue.delete';
    //     return view('backend.dashboard.layout', compact(
    //         'template',
    //         'config',
    //         'user'
    //     ));
    // }

    // public function destroy($id) {
    //     if($this->userCatalogueService->destroy($id)) {
    //         return redirect()->route('user.index')->with('success', 'User Deleted Successfully');
    //     }
    //     return redirect()->route('user.index')->with('error', 'User Deleted Unsuccessfully .Please try again!');
    // }
}
