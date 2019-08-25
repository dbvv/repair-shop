@extends('layouts.app')

@section('title', __('order.update', ['order' => $order->id]))

@section('content')
  <div class="container">
    <h1>{{ __('order.update', ['order' => $order->id]) }}</h1>
    <a href="{{route('order.index')}}">{{__('order.all')}}</a>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('order.update', ['order' => $order->id]) }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('order.update', ['id' => $order->id]) }}">
                        @csrf
                        @method('PATCH')

                        {{-- client_id --}}
                        <div class="form-group {{ $errors->has('client_id') ? 'has-danger' : ''}}">
                            <label class="control-label requiredField" for="client">
                                {{__('nomenclature.client')}}
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                            <input type="hidden" name="client_id" value="{{ old('client_id') ? old('client_id') : $order->client->id }}">
                            <input required="true" class="form-control clientSelect {{ $errors->has('client_id') ? 'form-control-danger' : ''}}" id="client" name="client" type="text" value="{{old('client') ? old('client') : $order->client->name . ' (' . $order->client->phone . ') '}}" autofocus />
                            @if($errors->has('client_id'))
                              <div class="form-control-feedback">{{ $errors->first('client_id')}}</div>
                            @endif
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
                            <select name="type_id" id="type_id" class="form-control {{ $errors->has('type_id') ? 'form-control-danger' : ''}}">
                              <option value="">{{ __('order.select_this') }}</option>
                              @foreach($types as $type)
                                <option @if(old('type_id') === $type->id || $order->type_id === $type->id) selected="true" @endif value="{{$type->id}}">{{ $type->name }}</option>
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
                                <option @if(old('brand_id') === $brand->id || $order->brand_id === $brand->id) selected="true" @endif value="{{$brand->id}}">{{ $brand->name }}</option>
                              @endforeach
                            </select>
                            @if($errors->has('brand_id_id'))
                              <div class="form-control-feedback">{{ $errors->first('brand_id')}}</div>
                            @endif
                        </div>
                        {{-- end brand_id --}}

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
                                <option @if(old('workshop_id') === $workshop->id || $order->workshop_id === $workshop->id) selected="true" @endif value="{{$workshop->id}}">{{ $workshop->name }}</option>
                              @endforeach
                            </select>
                            @if($errors->has('workshop_id_id'))
                              <div class="form-control-feedback">{{ $errors->first('workshop_id')}}</div>
                            @endif
                        </div>
                        {{-- end workshop_id --}}

                        {{-- model_data --}}
                        <div class="form-group {{ $errors->has('model_data') ? 'has-danger' : ''}}">
                            <label class="control-label requiredField" for="model_data">
                                {{__('nomenclature.model_data')}}
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                            <textarea name="model_data" id="model_data" cols="30" rows="10" class="tinymce form-control">
                              {!! old('model_data') ? old('model_data') : $order->model_data !!}
                            </textarea>
                            @if($errors->has('model_data'))
                              <div class="form-control-feedback">{{ $errors->first('model_data')}}</div>
                            @endif
                        </div>
                        {{-- end model_data --}}

                        {{-- problem_id --}}
                        <div class="form-group {{ $errors->has('problem') ? 'has-danger' : ''}}">
                            <label class="control-label requiredField" for="problem">
                                {{__('nomenclature.problem')}}
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                            <textarea name="problem" id="problem" cols="30" rows="10" class="tinymce form-control">
                              {!! old('problem') ? old('problem') : $order->problem !!}
                            </textarea>
                            @if($errors->has('problem'))
                              <div class="form-control-feedback">{{ $errors->first('problem')}}</div>
                            @endif
                        </div>
                        {{-- end problem --}}

                        {{-- price --}}
                        <div class="form-group row">
                            <label for="price" class="col-md-4 col-form-label text-md-right">{{ __('order.price') }}</label>

                            <div class="col-md-6">
                                <input id="price" type="number" class="form-control @error('price') is-invalid @enderror" name="price" value="{{ old('price') ? old('price') : $order->price }}" required autocomplete="price">

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
                                <input id="client_pay" type="number" class="form-control @error('client_pay') is-invalid @enderror" name="client_pay" value="{{ old('client_pay') ? old('client_pay') : $order->client_pay }}" required autocomplete="client_pay">

                                @error('client_pay')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        {{-- end client_pay --}}

                        {{-- notices_id --}}
                        <div class="form-group {{ $errors->has('notices') ? 'has-danger' : ''}}">
                            <label class="control-label requiredField" for="notices">
                                {{__('nomenclature.notices')}}
                                <span class="asteriskField">
                                    *
                                </span>
                            </label>
                            <textarea name="notices" id="notices" cols="30" rows="10" class="tinymce form-control">
                              {!! old('notices') ? old('notices') : $order->notices !!}
                            </textarea>
                            @if($errors->has('notices'))
                              <div class="form-control-feedback">{{ $errors->first('notices')}}</div>
                            @endif
                        </div>
                        {{-- end notices_id --}}



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