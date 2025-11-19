<template>
    <v-dialog max-width="500" v-model="dialog" persistent>
        <v-btn class="btn-close-dashboard" icon @click="goBack">
            <v-icon class="text-white">
                mdi-window-close
            </v-icon>
        </v-btn>
        <template v-slot:activator="{ on, attrs }">
            <v-btn icon
                   v-on="on"
                   v-bind="attrs">
                <v-img contain src="/assets/icon/ic_edit.png" max-height="20"/>
            </v-btn>
        </template>
        <v-card>
            <v-card-title class="d-flex justify-content-center bg-purple py-5">
                <div class="d-flex text-white text-center py-0 mb-0">
                    <span class="mx-2">Editar meta</span>
                </div>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" lazy-validation>
                    <v-container class="px-3rem">
                        <v-row justify="center">
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>{{ label }}</b></p>
                                <v-text-field
                                    v-model="goals"
                                    :rules="rules.goals"
                                    color="#62457F"
                                    required dense
                                    outlined>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0 text-center">
                                <v-btn
                                    v-if="label === 'Usuarios mensuales'"
                                    @click="submit(1)"
                                    color="#62457F"
                                    dark
                                    :loading="isLoading"
                                    width="12rem"
                                >
                                    Aceptar
                                </v-btn>
                                <v-btn
                                    v-else-if="label === 'Ventas mensuales'"
                                    @click="submit(2)"
                                    color="#62457F"
                                    dark
                                    :loading="isLoading"
                                    width="12rem"
                                >
                                    Aceptar
                                </v-btn>
                                <v-btn
                                    v-else
                                    @click="submit(3)"
                                    color="#62457F"
                                    dark
                                    :loading="isLoading"
                                    width="12rem"
                                >
                                    Aceptar
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
    name: "DashboardForm",
    props: {
        label: {
            type: String,
            required: true,
        }
    },

    data: () => ({
        dialog: false,
        goals: '',
        isLoading: false,

        rules: {
            goals: [v => !!v || '¡La meta mensual es requerida!']
        }
    }),

    methods: {
        async submit(id) {
            let valid = this.$refs.form.validate();
            if (valid) {
                this.isLoading = true;
                try {
                    const {data} = await axios.post(route('admin.dashboard.update_goals', {id}), this.formData());
                    if (data.success) {
                        this.alert('success', '¡Meta editada!', 'La meta ha sido editada correctamente');
                        location.reload();
                    }
                } catch (e) {
                    this.alert(
                        'error',
                        '¡Error!',
                        `Ocurrio un error favor de contactar al administrador ${e}`
                    );
                    this.goBack();
                }
            }
        },

        formData() {
            let formData = new FormData();
            formData.append('goal', this.goals);
            return formData;
        },

        goBack() {
            this.dialog = false;
            this.resetForm();
        },

        resetForm() {
            this.$refs.form.reset();
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
