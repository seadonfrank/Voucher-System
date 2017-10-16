@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-primary">
                <div class="panel-heading">
                    <span><b>Users</b></span>
                    <span class="pull-right">
                        <a class="btn btn-info btn-xs" href="/users/create"><i class="fa fa-plus"></i> Add User</a>
                    </span>
                </div>
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            @if(count($users)>0)
                            <table class="table  table-responsive">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        <a href="/users/{{ $user->id }}/edit" class="btn-xs btn btn-warning"><i class="fa fa-pencil"></i> Edit</a>
                                    </td>
                                </tr>
                                @endforeach
                            </table>
                            @else
                                <h4>No Users have been created yet. &nbsp;&nbsp; <a class="btn btn-success btn-xs" href="/users/create">Add User</a></h4>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection