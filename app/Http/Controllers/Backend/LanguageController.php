<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Services\Interfaces\LanguageServiceInterface as LanguageService;
use App\Repositories\Interfaces\LanguageRepositoryInterface as LanguageRepository;


use App\Http\Requests\StoreLanguageRequest;
use App\Http\Requests\UpdateLanguageRequest;

class LanguageController extends Controller
{
    protected $languageService;
    protected $languageRepository;

    public function __construct(
        LanguageService $languageService, 
        LanguageRepository $languageRepository
    ) {
        $this->languageService = $languageService;
        $this->languageRepository = $languageRepository;
    }

    public function index(Request $request) {
        $languages = $this->languageService->paginate($request);

        $config['seo'] = config('apps.language');

        $template = 'backend.language.index';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'languages'
        ));

    }

    public function create() {

        $config['seo'] = config('apps.language');
        $config['method'] = 'create';

        $template = 'backend.language.store';
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

    public function store(StoreLanguageRequest $request) {
        if($this->languageService->create($request)) {
            return redirect()->route('language.index')->with('success', 'Language Created Successfully');
        }
        return redirect()->route('language.index')->with('error', 'Language Created Unsuccessfully .Something went wrong!');
    }

    public function edit($id) {
        $language = $this->languageRepository->findById($id);
        $config['seo'] = config('apps.language');
        $config['method'] = 'edit';

        $template = 'backend.language.store';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'language'
        ));
    }

    public function update(UpdateLanguageRequest $request,$id) {
        if($this->languageService->update($id, $request)) {
            return redirect()->route('language.index')->with('success', 'Language Updated Successfully');
        }
        return redirect()->route('language.index')->with('error', 'Language Updated Unsuccessfully .Something went wrong!');
    }

    public function delete($id) {
        $config['seo'] = config('apps.language');
        $language = $this->languageRepository->findById($id);
        $template = 'backend.language.delete';
        return view('backend.dashboard.layout', compact(
            'template',
            'config',
            'language'
        ));
    }

    public function destroy($id) {
        if($this->languageService->destroy($id)) {
            return redirect()->route('language.index')->with('success', 'Language Deleted Successfully');
        }
        return redirect()->route('language.index')->with('error', 'Language Deleted Unsuccessfully .Please try again!');
    }
}
