<template>
    <v-dialog max-height="90vh" max-width="500" v-model="dialog">
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
                + Agregar usuario
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
                    <div class="mx-2">{{ isUpdate === false ? 'Agregar ' : 'Modificar ' }} usuario</div>
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
                            <v-col cols="6" class="py-0">
                                <p class="text-violet my-2"><b>Apellido paterno:</b></p>
                                <v-text-field
                                    v-model="last_name"
                                    :rules="rules.last_name"
                                    color="#62457F"
                                    required
                                    dense
                                    outlined>
                                </v-text-field>
                            </v-col>
                            <v-col cols="6" class="py-0">
                                <p class="text-violet my-2"><b>Apellido materno:</b></p>
                                <v-text-field
                                    v-model="second_last_name"
                                    :rules="rules.second_last_name"
                                    color="#62457F"
                                    required
                                    dense
                                    outlined>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Correo electrónico:</b></p>
                                <v-text-field
                                    v-model="email"
                                    :rules="rules.email"
                                    color="#62457F"
                                    required
                                    dense
                                    outlined>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Perfil:</b></p>
                                <v-select
                                    v-model="profile"
                                    :items="profiles"
                                    :rules="rules.profile"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                    item-text="name"
                                    item-value="id">
                                </v-select>
                            </v-col>
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Contraseña:</b></p>
                                <v-text-field
                                    v-model="password"
                                    :rules="rules.password"
                                    color="#62457F"
                                    required
                                    outlined
                                    dense
                                    type="password">
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Confirmar contraseña:</b></p>
                                <v-text-field
                                    v-model="confirmPassword"
                                    :rules="rules.confirmPassword"
                                    color="#62457F"
                                    required
                                    outlined
                                    dense
                                    type="password">
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0 text-center">
                                <v-btn color="#62457F" dark width="12rem" @click="submit" :loading="isLoading">
                                    {{ !isUpdate ? 'Agregar usuario' : 'Guardar' }}
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
    name: "UsersForm",
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
        profiles: {
            type: Array,
        }
    },
    data() {
        return {
            dialog: false,
            isLoading: false,

            name: null,
            last_name: null,
            second_last_name: null,
            email: null,
            profile: null,
            password: null,
            confirmPassword: null,

            //Rules Form,
            rules: {
                name: [v => !!v || 'El nombre es requerido.'],
                last_name: [v => !!v || 'El apellido paterno es requerido.'],
                second_last_name: [v => !!v || 'El apellido materno es requerido.'],
                email: [v => !!v || 'El correo es requerido.', v => /.+@.+/.test(v) || 'El correo debe ser válido.'],
                profile: [v => !!v || 'El perfil es requerido.'],
                password: this.isUpdate ? [] : [
                    v => !!v || 'La contraseña es requerida',
                    v => (v && v.length >= 8) || 'La contraseña debe tener contener al menos 8 dígitos'
                ],
                confirmPassword: [],
            },
        }
    },
    watch: {
        password(val) {
            if (val !== '' && val !== null && val !== undefined && !this.isUpdate) {
                this.rules.update_password = [
                    v => !!v || 'La contraseña es requerida',
                    v => (v && v.length >= 8) || 'La contraseña debe tener contener al menos 8 dígitos'
                ];
            }
            if (val !== this.confirmPassword) {
                this.rules.confirmPassword = [
                    'Las contraseñas no coinciden'
                ];
            } else {
                this.rules.confirmPassword = [];
            }
        },
        confirmPassword(val) {
            if (val !== this.password) {
                this.rules.confirmPassword = [
                    'Las contraseñas no coinciden'
                ];
            } else {
                this.rules.confirmPassword = [];
            }
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
            this.name = dataUpdate.name;
            this.last_name = dataUpdate.last_name;
            this.second_last_name = dataUpdate.second_last_name;
            this.email = dataUpdate.email;
            this.profile = dataUpdate.role_id;
        },
        submit() {
            let valid = this.$refs.form.validate();
            if (valid) {
                this.loading = true;
                axios.post(route('admin.users.upsert', {id: !this.isUpdate ? 'FAKE_ID' : this.dataUpdate.id}), this.formData()).then(response => {
                    if (response.data.success) {
                        this.$swal(
                            {
                                title: !this.isUpdate ? '¡Usuario agregado!' : '¡Usuario modificado!',
                                text: !this.isUpdate ? 'El usuario se ha agregado correctamente.' : 'El usuario se ha modificado correctamente.',
                                icon: 'success',
                                iconColor: '#62457F',
                                showConfirmButton: false,
                            });
                        bus.$emit('reload-grid');
                        this.goBack();
                        location.reload();
                    } else {
                        this.$swal({
                                title: '¡Advertencia!',
                                text: 'Revisa que los datos sean correctos.',
                                icon: 'warning',
                                iconColor: '#62457F',
                                showConfirmButton: false,
                            }
                        );
                    }
                    this.loading = false;
                });
            }
        },
        formData() {
            let formData = new FormData();
            formData.append('name', this.name);
            formData.append('last_name', this.last_name);
            formData.append('second_last_name', this.second_last_name);
            formData.append('email', this.email);
            formData.append('role_id', this.profile);
            if (this.password !== '' && this.password !== null && this.password !== undefined)
                formData.append('password', this.password);
            return formData;
        }
    }
}
</script>

<style scoped>

</style>
