<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Inicio</div>

                <div class="card-body">
                    <h4>¿Como contribuirias a la reutilizacion de residuos solidos de tu ciudad?</h4>

                    <form v-on:submit.prevent="newPost()">
                        <textarea style="width:100%; padding: 10px" v-model="descripcion" placeholder="Redacta tu propuesta"></textarea>
                        <div class="custom-file">
                            <input type="file" class="custom-file-input" id="validatedCustomFile" v-on:change="onFileChange" required>
                            <label class="custom-file-label" for="validatedCustomFile">Selecciona foto / video.</label>
                            <div class="invalid-feedback">Selecciona un archivo valido</div>
                        </div>
                        <progress class="my-2" id="progressbar" max="100" :value="progressValue" style="width:100%; background: rgb(97, 224, 97)">{{ progressValue }}%</progress>
                        <div class="row">
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4"></div>
                            <div class="col-lg-4 text-right"><input type="submit" class="btn btn-outline-success my-4" value="Publicar"></div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script> 
    const firebase = require('firebase');
    export default {
        mounted() {      
            const firebaseConfig = {
                apiKey: "AIzaSyA43q2jDCq1Yu_bmW3RZCZn5Z4fsBYxy4w",
                authDomain: "medegreen-a9629.firebaseapp.com",
                databaseURL: "https://medegreen-a9629.firebaseio.com",
                projectId: "medegreen-a9629",
                storageBucket: "medegreen-a9629.appspot.com",
                messagingSenderId: "239786999911",
                appId: "1:239786999911:web:692b21d12ec082ea"
            };  
            // Initialize Firebase
            firebase.initializeApp(firebaseConfig);    
        },
        props: ['user'], 
        data() {
            return {
                descripcion: '',
                media: null,
                progressValue: 0,
                firebase: firebase,
                CLOUDINARY_URL: "https://api.cloudinary.com/v1_1/dagudelot/image/upload",
                CLOUDINARY_UPLOAD_PRESET: "vfpt8k9k"
            }
        },
        methods: {
            newPost() {
                let post = {
                    user_id: this.user.id,
                    descripcion: this.descripcion,
                    media: this.media
                };

                const storageRef = firebase.storage().ref(this.media.type+'/'+this.media.name);
                const task = storageRef.put(this.media);
                task.on('state_changed', 
                snapshot => {
                    let percentage = (snapshot.bytesTransferred / snapshot.totalBytes) * 100;
                    this.progressValue = percentage;
                }, error => {
                    console.log(error.message);
                }, () => {

                    this.progressValue = 100;

                    task.snapshot.ref.getDownloadURL().then(url => {
                        let params = {
                            descripcion: post.descripcion,
                            media_url: url,
                            media_name: this.media.name,
                            media_mime: this.media.type
                        };

                        // Request to php server to save description
                        axios.post('/publicaciones', params)
                        .then(response => {
                            this.descripcion = '';
                            this.$emit('new', response.data);
                            //alert('Propuesta publicada correctamente');
                        });
                    });
                });
                
                /*const formData = new FormData();
                formData.append('file', post.media);
                formData.append('upload_preset', this.CLOUDINARY_UPLOAD_PRESET);

                // Request to cloudinary to save media
                axios.post(this.CLOUDINARY_URL, 
                            formData, 
                            {
                                headers: {
                                    'Content-Type': 'multipart/form-data'
                                },
                                onUploadProgress(e){
                                    const progress = Math.round(e.loaded * 100) / e.total;
                                    $('#progressbar').attr('value', progress);
                                }
                            })
                .then(response => {
                    let params = {
                        descripcion: post.descripcion,
                        media_url: response.data.secure_url,
                        media_name: response.data.original_filename,
                        media_mime: response.data.format
                    };

                    // Request to php server to save description
                    axios.post('/publicaciones', params)
                    .then(response => {
                        this.$emit('new', response.data);
                        //alert('Propuesta publicada correctamente');
                    });
                });*/
            },
            onFileChange(e) {
                let files = e.target.files || e.dataTransfer.files;
                if (!files.length)
                    return;
                this.media = files[0];
            }
        }
    }
</script>
