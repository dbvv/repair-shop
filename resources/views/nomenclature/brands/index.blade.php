@extends('layouts.app')

@section('title', __('nomenclature.brands'))

@section('content')
  <div class="container">
    <h1>{{ __('nomenclature.brands') }}</h1>
    <a href="{{ route('nomenclature.brand.create') }}" class="btn btn-info">{{ __('nomenclature.create') }}</a>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">{{ __('nomenclature.name') }}</th>
          <th scope="col">{{ __('nomenclature.created_at') }}</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($brands as $brand)
        <tr>
          <th scope="row">{{$brand->id}}</th>
          <td>{{ $brand->name }}</td>
          <td>{{ date('d.m.Y', strtotime($brand->created_at)) }}</td>
          <td>
            <form action="{{ route('nomenclature.brand.destroy', ['id' => $brand->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <a class="btn btn-default btn-sm" href="{{route('nomenclature.brand.edit', ['id' => $brand->id])}}"><i class="fa fa-edit"></i></a>
              <button class="btn btn-sm"><i class="fa fa-trash"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{$brands->links()}}
  </div>
@endsection