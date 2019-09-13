<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>{{__('order.show', ['id' => $order->id])}}</title>
  <link rel="stylesheet" href="{{ asset('css/app.css') }}">
  <style>
  @media screen {
    html, body {
        max-width: 210mm;
        max-height: 297mm;
        margin: 1cm auto;
      }
  }
  .print {
    position: fixed;
    top: 1cm;
    left: 1cm;
  }
  .print a i {
    font-size: 32px;
  }
  @page {
    size: A4;
    margin: 0;
  }
  @media print {
    .print {
      display: none;
    }
    * {
      font-size: 18px;
      line-height: 20px;
    }
    html, body {
      width: 210mm;
      height: 297mm;

    }
    /* ... the rest of the rules ... */
    body {
        padding: 2cm 1cm;
        margin: 0;
        overflow: hidden;
        position: relative;
        box-sizing: border-box;
        page-break-after: always
    }
    .hr {
      width: 100%;
      border-bottom: 3px solid black;
    }
  }
  .hr {
    width: 100%;
    height: 3px;
    color: black !important; 
    background-color: black !important;
  }
  </style>
</head>
<body>
  <div class="print" id="print-button">
    <a href="#" onclick="window.print(); return false;"><i class="fa fa-print"></i></a>
  </div>
  {{-- begin header --}}
  <header class="text-center mb-5">
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
    {{-- credentials --}}
    <div class="row mb-5 justify-content-between bordered-data">
      <div class="col-sm-5 bordered-data-right">
        <p class="mb-0"><b>{{__('order.workshop_owner')}}</b></p>
        <p class="mb-0">{{ __('order.workshop_owner_iin') }}</p>
        <p class="mb-0">{{ $order->workshop->name }}</p>
        <p class="mb-0">{!! __('order.phone', ['phone' => '+7 (961) 059-99-13']) !!}</p>
        <p class="mb-0">{{ __('order.opening_hours') }}</p>
        <p>{{ __('order.opening_hours_weekend') }}</p>
      </div>
      <div class="col-sm-3 text-right">
        <p class="mb-0"><b>{{ __('order.client') }}</b></p>
        <p class="mb-0">{{$order->client->name}}</p>
        <p class="mb-0">{{$order->client->address}}</p>
        <p class="mb-0">{{$order->client->phone}}</p>
      </div>
    </div>
    {{-- end credentials --}}

    {{-- data --}}
    <div class="model-data mt-3 mb-5">
      <div>{{ __('order.apparat') }}: {{ $order->type->name }} {{ $order->brand->name }} {!! $order->model_data !!} {{ $order->imei ? ' IMEI: ' . $order->imei : '' }}</div>
      <div>
        {{__('nomenclature.problem')}}: {!! $order->problem !!}
      </div>
      @if($order->client_pay && $order->price)
        <div>
          {{__('order.payments')}}: {{$order->client_pay}}₽ / {{$order->price}}₽
        </div>
      @endif
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

    <div class="hr mb-5 mt-5"></div>
  </main>
  {{-- end main --}}
  
  {{-- footer --}}
  <footer class="container-fluid">
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

      @if($order->client_pay && $order->price)
      <div>
        {{__('order.payments')}}: {{$order->client_pay}}₽ / {{$order->price}}₽
      </div>
      @endif
    </div>
  </footer>
  {{-- end footer --}}
</body>
</html>