<?php


use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'name' => 'feebf2ce8e41247d0a2c533af8bd4e6a',
                'password' => '8c1e53f478de2be125953060b1223996'
            ]
        ];
        
        $users = $this->table('users');
        $users->insert($data)->save();
    }
}
