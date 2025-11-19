<template>
    <v-dialog max-height="90vh" max-width="888" v-model="dialog" style="margin-left: 4rem;">
        <v-btn class="btn-close" icon @click="goBack">
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
                Editar Afirmaciones
            </v-btn>
        </template>
        <v-card class="invisible-scrollbarr">
            <v-card-title class="d-flex justify-content-center bg-purple py-5">
                <div/>
                <div class="d-flex text-white text-center py-0 mb-0">
                    <v-img contain src="/assets/icon/ic_white_logo.svg" max-height="30"/>
                    <div class="mx-2"> Editar  Afirmaciones</div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" lazy-validation>
                    <v-container class="px-3rem">
                        <v-row justify="center">
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Afirmaciones:</b></p>
                                <jodit-editor v-model="affirmations"
                                              :config="config"
                                              :buttons="buttons"
                                />
                            </v-col>
                            <br>
                            <br>
                            <v-col cols="12" class="py-0 text-center" style="margin-top: 1.5rem">
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

export default {
    name: "InstructiveForm",
    components: {},
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

            affirmations: null,

            //Jodit-options
            content: '',
            buttons: ['fontsize','font','bold','italic','underline','strikethrough','ul','ol','paragraph'],
            config: {
                askBeforePasteHTML: false,
                language: 'es',
            },
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
            this.affirmations = dataUpdate;
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
            if (this.affirmations.length !== 0) {
                this.loading = true;
                axios.post(route('admin.categories.phase_affirmations_upsert', {id: this.$route.params.id_phase}), this.formData()).then(response => {
                    if (response.data.success) {
                        this.$swal(
                            {
                                title: !this.isUpdate ? '¡Afirmaciones agregadas!' : '¡Afirmaciones modificadas!',
                                text: !this.isUpdate ? 'Las afirmaciones se han agregado correctamente.' : 'Las afirmaciones se han modificado correctamente.',
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
                    text: 'Por favor, ingresa el contenido para las afirmaciones',
                    icon: 'error',
                    timer: 2000,
                    showConfirmButton: false,
                });
            }
        },
        formData() {
            let formData = new FormData();
            formData.append('affirmations', this.affirmations);
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


