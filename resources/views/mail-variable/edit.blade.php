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
    <div class="card-header">Create Variables</div>
    <div class="card-body">
        <a href="{{ route( 'mail-variable.index' )}}" type="button" class="btn btn-secondary create-btn mb-3" style="float: right"><i class="fa fa-plus"></i> Back</a>
        <form method="POST" action="{{ route('mail-variable.updateOrCreate', ['id' => Request::segment(2) ]) }}">
            @csrf
            <div class="form-group">
                <label>Variable Key</label>
                <input type="text" name="variable_key" class="form-control" placeholder="Variable Key">

            </div>
            <div class="form-group">
                <label>Variable Value</label>
                <textarea type="text" name="variable_value" cols="4" rows="4" class="form-control" placeholder="Variable Values"></textarea>
            </div>

            <div class="text-muted">
                Tip: Template variable keys must be unique and enclosed with two square brackets, <br />
                <ul>
                    <li>for static variables use uppercase letters like [WEBSITE_URL]</li>
                    <li>for input variables use [INPUT:field_name] like [INPUT:name]</li>
                    <li>for dynamic data use [DYNAMIC:$data]</li>
                </ul>
            </div>

            <button type="submit" class="btn btn-primary float-right">Submit</button>
        </form>
    </div>
</div>
@endsection