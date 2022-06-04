<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'country_create',
            ],
            [
                'id'    => 18,
                'title' => 'country_edit',
            ],
            [
                'id'    => 19,
                'title' => 'country_show',
            ],
            [
                'id'    => 20,
                'title' => 'country_delete',
            ],
            [
                'id'    => 21,
                'title' => 'country_access',
            ],
            [
                'id'    => 22,
                'title' => 'city_create',
            ],
            [
                'id'    => 23,
                'title' => 'city_edit',
            ],
            [
                'id'    => 24,
                'title' => 'city_show',
            ],
            [
                'id'    => 25,
                'title' => 'city_delete',
            ],
            [
                'id'    => 26,
                'title' => 'city_access',
            ],
            [
                'id'    => 27,
                'title' => 'area_create',
            ],
            [
                'id'    => 28,
                'title' => 'area_edit',
            ],
            [
                'id'    => 29,
                'title' => 'area_show',
            ],
            [
                'id'    => 30,
                'title' => 'area_delete',
            ],
            [
                'id'    => 31,
                'title' => 'area_access',
            ],
            [
                'id'    => 32,
                'title' => 'category_create',
            ],
            [
                'id'    => 33,
                'title' => 'category_edit',
            ],
            [
                'id'    => 34,
                'title' => 'category_show',
            ],
            [
                'id'    => 35,
                'title' => 'category_delete',
            ],
            [
                'id'    => 36,
                'title' => 'category_access',
            ],
            [
                'id'    => 37,
                'title' => 'feature_create',
            ],
            [
                'id'    => 38,
                'title' => 'feature_edit',
            ],
            [
                'id'    => 39,
                'title' => 'feature_show',
            ],
            [
                'id'    => 40,
                'title' => 'feature_delete',
            ],
            [
                'id'    => 41,
                'title' => 'feature_access',
            ],
            [
                'id'    => 42,
                'title' => 'place_create',
            ],
            [
                'id'    => 43,
                'title' => 'place_edit',
            ],
            [
                'id'    => 44,
                'title' => 'place_show',
            ],
            [
                'id'    => 45,
                'title' => 'place_delete',
            ],
            [
                'id'    => 46,
                'title' => 'place_access',
            ],
            [
                'id'    => 47,
                'title' => 'item_review_create',
            ],
            [
                'id'    => 48,
                'title' => 'item_review_edit',
            ],
            [
                'id'    => 49,
                'title' => 'item_review_show',
            ],
            [
                'id'    => 50,
                'title' => 'item_review_delete',
            ],
            [
                'id'    => 51,
                'title' => 'item_review_access',
            ],
            [
                'id'    => 52,
                'title' => 'home_page_access',
            ],
            [
                'id'    => 53,
                'title' => 'home_slider_create',
            ],
            [
                'id'    => 54,
                'title' => 'home_slider_edit',
            ],
            [
                'id'    => 55,
                'title' => 'home_slider_show',
            ],
            [
                'id'    => 56,
                'title' => 'home_slider_delete',
            ],
            [
                'id'    => 57,
                'title' => 'home_slider_access',
            ],
            [
                'id'    => 58,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
