<?php

use Illuminate\Database\Seeder;
use App\Models\Company;


class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);

        Company::unguard();

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        DB::table('Companies')->truncate();
        $this->call('CompaniesTableSeeder');

        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        Company::reguard();
    }
}
