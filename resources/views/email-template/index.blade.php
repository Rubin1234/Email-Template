@extends('layout\app')

@section('content')
@if(session()->has('message'))
<div class="alert alert-success">
    {{ session()->get('message') }}
</div>
@endif
<div class="card">
    <div class="card-header text-center"><b>Email Template Lists</b></div>
    <div class="card-body">
        <a href="{{ route( 'mail-template.create', ['id' => 'new'] )}}" type="button" class="btn btn-primary create-btn mb-3" style="float: right"><i class="fa fa-plus"></i> Create</a>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">S.N</th>
                    <th scope="col">Title</th>
                    <th scope="col">Body</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                @if(count($emailTemplateLists) > 0)
                @foreach($emailTemplateLists as $key => $emailTemplateList)
                <tr>
                    <th scope="row">{{ $key + 1}}</th>
                    <td>{{ $emailTemplateList->title }}</td>
                    <td> {!! $emailTemplateList->body !!} </td>
                    <td>
                    <td>
                        <a href="{{ route('mail-template.create',['id' => $emailTemplateList->id] )}}" type="button" class="btn btn-primary">Edit</a>
                        <a href="{{ route('email-template.delete',['id' => $emailTemplateList->id] )}}" type="button" class="btn btn-danger">Delete</a>
                    </td>
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