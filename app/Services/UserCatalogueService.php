<?php

namespace App\Services;

use App\Services\Interfaces\UserCatalogueServiceInterface;
use App\Repositories\Interfaces\UserCatalogueRepositoryInterface as UserCatalogueRepository;
use App\Repositories\Interfaces\UserRepositoryInterface as UserRepository;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

/**
 * Class UserCatalogueService
 * @package App\Services
 */
class UserCatalogueService implements UserCatalogueServiceInterface
{
    protected $userCatalogueRepository;
    protected $userRepository;

    public function __construct(
        UserCatalogueRepository $userCatalogueRepository,
        UserRepository $userRepository
    ) {
        $this->userCatalogueRepository = $userCatalogueRepository;
        $this->userRepository = $userRepository;
    }

    public function paginate($request) {

        $condition['keyword'] = addslashes($request->input('keyword'));
        $condition['publish'] = $request->integer('publish');
        $perPage = $request->integer('perpage');
        $userCatalogues = $this->userCatalogueRepository->pagination(
            $this->paginateSelect(), 
            $condition, [], 
            ['path' => '/user/calalogue/index'], 
            $perPage, ['users']

        );
        return $userCatalogues;
    }
    public function create($request) {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token','send']);
            $user = $this->userCatalogueRepository->create($payload);

            DB::commit();
            return true;
        }catch(\Exception $e) {
            DB::rollBack();
            echo $e->getMessage(); die();
            // Log::error($e->getMessage());
            return false;
        }
    }

    public function update($id, $request) {
        DB::beginTransaction();
        try {
            $payload = $request->except(['_token','send']);
            $user = $this->userCatalogueRepository->update($id, $payload);
            DB::commit();
            return true;
        }catch(\Exception $e) {
            DB::rollBack();
            echo $e->getMessage(); die();
            // Log::error($e->getMessage());
            return false;
        }
    }

    public function destroy($id) {
        DB::beginTransaction();
        try {
            $user = $this->userCatalogueRepository->delete($id);
            DB::commit();
            return true;
        }catch(\Exception $e) {
            DB::rollBack();
            echo $e->getMessage(); die();
            // Log::error($e->getMessage());
            return false;
        }
    }

    public function updateStatus($post = []) {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = (($post['value'] == 1)?2:1);

            $user = $this->userCatalogueRepository->update($post['modelId'],$payload);
            $this->changeUserStatus($post, $payload[$post['field']]);

            DB::commit();
            return true;
        }catch(\Exception $e) {
            DB::rollBack();
            echo $e->getMessage(); die();
            // Log::error($e->getMessage());
            return false;
        }
    }

    public function updateStatusAll($post) {
        DB::beginTransaction();
        try {
            $payload[$post['field']] = $post['value'];
            $flag = $this->userCatalogueRepository->updateByWhereIn('id',$post['id'],$payload);
            $this->changeUserStatus($post,$post['value']);

            DB::commit();
            return true;
        }catch(\Exception $e) {
            DB::rollBack();
            echo $e->getMessage(); die();
            // Log::error($e->getMessage());
            return false;
        }
    }

    private function changeUserStatus($post, $value) {
        
        DB::beginTransaction();
        try {
            $array = [];
            if(isset($post['modelId'])) {
                $array[] = $post['modelId'];
            }else {
                $array = $post['id'];
            }

            $payload[$post['field']] = $value;
            $this->userRepository->updateByWhereIn('user_catalogue_id', $array, $payload);

            DB::commit();
            return true;
        }catch(\Exception $e) {
            DB::rollBack();
            echo $e->getMessage(); die();
            // Log::error($e->getMessage());
            return false;
        }
    }

    private function convertBirthDate($birthday = '') {
        $carbonDate = Carbon::createFromFormat('Y-m-d',$birthday);
        $birthday = $carbonDate->format('Y-m-d H:i:s');
        return $birthday;
    }

    public function paginateSelect() {
        return [
            'id',
            'name',
            'description',
            'publish'
        ];
    }
}
