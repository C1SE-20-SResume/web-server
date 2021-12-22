@extends('layouts.app')

@section('content')
<div class="shadow-lg rounded-md bg-gray-200">
    <div class="py-4 px-6">
        <div>
            <h2 class="text-center font-bold mb-4 text-xl">Reset Password</h2>
            <div class="">
                <form method="POST" action="/reset-password">
                    @csrf
                    <input type="hidden" name="token" value="{{ $token }}">
                    <div class="grid grid-cols-2 items-center mb-2">
                        <label for="email" class="">E-Mail Address</label>
                        <div class="">
                            <input id="email" type="email" class="rounded-md @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" autocomplete="email" autofocus>


                            @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>
                    </div>

                    <div class="grid grid-cols-2 items-center mb-2">

                        <label for="password" class="">Password</label>
                        <div class="">
                            <input id="password" type="password" class="rounded-md @error('password') is-invalid @enderror" name="password" autocomplete="new-password">


                            @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                            @enderror
                        </div>

                    </div>

                    <div class="grid grid-cols-2 items-center mb-2">
                        <label for="password-confirm" class="">Confirm Password</label>
                        <div class="">
                            <input id="password-confirm" type="password" class="rounded-md" name="password_confirmation" autocomplete="new-password">
                        </div>
                    </div>

                    <div class="mb-0">
                        <div class="text-center">
                            <button type="submit" class="py-2 px-6 border border-blue-500 rounded-lg hover:bg-blue-500 transition duration-200 hover:text-white">
                                Reset Password
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</div>
@endsection
