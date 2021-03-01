@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

                @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                              <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
                @endif

                <div class="card-header">{{ __('Register') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label>

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
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- password field --}}
                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- confirm-password field --}}
                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

<<<<<<< HEAD
                        {{-- address field --}}
                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">{{ __('Address') }}</label>

                            <div class="col-md-6">
                                <input id="address" type="address" class="form-control @error('address') is-invalid @enderror" name="address" value="{{ old('address') }}" required autocomplete="address">

                                @error('address')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- P iva field --}}
                        <div class="form-group row">
                            <label for="piva" class="col-md-4 col-form-label text-md-right">{{ __('IVA') }}</label>

                            <div class="col-md-6">
                                <input id="piva" type="piva" class="form-control @error('piva') is-invalid @enderror" name="piva" value="{{ old('piva') }}" required autocomplete="piva">

                                @error('piva')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- PHONE field --}}
                        <div class="form-group row">
                            <label for="phone" class="col-md-4 col-form-label text-md-right">{{ __('Phone Number') }}</label>

                            <div class="col-md-6">
                                <input id="phone" type="phone" class="form-control @error('phone') is-invalid @enderror" name="phone" value="{{ old('phone') }}" required autocomplete="phone">

                                @error('phone')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- description field --}}
                        <div class="form-group row">
                            <label for="description" class="col-md-4 col-form-label text-md-right">{{ __('Description') }}</label>

                            <div class="col-md-6">
                                <input id="description" type="description" class="form-control @error('description') is-invalid @enderror" name="description" value="{{ old('description') }}" required autocomplete="description">

                                @error('description')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- photo field --}}
                        <div class="form-group row">
                            <label for="photo" class="col-md-4 col-form-label text-md-right">{{ __('Image Upload for your account') }}</label>

                            <div class="col-md-6">
                                <input id="photo" class="btn btn-warning btn-sm" type="file" name="photo" value="{{ old('photo') }}">

                                @error('photo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>


                        {{-- delivery_cost field --}}
                        <div class="form-group row">
                            <label for="delivery_cost" class="col-md-4 col-form-label text-md-right">{{ __('Delivery_cost') }}</label>

                            <div class="col-md-6">
                                <input id="delivery_cost" type="delivery_cost" class="form-control @error('delivery_cost') is-invalid @enderror" name="delivery_cost" value="{{ old('delivery_cost') }}">

                                @error('delivery_cost')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        {{-- register submit --}}
=======
                        <div class="">
                          <label for="address">Address</label>
                          <input type="text" name="address" value="{{ old('address') }}" maxlength="255" required>
                          {{-- <input type="text" name="address" value="{{ old('address') }}"> --}}

                          <label for="piva">PIVA</label>
                          <input type="text" name="piva" value="{{ old('piva') }}" minlength="11" maxlength="11" required>
                          {{-- <input type="text" name="piva" value="{{ old('piva') }}"> --}}

                          <label for="phone">Phone</label>
                          <input type="text" name="phone" value="{{ old('phone') }}" minlength="6" maxlength="30" required>
                          {{-- <input type="text" name="phone" value="{{ old('phone') }}"> --}}

                          <label for="delivery_cost_euro">Delivery cost (prima della virgola)</label>
                          <input type="number" name="delivery_cost_euro" value="{{ old('delivery_cost_euro') }}" min="0" max="9999" required>
                          {{-- <input type="number" name="delivery_cost_euro" value="{{ old('delivery_cost_euro') }}"> --}}

                          <label for="delivery_cost_cent">Delivery_cost (centesimi)</label>
                          <input type="number" name="delivery_cost_cent" value="{{ old('delivery_cost_cent') }}" min="0" max="99" required>
                          {{-- <input type="number" name="delivery_cost_cent" value="{{ old('delivery_cost_cent') }}"> --}}


                        </div>

>>>>>>> bbae2a859145a5a68e4c0e6f646dd8a4db459895
                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary btn-lg">
                                    {{ __('Register') }}
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



{{-- $table->string('address')->unique();
$table->string('piva')->unique(); --}}
{{-- $table->string('phone', 30);
$table->string ('description')->nullable(); --}}
{{-- $table->string('photo')->nullable();
$table->string('delivery_cost',6); --}}
