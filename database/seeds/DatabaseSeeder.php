<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {



        $this->call([
            //ActuadorTableSeed::class
        ]);

        factory(\App\Escuchador::class)->times(100)->create();
    }
}
