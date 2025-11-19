<template>
    <v-dialog max-height="200" max-width="500" persistent v-model="dialog">
        <v-btn @click="goBack" class="btn-close-program" icon>
            <v-icon class="text-white">
                mdi-window-close
            </v-icon>
        </v-btn>

        <template v-slot:activator="{ on, attrs }">
            <v-btn
                @click="updateData(dataUpdate)"
                v-bind="attrs" v-on="on"
                icon
            >
                <v-icon>$vuetify.icons.updateIcon</v-icon>
            </v-btn>
        </template>

        <v-card>
            <v-card-title class="d-flex justify-content-center bg-purple py-5">
                <div class="d-flex text-white text-center py-0 mb-0">
                    <v-icon>
                        $vuetify.icon.programsIcon
                    </v-icon>
                    <div class="mx-2">Editar programa</div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" lazy-validation>
                    <v-container class="px-3rem">
                        <v-row justify="center">
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Nombre</b></p>
                                <v-text-field
                                    v-model="program.name"
                                    :rules="rules.name"
                                    color="#62457F"
                                    dense
                                    outlined
                                    required
                                >
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0 mb-5">
                                <p class="text-violet my-2"><b>Material de acceso</b></p>
                                <div class="d-flex flex-column">
                                    <span
                                        v-for="(categories, indexCategories) in dataUpdate.categories"
                                        :key="indexCategories"
                                        class="my-1 ml-2"
                                    >
                                        {{ categories.name }}
                                    </span>
                                </div>
                            </v-col>
                            <v-col cols="12" class="py-0 text-center mt-5">
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
import {bus} from "../../app";

export default {
    name: "ProgramsForm",
    props: {
        dataUpdate: {
            type: Object,
            required: false,
        },
    },

    data: () => ({
        dialog: false,
        isLoading: false,

        program: {
            name: null
        },

        rules: {
            name: [v => !!v || '¡El nombre del programa es requerido!'],
        }
    }),

    methods: {
        async submit() {
            let valid = this.$refs.form.validate();
            if (valid) {
                this.isLoading = true;
                const {data} = await axios.post(route('admin.programs.update', {id: this.dataUpdate.id}), this.formData());

                if (data.success) {
                    this.alert('success', '¡Programa modificado!', 'El programa ha sido modificado correctamente');
                    bus.$emit('reload-grid');
                    this.goBack();
                } else {
                    this.alert('error', 'Error', 'Revisa que los datos sean correctos');
                    this.isLoading = false;
                }
            }
        },

        formData() {
            let formData = new FormData();
            formData.append('name', this.program.name);
            return formData;
        },

        updateData(dataUpdate) {
            this.program.name = dataUpdate.name;
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
