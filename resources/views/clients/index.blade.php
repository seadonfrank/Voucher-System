@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span><b>Clients</b></span>
                    <span class="pull-right">
                        <a class="btn btn-info btn-xs" href="/clients/create"><i class="fa fa-plus"></i> Add Client</a>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(count($clients)>0)
                            <table class="table  table-responsive">
                                <tr>
                                    <th>Client Name</th>
                                    <th>Client API Token</th>
                                    <th>Client Status</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($clients as $client)
                                <tr>
                                    <td>{{ $client->name }}</td>
                                    <td>{{ $client->api_token }}</td>
                                    <td>
                                        @if($client->is_active)
                                            <span class="label label-success">Enabled</span>
                                        @else
                                            <span class="label label-danger">Disabled</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="/clients/{{ $client->id }}/edit" class="btn-xs btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            @else
                                <h4>No clients have been created yet. &nbsp;&nbsp; <a class="btn btn-success btn-xs" href="/clients/create">Add Client</a></h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection