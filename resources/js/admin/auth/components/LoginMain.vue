<template>
    <div>
        <v-container class="d-flex align-items-center h-100vh">
            <v-card class="p-5" max-width="500" outlined>
                <div class="d-flex justify-content-center">
                    <div class="text-center w-100vh">
                        <v-img contain src="/assets/logo/logo.svg" max-height="100"/>
                        <h2 class="my-5 py-5 text-violet">Iniciar sesión</h2>
                        <div class="text-left text-violet px-2 mb-1">Correo electrónico</div>
                        <v-text-field
                            v-model="form.user"
                            class="px-2"
                            placeholder="Ingresa tu correo"
                            outlined
                            dense
                        ></v-text-field>
                        <div class="text-left text-violet px-2 mb-1">Contraseña</div>
                        <v-text-field
                            v-model="form.password"
                            class="px-2"
                            :append-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
                            placeholder="Ingresa tu contraseña"
                            :type="showPassword ? 'text' : 'password'"
                            outlined
                            dense
                            @click:append="showPassword = !showPassword"
                        ></v-text-field>
                    </div>
                </div>
                <div class="d-flex justify-content-end px-2 mb-2">
                    <ResetPasswordForm/>
                </div>

                <v-card-actions class="d-flex justify-content-center">
                    <v-btn class="bg-purple text-white w-54vh px-2" outlined text @click="submit" :loading="isLoading">
                        Iniciar sesión
                    </v-btn>
                </v-card-actions>
            </v-card>
        </v-container>
    </div>
</template>

<script>
import ResetPasswordForm from "./ResetPasswordForm";
export default {
    name: "LoginMain",
    components: {ResetPasswordForm},
    data() {
        return {
            showPassword: false,
            isLoading: false,
            form: {
                user: null,
                password: null,
            },
        }
    },
    methods: {
        submit() {
            this.isLoading = true;
            axios.post(route('auth.login'), {user: this.form.user, password: this.form.password})
                .then((response) => {
                    if (response.data.success) {
                        this.$swal({
                            position: 'center',
                            icon: 'success',
                            iconColor: '#62457F',
                            title: '¡Bienvenido!',
                            text: 'MEDITA MÉXICO A.C',
                            showConfirmButton: false,
                            timer: 2000
                        }).then(() => {
                            window.location.href = "/admin/dashboard";
                        });
                    } else {
                        this.$swal({
                            position: 'center',
                            icon: 'warning',
                            iconColor: '#62457F',
                            title: '¡Advertencia!',
                            text: 'Verifica los datos ingresados, el correo o contraseña son incorrectos.',
                            showConfirmButton: false,
                            timer: 2000
                        });
                    }
                    this.isLoading = false;
                })
                .catch(err => {

                });
        },
        resetPassword(){

        }
    }
}
</script>

<style scoped>

</style>
