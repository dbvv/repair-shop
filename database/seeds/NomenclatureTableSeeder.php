<?php

use Illuminate\Database\Seeder;
use App\Models\Brand;
use App\Models\Client;
use App\Models\Type;
use App\Models\Workshop;

class NomenclatureTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::create(['name' => 'iPhone']);
        Brand::create(['name' => 'iMac']);
        Brand::create(['name' => 'Samsung']);
        Brand::create(['name' => 'Prestigio']);

        Client::create(['name' => 'Client name', 'phone' => '+77777777777', 'address' => 'У черта на куличках']);

        Type::create(['name' => 'Планшет']);
        Type::create(['name' => 'Смартфон']);
        Type::create(['name' => 'Ноутбук']);

        Workshop::create(['name' => 'Ул. Такая 5']);
    }
}
