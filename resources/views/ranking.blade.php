@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Ranking de publicaciones MedeGreen</h1>
    
    @forelse($posts as $post)
        <div class="card bg-light text-dark my-5 mx-auto" id="postComponent">
            <div class="card-header text-center">

                @if($post->usuario->profile_pic)
                    <img src="{{ asset('storage/profile_pics/'.$post->usuario->email.'/'.$post->usuario->profile_pic) }}" alt="profile_pic" class="avatar my-2">
                @else
                    <img src="{{ asset('images/no_profile_pic.jpg') }}" alt="profile_pic" class="avatar my-2">
                @endif
                
                <h5 class="card-title">{{ $post->usuario->name }}</h5>
                
                <p class="card-text">{{ $post->descripcion }}</p>
                
                <p class="card-text text-muted">{{ $post->created_at->diffForHumans() }}</p>
            </div>
            @if($post->media->mime == 'image')
                <img class="card-img" src="{{ $post->media->link }}" alt="Card image">
            @else    
                <video src="{{ $post->media->link }}" controls></video>
            @endif
            <div class="footer">
                <div class="row">
                    <div class="col-12"><a class="btn btn-success col-12"><i class="fas fa-arrow-up mr-2" style="color:green;"></i>{{ $post->likes->count() }}</a></div>    
                </div>
            </div>
        </div>
    @empty
        <div class="alert alert-warning m-t-1 text-xs-center" role="alert">
            <i class="fas fa-bell"></i> Ops. Aun no hay publicaciones calificadas.
        </div>
    @endforelse

</div>

@endsection
