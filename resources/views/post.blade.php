@extends('layouts.app')

@section('content')
<div class="container">
    
    <single-post-component
    :post="{{ $post }}"
    :user="{{ \Auth::user() }}">
    </single-post-component>

</div>

@endsection
