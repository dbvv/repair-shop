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
    <h5>{{__('order.subtitle')}}</h5>
    <p>{{ __('order.order_data', [
        'id' => $order->id, 
        'date' => \Date::parse($order->created_at)->format('"d" M Y'),
      ]) }}</p>
  </header>
  {{-- end header --}}

  {{-- beginn main --}}
  <main class="container-fluid">
    <div class="row justify-content-between bordered-data">
      <div class="col-sm-5 bordered-data-right">
        <p class="mb-0"><b>{{__('order.workshop_owner')}}</b></p>
        <p class="mb-0">{{ __('order.workshop_owner_iin') }}</p>
        <p class="mb-0">{{ $order->workshop->name }}</p>
        <p class="mb-0">{!! __('order.phone', ['phone' => '8961059913']) !!}</p>
        <p class="mb-0">{{ __('order.opening_hours') }}</p>
        <p>{{ __('order.opening_hours_weekend') }}</p>
      </div>
      <div class="col-sm-2 text-right">
        <p class="mb-0"><b>{{ __('order.client') }}</b></p>
        <p class="mb-0">{{$order->client->name}}</p>
        <p class="mb-0">{{$order->client->address}}</p>
        <p class="mb-0">{{$order->client->phone}}</p>
      </div>
    </div>
    {{-- end credentials --}}

    {{-- data --}}
    <div class="model-data mt-3">
      <div>{{ __('order.apparat') }}: {{ $order->type->name }} {{ $order->brand->name }} {!! $order->model_data !!}</div>
      <div>
        {{__('nomenclature.problem')}}: {!! $order->problem !!}
      </div>

      <div>
        {{__('order.payments')}}: {{$order->client_pay}} | {{$order->price}}
      </div>
    </div>
    {{-- end data --}}

    {{-- small text --}}
    <p class="mt-3"><small>{{ __('order.notices_text') }}</small></p>
    {{-- end small text --}}

    {{-- client autograph --}}
    <div class="client">
      <b>{{__('order.client')}}</b>: ___________________________
    </div>
    {{-- end client autograph --}}

    <div class="aggreement mt-5">
      <p>{{ __('order.agreement') }}</p>
      <p>{{__('order.apparat_get')}}: __________________________</p>
    </div>

    <hr size="3" style="height: 3px; color: black; background-color: black">
  </main>
  {{-- end main --}}
  
  {{-- footer --}}
  <footer>
    <div class="text-center">
      <h5>{{__('order.subtitle')}}</h5>
      <p>{{ __('order.order_data', [
          'id' => $order->id, 
          'date' => \Date::parse($order->created_at)->format('"d" M Y'),
        ]) }}</p>
    </div>

    <div class="order-data">
      <p class="mb-0"><b>{{ __('order.client') }}</b></p>
      <p class="mb-0">{{$order->client->name}} {{$order->client->address}} {{$order->client->phone}}</p>

      <div class="mt-3">{{ __('order.apparat') }}: {{ $order->type->name }} {{ $order->brand->name }} {!! $order->model_data !!}</div>
      <div>
        {{__('nomenclature.problem')}}: {!! $order->problem !!}
      </div>

      <div>
        {{__('order.payments')}}: {{$order->client_pay}} | {{$order->price}}
      </div>
    </div>
  </footer>
  {{-- end footer --}}
</body>
</html>