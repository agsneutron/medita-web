<template>
    <v-dialog max-width="350" v-model="dialog">
        <v-btn class="btn-close-setting" icon @click="goBack">
            <v-icon class="text-white">
                mdi-window-close
            </v-icon>
        </v-btn>
        <template v-slot:activator="{ on, attrs }">
            <v-btn icon @click="updateData(dataUpdate)"
                   v-on="on"
                   v-bind="attrs">
                <v-img contain src="/assets/icon/ic_edit.png" max-height="20"/>
            </v-btn>
        </template>
        <v-card class="invisible-scrollbar-70">
            <v-card-title class="d-flex justify-content-center bg-purple py-5">
                <div/>
                <div class="d-flex text-white text-center py-0 mb-0">
                    <v-img contain src="/assets/icon/ic_user.svg" max-height="30"/>
                    <div class="mx-2">Editar grado de estudio</div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" lazy-validation>
                    <v-container class="px-3rem">
                        <v-row justify="center">
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Nivel de estudios</b></p>
                                <v-text-field
                                    v-model="educational_level"
                                    :rules="rules.educational_level"
                                    color="#62457F"
                                    required
                                    dense
                                    outlined>
                                </v-text-field>
                            </v-col>
                            <v-col cols="12" class="py-0">
                                <p class="text-violet my-2"><b>Niveles</b></p>
                                <v-text-field
                                    v-for="(level, key) in levels"
                                    v-model="name_levels[key].name"
                                    :rules="rules.level"
                                    item-value="name"
                                    color="#62457F"
                                    required
                                    dense
                                    outlined
                                    :key="key">
                                </v-text-field>
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
    name: "EducationalLevelsForm",
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

            educational_level: null,
            name_levels: [],
            levels: [],

            //Rules Form,
            rules: {
                educational_level: [v => !!v || 'El nivel de estudios es requerido.'],
                level: [v => !!v || 'El nivel es requerido.'],
            },
        }
    },
    methods: {
        resetForm() {
            this.$emit('reload');
        },
        goBack() {
            this.dialog = false;
            this.resetForm();
        },
        updateData(dataUpdate) {
            this.educational_level = dataUpdate.name;
            this.levels = dataUpdate.levels;
            this.name_levels = dataUpdate.levels;
        },
        formData(){
            let formData = new FormData();
            formData.append('name', this.educational_level);
            this.name_levels.forEach((level, index) => {
                formData.append(`levels[${index}][id]`, level.id);
                formData.append(`levels[${index}][name]`, level.name);
            });
            return formData;
        },
        submit() {
            let valid = this.$refs.form.validate();
            if (valid){
                this.isLoading = true;
                axios.post(route('admin.settings_educational_levels.upsert', {id: this.dataUpdate.id}), this.formData()).then(response =>{
                    if (response.data.success) {
                        this.$emit('reload');
                        this.isLoading = false;
                        this.goBack();
                    }
                });
            }
        }
    }
}
</script>

<style scoped>

</style>
