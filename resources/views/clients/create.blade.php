@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span><b>Create a Client</b></span>
                    <span class="pull-right"></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="/clients" class="form-horizontal" role="form">
                                {{ csrf_field() }}
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-2 control-label">Name:</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user">
                                                </i>
                                            </div>
                                            <input id="Name" name="name" type="text" placeholder="Client Name" class="form-control input-md" value="{{ old('name') }}">
                                        </div>
                                        @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group{{ $errors->has('api_token') ? ' has-error' : '' }}">
                                    <label for="api_token" class="col-md-2 control-label">API Token:</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-file">
                                                </i>
                                            </div>
                                            <input id="api_token" name="api_token" type="text" placeholder="Client API Token" class="form-control input-md" value="@if(old('api_token')){{old('api_token')}}@else{{substr(md5(microtime()),rand(0,26),15)}}@endif">
                                        </div>
                                        @if ($errors->has('api_token'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('api_token') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-8 control-label"></label>
                                    <div class="col-md-4">
                                        <button class="btn btn-success" value="Save Changes" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Save</button>
                                        <span></span>
                                        <a href="/clients" class="btn btn-default"><i class="fa fa-close"></i>&nbsp;&nbsp;Cancel</a>
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
