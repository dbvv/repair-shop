<?php

use App\Models\Brand;
use App\Models\Client;
use App\Models\Order;
use App\Models\Type;
use App\Models\Workshop;
use Illuminate\Database\Seeder;
use ParseCsv\Csv;
use Carbon\Carbon;

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
      'brands'  => storage_path('app/firms.csv'),
      'types'   => storage_path('app/types.csv'),
      'orders'  => storage_path('app/orders.csv'),
    ];

    // parse clients
    $clientsdb    = new Csv($files['clients']);
    $clients_data = $clientsdb->data;

    if ($clients_data) {
      $clients = [];

      for ($i = 0; $i < count($clients_data); $i++) {
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

    // import brands
    $brandsdb    = new Csv($files['brands']);
    $brands_data = $brandsdb->data;

    if ($brands_data) {
      $brands = [];

      for ($i = 0; $i < count($brands_data); $i++) {
        $brand = $brands_data[$i];

        $brands[] = [
          'id'   => $brand['Id'],
          'name' => $brand['Name'],
        ];
      }
      if (!empty($brands)) {
        Brand::insert($brands);
      }
    }

    // import types
    $typesdb    = new Csv($files['types']);
    $types_data = $typesdb->data;

    if ($types_data) {
      $types = [];

      for ($i = 0; $i < count($types_data); $i++) {
        $type = $types_data[$i];

        $types[] = [
          'id'   => $type['Id'],
          'name' => $type['Name'],
        ];
      }
      if (!empty($types)) {
        Type::insert($types);
      }
    }

    $ordersdb    = new Csv($files['orders']);
    $orders_data = $ordersdb->data;

    if ($orders_data) {
      $orders = [];

      for ($i = 0; $i < count($orders_data); $i++) {
        $order      = $orders_data[$i];
        $created_at = Carbon::parse($order['GetDate'])->format('Y-m-d');
        // Log::info($orders_data[$i]);
        //
        $orders[] = [
          'id'          => $order['Id'],
          'workshop_id' => 1,
          'client_id'   => $order['ClientId'],
          'completed'   => true,
          'created_at'  => $created_at,
          'type_id'     => $order['Type'],
          'brand_id'    => $order['Firm'],
          'model_data'  => $order['Model'] . ', ' . $order['Complection'] . ', ' . $order['Number'],
          'problem'     => $order['Diagnose'],
          'notices'     => $order['MemoField'],
        ];
      }

      if (!empty($orders)) {
        $insert_data = collect($orders);

        $chunks = $insert_data->chunk(250);

        foreach ($chunks as $chunk) {
          Order::insert($chunk->toArray());
        }
      }
    }

    Workshop::create(['name' => 'Ул. Краснополянская 48']);
  }
}
