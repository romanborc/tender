@extends('auth.layouts.app')

@section('content')
<div class="middle-box text-center loginscreen animated fadeInDown">
    <div>
        <h3>Reset Password</h3>  

        @if (session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif    

        <form class="m-t" method="POST" action="{{ route('password.email') }}">
           <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                <label for="email" class="col-md-4 control-label">E-Mail Address</label>

                <div class="form-group">
                    <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">
                    Send Password Reset Link
                </button>
            </div>
        </form>
        <p class="m-t"> <small>Tender &copy; 2018</small> </p>
    </div>
</div>
@endsection


