<x-guest-layout>

    @section('title')
        Verify Account
    @endsection

    @section('authentication')
        <div class="row">
            <div class="col-lg-6 col-sm-6 col-md-6 col-xs-12 col-md-offset-3">
                <div class=" main-content-area">
                    <div class="wrap-login-item ">
                        <div class="login-form form-item form-stl">
                            @if (session('status') == 'verification-link-sent')
                                <div class="mb-4 font-medium text-sm text-green-600">
                                    {{ __('A new verification link has been sent to the email address you provided in your profile settings.') }}
                                </div>
                            @endif
                            <form name="frm-login" method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <fieldset class="wrap-input">
                                    <label
                                        for="frm-login-pass">{{ __('Before continuing, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}</label>
                                </fieldset>
                                <input type="submit" class="btn btn-submit" value="Resend Verification Email"
                                    name="submit">
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection
</x-guest-layout>
