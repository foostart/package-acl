<?php namespace Foostart\Acl\Database;

use Foostart\Acl\Library\Constants\FoostartConstants;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\App;

/**
 * Class PermissionSeeder
 *
 * @author Foostart foostart.com@gmail.com
 */

class PermissionSeeder extends Seeder
{
    public function run()
    {
        $permission_repository = App::make('permission_repository');

        // Clear data before create sample data
        $permission_repository->truncate();

        $permission1 = [
            "name" => "superadmin",
            "permission" => "_superadmin",
        ];
        $permission_repository->create($permission1);
        $permission2 = [
            "name" => "user editor",
            "permission" => "_user-editor",
        ];
        $permission_repository->create($permission2);
        $permission3 = [
            "name" => "group editor",
            "permission" => "_group-editor",

        ];
        $permission_repository->create($permission3);
        $permission4 = [
            "name" => "permission editor",
            "permission" => "_permission-editor",
        ];
        $permission_repository->create($permission4);
        $permission5 = [
            "name" => "profile type editor",
            "permission" => "_profile-editor",
        ];
        $permission_repository->create($permission5);

        // Create sample data for testing
        $this->createSampleData();
    }

    /**
     * Create sample data for testing
     */
    private function createSampleData() {
        $permission_repository = App::make('permission_repository');

        $isCreateSampleData =  env('DB_SAMPLE_TEST');
        if ($isCreateSampleData == FoostartConstants::IS_CREATE_SAMPLE_DATA) {
            $group_repository = App::make('group_repository');
            for($i = 0; $i < FoostartConstants::SAMPLE_DATA_SIZE; $i++) {
                $permission = [
                    "name" => "Permission test ".$i,
                    "permission" => "permission_test_".$i,
                ];
                $permission_repository->create($permission);
            }
        }
    }
}
