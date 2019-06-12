<template>
    <div class="card bg-light text-dark my-5 mx-auto" id="postComponent">
        <div class="card-header text-center">
            <div v-if="post.usuario.id == authUser.id" class="dropdown">
                <button class="btn btn-secondary dropdown-toggle close" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span aria-hidden="true"><i class="fas fa-plus" style="color: green"></i></span>
                </button>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                    <a class="dropdown-item btn btn-sm btn-success" v-if="editMode" v-on:click="updatePost()">Guardar</a>
                    <a class="dropdown-item btn btn-sm btn-primary" v-else v-on:click="editPost()">Editar</a>
                    <a class="dropdown-item btn btn-sm btn-danger" v-on:click="deletePost()">Eliminar</a>
                </div>
            </div>

            <img v-bind:src="user_profile_pic_path" alt="profile_pic" class="avatar my-2">
            <h5 class="card-title">{{ post.usuario.name }}</h5>
            
            <textarea  v-if="editMode" v-model="post.descripcion" cols="30" rows="5" style="width: 100%"></textarea>
            <p class="card-text" v-else>{{ post.descripcion }}</p>
            
            <p class="card-text text-muted">{{ moment().startOf(post.created_at).fromNow() }}</p>
        </div>
        <img class="card-img" v-if="post.media.mime == 'image'" v-bind:src="post.media.link" alt="Card image">
        <video v-else v-bind:src="post.media.link" controls></video>
        <div class="footer">
            <div class="row">
                <div class="col-4"><a v-bind:class="likedBtn" v-on:click="addLike()"><i class="fas fa-arrow-up mr-2" style="color:green;"></i>{{ likeCounter }}</a></div>
                <div class="col-4"><a v-bind:class="dislikedBtn" v-on:click="addDislike()"><i class="fas fa-arrow-down mr-2" style="color:green;"></i>{{ dislikeCounter }}</a></div>
                <div class="col-4"><a class="col-lg-12 btn btn-outline-primary" v-bind:href="viewPost" disabled><i class="fas fa-comments mr-2"></i>{{ commentsCounter }}</a></div>
            </div>
        </div>
    </div>
</template>

<script>
    let moment = require('moment');
    moment.locale('es');
    export default {
        async mounted() {            
            const user = await axios.get('/user');
            this.authUser = user.data;
            if(this.post.usuario.profile_pic){
                this.user_profile_pic_path = '/storage/profile_pics/'+this.post.usuario.email+'/'+this.post.usuario.profile_pic;
            }
            if(this.checkIfUserLiked() == true){
                this.likedBtn = 'col-lg-12 btn btn-success';
            }
            if(this.checkIfUserDisliked() == true){
                this.dislikedBtn = 'col-lg-12 btn btn-danger';
            }
        },
        props: ['post', 'comments'],
        data() {
            return {
                viewPost: 'http://127.0.0.1:8000/publicaciones/'+this.post.id,
                authUser: {
                    id: null,
                },
                user_profile_pic_path: 'http://127.0.0.1:8000/images/no_profile_pic.jpg',
                editMode: false,
                moment: moment,
                likedBtn: 'col-lg-12 btn btn-outline-success',
                dislikedBtn: 'col-lg-12 btn btn-outline-danger',
                likeCounter: this.post.likes.length,
                likeMode: true,
                dislikeCounter: this.post.dislikes.length,
                dislikeMode: true,
                commentsCounter: (this.post.comentarios) ? this.post.comentarios.length : 0
            }
        },
        methods: {
            editPost() {
                this.editMode = true;
            },
            deletePost() {
                axios.delete('/publicaciones/'+this.post.id)
                    .then(response => {
                        this.$emit('delete');
                    });
            },
            updatePost() {
                this.editMode = false;
                this.$emit('update', this.post);
            },
            addLike(){
                axios.post('/valorar/like/', {post_id: this.post.id})
                .then(response => {
                    if(response.data == 'success'){
                        this.dislikeCounter = this.dislikeCounter-1;
                        this.likeMode = true;
                        this.dislikedBtn = 'col-lg-12 btn btn-outline-danger';
                    }
                    if(!this.checkIfUserLiked() && this.likeMode){
                        this.likeCounter = this.likeCounter+1;
                        this.likeMode = false;
                        this.likedBtn = 'col-lg-12 btn btn-success';
                    }

                });
            },
            addDislike(){
                axios.post('/valorar/dislike/', {post_id: this.post.id})
                .then(response => {
                    if(response.data == 'success'){
                        this.likeCounter = this.likeCounter-1;
                        this.dislikeMode = true;
                        this.likedBtn = 'col-lg-12 btn btn-outline-success';
                    }
                    if(!this.checkIfUserDisliked() && this.dislikeMode){
                        this.dislikeCounter = this.dislikeCounter+1;
                        this.dislikeMode = false;
                        this.dislikedBtn = 'col-lg-12 btn btn-danger';
                    }
                });
            },
            checkIfUserLiked(){
                for(let i=0; i < this.post.likes.length; i++){
                    if(this.post.likes[i].user_id == this.authUser.id){
                        return true;
                    }
                }
                return false;
            },
            checkIfUserDisliked(){
                for(let i=0; i < this.post.dislikes.length; i++){
                    if(this.post.dislikes[i].user_id == this.authUser.id){
                        return true;
                    }
                }
                return false;
            }
        }
    }
</script>
