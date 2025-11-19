<template>
    <v-dialog max-height="90vh" max-width="700" v-model="dialog">
        <v-btn class="btn-close" icon @click="goBack">
            <v-icon class="text-white">
                mdi-window-close
            </v-icon>
        </v-btn>
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                v-if="!isUpdate"
                color="#62457F"
                dark
                width="12rem"
                v-bind="attrs"
                v-on="on">
                + Agregar categoría
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
                    <div class="mx-2">{{ isUpdate === false ? 'Agregar ' : 'Modificar ' }} categoría</div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" lazy-validation>
                    <v-container class="px-3rem">
                        <v-row justify="center">
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
                            <v-col cols="12" class="py-0" v-if="this.categoriasConDuracion.includes(dataUpdate.id)">
                                <p class="text-violet my-2"><b>Duración.</b></p>
                                <v-text-field
                                    v-model="duration"
                                    :rules="rules.duration"
                                    color="#62457F"
                                    required
                                    dense
                                    outlined>
                                </v-text-field>
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
                            </v-row>
                            <v-row justify="center">
                            <br>
                            <v-col cols="12" class="py-0" style="text-align: center;">

                                <vue2-dropzone
                                    class="elDropzone"
                                    ref="categoriesDropzone"
                                    id="categoriesDropzone"
                                    :options="dropzoneOptions"
                                    @vdropzone-mounted="dzUploadImage"
                                    @vdropzone-removed-file="dzRemovedFile"
                                    @vdropzone-success="dzSuccess"
                                    @vdropzone-error="(file, message, xhr) =>{dzError(file, message, xhr)}"
                                >
                                </vue2-dropzone>
                            </v-col>
                            <v-col class="col offset-4 col-8">
                                <div style="display: flex; align-items: center;">
                                    <img  style="max-height: 18px; margin-right: 1rem" src="/assets/icon/ic_info.svg" />
                                    <p style="color: gray; margin: 0; text-align: justify; font-size: 11px">
                                        La imagen debe tener un tamaño de 430x280px o proporción a esta medida
                                    </p>
                                </div>

                            </v-col>

                            <v-col cols="12" class="py-0 text-center" style="margin-top: 1rem">
                                <v-btn color="#62457F" dark width="12rem" @click="submit" :loading="isLoading">
                                    {{ !isUpdate ? 'Agregar categoría' : 'Guardar' }}
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
    name: "CategoriesForm",
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
    },
    data() {
        return {
            dialog: false,
            isLoading: false,

            categoriasConDuracion: [0,1],

            name: null,
            duration: null,
            description: null,
            url_image: null,
            old_url_image: '',

            //Rules Form,
            rules: {
                name: [v => !!v || 'El nombre es requerido.'],
                duration: [v => !!v || 'La duración  es requerida.'],
                description: [v => !!v || 'La descripción  es requerida.'],
            },

            dropzoneOptions: {
                url: route('admin.categories.add_file'),
                headers: { 'X-CSRF-TOKEN': document.getElementById('csrf_token').value },
                thumbnailWidth: 150,
                thumbnailHeight: 150,
                resizeWidth: 250,
                resizeHeight: 240,
                thumbnailMethod: 'crop',
                maxFileSize: 102400000,
                maxFiles: 1,
                uploadMultiple: false,
                autoProcessQueue: true,
                acceptedFiles: 'image/*',
                dictRemoveFile: "Eliminar",
                dictCancelUpload: "Cancelar",
                dictUploadCanceled: "Se canceló la carga del archivo",
                dictMaxFilesExceeded: "Sólo se puede adjuntar una imagen",
                dictInvalidFileType: "Sólo se aceptan imagenes",

                dictDefaultMessage:`
                <h6   style="text-align: center"> Adjuntar Imagen </h6> <br>
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
            // this.resetForm();
        },
        updateData(dataUpdate) {
            this.name = dataUpdate.name;
            this.duration = dataUpdate.duration;
            this.description = dataUpdate.description;
            this.url_image = dataUpdate.url_image;
            this.old_url_image = dataUpdate.url_image;
            try { this.dzUploadImage(); }catch (e) {}
        },
        submit() {
            let valid = this.$refs.form.validate();
            if( valid ){
                if (this.url_image !== null) {
                    this.loading = true;
                    axios.post(route('admin.categories.upsert', {id: !this.isUpdate ? 'FAKE_ID' : this.dataUpdate.id}), this.formData()).then(response => {
                        if (response.data.success) {
                            this.$swal(
                                {
                                    title: !this.isUpdate ? '¡Categoría agregada!' : '¡Categoría modificada!',
                                    text: !this.isUpdate ? 'La categoría se ha agregado correctamente.' : 'La categoría se ha modificado correctamente.',
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
                                });
                        }
                        this.loading = false;
                    });
                }else{
                    this.$swal({
                        title: 'Error',
                        text: 'Por favor, adjunta una imagen',
                        icon: 'error',
                        timer: 2000,
                        showConfirmButton: false,
                    });
                }
            }

        },
        formData() {
            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('old_url_image', this.old_url_image);
            formData.append('url_image', this.url_image);
            formData.append('description', this.description);
            formData.append('duration', this.duration === null ? "..." : this.duration);
            return formData;
        },
        dzUploadImage() {
            this.$refs.categoriesDropzone.removeAllFiles();
            let file = { size: 1234, name: "img.jpg"};
            let url = this.dataUpdate.url_image
            this.$refs.categoriesDropzone.manuallyAddFile(file, url);
        },
        dzMaxFilesExceeded(file) {
            this.alerta("Error al agregar archivo:","Ya hay una imagen adjunta");
            this.$refs.categoriesDropzone.removeFile(file);
        },
        dzRemovedFile() {
           this.url_image = null;
        },
        dzError(file, message, xhr) {
            this.alerta("Error al agregar archivo:",message);
            this.$refs.categoriesDropzone.removeAllFiles();
            // this.$refs.categoriesDropzone.removeFile(file);
        },
        dzSuccess: async function (file, response) {
            if (response.success) {
                this.url_image = response.theUrl;
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
        }
    },
    mounted(){
    }
}
</script>

<style scoped>

    .elDropzone{
        background-color: white;
        border: dotted 2px gray;
        border-radius: 3px;
    }

    .elDropzone:hover{
        background-color: white;
        border: dotted 2px gray;
        border-radius: 3px;
    }

</style>


