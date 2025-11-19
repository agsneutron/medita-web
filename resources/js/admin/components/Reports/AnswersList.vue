<template>
    <v-dialog max-height="90vh" max-width="555" v-model="dialog">
        <v-btn class="btn-close" icon @click="goBack">
            <v-icon class="text-white">
                mdi-window-close
            </v-icon>
        </v-btn>
        <template v-slot:activator="{ on, attrs }">
            <v-btn icon
                   v-on="on"
                   v-bind="attrs">
                <v-img contain src="/assets/icon/ic_info.svg" max-height="20"/>
            </v-btn>
        </template>
        <v-card class="invisible-scrollbar">
            <v-card-title class="d-flex justify-content-center bg-purple py-5">
                <div/>
                <div class="d-flex text-white text-center py-0 mb-0">
                    <v-img contain src="/assets/icon/ic_white_logo.svg" max-height="30"/>
                    <div class="mx-2"> Respuestas de {{ clientName }}
                    </div>
                </div>
            </v-card-title>
            <v-card-text>
                <br>
                <table class="table table-bordered table-striped" style="text-align: center;">
                    <thead style="background-color: #62457F; color: #ffffff;">
                    <tr>
                        <th>Pregunta</th>
                        <th>Respuesta</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr v-for="(item, index) in answers">
                        <td style="text-align: justify">{{ (index+1)+'.- '+item.question.description }}</td>
                        <td>{{ item.answer.name }}</td>
                    </tr>
                    </tbody>
                </table>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>

export default {
    name: "AnswersList",
    components: {},
    props: {
        clientName: {
            type: String,
            required: true
        },
        answers: {
            type: Array,
            required: true
        },
    },
    data() {
        return {
            dialog: false,
            isLoading: false,
        }
    },
    methods: {
        goBack() {
            this.dialog = false;
        }
    },
}
</script>

<style scoped>


</style>




