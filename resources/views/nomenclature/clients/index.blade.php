@extends('layouts.app')

@section('title', __('nomenclature.clients'))

@section('content')
  <div class="container">
    <h1>{{ __('nomenclature.clients') }}</h1>
    <a href="{{ route('nomenclature.client.create') }}" class="btn btn-info float-right">{{ __('nomenclature.create') }}</a>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">{{ __('nomenclature.client_name') }}</th>
          <th scope="col">{{ __('nomenclature.client_address') }}</th>
          <th scope="col">{{ __('nomenclature.client_phone') }}</th>
          <th scope="col">{{ __('nomenclature.created_at') }}</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($clients as $client)
        <tr>
          <th scope="row">{{$client->id}}</th>
          <td>{{ $client->name }}</td>
          <td>{{ $client->address }}</td>
          <td>{{ $client->phone }}</td>
          <td>{{ date('d.m.Y', strtotime($client->created_at)) }}</td>
          <td>
            <form action="{{ route('nomenclature.client.destroy', ['id' => $client->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <a class="btn btn-default btn-sm" href="{{route('nomenclature.client.edit', ['id' => $client->id])}}"><i class="fa fa-edit"></i></a>
              <button class="btn btn-sm"><i class="fa fa-trash"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{$clients->links()}}
  </div>
@endsection