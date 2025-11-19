<template>
    <v-dialog max-height="90vh" max-width="500" v-model="dialog">
        <v-btn class="btn-close" icon @click="goBack">
            <v-icon class="text-white">
                mdi-window-close
            </v-icon>
        </v-btn>
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                @click="defaultValues"
                v-if="!isUpdate"
                color="#62457F"
                dark
                width="12rem"
                v-bind="attrs"
                v-on="on">
                + Agregar Audio
            </v-btn>
            <v-btn icon @click="updateData(dataUpdate)"
                   v-else
                   v-on="on"
                   v-bind="attrs">
                <v-img contain src="/assets/icon/ic_edit.png" max-height="20"/>
            </v-btn>
        </template>
        <v-card class="invisible-scrollbar">
            <v-card-title class="d-flex justify-content-center bg-purple py-5">
                <div/>
                <div class="d-flex text-white text-center py-0 mb-0">
                    <v-img contain src="/assets/icon/ic_white_logo.svg" max-height="30"/>
                    <div class="mx-2">{{ isUpdate === false ? 'Agregar ' : 'Modificar ' }} Audio
                    </div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" lazy-validation>
                    <v-container class="px-3rem">
                             <!--
                                 Mostrar el input para asignar el precio de audio sólo para:
                                 Audios alta tecnología (ID=8)
                             -->
                         <v-row justify="center" v-if="this.categoriasDePago.includes(this.category_id)">
                                <v-col cols="6" class="py-0">
                                    <p class="text-violet my-2"><b>No.</b></p>
                                    <v-text-field
                                        v-model="number"
                                        :rules="rules.number"
                                        @change="validaNumeroPositivo"
                                        type="number"
                                        min="0"
                                        color="#62457F"
                                        required
                                        dense
                                        outlined>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="6" class="py-0" >
                                    <p class="text-violet my-2"><b>Precio:</b></p>
                                    <v-text-field
                                        v-model="price"
                                        :rules="rules.price"
                                        @change="validaPrecioPositivo"
                                        type="number"
                                        min="0"
                                        color="#62457F"
                                        required
                                        dense
                                        outlined>
                                    </v-text-field>
                                </v-col>
                                <v-col cols="12" class="py-0">
                                    <p class="text-violet my-2"><b>Nombre:</b></p>
                                    <v-text-field
                                        v-model="name"
                                        :rules="rules.name"
                                        color="#62457F"
                                        required
                                        dense
                                        outlined>
                                    </v-text-field>
                                </v-col>
                        </v-row>
                        <v-row justify="center" v-else>
                            <v-col cols="4" class="py-0">
                                <p class="text-violet my-2"><b>No.</b></p>
                                <v-text-field
                                    v-model="number"
                                    :rules="rules.number2"
                                    @change="validaNumeroPositivo"
                                    type="number"
                                    min="0"
                                    color="#62457F"
                                    required
                                    dense
                                    outlined>
                                </v-text-field>
                            </v-col>
                            <v-col cols="8" class="py-0">
                                <p class="text-violet my-2"><b>Nombre:</b></p>
                                <v-text-field
                                    v-model="name"
                                    :rules="rules.name"
                                    color="#62457F"
                                    required
                                    dense
                                    outlined>
                                </v-text-field>
                            </v-col>
                        </v-row>

                        <v-row justify="center">
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Restricción:</b></p>
                                <v-select
                                    :disabled=true
                                    v-model="restriction_id"
                                    :rules="rules.restriction"
                                    :items="restrictions"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                    item-text="name"
                                    item-value="id">
                                </v-select>
                            </v-col>
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Descripción:</b></p>
                                <v-textarea
                                    v-model="description"
                                    :rules="rules.description"
                                    color="#62457F"
                                    required
                                    dense
                                    outlined>
                                </v-textarea>
                            </v-col>
                            <br>
                        </v-row>
                        <v-row justify="center" style="margin: 1rem 0rem;">
                            <v-col cols="4" class="p-0 dropzoneTitle" >
                                <p class="m-0 pink-text"> Adjuntar imagen </p>
                            </v-col>
                            <v-col cols="8" class="py-0">
                                <vue2-dropzone
                                    style="height: 50px;"
                                    class="elDropzone"
                                    ref="IMGDropzoneRef"
                                    id="IMGDropzoneRef"
                                    :options="IMGdropzoneOptions"
                                    :useCustomSlot=true
                                    :include-styling="false"
                                    v-on:vdropzone-thumbnail="this.dzThumbnail"
                                    @vdropzone-mounted="dzUploadImage"
                                    @vdropzone-file-added="dzImageLoaded"
                                    @vdropzone-removed-file="dzRemovedIMG"
                                    @vdropzone-success="dzIMGSuccess"
                                    @vdropzone-error="(file, message, xhr) =>{dzError($refs.IMGDropzoneRef, file, message, xhr)}"
                                >
                                    <div>
                                        <div v-if="!imgLoaded">
                                                <h6  style="margin: 1rem;"> Adjuntar archivo
                                                <img style="max-height: 17px;margin-left: .5rem;margin-bottom: .3rem;" src="/assets/icon/ic_upload.svg" />
                                                </h6>
                                        </div>
                                    </div>
                                </vue2-dropzone>
                            </v-col>
                        </v-row>
                       <v-row justify="center" style="margin: 1rem 0rem;">
                            <v-col cols="4" class="p-0 dropzoneTitle">
                                <p class="m-0 pink-text"> Adjuntar GIF </p>
                            </v-col>
                            <v-col cols="8" class="py-0" style="text-align: center;">
                                <vue2-dropzone
                                    class="elDropzone"
                                    ref="GIFdropzoneRef"
                                    id="GIFdropzoneRef"
                                    :options="GIFdropzoneOptions"
                                    :useCustomSlot=true
                                    :include-styling="false"
                                    v-on:vdropzone-thumbnail="this.dzThumbnail"
                                    @vdropzone-file-added="dzGIFLoaded"
                                    @vdropzone-mounted="dzUploadGIF"
                                    @vdropzone-removed-file="dzRemovedGIF"
                                    @vdropzone-success="dzGIFSuccess"
                                    @vdropzone-error="(file, message, xhr) =>{dzError($refs.GIFdropzoneRef, file, message, xhr)}"
                                >
                                    <div>
                                        <div v-if="!gifLoaded">
                                            <h6  style="margin: 1rem;"> Adjuntar archivo
                                                <img style="max-height: 17px;margin-left: .5rem;margin-bottom: .3rem;" src="/assets/icon/ic_upload.svg" />
                                            </h6>
                                        </div>
                                    </div>
                                </vue2-dropzone>
                            </v-col>
                        </v-row>
                       <v-row justify="center" style="margin: 1rem 0rem;">
                            <v-col cols="4" class="p-0 dropzoneTitle">
                                <p class="m-0 pink-text"> Adjuntarrr audio </p>
                            </v-col>
                            <v-col cols="8" class="py-0" style="text-align: center;">
                                <vue2-dropzone
                                    class="elDropzone"
                                    ref="AUDIOdropzoneRef"
                                    id="AUDIOdropzoneRef"
                                    :options="AUDIOdropzoneOptions"
                                    :useCustomSlot=true
                                    :include-styling="false"
                                    v-on:vdropzone-thumbnail="this.dzThumbnail"
                                    @vdropzone-file-added="dzAudioLoaded"
                                    @vdropzone-mounted="dzUploadAUDIO"
                                    @vdropzone-removed-file="dzRemovedAUDIO"
                                    @vdropzone-success="dzAUDIOSuccess"
                                    @vdropzone-error="(file, message, xhr) =>{dzError($refs.AUDIOdropzoneRef, file, message, xhr)}"
                                >
                                    <div>
                                        <div v-if="!audioLoaded">
                                            <h6  style="margin: 1rem;"> Adjuntar archivo
                                                <img style="max-height: 17px;margin-left: .5rem;margin-bottom: .3rem;" src="/assets/icon/ic_upload.svg" />
                                            </h6>
                                        </div>
                                    </div>
                                </vue2-dropzone>
                            </v-col>
                        </v-row>
                        <v-row>
                            <v-col cols="12" class="py-0 text-center" style="margin-top: 1rem">
                                <v-btn color="#62457F" dark width="12rem" @click="submit" :loading="isLoading">
                                    {{ !isUpdate ? 'Agregar audio' : 'Guardar' }}
                                </v-btn>
                            </v-col>

                        </v-row>
                    </v-container>
                </v-form>
                <audio type="hidden" ref="audio" id="audio" controls="controls" style="display: none" @loadedmetadata="getDuration()">
                    <source id="audioSource" ref="audioSource" src="">
                </audio>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import {bus} from "../../app";
import vue2Dropzone from 'vue2-dropzone';

export default {
    name: "AudiosForm",
    components: {vue2Dropzone},
    props: {
        isUpdate: {
            required: false,
            default: function () {
                return false;
            }
        },
        dataUpdate: {
            type: Object,
            required: false
        },
        restrictions:{
            type: Array,
            required: true
        }
    },
    data() {
        return {
            dialog: false,
            isLoading: false,

            categoriasDePago: [0,8],
            categoriasSinRestriccion: [0,1,8],
            categoriasConReproduccionEnLista: [0,2,3,4,5,6,7,9,10],

            number: null,
            name: null,
            price: null,
            duration: null,
            description: null,
            old_url_image: '',
            url_image: null,
            old_url_audio: '',
            url_audio: null,
            old_url_gif: '',
            url_gif: null,
            restriction_id: null,
            phase_id: this.$route.params.id_phase,
            category_id: parseInt(this.$route.params.id),

            //Rules Form,
            rules: {
                number: [ v => !!v || 'El número es requerido.',
                          v => !isNaN(v) || 'No es un número válido.',
                    ],
                number2: [ v => !!v || 'Requerido.',
                          v => !isNaN(v) || 'No válido.',
                    ],
                name: [v => !!v || 'El nombre es requerido.'],

                //VALIDAR PRECIO

                price: [v => !!v || 'El precio es requerido.', v => !isNaN(v) || 'No es un número válido'],
                restriction: [v => !!v || 'La restricción es requerida.']
                // description: [v => !!v || 'La descripción  es requerida.'],
            },

            imgLoaded: false,
            gifLoaded: false,
            audioLoaded: false,

            IMGdropzoneOptions: {
                url: route('admin.categories.audio_add_file'),
                headers: { 'X-CSRF-TOKEN': document.getElementById('csrf_token').value },
                thumbnailWidth: 200,
                thumbnailHeight: 40,
                maxFileSize: 102400000,
                maxFiles: 1,
                uploadMultiple: false,
                autoProcessQueue: true,
                previewTemplate: this.dzTemplate(),
                acceptedFiles: 'image/*',
                dictRemoveFile: "Eliminar",
                dictCancelUpload: "Cancelar",
                dictUploadCanceled: "Se canceló la carga del archivo",
                dictMaxFilesExceeded: "Sólo se puede adjuntar una imagen",
                dictInvalidFileType: "Sólo se aceptan imagenes",
                dictDefaultMessage:`
                <div style="text-align: center; align-content: center; display: flex;">
                hola
                </div>
                `,
                addRemoveLinks: true,
                destroyDropzone: false
            },

           AUDIOdropzoneOptions: {
                url: route('admin.categories.audio_add_file'),
                headers: { 'X-CSRF-TOKEN': document.getElementById('csrf_token').value },
                timeout: 300000,
                thumbnailWidth: 200,
                thumbnailHeight: 40,
                maxFileSize: 102400000,
                maxFiles: 1,
                uploadMultiple: false,
                autoProcessQueue: true,
                previewTemplate: this.dzTemplate(),
                acceptedFiles: 'audio/*',
                dictRemoveFile: "Eliminar",
                dictCancelUpload: "Cancelar",
                dictUploadCanceled: "Se canceló la carga del archivo",
                dictCancelUploadConfirmation:"Desea cancelar la carga del archivo?",
                dictMaxFilesExceeded: "Sólo se puede adjuntar un archivo",
                dictInvalidFileType: "Sólo se aceptan audios",
                dictDefaultMessage:`
                <div style="text-align: center; align-content: center; display: flex;">
                <h6  style="text-align: center; margin: 2px 0;"> Adjuntar archivo </h6>
                <img style="max-height: 20px;   margin: 0rem 1rem;" src="/assets/icon/ic_upload.svg" />
                </div>
                `,
                addRemoveLinks: true,
                destroyDropzone: false
            },

            GIFdropzoneOptions: {
                url: route('admin.categories.audio_add_file'),
                headers: { 'X-CSRF-TOKEN': document.getElementById('csrf_token').value },
                timeout: 60000,
                thumbnailWidth: 200,
                thumbnailHeight: 40,
                maxFileSize: 102400000,
                maxFiles: 1,
                uploadMultiple: false,
                autoProcessQueue: true,
                previewTemplate: this.dzTemplate(),
                acceptedFiles: 'image/gif',
                dictRemoveFile: "Eliminar",
                dictCancelUpload: "Cancelar",
                dictUploadCanceled: "Se canceló la carga del archivo",
                dictCancelUploadConfirmation:"Desea cancelar la carga del archivo?",
                dictMaxFilesExceeded: "Sólo se puede adjuntar un archivo",
                dictInvalidFileType: "Sólo se aceptan GIFs",
                dictDefaultMessage:`
                <div style="text-align: center; align-content: center; display: flex;">
                <h6  style="text-align: center; margin: 2px 0;"> Adjuntar archivo </h6>
                <img style="max-height: 20px;   margin: 0rem 1rem;" src="/assets/icon/ic_upload.svg" />
                </div>
                `,
                addRemoveLinks: true,
                destroyDropzone: false
            }

        }
    },
    watch: {
    },
    methods: {
        resetForm() {
            this.$refs.form.reset();
            this.$refs.IMGDropzoneRef.removeAllFiles();
            this.$refs.AUDIOdropzoneRef.removeAllFiles();
            this.$refs.GIFdropzoneRef.removeAllFiles();
        },
        goBack() {
            this.dialog = false;
            this.resetForm();
        },
        updateData(dataUpdate) {
            // console.log(dataUpdate)
            this.number = dataUpdate.number;
            this.name = dataUpdate.name;
            this.price = dataUpdate.price;
            this.duration = dataUpdate.duration;
            this.url_image = dataUpdate.url_image;
            this.old_url_image = dataUpdate.url_image;
            this.url_audio = dataUpdate.url_audio;
            this.old_url_audio = dataUpdate.url_audio;
            this.url_gif = dataUpdate.url_gif;
            this.old_url_gif = dataUpdate.url_gif;
            this.description = dataUpdate.description;
            this.restriction_id = dataUpdate.restriction_id;
            this.category_id;
            try { this.dzUploadImage(); }catch (e) {}
            try { this.dzUploadAUDIO(); }catch (e) {}
            try { this.dzUploadGIF(); }catch (e) {}
        },
        validaNumeroPositivo: function () {
            if (parseFloat(this.number) <= 0) {
                this.number = '';
            }
        },
        validaPrecioPositivo: function () {
            if (parseFloat(this.price) <= 0) {
                this.price = '';
            }
        },
        submit() {
            let valid = this.$refs.form.validate();
            if( valid ){
                if(this.validateDropzones()){
                    if (this.validateAudioDuration()) {
                        this.loading = true;
                        axios.post(route('admin.categories.audio_upsert', {id: !this.isUpdate ? 'FAKE_ID' : this.dataUpdate.id}), this.formData()).then(response => {
                            if (response.data.success) {
                                this.$swal(
                                    {
                                        title: !this.isUpdate ? '¡Audio agregado!' : '¡Audio modificado!',
                                        text: !this.isUpdate ? 'El audio se ha agregado correctamente.' : 'El audio se ha modificado correctamente.',
                                        icon: 'success',
                                        timer: 2000,
                                        iconColor: '#62457F',
                                        showConfirmButton: false,
                                    });
                                bus.$emit('reload-grid');
                                this.goBack();
                                // location.reload();
                            } else {
                                this.$swal({
                                        title: 'Error',
                                        text: 'Revisa que los datos sean correctos',
                                        icon: 'error',
                                        timer: 2000,
                                        showConfirmButton: false,
                                    }
                                );
                            }
                            this.loading = false;
                        });
                    } else{
                        this.$swal({
                            title: 'Error',
                            text: 'No fue posible obtener la duración del audio, puede que su archivo sea incorrecto o no válido, intente con otro formato o tipo de audio.',
                            icon: 'error',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    }
                }else{
                    this.$swal({
                        title: 'Error',
                        text: 'Por favor, adjunta todos los archivos',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            }
        },
        formData() {
            let formData = new FormData();
            formData.append('number', this.number);
            let precio = parseFloat(this.price).toFixed(2);
            formData.append('price', precio);
            formData.append('name', this.name);
            formData.append('duration', this.duration);
            formData.append('description', this.description === null ? '' : this.description);
            formData.append('url_image', this.url_image);
            formData.append('old_url_image', this.old_url_image);
            formData.append('old_url_audio', this.old_url_audio);
            formData.append('url_audio', this.url_audio);
            formData.append('url_download', this.url_audio);
            formData.append('old_url_gif', this.old_url_gif);
            formData.append('url_gif', this.url_gif);
            formData.append('restriction_id', this.restriction_id);
            formData.append('phase_id', this.phase_id);
            return formData;
        },
        validateDropzones(){
            if(this.url_image===null) return false;
            if(this.url_gif===null) return false;
            if(this.url_audio===null) return false;
            return true;
        },
        validateAudioDuration(){
            if(this.duration===null) return false;
            return true;
        },
        dzTemplate: function () {
            return `
            <div class="dz-preview dz-file-preview">
                <div class="dz-details">
                    <div class="dz-size dz-filename"><span data-dz-size></span><span> - </span><span data-dz-name></span></div>
                </div>
                <div class="dz-progress"><span class="dz-upload" data-dz-uploadprogress></span></div>
                <div class="dz-error-message"><span data-dz-errormessage></span></div>
                <div class="dz-success-mark"><i class="fa fa-check"></i></div>
                <div class="dz-error-mark"><i class="fa fa-close"></i></div>
            </div>`;
        },
        dzThumbnail: function(file, dataUrl) {
                var j, len, ref, thumbnailElement;
                if (file.previewElement) {
                    file.previewElement.classList.remove("dz-file-preview");
                    ref = file.previewElement.querySelectorAll("[data-dz-thumbnail-bg]");
                    for (j = 0, len = ref.length; j < len; j++) {
                        thumbnailElement = ref[j];
                        thumbnailElement.alt = file.name;
                        thumbnailElement.style.backgroundImage = 'url("' + dataUrl + '")';
                    }
                    return setTimeout(((function(_this) {
                        return function() {
                            return file.previewElement.classList.add("dz-image-preview");
                        };
                    })(this)), 1);
                }
            },
        dzImageLoaded(){
            this.imgLoaded = true;
        },
        dzGIFLoaded(){
            this.gifLoaded = true;
        },
        dzAudioLoaded(){
            this.audioLoaded = true;
        },
        dzUploadImage() {
            if(this.isUpdate){
                this.$refs.IMGDropzoneRef.removeAllFiles(true);
                let file = { size: 1234, name: "img", type:"image/*"};
                let url = this.dataUpdate.url_image
                this.$refs.IMGDropzoneRef.manuallyAddFile(file, url);
            }
        },
        dzUploadAUDIO() {
             if(this.isUpdate){
                 this.$refs.AUDIOdropzoneRef.removeAllFiles(true);
                 let file = { size: 1234, name: "audio", type:"audio/*"};
                 let url = this.dataUpdate.url_audio
                 this.$refs.AUDIOdropzoneRef.manuallyAddFile(file, url);
             }
        },
        dzUploadGIF() {
             if(this.isUpdate){
                 this.$refs.GIFdropzoneRef.removeAllFiles(true);
                 let file = { size: 1234, name: "GIF", type:"image/gif"};
                 let url = this.dataUpdate.url_gif
                 this.$refs.GIFdropzoneRef.manuallyAddFile(file, url);
             }
        },
        dzRemovedIMG() {
            this.url_image = null;
            this.imgLoaded = false;
        },
        dzRemovedAUDIO() {
            this.url_audio = null;
            this.duration = null;
            this.audioLoaded = false;
        },
        dzRemovedGIF() {
            this.url_gif = null;
            this.gifLoaded = false;
        },
        dzError(DropzoneRef, file, message, xhr) {
            //Mismo mensaje que 'dictUploadCanceled' en las opciones del Dropzone
            if(message === "Se canceló la carga del archivo"){
                this.alerta("Archivo eliminado",message);
            }else{
                this.alerta("Error al agregar archivo:",message);
            }
            DropzoneRef.removeAllFiles();
            // DropzoneRef.removeFile(file);
        },
        dzIMGSuccess: async function (file, response) {
            if (response.success) {
                this.url_image = response.theUrl;
            }else {
                this.alerta('Ocurrio un error:',response.message);
            }
        },
         dzAUDIOSuccess: async function (file, response) {
            if (response.success) {
                this.url_audio = response.theUrl;
                this.$refs.audioSource.src = this.url_audio;
                this.$refs.audio.load();
            }else {
                this.alerta('Ocurrio un error al subir el audio:',response.message);
                console.log('response',response);
            }
        },
         dzGIFSuccess: async function (file, response) {
            if (response.success) {
                this.url_gif = response.theUrl;
            }else {
                this.alerta('Ocurrio un error:',response.message);
            }
        },
        getDuration: function (){
            this.duration = Math.round(this.$refs.audio.duration);
        },
        alerta(title, text){
            this.$swal.fire({
                html: "<h4 class='text-center color-pink'> ".concat(title+"</h4>") + "<hr/>" +
                    "<span class='text-center color-grey'> ".concat( text +"</span>"),
                showConfirmButton: false,
                showCancelButton: true,
                cancelButtonColor: '#573c72',
                cancelButtonText: "<span style='color: white'>Cerrar</span>",
                timer:4000,
                width: 400
            });
        },
        defaultValues(){
            // Los audios para la categorias de no sean  Audios de alta Tecnología (ID=8)  son gratis
            if (!this.categoriasDePago.includes(this.category_id)){
                this.price = 0;
            }
            if (this.categoriasSinRestriccion.includes(this.category_id)){
                this.restriction_id = 2;
            }else if (this.categoriasConReproduccionEnLista.includes(this.category_id)){
                this.restriction_id = 1;
            }
        }
    },
}
</script>

<style scoped>
    .pink-text{
        color: #a3326d;
        font-weight: bold;
    }

    .elDropzone{
        background-color: white !important;
        border: dotted 2px gray !important;
        border-radius: 3px;
        min-height: 50px !important;
        max-height: 100px !important;
        padding: 0rem !important;
        text-align: center;
        cursor: pointer;
    }

    .dropzoneTitle{
        text-align: center;
        align-content: center;
        display: grid;
    }

    .elDropzone:hover{
        background-color: white;
        border: dotted 2px gray;
        border-radius: 3px;
    }

</style>




