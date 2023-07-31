@extends('layouts.app')

@section('content')
    <div class="main-content-wrap section-ptb cart-page">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="table-content table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th class="plantmore-product-thumbnail text-center">{{ __('Verify Your Email Address') }}</th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td class="plantmore-product-thumbnail">
                                    @if (session('resent'))
                                        <div class="alert alert-success label-roundless" role="alert">
                                            {{ __('A fresh verification link has been sent to your email address.') }}
                                        </div>
                                    @endif

                                    {{ __('Before proceeding, please check your email for a verification link.') }}
                                    {{ __('If you did not receive the email') }}, <a class="theme-color"
                                        href="{{ route('verification.resend') }}">{{ __('click here to request another') }}</a>.
                                </td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
