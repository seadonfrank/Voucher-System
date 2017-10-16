@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span><b>Edit a Client</b></span>
                    <span class="pull-right"></span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <form method="post" action="/clients/{{ $client->id }}" class="form-horizontal" role="form">
                                {{ csrf_field() }}
                                <input name="_method" type="hidden" value="PUT">
                                <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                                    <label for="name" class="col-md-2 control-label">Name:</label>
                                    <div class="col-md-10">
                                        <div class="input-group">
                                            <div class="input-group-addon">
                                                <i class="fa fa-user">
                                                </i>
                                            </div>
                                            <input id="Name" name="name" type="text" placeholder="Client Name" class="form-control input-md" value="@if(old('name')){{old('name')}}@else{{$client->name}}@endif">
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
                                            <input id="api_token" name="api_token" type="text" placeholder="Client API Token" class="form-control input-md" value="@if(old('api_token')){{old('api_token')}}@else{{$client->api_token}}@endif">
                                        </div>
                                        @if ($errors->has('api_token'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('api_token') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="name" class="col-md-2 control-label">Status:</label>
                                    <div class="col-md-10 funkyradio">
                                        <div class="col-md-6 funkyradio-success">
                                            <input type="radio" name="is_active" <?php if($client->is_active) echo "checked"; ?> id="enable" value="true"/>
                                            <label for="enable">Enable</label>
                                        </div>
                                        <div class="col-md-6 pull-right funkyradio-danger">
                                            <input type="radio" name="is_active" <?php if(!$client->is_active) echo "checked"; ?> id="disable" value="false"/>
                                            <label for="disable">Disable</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-8 control-label"></label>
                                    <div class="col-md-4">
                                        <button class="btn btn-success" value="Save Changes" type="submit"><i class="fa fa-save"></i>&nbsp;&nbsp;Update</button>
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
