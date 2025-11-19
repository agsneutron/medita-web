<template>
    <v-dialog max-width="700" v-model="dialog">
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
                Editar Información
            </v-btn>
        </template>
        <v-card class="invisible-scrollbar">
            <v-card-title class="d-flex justify-content-center bg-purple py-5">
                <div/>
                <div class="d-flex text-white text-center py-0 mb-0">
                    <v-img contain src="/assets/icon/ic_user.svg" max-height="30"/>
                    <div class="mx-2">Editar términos y condociones</div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" lazy-validation>
                    <v-container class="px-3rem">
                        <v-row justify="center">
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Términos y condociones</b></p>
                                <jodit-editor v-model="content"
                                              :config="config"
                                              :rules="rules.content"
                                              :buttons="buttons"
                                />
                            </v-col>
                            <v-col cols="12" class="pt-4 pb-0 text-center">
                                <v-btn color="#62457F" dark width="12rem" @click="submit" :loading="isLoading">
                                    Editar
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
    name: "TermsForm",
    props: {
        dataUpdate: {
            type: Object,
            required: false
        },
    },
    data() {
        return {
            dialog: false,
            isLoading: false,

            content: '',
            buttons: ['bold','italic','underline','strikethrough','ul','ol','align','font','fontsize'],
            config: {
                height: '60vh',
                askBeforePasteHTML: false,
                language: 'es',
            },

            //Rules Form,
            rules: {
                content: [v => !!v || 'El texto es requerido.'],
            },
        }
    },
    methods: {
        resetForm() {
            this.content='';
        },
        goBack() {
            this.dialog = false;
            this.resetForm();
        },
        updateData(dataUpdate) {
            this.content = dataUpdate.content;
        },
        formData(){
            let formData = new FormData();
            formData.append('content', this.content);
            return formData;
        },
        submit() {
            let valid = this.$refs.form.validate();
            if (valid && this.content !== ''){
                this.isLoading = true;
                axios.post(route('admin.settings_terms.upsert'), this.formData()).then(response =>{
                    if (response.data.success) {
                        this.$emit('reload');
                        this.isLoading = false;
                        this.goBack();
                    }
                });
            }else{
                this.alert('warning', '¡Advertencia!', 'Revise que la información sea correcta y todos los campos estén llenos.')
            }
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
