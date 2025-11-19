<template>
    <v-dialog max-width="500" v-model="dialog" style="margin-left: 4rem">
        <v-btn class="btn-close" icon @click="goBack" style="margin-top: 8rem">
            <v-icon class="text-white">
                mdi-window-close
            </v-icon>
        </v-btn>
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                @click="updateData(dataUpdate)"
                color="#62457F"
                dark
                width="12rem"
                v-bind="attrs"
                v-on="on">
                Cambiar Manual
            </v-btn>
        </template>
        <v-card class="invisible-scrollbar" style="height: auto">
            <v-card-title class="d-flex justify-content-center bg-purple py-5">
                <div/>
                <div class="d-flex text-white text-center py-0 mb-0">
                    <v-img contain src="/assets/icon/ic_white_logo.svg" max-height="30"/>
                    <div class="mx-2">Cambiar  Manual</div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" lazy-validation>
                    <v-container class="px-3rem">
                        <v-row justify="center" style="margin: 1rem 0rem;">
                            <v-col cols="4" class="p-0 dropzoneTitle">
                                <p class="m-0 pink-text"> Adjuntar Manual </p>
                            </v-col>
                            <v-col cols="8" class="py-0" style="text-align: center;">
                                <vue2-dropzone
                                    class="elDropzone"
                                    ref="manualDropzone"
                                    id="manualDropzone"
                                    :options="dropzoneOptions"
                                    :useCustomSlot=true
                                    :include-styling="false"
                                    v-on:vdropzone-thumbnail="this.dzThumbnail"
                                    @vdropzone-file-added="dzFileLoaded"
                                    @vdropzone-mounted="dzUploadFile"
                                    @vdropzone-removed-file="dzRemovedFile"
                                    @vdropzone-success="dzSuccess"
                                    @vdropzone-error="(file, message, xhr) =>{dzError(file, message, xhr)}"
                                >
                                    <div>
                                        <div v-if="!fileLoaded">
                                            <h6  style="margin: 1rem;"> Adjuntar archivo
                                                <img style="max-height: 17px;margin-left: .5rem;margin-bottom: .3rem;" src="/assets/icon/ic_upload.svg" />
                                            </h6>
                                        </div>
                                    </div>
                                </vue2-dropzone>
                            </v-col>
                            <v-col cols="12" class="py-0 text-center" style="margin-top: 3rem">
                                <v-btn color="#62457F" dark width="12rem" @click="submit" :loading="isLoading">
                                    Guardar
                                </v-btn>
                            </v-col>
                        </v-row>
                    </v-container>
                </v-form>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import {bus} from "../../app";
import vue2Dropzone from 'vue2-dropzone';

export default {
    name: "ManualForm",
    components: {vue2Dropzone},
    props: {
        dataUpdate: {
            type: String,
            required: true
        },

    },
    data() {
        return {
            dialog: false,
            isLoading: false,
            isUpdate: true,
            url: '',
            fileLoaded: false,

            dropzoneOptions: {
                url: route('admin.categories.add_file'),
                headers: { 'X-CSRF-TOKEN': document.getElementById('csrf_token').value },
                timeout: 300000,
                thumbnailWidth: 150,
                thumbnailHeight: 150,
                resizeWidth: 250,
                resizeHeight: 240,
                thumbnailMethod: 'crop',
                maxFileSize: 102400000,
                maxFiles: 1,
                uploadMultiple: false,
                autoProcessQueue: true,
                previewTemplate: this.dzTemplate(),
                acceptedFiles: 'application/pdf',
                dictRemoveFile: "Eliminar",
                dictCancelUpload: "Cancelar",
                dictUploadCanceled: "Se canceló la carga del archivo",
                dictCancelUploadConfirmation:"Desea cancelar la carga del archivo?",
                dictMaxFilesExceeded: "Sólo se puede adjuntar un archivo",
                dictInvalidFileType: "Sólo se aceptan archivos PDF",
                dictDefaultMessage:`
                <h6   style="text-align: center"> Adjuntar Archivo </h6> <br>
                <img  style="max-height: 25px" src="/assets/icon/ic_upload.svg" />
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
        },
        goBack() {
            this.dialog = false;
            this.resetForm();
        },
        updateData(dataUpdate) {
            this.url = dataUpdate;
            try { this.dzUploadFile(); }catch (e) {}
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
        dzFileLoaded(){
            this.fileLoaded = true;
        },
        dzUploadFile() {
            this.$refs.manualDropzone.removeAllFiles(true);
            let file = { size: 1234, name: "file.pdf"};
            let url = this.dataUpdate
            this.$refs.manualDropzone.manuallyAddFile(file, url);
        },
        dzMaxFilesExceeded(file) {
            this.alerta("Error al agregar archivo:","Ya hay un archivo adjunto");
            this.$refs.manualDropzone.removeFile(file);
        },
        dzRemovedFile() {
            this.url = null;
            this.fileLoaded = false;
        },
        dzError(file, message, xhr) {
            //Mismo mensaje que 'dictUploadCanceled' en las opciones del Dropzone
            if(message === "Se canceló la carga del archivo"){
                this.alerta("Archivo eliminado",message);
            }else{
                this.alerta("Error al agregar archivo:",message);
            }
            this.$refs.manualDropzone.removeAllFiles();
        },
        dzSuccess: async function (file, response) {
            if (response.success) {
                this.url = response.theUrl;
            }else {
                this.alerta('Ocurrio un error:',response.message);
            }
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
        submit() {
            if (this.url !== null) {
                this.loading = true;
                axios.post(route('admin.categories.phase_manual_upsert', {id: this.$route.params.id_phase}), this.formData()).then(response => {
                    if (response.data.success) {
                        this.$swal(
                            {
                                title: !this.isUpdate ? '¡Manual agregado!' : '¡Manual modificado!',
                                text: !this.isUpdate ? 'El manual se ha agregado correctamente.' : 'El manual se ha cambiado correctamente.',
                                icon: 'success',
                                timer: 2000,
                                iconColor: '#62457F',
                                showConfirmButton: false,
                            });
                        this.goBack();
                        location.reload();
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
            }else{
                this.$swal({
                    title: 'Error',
                    text: 'Por favor, adjunta un archivo',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false,
                });
            }
        },
        formData() {
            let formData = new FormData();
            formData.append('url', this.url);
            return formData;
        },
        alert(icon, title, text) {
            this.$swal({
                icon,
                title: `<span class="text-violet">` + title + `</span>`,
                text,
                iconColor: '#62457F',
                showConfirmButton: false,
                timer: 2000,
            });
        }
    }
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

