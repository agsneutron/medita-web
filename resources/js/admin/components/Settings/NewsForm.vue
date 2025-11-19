<template>
    <v-dialog max-height="90vh" max-width="575" v-model="dialog">
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
                + Agregar noticia
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
                    <v-img contain src="/assets/icon/ic_user.svg" max-height="30"/>
                    <div class="mx-2">{{ isUpdate === false ? 'Agregar ' : 'Editar ' }} noticia</div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" lazy-validation>
                    <v-container class="px-3rem">
                        <v-row justify="center">
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Título:</b></p>
                                <v-text-field
                                    v-model="title"
                                    :rules="rules.title"
                                    color="#62457F"
                                    required
                                    dense
                                    outlined>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0">
                                <vue2Dropzone
                                    class="dotted"
                                    tabindex="1"
                                    ref="myVueDropzone"
                                    id="dropzone"
                                    :options="dropzoneOptions"
                                    @vdropzone-success="dropzoneSuccess"
                                    @vdropzone-sending="dropzoneSending"
                                    :useCustomSlot=true>
                                    <div>
                                        <h5 class="text-violet"><strong>Adjuntar imagen</strong></h5>
                                        <v-img contain src="/assets/icon/ic_upload.svg" max-height="50"/>
                                    </div>
                                </vue2Dropzone>
                            </v-col>
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>{{ isUpdate === false ? 'Cuerpo de texto ' : 'Texto ' }}</b></p>
                                <jodit-editor v-model="content"
                                              :config="config"
                                              :rules="rules.content"
                                              :buttons="buttons"
                                />
                            </v-col>
                            <v-col cols="12" class="pt-4 pb-0 text-center">
                                <v-btn color="#62457F" dark width="12rem" @click="submit" :loading="isLoading">
                                    {{ !isUpdate ? 'Agregar' : 'Editar' }}
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
    name: "NewsForm",
    components:{vue2Dropzone},
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

            title: null,

            //Dropzone options
            flag: false,
            dropzoneOptions: {
                url: route('admin.settings_news.upsert', {id: !this.isUpdate ? 'FAKE_ID' : this.dataUpdate.id}),
                headers: {
                    'X-CSRF-TOKEN': document.getElementById('csrf_token').value,
                },
                thumbnailWidth: 250,
                maxFilesize: 102400000,
                autoProcessQueue: false,
                maxFiles: 1,
                addRemoveLinks: true,
                dictMaxFilesExceeded : 'Esta imagen no puede ser agregada.',
                dictRemoveFile: 'Eliminar',
            },

            //Jodit-options
            content: '',
            buttons: ['bold','italic','underline','strikethrough','ul','ol','align','font','fontsize'],
            config: {
                askBeforePasteHTML: false,
                language: 'es',
            },

            //Rules Form,
            rules: {
                title: [v => !!v || 'El título es requerido.'],
                content: [v => !!v || 'El texto es requerido.'],
            },
        }
    },
    methods: {
        resetForm() {
            this.$refs.form.reset();
            this.$refs.myVueDropzone.removeAllFiles();
            this.content='';
        },
        goBack() {
            this.dialog = false;
            this.resetForm();
        },
        updateData(dataUpdate) {
            setTimeout(() => {
                this.title = dataUpdate.title;
                this.content = dataUpdate.content;
                let file = { size: 123, name: "Imagen_noticia", type: "image/png" };
                let url = document.getElementById('asset').value + dataUpdate.url_image;
                this.$refs.myVueDropzone.manuallyAddFile(file, url);
            }, 100);
        },
        dropzoneSuccess: async function (file, response) {
            this.$refs.myVueDropzone.removeAllFiles();
            if (response.success) {
                let alertTitle = !this.isUpdate ? '¡Noticia agregada!' : '¡Noticia modificada!';
                let alertText = !this.isUpdate ? 'La noticia se ha agregado correctamente.' : 'La noticia se ha modificado correctamente.';
                this.alert('success', alertTitle, alertText);
                bus.$emit('reload-grid');
                this.isLoading = false;
                this.goBack();
            }
        },
        dropzoneSending: async function (files, xhr, formData) {
            formData.append('title', this.title);
            formData.append('content', this.content);
        },
        formData(){
            let formData = new FormData();
            formData.append('title', this.title);
            formData.append('content', this.content);
            return formData;
        },
        submit() {
            let valid = this.$refs.form.validate();
            if (this.isUpdate && valid && this.validateUpdate()){
                axios.post(route('admin.settings_news.upsert', {id: this.dataUpdate.id}), this.formData()).then(response =>{
                    this.$refs.myVueDropzone.removeAllFiles();
                    if (response.data.success) {
                        console.log('¡Noticia agregada!');
                        let alertTitle = !this.isUpdate ? '¡Noticia agregada!' : '¡Noticia modificada!';
                        let alertText = !this.isUpdate ? 'La noticia se ha agregado correctamente.' : 'La noticia se ha modificado correctamente.';
                        this.alert('success', alertTitle, alertText);
                        bus.$emit('reload-grid');
                        this.isLoading = false;
                        this.goBack();
                    }
                });
            }
            else if (this.validate() && valid) {
                this.isLoading = true;
                this.$refs.myVueDropzone.processQueue();
            }else{
                this.alert('warning', '¡Advertencia!', 'Revise que la información sea correcta y todos los campos estén llenos.')
            }
        },
        validate(){
            let valid = true;
            if (this.content === '') valid = false;
            if (this.$refs.myVueDropzone.getAcceptedFiles().length !== 1) valid = false;
            return valid;
        },
        validateUpdate(){
            let valid = true;
            if (this.content === '') valid = false;
            if (this.$refs.myVueDropzone.getAcceptedFiles().length !== 0) valid = false;
            return valid;
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

</style>
