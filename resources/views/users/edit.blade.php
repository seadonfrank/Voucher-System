@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span><b>Edit a User</b></span>
                    <span class="pull-right"></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="/users/{{ $user->id }}" class="form-horizontal" role="form">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="PUT">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-4 control-label">Name:</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user">
                                                </i>
                                            </div>
                                            <input id="Name" name="name" type="text" placeholder="Name" class="form-control input-md" value="@if(old('name')){{old('name')}}@else{{$user->name}}@endif">
                                        </div>
                                        @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                                    <label for="email" class="col-md-4 control-label">E-Mail Address</label>
                                    <div class="col-md-8">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user">
                                                </i>
                                            </div>
                                            <input id="email" name="email" type="text" placeholder="E-mail Address" class="form-control input-md" value="@if(old('email')){{old('email')}}@else{{$user->email}}@endif">
                                        </div>
                                        @if ($errors->has('email'))
                                        <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="bg-info">
                                    <br/>
                                    <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                        <label for="password" class="col-md-4 control-label">Password</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-user">
                                                    </i>
                                                </div>
                                                <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md">
                                            </div>
                                            @if ($errors->has('password'))
                                            <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="password-confirm" class="col-md-4 control-label">Confirm Password</label>
                                        <div class="col-md-8">
                                            <div class="input-group">
                                                <div class="input-group-addon">
                                                    <i class="fa fa-user">
                                                    </i>
                                                </div>
                                                <input id="password-confirm" name="password_confirmation" type="password" placeholder="Password" class="form-control input-md">
                                            </div>
                                        </div>
                                    </div>
                                    <label for="password-info" class="text-danger col-md-12 control-label">***Leave it blank if you do not want wish to change the password.</label>
                                    <br/>
                                    <br/>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-8 control-label"></label>
                                    <div class="col-md-4">
                                        <button class="btn btn-success" value="Save Changes" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button>
                                        <span></span>
                                        <a href="/users" class="btn btn-default"><i class="fa fa-close"></i>&nbsp;&nbsp;Cancel</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
