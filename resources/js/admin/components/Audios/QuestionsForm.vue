<template>
    <v-dialog max-height="90vh" max-width="700" v-model="dialog">
        <v-btn class="btn-close" icon @click="goBack">
            <v-icon class="text-white">
                mdi-window-close
            </v-icon>
        </v-btn>
        <template v-slot:activator="{ on, attrs }">
            <v-btn icon @click="updateData(dataUpdate)"  v-on="on" v-bind="attrs">
                <v-img contain src="/assets/icon/ic_edit.png" max-height="20"/>
            </v-btn>
        </template>
        <v-card class="invisible-scrollbar">
            <v-card-title class="d-flex justify-content-center bg-purple py-5">
                <div/>
                <div class="d-flex text-white text-center py-0 mb-0">
                    <v-img contain src="/assets/icon/ic_white_logo.svg" max-height="30"/>
                    <div class="mx-2"> Editar  instrucciones</div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-form ref="form" lazy-validation>
                    <v-container class="px-3rem">
                        <v-row justify="center">
                            <v-col cols="12" class="py-0" v-for="(question, index) in this.dataUpdate" :key="question.id">
                                <div v-if="question.id===0">
                                    <p class="text-violet my-2"><b>Instrucciones:</b></p>
                                    <v-textarea
                                        v-model="question.description"
                                        :rules="rules.question"
                                        color="#62457F"
                                        required
                                        dense
                                        outlined>
                                    </v-textarea>
                                </div>
                                <div v-else>
                                    <p class="text-violet my-2"><b>Pregunta {{index}}:</b></p>
                                    <v-text-field
                                        v-model="question.description"
                                        :rules="rules.question"
                                        color="#62457F"
                                        required
                                        dense
                                        outlined>
                                    </v-text-field>
                                </div>

                            </v-col>
                            <br>
                            <br>
                            <v-col cols="12" class="py-0" style="display: flex; justify-content: flex-end">
                                <v-btn icon @click="addQuestion()" >
                                    <v-img contain src="/assets/icon/ic_add_circle.svg" max-height="30"/>
                                </v-btn>
                            </v-col>
                            <v-col cols="12" class="py-0 text-center">
                                <v-btn color="#62457F" dark width="12rem" @click="submit" :loading="isLoading">
                                    Guardar
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
    name: "QuestionsForm",
    props: {
        dataUpdate:{},
    },
    data() {
        return {
            dialog: false,
            isLoading: false,
            isUpdate: true,

            questions: [],

            //Rules Form,
            rules: {
                question: [v => !!v || 'La pregunta es requerida.']
            },
        }
    },
    watch: {
    },
    methods: {
        goBack() {
            this.dialog = false;
        },
        updateData(dataUpdate) {
           this.questions = dataUpdate;
        },
        addQuestion() {
            let valid = this.$refs.form.validate();
            if (valid) {
                this.questions.push({id: this.questions.length+100, description:''});
            }

        },
        submit() {
            let valid = this.$refs.form.validate();
            if (valid) {
                this.loading = true;
                axios.post(route('questions_upsert',  {id: this.$route.params.id}), this.formData()).then(response => {
                    if (response.data.success) {
                        this.$swal(
                            {
                                title: !this.isUpdate ? '¡Cuestionario agregado!' : '¡Cuestionario modificado!',
                                text: !this.isUpdate ? 'El cuestionario se ha agregado correctamente.' : 'El cuestionario se ha modificado correctamente.',
                                icon: 'success',
                                timer: 2000,
                                iconColor: '#62457F',
                                showConfirmButton: false,
                            });
                        this.goBack();
                        // location.reload();
                    } else {
                        this.$swal({
                                title: 'Error',
                                text: 'Revisa que los datos sean correctos',
                                icon: 'error',
                                timer: 2000,
                                showConfirmButton: false,
                            }
                        );
                    }
                    this.loading = false;
                });
            }
        },
        formData() {
            let name = 'questionx';
            let formData = new FormData();
            this.questions.forEach(function(item) {
                    let name = ''+item.id;
                    formData.append(name, item.description);
            })

            return formData;
        }
    }
}
</script>

<style scoped>

</style>
