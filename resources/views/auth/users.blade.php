@extends('layouts.app')

@section('title', __('users.all'))

@section('content')
<div class="container">
    <h1>{{ __('users.all') }}</h1>
    <a href="{{ route('invite') }}" class="btn btn-info">{{ __('users.invite') }}</a>
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">{{ __('users.name') }}</th>
          <th scope="col">{{ __('users.email') }}</th>
          <th scope="col">{{ __('users.role') }}</th>
          <th scope="col">{{ __('nomenclature.created_at') }}</th>
          <th scope="col"></th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <th scope="row">{{$user->id}}</th>
          <td>{{ $user->name }}</td>
          <td>{{ $user->email }}</td>
          <td>{{ $user->getRoleNames()->implode(', ') }}</td>
          <td>{{ date('d.m.Y', strtotime($user->created_at)) }}</td>
          <td>
            <div class="row">
              <form action="{{ route('users.destroy', ['id' => $user->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm"><i class="fa fa-trash"></i></button>
              </form>
              <form action="{{ route('users.assign-admin', ['id' => $user->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <button class="btn btn-info btn-sm"><i class="fa fa-user-plus"></i>Дать админку</button>
              </form>
              <form action="{{ route('users.revoke-admin', ['id' => $user->id]) }}" method="POST">
                @csrf
                <input type="hidden" name="user_id" value="{{ $user->id }}">
                <button class="btn btn-danger btn-sm"><i class="fa fa-user-plus"></i>Забрать админку</button>
              </form>
            </div>
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
@endsection