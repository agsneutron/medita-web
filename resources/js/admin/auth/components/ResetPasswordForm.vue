<template>
    <v-dialog max-width="500" v-model="dialog">
        <template v-slot:activator="{ on, attrs }">
            <small class="text-gray cursor-pointer" @click="dialog = true">Olvide mi contraseña</small>
        </template>
        <v-card class="invisible-scrollbar h-auto">
            <v-card-title class="d-flex justify-content-center bg-purple py-5">
                <div/>
                <div class="d-flex text-white text-center py-0 mb-0">
                    <div class="mx-2">Restaurar contraseña</div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" lazy-validation>
                    <v-container class="px-3rem">
                        <v-row justify="center">
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Correo electrónico</b></p>
                                <v-text-field
                                    v-model="email"
                                    :rules="rules.email"
                                    placeholder="Ingresa tu correo"
                                    color="#62457F"
                                    required
                                    dense
                                    outlined>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0 text-center">
                                <v-btn color="#62457F" dark width="12rem" @click="submit" :loading="isLoading">
                                    Enviar
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
    name: "ResetPasswordForm",
    data() {
        return {
            dialog: false,
            isLoading: false,

            email: null,
            //Rules Form,
            rules: {
                email: [v => !!v || 'El correo es requerido.', v => /.+@.+/.test(v) || 'El correo debe ser válido.'],
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
        submit() {
            let valid = this.$refs.form.validate();
            if (valid) {
                this.isLoading = true;
                axios.post(route('auth.reset'),{email: this.email}).then(response => {
                    if (response.data.success) {
                        this.$swal({
                                title: '¡Éxito!',
                                text: 'Se envio su contraseña al correo.',
                                icon: 'success',
                                iconColor: '#62457F',
                                showConfirmButton: false,
                                timer: 2000
                            }
                        );
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
                    this.isLoading = false;
                });
            }
        },
    }
}
</script>

<style scoped>

</style>
