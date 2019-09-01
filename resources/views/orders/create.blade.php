@extends('layouts.app')

@section('title', __('order.create'))

@section('content')
  <div class="container">
    <h1>{{ __('order.create') }}</h1>
    <a href="{{route('order.index')}}">{{__('order.all')}}</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('order.create') }}</div>

                <div class="card-body">
                  @if (count($errors) > 0)
                    <div class="alert alert-danger">
                      <ul>
                        @foreach ($errors->all() as $error)
                          <li>{{ $error }}</li>
                        @endforeach
                      </ul>
                    </div>
                  @endif
                    <form method="POST" action="{{ route('order.store') }}">
                        @csrf

                        {{-- client_id --}}
                        <div class="form-group {{ $errors->has('client_id') ? 'has-danger' : ''}}">
                            <label class="control-label requiredField" for="client">
                                {{__('nomenclature.client')}}
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                            <input type="hidden" name="client_id" value="{{old('client_id')}}">
                            <input required="true" class="form-control clientSelect {{ $errors->has('client_id') ? 'form-control-danger' : ''}}" id="client" name="client" type="text" value="{{isset($proposal) && $proposal->client != null ? $proposal->client->name . ' (' . $proposal->client->phone . ') ' : old('client')}}" autofocus />
                            @if($errors->has('client_id'))
                              <div class="form-control-feedback">{{ $errors->first('client_id')}}</div>
                            @endif

                            <br>

                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                              {{__('nomenclature.client_create')}}
                            </button>
                        </div>
                        {{-- end client_id --}}

                        {{-- type --}}
                        <div class="form-group {{ $errors->has('type_id') ? 'has-danger' : ''}}">
                            <label class="control-label requiredField" for="type_id">
                                {{__('nomenclature.type')}}
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                            <select name="type_id" id="type_id" class="form-control {{ $errors->has('client_id') ? 'form-control-danger' : ''}}">
                              <option value="">{{ __('order.select_this') }}</option>
                              @foreach($types as $type)
                                <option value="{{$type->id}}">{{ $type->name }}</option>
                              @endforeach
                            </select>
                            @if($errors->has('type_id'))
                              <div class="form-control-feedback">{{ $errors->first('type_id')}}</div>
                            @endif
                        </div>
                        {{-- end type --}}

                        {{-- brand_id --}}
                        <div class="form-group {{ $errors->has('brand_id') ? 'has-danger' : ''}}">
                            <label class="control-label requiredField" for="brand_id">
                                {{__('nomenclature.brand')}}
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                            <select name="brand_id" id="brand_id" class="form-control {{ $errors->has('brand_id') ? 'form-control-danger' : ''}}">
                              <option value="">{{ __('order.select_this') }}</option>
                              @foreach($brands as $brand)
                                <option value="{{$brand->id}}">{{ $brand->name }}</option>
                              @endforeach
                            </select>
                            @if($errors->has('brand_id_id'))
                              <div class="form-control-feedback">{{ $errors->first('brand_id')}}</div>
                            @endif
                        </div>
                        {{-- end brand_id --}}

                        <div class="form-group row">
                            <label for="imei" class="col-md-4 col-form-label text-md-right">{{ __('IMEI') }}</label>

                            <div class="col-md-6">
                                <input id="imei" type="text" class="form-control @error('imei') is-invalid @enderror" name="imei" value="{{ old('imei') }}" >

                                @error('imei')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- model_data --}}
                        <div class="form-group {{ $errors->has('model_data') ? 'has-danger' : ''}}">
                            <label class="control-label requiredField" for="model_data">
                                {{__('nomenclature.model_data')}}
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                            <textarea name="model_data" id="model_data" cols="30" rows="5" class="tinymce form-control com-sm-12 clearfix">{{old('model_data')}}</textarea>
                            @if($errors->has('model_data'))
                              <div class="form-control-feedback">{{ $errors->first('model_data')}}</div>
                            @endif
                        </div>
                        {{-- end model_data_id --}}

                        {{-- workshop_id --}}
                        <div class="form-group {{ $errors->has('workshop_id') ? 'has-danger' : ''}}">
                            <label class="control-label requiredField" for="workshop_id">
                                {{__('nomenclature.workshop')}}
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                            <select name="workshop_id" id="workshop_id" class="form-control {{ $errors->has('workshop_id') ? 'form-control-danger' : ''}}">
                              <option value="">{{ __('order.select_this') }}</option>
                              @foreach($workshops as $workshop)
                                <option value="{{$workshop->id}}">{{ $workshop->name }}</option>
                              @endforeach
                            </select>
                            @if($errors->has('workshop_id_id'))
                              <div class="form-control-feedback">{{ $errors->first('workshop_id')}}</div>
                            @endif
                        </div>
                        {{-- end workshop_id --}}

                        

                        {{-- problem --}}
                        <div class="form-group {{ $errors->has('problem') ? 'has-danger' : ''}}">
                            <label class="control-label requiredField" for="problem">
                                {{__('nomenclature.problem')}}
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                            <textarea name="problem" id="problem" cols="30" rows="5" class="tinymce form-control">{{old('problem')}}</textarea>
                            @if($errors->has('problem'))
                              <div class="form-control-feedback">{{ $errors->first('problem')}}</div>
                            @endif
                        </div>
                        {{-- end problem --}}

                        {{-- price --}}
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('order.price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') }}"  autocomplete="price">

                                @error('price')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- end price --}}

                        {{-- client pay --}}
                        <div class="form-group row">
                            <label for="client_pay" class="col-md-4 col-form-label text-md-right">{{ __('nomenclature.client_pay') }}</label>

                            <div class="col-md-6">
                                <input id="client_pay" type="number" class="form-control @error('client_pay') is-invalid @enderror" name="client_pay" value="{{ old('client_pay') }}"  autocomplete="client_pay">

                                @error('client_pay')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- end client_py --}}

                        {{-- notices --}}
                        <div class="form-group {{ $errors->has('notices') ? 'has-danger' : ''}}">
                            <label class="control-label requiredField" for="notices">
                                {{__('nomenclature.notices')}}
                            </label>
                            <textarea name="notices" id="notices" cols="30" rows="5" class="tinymce form-control">{{old('notices')}}</textarea>
                            @if($errors->has('notices'))
                              <div class="form-control-feedback">{{ $errors->first('notices')}}</div>
                            @endif
                        </div>
                        {{-- end notices --}}

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

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">
            {{__('nomenclature.client_create')}}
        </h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="clientCreateModalForm" method="POST" action="{{ route('nomenclature.client.store') }}">
            @csrf

            <div class="form-group row">
                <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('nomenclature.client_name') }}</label>

                <div class="col-md-6">
                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('nomenclature.client_phone') }}</label>

                <div class="col-md-6">
                    <input id="phone" type="text" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" autocomplete="phone" autofocus>

                    @error('phone')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>

            <div class="form-group row">
                <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('nomenclature.client_address') }}</label>

                <div class="col-md-6">
                    <input id="address" type="text" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" autocomplete="address" autofocus>

                    @error('address')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">{{ __('nomenclature.close') }}</button>
        <button type="button" class="btn btn-primary" id="saveClientModal">{{ __('nomenclature.save') }}</button>
      </div>
    </div>
  </div>
</div>

@endsection