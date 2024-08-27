<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
      Role::create(['name' => 'administrator']);
      Role::create(['name' => 'kanit']);
      Role::create(['name' => 'panit']);
      Role::create(['name' => 'banit']);

      $user = [
        [
          'username' => 'administrator',
          'name' => 'Administrator',
          'password' => bcrypt(12345),
          'role' => 'administrator',
        ],
        [
          'username' => 'kanit2',
          'name' => 'ERICSON SIREGAR, S.Kom., M.T., M.Sc.',
          'pangkat_id' => 8,
          'jabatan' => 'KANIT II',
          'unit_id' => 2,
          'den_id' => 1,
          'password' => bcrypt(12345),
          'role' => 'kanit',
        ],
        [
          'username' => 'panit2_1',
          'name' => 'ACHMAD HUSNI IMAWAN, S.Tr.K., S.I.K.',
          'pangkat_id' => 8,
          'jabatan' => 'PANIT II',
          'unit_id' => 2,
          'den_id' => 1,
          'password' => bcrypt(12345),
          'role' => 'panit',
        ],
        [
          'username' => 'panit2_2',
          'name' => 'APRI AJI SETYAWAN, S.H., M.M.',
          'pangkat_id' => 9,
          'jabatan' => 'PANIT II',
          'unit_id' => 2,
          'den_id' => 1,
          'password' => bcrypt(12345),
          'role' => 'panit',
        ],
        [
          'username' => 'banit2_1',
          'name' => 'YOBIE ARI YUANDANA',
          'pangkat_id' => 15,
          'jabatan' => 'BANIT II',
          'unit_id' => 2,
          'den_id' => 1,
          'password' => bcrypt(12345),
          'role' => 'banit',
        ],
        [
          'username' => 'banit2_2',
          'name' => 'SANDI YUDHA WIRATAMA, S.H., M.H.',
          'pangkat_id' => 15,
          'jabatan' => 'BANIT II',
          'unit_id' => 2,
          'den_id' => 1,
          'password' => bcrypt(12345),
          'role' => 'banit',
        ],
        [
          'username' => 'banit2_1',
          'name' => 'MUHAMMAD FADEL ALFARISI',
          'pangkat_id' => 15,
          'jabatan' => 'BANIT II',
          'unit_id' => 2,
          'den_id' => 1,
          'password' => bcrypt(12345),
          'role' => 'banit',
        ],
      ];

        foreach ($user as $val) {
          $userData = collect($val)->except('role')->toArray();

          $user = User::create($userData);
          $user->assignRole($val['role']);
        }
    }
}
