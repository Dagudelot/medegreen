<template>
    <div class="card bg-light text-dark my-1 mx-auto" id="commentComponent">
        <div class="card-header text-left">
            <div style="width: 70px; display: flex; float: left">   
                <img v-bind:src="(this.user_profile_pic_path)" alt="user_picture" class="avatar">
            </div>
            <p style="font-size: 20px; margin: 0">{{ comment.usuario.name }}</p> 
            <p class="text-muted">{{ moment().startOf(comment.created_at).fromNow() }}</p>
        </div>
        <div class="card-body">
            <textarea v-model="descripcion" v-if="editMode" style="width: 100%"></textarea>
            <p v-else>{{ descripcion }}</p>
        </div>
        <div class="footer">
            <div v-if="comment.usuario.id == user.id" class="row">
                <div class="col-6"></div>
                <div class="col-6 text-right">
                    <a class="btn btn-sm btn-success text-white" v-on:click="updateComment()" v-if="editMode"><i class="fas fa-save mr-2"></i>Guardar</a>
                    <a class="btn btn-sm btn-secondary text-white" v-on:click="editComment()" v-else><i class="fas fa-pen mr-2"></i>Editar</a>
                    <a class="btn btn-sm btn-danger text-white" v-on:click="deleteComment()"><i class="fas fa-trash mr-2"></i>Eliminar</a>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    let moment = require('moment');
    moment.locale('es');
    export default {
        mounted() {
            if(this.comment.usuario.profile_pic){
                this.user_profile_pic_path = '/storage/profile_pics/'+this.comment.usuario.email+'/'+this.comment.usuario.profile_pic;
            }
        },
        props: ['comment', 'user'],
        data() {
            return {
                moment: moment,
                user_profile_pic_path: 'http://127.0.0.1:8000/images/no_profile_pic.jpg',
                editMode: false,
                descripcion: this.comment.descripcion
            }
        },
        methods: {
            deleteComment(){
                axios.delete('comentarios/'+this.comment.id)
                .then(response => {
                    this.$emit('delete');
                });
            },
            editComment() {
                this.editMode = true;
            },
            updateComment(){
                let params = {
                    'id': this.comment.id,
                    'descripcion': this.descripcion
                };
                axios.put('comentarios/', params)
                .then(response => {
                    this.editMode = false;
                });
            }
        }
    }
</script>