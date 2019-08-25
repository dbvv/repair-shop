@extends('layouts.app')

@section('title', __('order.all'))

@section('content')
<div class="container">
    <h1>{{ __('order.all') }}</h1>
    <a href="{{ route('order.create') }}" class="btn btn-info float-right">{{ __('nomenclature.create') }}</a>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">{{ __('nomenclature.created_at') }}</th>
          <th scope="col">{{ __('order.apparat') }}</th>
          <th scope="col">{{ __('nomenclature.client') }}</th>
          <th scope="col">{{ __('nomenclature.workshop') }}</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($orders as $order)
        <tr>
          <th scope="row">{{$order->id}}</th>
          <td>{{ date('d.m.Y', strtotime($order->created_at)) }}</td>
          <td>{{ $order->type->name . ' ' . $order->brand->name }}</td>
          <td>{{ $order->client->name . ' ' . $order->client->phone }}</td>
          <td>{{ $order->workshop->name }}</td>
          <td>
            <form action="{{ route('order.destroy', ['id' => $order->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <a href="#" class="btn btn-default btn-sm"><i class="fa fa-print"></i></a>
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
@endsection