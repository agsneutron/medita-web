<template>
    <v-dialog max-width="500" v-model="dialog">
        <v-btn class="btn-close-center" icon @click="goBack">
            <v-icon class="text-white">
                mdi-window-close
            </v-icon>
        </v-btn>
        <template v-slot:activator="{ on, attrs }">
            <v-btn icon @click="updateData(dataUpdate)"
                   :disabled="!dataUpdate.code"
                   :class="dataUpdate.code ? '' : 'opacity-5'"
                   v-on="on"
                   v-bind="attrs">
                <v-img contain src="/assets/icon/ic_lock.svg" max-height="20"/>
            </v-btn>
        </template>
        <v-card class="invisible-scrollbar h-auto">
            <v-card-title class="d-flex justify-content-center bg-purple py-5">
                <div/>
                <div class="d-flex text-white text-center py-0 mb-0">
                    <v-img contain src="/assets/icon/ic_lock.svg" max-height="30"/>
                    <div class="mx-2">Generar código de acceso</div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" lazy-validation>
                    <v-container class="px-3rem">
                        <v-row justify="center">
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Código actual:</b></p>
                                <v-text-field
                                    v-model="code"
                                    :rules="rules.code"
                                    color="#62457F"
                                    required
                                    readonly
                                    dense
                                    outlined>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0 text-center">
                                <v-btn color="#62457F" dark width="12rem" @click="submit" :loading="isLoading">
                                    Generar nuevo código
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

export default {
    name: "CodeForm",
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

            code: null,
            //Rules Form,
            rules: {
                code: [v => !!v || 'El código es requerido.'],
            },
        }
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
            this.code = dataUpdate.code;
        },
        submit() {
            let valid = this.$refs.form.validate();
            if (valid) {
                this.isLoading = true;
                this.$swal(
                    {
                        title: `<h4 class='text-center text-violet'> Generar nuevo código </h4>`,
                        text: `¿Estás seguro de que quieres generar un nuevo código de acceso? Al generar un nuevo código, el anterior quedará inservible.`,
                        icon: 'info',
                        iconColor: '#62457F',
                        confirmButtonColor: '#62457F',
                        confirmButtonText: 'Aceptar',
                        showCancelButton: true,
                        cancelButtonColor: '#62457F',
                        cancelButtonText: "Cancelar",
                        reverseButtons: true
                    }).then((result) => {
                    if (result.isConfirmed) {
                        axios.get(route('admin.income.codeChange', {id: this.dataUpdate.id})).then(response => {
                            if (response.data.success) {
                                let code = response.data.code;
                                this.$swal(
                                    {
                                        title: `<h4 class='text-center text-violet'> Código generado </h4>`,
                                        text: 'El código ha sido generado correctamente.',
                                        icon: 'success',
                                        iconColor: '#62457F',
                                        confirmButtonColor: '#62457F',
                                        input: 'text',
                                        inputValue: code,
                                        inputAttributes: {
                                            readonly: 'true',
                                        },
                                        customClass:{
                                            input: 'text-center mx-auto rounded',
                                        },
                                        showConfirmButton: false,
                                    });
                                bus.$emit('reload-grid');
                                this.goBack();
                            } else {
                                this.$swal({
                                        title: '¡Advertencia!',
                                        text: 'Ocurrió un problema, inténtelo más tarde.',
                                        icon: 'warning',
                                        iconColor: '#62457F',
                                        showConfirmButton: false,
                                    }
                                );
                            }
                            this.loading = false;
                        });
                        this.$swal(
                            {
                                title: `<h4 class='text-center text-violet'> Generar nuevo código </h4>`,
                                text: `¿Estás seguro de que quieres generar un nuevo código de acceso? Al generar un nuevo código, el anterior quedará inservible.`,
                                icon: 'info',
                                iconColor: '#62457F',
                                confirmButtonColor: '#62457F',
                                confirmButtonText: 'Aceptar',
                                showCancelButton: true,
                                cancelButtonColor: '#62457F',
                                cancelButtonText: "Cancelar",
                                reverseButtons: true
                            })
                    } else if (result.isDismissed) {
                        this.goBack();
                    }
                    this.isLoading = false;
                });
            }
        },
    }
}
</script>

<style scoped>

</style>
