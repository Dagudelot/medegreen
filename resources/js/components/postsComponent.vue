<template>
    <div class="container">
        <form-component
            @new="addPost"
            :user="user">
        </form-component>
        <post-component 
            v-for="(post, index) in posts"
            :key="post.id"
            :post="post"
            :comments="post.comentarios"
            @delete="deletePost(index)"
            @update="updatePost(index, ...arguments)">
        </post-component>
    </div>
</template>

<script>
    export default {
        mounted() {
            axios.get('/publicaciones')
                .then(response => {
                    this.posts = response.data.posts;                    
                });
        },
        props: ['user'],
        data() {
            return {
                posts: null
            }
        },
        methods: {
            addPost(post) {
                this.posts.unshift(post[0]);
            },
            deletePost(index) {
                this.posts.splice(index, 1);
            },
            updatePost(index, post) {
                this.posts[index] = post;
                let params = {
                    id: post.id,
                    descripcion: post.descripcion,
                    media: post.media
                };
                axios.put('/publicaciones', params)
                    .then(response => {
                    });
            }
        }
    }
</script>
