<template>
    <div class="container">
        <post-component
        :post="post"
        :comments="comments"
        >
        </post-component>
        <comment-form-component
        @new="addComment">
        </comment-form-component>
        <comment-component 
        v-for="(comment, index) in comments"
        :key="comment.id"
        :comment="comment"
        :user="user"
        @delete="deleteComment(index)">
        </comment-component>
    </div>
</template>

<script>
    export default {
        async mounted() {
            const receivedComments = await axios.get(this.post.id+'/getComments');
            this.comments = receivedComments.data;
            //console.log(this.comments);
        },
        props: ['post', 'user'],
        data() {
            return {
                comments: null
            }
        },
        methods: {
            addComment(comment) {
                let params = {
                    post_id: this.post.id,
                    descripcion: comment.descripcion
                }
                axios.post('comentarios', params)
                .then(response => {
                    this.comments.unshift(response.data);
                });
            },
            deleteComment(index){
                this.comments.splice(index, 1);
            }
        }
    }
</script>