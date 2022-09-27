@extends('layout\app')

@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<div class="card">
    <div class="card-header text-center"><b>Mail Variables</b></div>
    <div class="card-body">
        <a href="{{ route( 'mail-variable.create', ['id' => 'new'] )}}" type="button" class="btn btn-primary create-btn mb-3" style="float: right"><i class="fa fa-plus"></i> Create</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">Key</th>
                    <th scope="col">Values</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(count($mailVariableLists) > 0)
                @foreach($mailVariableLists as $key => $mailVariableList)
                <tr>
                    <th scope="row">{{ $key + 1}}</th>
                    <td>{{ $mailVariableList->variable_key }}</td>
                    <td> {{ $mailVariableList->variable_value}} </td>
                    <td>
                        <a href="{{ route('mail-variable.create',['id' => $mailVariableList->id] )}}" type="button" class="btn btn-primary">Edit</a>
                        <a href="{{ route('mail-variable.delete',['id' => $mailVariableList->id] )}}" type="button" class="btn btn-danger">Delete</a>
                    </td>
                </tr>
                @endforeach
                @else
                <p>Data not found.</p>
                @endif
            </tbody>
        </table>
    </div>
</div>
@endsection