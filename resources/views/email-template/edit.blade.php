@extends('layout\app')

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif<br />
<div class="card">
    <div class="card-header">Create Email Template</div>
    <div class="card-body">
        <a href="{{ route( 'mail-template.index' )}}" type="button" class="btn btn-secondary create-btn mb-3" style="float: right"><i class="fa fa-plus"></i> Back</a>
        <form method="POST" action="{{ route('email-template.updateOrCreate', ['id' => Request::segment(2) ]) }}">
            @csrf
            <div class="form-group">
                <label>Email TitleTitle</label>
                <input type="text" name="email_title" class="form-control" placeholder="Email Title">

            </div>
            <div class="form-group">
                <label>Email Content</label>
                <textarea type="text" name="email_content" cols="4" rows="4" class="form-control" placeholder="Variable Values"></textarea>
            </div>

            <div class="text-muted">
                Available Variables
                <hr>

                <ul>
                    @foreach($mailVariables as $mailVariable)
                    <li class="mb-2"> <span style="background: #972e2e;color: #f9f5f5;border-radius: 5px;padding: 1px 9px;">{{$mailVariable->variable_key}}</span></li>
                    @endforeach
                </ul>
            </div>

            <button type="submit" class="btn btn-primary float-right">Submit</button>
        </form>
    </div>
</div>
@endsection