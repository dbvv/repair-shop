<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{__('order.show', ['id' => $order->id])}}</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
  {{-- begin header --}}
  <header class="text-center">
    <h1>{{ __('order.workshop') }}</h1>
    <h3>{{__('order.subtitle')}}</h3>
    <p>{{ __('order.order_data', [
        'id' => $order->id, 
        'date' => \Date::parse($order->created_at)->format('"d" M Y'),
      ]) }}</p>
  </header>
  {{-- end header --}}

  {{-- beginn main --}}
  <main class="container-fluid">
    <row class="justify-between bordered-data">
      <div class="col-sm-5 bordered-data-right">
        <p class="mb-0"><b>{{__('order.workshop_owner')}}</b></p>
        <p class="mb-0">{{ __('order.workshop_owner_iin') }}</p>
        <p class="mb-0">{{ $order->workshop->name }}</p>
        <p class="mb-0">{!! __('order.phone', ['phone' => '8961059913']) !!}</p>
        <p class="mb-0">{{ __('order.opening_hours') }}</p>
        <p class="mb-0">{{ __('order.opening_hours_weekend') }}</p>
      </div>
    </row>
  </main>
  {{-- end main --}}
</body>
</html>