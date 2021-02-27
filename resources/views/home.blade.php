@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>

            </div>
        </div>
    </div>

    <!-- Load the required client component. -->
  <script src="https://js.braintreegateway.com/web/3.73.1/js/client.min.js"></script>

  <!-- Load Hosted Fields component. -->
  <script src="https://js.braintreegateway.com/web/3.73.1/js/hosted-fields.min.js"></script>

@endsection
