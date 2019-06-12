@extends('layouts.app')

@section('content')
<div class="container">

    <h1>Ranking de publicaciones MedeGreen</h1>

    @if(Session::has('success'))
        <div class="alert alert-success m-t-1 text-xs-center" role="alert">
            <i class="fas fa-bell"></i> {{ Session::get('success') }}
        </div>
    @endif
    
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
                    <div class="col-12">
                        <a class="btn btn-primary col-12">
                            <i class="fas fa-arrow-up mr-2" style="color:green;"></i>
                            {{ $post->likes->count() }}
                        </a>
                    </div>    
                    <!-- Button trigger modal -->
                    <div class="col-12">
                        <a class="btn btn-success col-12 text-white" data-toggle="modal" data-target="#winnerModal{{ $post->id }}">
                            <i class="far fa-smile-beam" style="font-size: 22px"></i>
                            Seleccionar ganador
                        </a>
                    </div>

                    <!-- Modal -->
                    <div class="modal fade" id="winnerModal{{ $post->id }}" tabindex="-1" role="dialog" aria-labelledby="winnerModalLabel" aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <form method="POST" action="{{ route('winner') }}">
                                @csrf

                                    <input type="hidden" name="user_id" value="{{ $post->usuario->id }}">

                                    <div class="modal-header bg-success">
                                        <h5 class="modal-title" id="winnerModalLabel">Ganador</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        @if($post->usuario->profile_pic)
                                            <img src="{{ asset('storage/profile_pics/'.$post->usuario->email.'/'.$post->usuario->profile_pic) }}" alt="profile_pic" class="avatar my-2">
                                        @else
                                            <img src="{{ asset('images/no_profile_pic.jpg') }}" alt="profile_pic" class="avatar my-2">
                                        @endif
                                        
                                        <h5 class="card-title">Nombre: {{ $post->usuario->name }}</h5>
                                        <p class="text-muted">Correo electronico: {{ $post->usuario->email }}</p>
                                        <p class="text-muted">Puntos: {{ $post->usuario->puntos }}</p>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-outline-success">Notificar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
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
