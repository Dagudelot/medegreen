@extends('layouts.app')

@section('content')
<div class="container">
    
    <posts-component
        :user="{{ \Auth::user() }}">
    </posts-component>

</div>

@endsection