@extends('layouts.app')

@section('title', __('nomenclature.brand_edit', ['name' => $brand->name]))

@section('content')
<div class="container">
    <h1>{{ __('nomenclature.brand_edit', ['name' => $brand->name]) }}</h1>
    <a href="{{route('nomenclature.brand.index')}}">{{__('nomenclature.brands')}}</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('nomenclature.brand_edit', ['name' => $brand->name]) }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('nomenclature.brand.update', ['id' => $brand->id]) }}">
                        @csrf
                        @method('PATCH')

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('nomenclature.name') }}</label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') ? old('name') : $brand->name }}" required autocomplete="name" autofocus>

                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('nomenclature.save') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
