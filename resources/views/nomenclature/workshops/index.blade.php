@extends('layouts.app')

@section('title', __('nomenclature.workshops'))

@section('content')
  <div class="container">
    <h1>{{ __('nomenclature.workshops') }}</h1>
    @include('layouts.search')
    <a href="{{ route('nomenclature.workshop.create') }}" class="btn btn-info float-right mb-3">{{ __('nomenclature.create') }}</a>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col" data-sortable="true">#</th>
          <th scope="col" data-sortable="true">{{ __('nomenclature.name') }}</th>
          <th scope="col" data-sortable="true">{{ __('nomenclature.created_at') }}</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($workshops as $workshop)
        <tr>
          <th scope="row">{{$workshop->id}}</th>
          <td>{{ $workshop->name }}</td>
          <td>{{ date('d.m.Y', strtotime($workshop->created_at)) }}</td>
          <td>
            <form action="{{ route('nomenclature.workshop.destroy', ['id' => $workshop->id]) }}" method="POST">
              @csrf
              @method('DELETE')
              <a class="btn btn-default btn-sm" href="{{route('nomenclature.workshop.edit', ['id' => $workshop->id])}}"><i class="fa fa-edit"></i></a>
              <button class="btn btn-sm"><i class="fa fa-trash"></i></button>
            </form>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
    {{$workshops->links()}}
  </div>
@endsection