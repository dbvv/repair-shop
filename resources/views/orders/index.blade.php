@extends('layouts.app')

@section('title', __('order.all'))

@section('content')
<div class="container">
    <h1>{{ __('order.all') }}</h1>
    @include('layouts.search')
    <a href="{{ route('order.create') }}" class="btn btn-info float-right">{{ __('nomenclature.create') }}</a>
    <table class="table table-striped table-hover" data-toggle="table">
      <thead>
        <tr>
          <th scope="col" data-field="id" data-sortable="true">#</th>
          <th scope="col" data-field="created_at" data-sortable="true">{{ __('nomenclature.created_at') }}</th>
          <th scope="col" data-field="apparat" data-sortable="true" style="width: 20%">{{ __('order.apparat') }}</th>
          <th scope="col" data-field="client" data-sortable="true">{{ __('nomenclature.client') }}</th>
          <th scope="col" data-field="workshop" data-sortable="true">{{ __('nomenclature.workshop') }}</th>
          <th scope="col" data-field="edit" data-width="15" data-width-unit="%"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
        <tr>
          <th scope="row">{{$order->id}}</th>
          <td>{{ date('d.m.Y', strtotime($order->created_at)) }}</td>
          <td>{{ $order->type->name . ' ' . $order->brand->name . ' ' . $order->model_data }}</td>
          <td>{{ $order->client->name . ' ' . $order->client->phone }}</td>
          <td>{{ $order->workshop->name }}</td>
          <td>
            <form action="{{ route('order.destroy', ['id' => $order->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <a href="#" onclick="return showOrderModal({{$order->id}})" class="btn btn-default"><i class="fa fa-eye"></i></a>
              <a href="{{route('print', ['orderID' => $order->id])}}" target="_blank" class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>
              <a class="btn btn-default btn-sm" href="{{route('order.edit', ['id' => $order->id])}}"><i class="fa fa-edit"></i></a>
              <button class="btn btn-sm"><i class="fa fa-trash"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{$orders->links()}}
  </div>

  {{-- order session modal --}}
  @if(session('order_id'))
  @php
    $orderR = App\Models\Order::find(session('order_id'));
  @endphp
  <!-- Modal -->
  <div class="modal fade" id="recentlyCreatedOrder" tabindex="-1" role="dialog" aria-labelledby="recentlyCreatedOrderTitle" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLongTitle">{{$orderR->id }}</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div class="modal-order-form">
            @include('orders.preview', ['order' => $orderR])
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('nomenclature.close')}}</button>
          <button type="button" class="btn btn-primary">{{__('nomenclature.save')}}</button>
        </div>
      </div>
    </div>
  </div>
  <script>
    window.onload = function () {
      $('#recentlyCreatedOrder').modal('show');
    }
  </script>
  @endif

  {{-- end order session modal --}}

  {{-- script with modal --}}
  <div class="modal fade" id="modalShowOrder" tabindex="-1" role="dialog" aria-labelledby="modalShowOrderTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalsShowOrderLongTitle"></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <div id="modalPreviewForm" class="modal-order-form">
            <iframe frameborder="0" id="model-data-iframe" style="width: 100%; height: 100%; min-height: 290mm"></iframe>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('nomenclature.close')}}</button>
          <button id="modalPrintButton" type="button" data-id="" onclick="goToPrint()" class="btn btn-primary">
            <i class="fa fa-print"></i>
          </button>
        </div>
      </div>
    </div>
  </div>
  <script>
    function showOrderModal(orderID) {
      var $modalShowOrder = $('#modalShowOrder');
      $('#modalsShowOrderLongTitle').html('#' + orderID);
      axios.get('{{ route('order.index') }}/' + orderID)
        .then(data => {
          $('#modalPrintButton').attr('data-id', orderID);
          var hideprintButton = "<style>#print-button{display:none !important}\<\/style>";
          $('#model-data-iframe').contents().find('html').html(data.data + hideprintButton);

        })
      $modalShowOrder.modal('show');
    }

    function goToPrint() {
      var orderID = $('#modalPrintButton').attr('data-id');
      if (orderID) {
        var redirectUrl = '{{url('/')}}/print/' + orderID;
        window.open(redirectUrl, '_blank');
      }
    }
  </script>
  {{-- script with modal --}}
@endsection