<template>
    <v-dialog max-height="90vh" max-width="500" v-model="dialog">
        <v-btn class="btn-close" icon @click="goBack">
            <v-icon class="text-white">
                mdi-window-close
            </v-icon>
        </v-btn>
        <template v-slot:activator="{ on, attrs }">
            <v-btn
                @click="getPrograms()"
                v-if="!isUpdate"
                color="#62457F"
                dark
                width="12rem"
                v-bind="attrs"
                v-on="on">
                + Agregar institución
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
                    <div class="mx-2">{{ isUpdate === false ? 'Agregar ' : 'Modificar ' }} institución</div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" lazy-validation>
                    <v-container class="px-3rem">
                        <v-row justify="center">
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Nombre completo:</b></p>
                                <v-text-field
                                    v-model="name"
                                    :rules="rules.name"
                                    color="#62457F"
                                    required
                                    dense
                                    outlined>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Contacto:</b></p>
                                <v-text-field
                                    v-model="contact"
                                    :rules="rules.contact"
                                    color="#62457F"
                                    required
                                    dense
                                    outlined>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Correo:</b></p>
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
                                <p class="text-violet my-2"><b>Tipo de cliente:</b></p>
                                <v-select
                                    v-model="client_type"
                                    :items="client_types"
                                    :rules="rules.client_type"
                                    ref="typeClientSelect"
                                    @change="setPrograms(client_type)"
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
                                    v-model="profile"
                                    :items="profile_options"
                                    :rules="rules.profile"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                    item-text="name"
                                    item-value="id">
                                </v-select>
                            </v-col>
                            <v-col cols="12" class="py-0 text-center">
                                <v-btn color="#62457F" dark width="12rem" @click="submit" :loading="isLoading">
                                    {{ !isUpdate ? 'Agregar institución' : 'Guardar' }}
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
    name: "InstitutionsForm",
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
        client_types: {
            type: Array,
        },
        profiles: {
            type: Array,
        }
    },
    data() {
        return {
            dialog: false,
            isLoading: false,
            school_profiles: [],
            enterprise_profiles:   [],
            hospital_profiles:   [],
            empty_profiles:  [],
            profile_options:  [],
            name: null,
            contact: null,
            email: null,
            client_type: null,
            profile: null,

            //Rules Form,
            rules: {
                name: [v => !!v || 'El nombre es requerido.'],
                contact: [v => !!v || 'El contacto es requerido.'],
                email: [v => !!v || 'El correo es requerido.', v => /.+@.+/.test(v) || 'El correo debe ser válido.'],
                client_type: [v => !!v || 'El tipo de cliente es requerido.'],
                profile: [v => !!v || 'El perfil es requerido.']
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
            this.name = dataUpdate.name;
            this.contact = dataUpdate.contact;
            this.email = dataUpdate.contact_email;
            this.client_type = dataUpdate.type_client_id;
            this.setPrograms(this.client_type);
            this.profile = dataUpdate.program_id;
        },
        submit() {
            let valid = this.$refs.form.validate();
            if (valid) {
                this.loading = true;
                axios.post(route('admin.institutions.upsert', {id: !this.isUpdate ? 'FAKE_ID' : this.dataUpdate.id}), this.formData()).then(response => {
                    if (response.data.success) {
                        this.$swal(
                            {
                                title: !this.isUpdate ? '¡Institución agregada!' : '¡Institución modificado!',
                                text: !this.isUpdate ? 'La institución se ha agregado correctamente.' : 'La institución se ha modificado correctamente.',
                                icon: 'success',
                                iconColor: '#62457F',
                                showConfirmButton: false,
                            });
                        bus.$emit('reload-grid');
                        this.goBack();
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
            formData.append('contact', this.contact);
            formData.append('contact_email', this.email);
            formData.append('type_client_id', this.client_type);
            formData.append('program_id', this.profile);
            return formData;
        },
        setPrograms(clientType){
            switch (clientType) {
                case 1:
                    this.profile_options = this.school_profiles;
                    this.profile = null;
                    break;
                case 2:
                    this.profile_options = this.enterprise_profiles;
                    this.profile = null;
                    break;
                case 3:
                    this.profile_options = this.hospital_profiles;
                    this.profile = null;
                    break;
                default:
                    this.profile_options = this.empty_profiles;
                    this.profile = null;
                    break;
            }
        },
        getPrograms(){
            /*
                1- Recognitions program => [0]
                2- Lifefullness         => [1]
                3- Work and wellness    => [2]
                4- Lifefulness Health   => [3]
            */
            this.school_profiles = [{id: this.profiles[1].id, name:this.profiles[1].name}];
            this.enterprise_profiles = [{id: this.profiles[2].id, name:this.profiles[2].name}];
            this.hospital_profiles = [{id: this.profiles[3].id, name:this.profiles[3].name}];
        },
    },
    mounted: function mounted() {
        /*
            1- Recognitions program => [0]
            2- Lifefullness         => [1]
            3- Work and wellness    => [2]
            4- Lifefulness Health   => [3]
        */
        if(this.isUpdate){
            this.school_profiles = [{id: this.profiles[1].id, name:this.profiles[1].name}];
            this.enterprise_profiles = [{id: this.profiles[2].id, name:this.profiles[2].name}];
            this.hospital_profiles = [{id: this.profiles[3].id, name:this.profiles[3].name}];
        }
    }
}
</script>

<style scoped>

</style>
