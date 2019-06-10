<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Comenta</div>

                <div class="card-body">
                    <form v-on:submit.prevent="newComment()">
                        <input class="form-control" type="text" v-model="comment" placeholder="¿Que piensas de esta propuesta?" required>
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4 text-right"><input type="submit" class="btn btn-outline-success my-4" value="Comentar"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() { 
        },
        data() {
            return {
                comment: ''
            }
        },
        methods: {
            newComment() {
                let comment = {
                    descripcion: this.comment
                }
                this.$emit('new', comment);
                this.comment = '';
            }
        }
    }
</script>
