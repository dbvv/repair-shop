<?php

use App\Models\Brand;
use App\Models\Client;
use App\Models\Type;
use App\Models\Workshop;
use Illuminate\Database\Seeder;
use ParseCsv\Csv;

class NomenclatureTableSeeder extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $files = [
      'clients' => storage_path('app/clients.csv'),
    ];

    // parse clients
    $clientsdb    = new Csv($files['clients']);
    $clients_data = $clientsdb->data;

    if ($clients_data) {
      $clients = [];

      for ($i = 0; $i < count($clients_data); $i++) {
        // Log::info($clients_data[$i]);
        $client    = $clients_data[$i];
        $clients[] = [
          'id'      => $client['Id'],
          'name'    => $client['Name'],
          'address' => $client['Address'],
          'phone'   => $client['PhoneH'] . ' ' . $client['PhoneW'],
        ];
      }

      if (!empty($clients)) {
        Client::insert($clients);
      }
    }

    Brand::create(['name' => 'iPhone']);
    Brand::create(['name' => 'iMac']);
    Brand::create(['name' => 'Samsung']);
    Brand::create(['name' => 'Prestigio']);

    Type::create(['name' => 'Планшет']);
    Type::create(['name' => 'Смартфон']);
    Type::create(['name' => 'Ноутбук']);

    Workshop::create(['name' => 'Ул. Такая 5']);
  }
}
