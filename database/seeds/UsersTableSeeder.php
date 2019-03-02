<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    use DatabaseTrait;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = now();
        $this->disableForeignKeys();
        $this->truncate('users');
        $defaultUsers = [
            [
                'name' => 'System Admin',
                'email' => 'system@admin.com',
                'email_verified_at' => $now,
                'password' => bcrypt(generateRandomString(32)),
                'remember_token' => str_random(10),
                'active' => 1,
                'verify' => 1,
                'agree' => 1,
                'role' => 'all'
            ],
            [

                'name' => 'Supermost Admin',
                'email' => env('SUPERMOST_ADMIN_EMAIL'),
                'email_verified_at' => $now,
                'password' => bcrypt(env('SUPERMOST_ADMIN_EMAIL')),
                'remember_token' => str_random(10),
                'active' => 1,
                'verify' => 1,
                'agree' => 1,
                'role' => 'all'
            ],
            [

                'name' => 'Account Manager',
                'email' => 'account@manager.com',
                'email_verified_at' => $now,
//                'password' => bcrypt(generateRandomString(16)), // secret
                'password' => bcrypt(env('SUPERMOST_ADMIN_EMAIL')),
                'remember_token' => str_random(10),
                'active' => 1,
                'verify' => 1,
                'agree' => 1,
                'role' => 'admin'
            ],
            [

                'name' => 'Guest',
                'email' => 'guest@admin.com',
                'email_verified_at' => $now,
//                'password' => bcrypt(generateRandomString(16)), // secret
                'password' => bcrypt(env('SUPERMOST_ADMIN_EMAIL')),
                'remember_token' => str_random(10),
                'active' => 1,
                'verify' => 1,
                'agree' => 1,
                'role' => 'admin'
            ]
        ];
        $bulkInsert = [];
        foreach ($defaultUsers as $k => $user) {
            $role = $user['role'];
            unset($user['role']);

            $user = new \App\Entities\User($user);

            if ($role == 'all') {
                $user->assignRole(\App\Entities\Acl\Role\Role::all());
            } else {
                $user->assignRole($role);
            }

            try {
                DB::beginTransaction();
                $user->save();
                DB::commit();
                event( new \App\Events\User\RegisterEvent($user));
                $bulkInsert[$k]['user'] = $user;
            } catch (Exception $exception) {
                $bulkInsert[$k]['error'] = $exception->getMessage();
            }
        }

        // Fake user creation.
        factory(\App\Entities\User::class, 500)->create();


    }
}
