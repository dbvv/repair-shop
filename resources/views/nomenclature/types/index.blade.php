@extends('layouts.app')

@section('title', __('nomenclature.types'))

@section('content')
  <div class="container">
    <h1>{{ __('nomenclature.types') }}</h1>
    @include('layouts.search')
    <a href="{{ route('nomenclature.type.create') }}" class="btn btn-info float-right">{{ __('nomenclature.create') }}</a>
    <table class="table table-striped table-hover" data-toggle="table" data-locale="ru-RU">
      <thead>
        <tr>
          <th scope="col" data-sortable="true">#</th>
          <th scope="col" data-sortable="true">{{ __('nomenclature.name') }}</th>
          <th scope="col" data-sortable="true">{{ __('nomenclature.created_at') }}</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($types as $type)
        <tr>
          <th scope="row">{{$type->id}}</th>
          <td>{{ $type->name }}</td>
          <td>{{ date('d.m.Y', strtotime($type->created_at)) }}</td>
          <td>
            <form action="{{ route('nomenclature.type.destroy', ['id' => $type->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <a class="btn btn-default btn-sm" href="{{route('nomenclature.type.edit', ['id' => $type->id])}}"><i class="fa fa-edit"></i></a>
              <button class="btn btn-sm"><i class="fa fa-trash"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{$types->links()}}
  </div>
@endsection