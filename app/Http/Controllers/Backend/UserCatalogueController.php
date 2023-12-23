<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\UserCatalogueServiceInterface as UserCatalogueService;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;


use App\Http\Requests\StoreUserCatalogueRequest;

class UserCatalogueController extends Controller
{
    protected $userCatalogueService;
    protected $userCatalogueRepository;

    public function __construct(
        UserCatalogueService $userCatalogueService, 
        UserCatalogueRepository $userCatalogueRepository
    ) {
        $this->userCatalogueService = $userCatalogueService;
        $this->userCatalogueRepository = $userCatalogueRepository;
    }

    public function index(Request $request) {
        $userCatalogues = $this->userCatalogueService->paginate($request);
        // $config = $this->config();

        $config['seo'] = config('apps.userCatalogue');

        $template = 'backend.user.catalogue.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'userCatalogues'
        ));

    }

    public function create() {

        $config['seo'] = config('apps.userCatalogue');
        $config['method'] = 'create';

        $template = 'backend.user.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config'
        ));
    }
    
    private function config () {
        return [
            'js' => [],
            'css' => []
        ];
    }

    public function store(StoreUserCatalogueRequest $request) {
        if($this->userCatalogueService->create($request)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Group User Created Successfully');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Group User Created Unsuccessfully .Something went wrong!');
    }

    public function edit($id) {
        $userCatalogue = $this->userCatalogueRepository->findById($id);
        $config['seo'] = config('apps.userCatalogue');
        $config['method'] = 'edit';

        $template = 'backend.user.catalogue.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'userCatalogue'
        ));
    }

    public function update(StoreUserCatalogueRequest $request,$id) {
        if($this->userCatalogueService->update($id, $request)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Group User Updated Successfully');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Group User Updated Unsuccessfully .Something went wrong!');
    }

    public function delete($id) {
        $config['seo'] = config('apps.userCatalogue');
        $userCatalogue = $this->userCatalogueRepository->findById($id);
        $template = 'backend.user.catalogue.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'userCatalogue'
        ));
    }

    public function destroy($id) {
        if($this->userCatalogueService->destroy($id)) {
            return redirect()->route('user.catalogue.index')->with('success', 'Group User Deleted Successfully');
        }
        return redirect()->route('user.catalogue.index')->with('error', 'Group User Deleted Unsuccessfully .Please try again!');
    }
}
