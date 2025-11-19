<template>
    <v-dialog max-height="90vh" max-width="500" persistent v-model="dialog">
        <v-btn @click="goBack" class="btn-close" icon>
            <v-icon class="text-white">
                mdi-window-close
            </v-icon>
        </v-btn>

        <template v-slot:activator="{ on, attrs }">
            <v-btn
                v-if="!isUpdate" color="#62457F" dark
                v-bind="attrs" v-on="on" width="12rem"
            >
                + Agregar cliente
            </v-btn>
            <v-btn
                @click="updateData(dataUpdate)"
                v-else v-bind="attrs" v-on="on"
                icon
            >
                <v-icon>$vuetify.icons.updateIcon</v-icon>
            </v-btn>
        </template>

        <v-card class="invisible-scrollbar">
            <v-card-title class="d-flex justify-content-center bg-purple py-5">
                <div class="d-flex text-white text-center py-0 mb-0">
                    <v-img contain src="/assets/icon/ic_user.svg" max-height="30"/>
                    <div class="mx-2">{{ isUpdate === false ? 'Agregar ' : 'Modificar ' }} cliente</div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" lazy-validation>
                    <v-container class="px-3rem">
                        <v-row justify="center">
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Nombre:</b></p>
                                <v-text-field
                                    v-model="customer.name"
                                    :rules="rules.name"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="6" class="py-0">
                                <p class="text-violet my-2"><b>Ap. paterno:</b></p>
                                <v-text-field
                                    v-model="customer.lastName"
                                    :rules="rules.lastName"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="6" class="py-0">
                                <p class="text-violet my-2"><b>Ap. materno (Opcional):</b></p>
                                <v-text-field
                                    v-model="customer.secondLastName"
                                    :rules="rules.secondLastName"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Teléfono (Opcional):</b></p>
                                <v-text-field
                                    v-model="customer.phone"
                                    :rules="rules.phone"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Correo electrónico:</b></p>
                                <v-text-field
                                    v-model="customer.email"
                                    :rules="rules.email"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Contraseña:</b></p>
                                <v-text-field
                                    @click:append="showPassword = !showPassword"
                                    :append-icon="showPassword ? 'mdi-eye-off' : 'mdi-eye'"
                                    :type="showPassword ? 'text' : 'password'"
                                    v-model="customer.password"
                                    :rules="rules.password"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Confirmar contraseña:</b></p>
                                <v-text-field
                                    @click:append="showConfirmPassword = !showConfirmPassword"
                                    :append-icon="showConfirmPassword ? 'mdi-eye-off' : 'mdi-eye'"
                                    :type="showConfirmPassword ? 'text' : 'password'"
                                    v-model="customer.confirmPassword"
                                    :rules="[passwordConfirmationRule]"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="6" class="py-0">
                                <p class="text-violet my-2"><b>Edad:</b></p>
                                <v-text-field
                                    v-model="customer.age"
                                    :rules="rules.age"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="6" class="py-0">
                                <p class="text-violet my-2"><b>Sexo:</b></p>
                                <v-select
                                    v-model="customer.gender"
                                    :rules="rules.gender"
                                    :items="genders"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                    item-text="name"
                                    item-value="id">
                                </v-select>
                            </v-col>
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Programa del cliente:</b></p>
                                <v-select
                                    v-model="customer.program"
                                    :rules="rules.program"
                                    :items="programs"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                    item-text="name"
                                    item-value="id">
                                </v-select>
                            </v-col>
                            <v-col cols="12" class="py-0" v-if="flag">
                                <p class="text-violet my-2"><b>Institución a la que pertenece:</b></p>
                                <v-select
                                    v-model="customer.institution"
                                    :items="institutionsWatch"
                                    :rules="rules.institution"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                    item-text="name"
                                    item-value="id">
                                </v-select>
                            </v-col>
                            <v-col cols="12" class="py-0" v-if="schoolWatch && !isTeacher">
                                <p class="text-violet my-2"><b>Escolaridad:</b></p>
                                <v-select
                                    :disabled=isTeacher
                                    v-model="customer.educationalLevel"
                                    :rules="rules.educationalLevel"
                                    :items="educationalLevels"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                    item-text="name"
                                    item-value="id">
                                </v-select>
                            </v-col>
                            <v-col cols="12" class="py-0" v-if="schoolWatch && !isTeacher">
                                <p class="text-violet my-2"><b>Grado:</b></p>
                                <v-select
                                    :disabled=isTeacher
                                    v-model="customer.degree"
                                    :rules="rules.degree"
                                    :items="schoolLevelWatch"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                    item-text="name"
                                    item-value="id">
                                </v-select>
                            </v-col>
                            <v-col
                                v-if="schoolWatch"
                                cols="12"
                                class="py-0 text-center d-flex justify-content-center align-items-center">
                                <v-checkbox
                                    v-on:change="isTeacherChanged"
                                    v-model="customer.isTeacher"
                                    class="mb-3"
                                    color="#A3326D"
                                    :false-value="0"
                                    :true-value="1"
                                >
                                </v-checkbox>
                                <p class="text-violet"><b>¿Es usted docente?</b></p>
                            </v-col>
                            <v-col cols="12" class="py-0 text-center">
                                <v-btn color="#62457F" dark width="12rem" @click="submit" :loading="isLoading">
                                    {{ !isUpdate ? 'Agregar cliente' : 'Guardar' }}
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
    name: "CustomersForm",
    props: {
        isUpdate: {
            required: false,
            default: function () {
                return false;
            }
        },

        dataUpdate: {
            type: Object,
            required: false,
        },

        genders: {
            type: Array,
            required: true,
        },

        programs: {
            type: Array,
            required: true,
        },

        institutions: {
            type: Array,
            required: true,
        },

        educationalLevels: {
            type: Array,
            required: true,
        },

        levels: {
            type: Array,
            required: true,
        }
    },

    data: () => ({
        dialog: false,
        isLoading: false,
        showPassword: false,
        showConfirmPassword: false,

        isTeacher: false,
        customer: {
            name: null,
            lastName: null,
            secondLastName: null,
            phone: null,
            email: null,
            password: null,
            confirmPassword: null,
            age: null,
            gender: null,
            program: null,
            institution: null,
            educationalLevel: null,
            degree: null,
            isTeacher: 0,
        },

        rules: {
            name: [v => !!v || 'El nombre es requerido.'],
            lastName: [v => !!v || 'El apellido paterno es requerido.'],
            // secondLastName: [v => !!v || 'El apellido materno es requerido.'],
            phone: [
                // v => !!v || 'La contraseña es requerida.',
                // v => v && !v.length >= 1 && !v.length < 11  || 'Deben de ser 10 dígitoss.'
            ],
            email: [
                v => !!v || 'El correo es requerido.',
                v => /^\w+([.-]?\w+)*@\w+([.-]?\w+)*(\.\w{2,3})+$/.test(v) || 'El correo debe tener un formato válido.'
            ],
            password: [
                v => (v && v.length >= 8) || !v  || 'Minimo 8 caracteres.'
            ],
            age: [
                v => !!v || 'La edad es requerida.',
                v => Number.isInteger(Number(v)) || 'La edad debe tener un formato válido.'
            ],
            gender: [v => !!v || 'El género es requerido.'],
            program: [v => !!v || 'El programa es requerido.'],
            institution: [v => !!v || 'La institución es requerida.'],
            educationalLevel: [v => !!v || 'El nivel escolar es requerido.'],
            degree: [v => !!v || 'El grado es requerido.'],

        }
    }),

    computed: {
        flag() {
            return this.customer.program !== 1;
        },

        schoolWatch() {
            return this.customer.program === 2;
        },

        institutionsWatch() {
            switch (this.customer.program) {
                case 2 :
                    return this.institutions.filter(institution => institution.type_client_id === 1);

                case 3 :
                    return this.institutions.filter(institution => institution.type_client_id === 2);

                case 4 :
                    return this.institutions.filter(institution => institution.type_client_id === 3);

                default :
                    return this.institutions;
            }
        },

        schoolLevelWatch() {
            switch (this.customer.educationalLevel) {
                case 1 :
                    return this.levels.filter(level => level.educational_level_id === 1);

                case 2 :
                    return this.levels.filter(level => level.educational_level_id === 2);

                case 3 :
                    return this.levels.filter(level => level.educational_level_id === 3);

                case 4 :
                    return this.levels.filter(level => level.educational_level_id === 4);

                case 5 :
                    return this.levels.filter(level => level.educational_level_id === 5);

                default :
                    return this.levels;
            }
        },

        passwordConfirmationRule() {
            return () => (this.customer.password === this.customer.confirmPassword) || (!this.customer.password && !this.customer.confirmPassword)  || 'La contraseña debe coincidir.'
        },
    },

    methods: {
        isTeacherChanged(){
            if(this.customer.isTeacher){
                this.customer.educationalLevel = null;
                this.customer.degree = null;
                this.isTeacher = true
            }else{
                this.isTeacher = false
            }
        },
        async submit() {
            let valid = this.$refs.form.validate();
            if (valid) {
                this.isLoading = true;
                const {data} = await axios.post(route('admin.clients.upsert', {id: !this.isUpdate ? 'FAKE_ID' : this.dataUpdate.id}), this.formData()
                );

                if (data.success) {
                    this.isLoading = false;
                    this.alert(
                        'success',
                        !this.isUpdate ? '¡Cliente agregado' : '¡Cliente modificado!',
                        !this.isUpdate ? 'El cliente se ha agregado correctamente' : 'El cliente se ha modificado correctamente'
                    );

                    bus.$emit('reload-grid');
                    this.goBack();

                } else {
                    if (data.message === 'correo duplicado') {
                        this.alert('error', 'Error', 'Ya existe un cliente asociado al correo: ' + data.email);
                    } else {
                        this.alert('error', 'Error', 'Revisa que los datos sean correctos');
                    }

                    this.isLoading = false;
                }
            }
        },

        formData() {
            let formData = new FormData();
            if(this.customer.password !== null){
                formData.append('password', this.customer.password);
            }
            if(this.customer.program === 1) {
                formData.append('name', this.customer.name);
                formData.append('last_name', this.customer.lastName);
                formData.append('second_last_name', this.customer.secondLastName === null ? '' : this.customer.secondLastName);
                formData.append('phone', this.customer.phone === null ? '' : this.customer.phone);
                formData.append('age', this.customer.age);
                formData.append('email', this.customer.email);
                formData.append('gender_id', this.customer.gender);
                formData.append('program_id', this.customer.program);
                formData.append('institution_id', '');
                formData.append('educational_level_id', '');
                formData.append('degree', '');
                return formData;
            } else if(this.customer.program === 2) {
                formData.append('name', this.customer.name);
                formData.append('last_name', this.customer.lastName);
                formData.append('second_last_name', this.customer.secondLastName === null ? '' : this.customer.secondLastName);
                formData.append('phone', this.customer.phone === null ? '' : this.customer.phone);
                formData.append('age', this.customer.age);
                formData.append('email', this.customer.email);
                formData.append('gender_id', this.customer.gender);
                formData.append('program_id', this.customer.program);
                formData.append('institution_id', this.customer.institution);
                formData.append('educational_level_id', this.isTeacher ? '' : this.customer.educationalLevel);
                formData.append('degree', this.isTeacher ? '' : this.customer.degree);
                formData.append('teacher', this.customer.isTeacher);
                return formData
            } else {
                formData.append('name', this.customer.name);
                formData.append('last_name', this.customer.lastName);
                formData.append('second_last_name', this.customer.secondLastName === null ? '' : this.customer.secondLastName);
                formData.append('phone', this.customer.phone === null ? '' : this.customer.phone);
                formData.append('age', this.customer.age);
                formData.append('email', this.customer.email);
                formData.append('gender_id', this.customer.gender);
                formData.append('program_id', this.customer.program);
                formData.append('institution_id', this.customer.institution);
                formData.append('educational_level_id', '');
                formData.append('degree', '');
                return formData;
            }
        },

        updateData(dataUpdate) {
            this.customer.name = dataUpdate.name;
            this.customer.lastName = dataUpdate.last_name;
            this.customer.secondLastName = dataUpdate.second_last_name;
            this.customer.phone = dataUpdate.phone;
            this.customer.email = dataUpdate.email;
            this.customer.age = dataUpdate.age;
            this.customer.gender = dataUpdate.gender.id;
            this.customer.program = dataUpdate.program.id;
        },

        resetForm() {
            this.$refs.form.reset();
        },

        goBack() {
            this.dialog = false;
            this.resetForm();
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
