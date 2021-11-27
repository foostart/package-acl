<?php namespace Foostart\Acl\Database;

use Foostart\Acl\Library\Constants\FoostartConstants;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model as Eloquent;
use Illuminate\Support\Facades\App;

/**
 * Class GroupsSeeder
 *
 * @author Foostart foostart.com@gmail.com
 * @property mixed group_repository
 */
class GroupsSeeder extends Seeder
{

    public function run()
    {
        $group_repository = App::make('group_repository');

        // Clear data before create sample data
        $group_repository->truncate();

        $group1 = [
            "name" => "superadmin",
            "permissions" => ["_superadmin" => 1]
        ];

        $group_repository->create($group1);

        $group2 = [
            "name" => "editor",
            "permissions" => ["_user-editor" => 1, "_group-editor" => 1]
        ];

        $group_repository->create($group2);

        $group3 = [
            "name" => "base admin",
            "permissions" => ["_user-editor" => 1]
        ];

        $group_repository->create($group3);

        $this->createSampleData();

    }

    /**
     * Create sample data for testing
     */
    private function createSampleData() {
       $isCreateSampleData =  env('DB_SAMPLE_TEST', FoostartConstants::IS_CREATE_SAMPLE_DATA);
       if ($isCreateSampleData == FoostartConstants::IS_CREATE_SAMPLE_DATA) {
           $group_repository = App::make('group_repository');
            for($i = 0; $i < FoostartConstants::SAMPLE_DATA_SIZE; $i++) {
                $group = [
                    "name" => "group_test_".$i,
                    "permissions" => ["permission_test_".$i => 1]
                ];
                $group_repository->create($group);
            }
       }
    }
}
