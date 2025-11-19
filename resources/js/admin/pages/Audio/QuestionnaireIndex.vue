<template>
    <v-card class="pb-5">
        <br>
        <div class="questionnaire">
            <h4 class="titulo">Mide tu avance</h4>
            <div class="edit-btn">
                <QuestionsForm :data-update="this.questions"/>
            </div>
            <v-card style="padding: 1rem 8rem">

                <div class="pb-5" v-for="question in questions" :key="question.description">

                    <p class="question" v-if="question.id===0" >
                        {{question.description}}
                    </p>

                    <div v-else>
                    <p class="question">{{question.description}}</p>
                    <v-radio-group class="options">
                        <v-radio class="fs13" label="Nunca o muy rara vez cierto" color="#573c72" value="1"/>
                        <v-radio label="Rara vez cierto" color="#573c72" value="2"/>
                        <v-radio class="fs13" label="Algunas veces cierto" color="#573c72" value="3"/>
                        <v-radio label="A menudo cierto" color="#573c72" value="4"/>
                        <v-radio class="fs13" label="Muy a menudo o siempre cierto" color="#573c72" value="5"/>
                    </v-radio-group>
                    </div>
                </div>

            </v-card>
        </div>
    </v-card>
</template>

<script>
import QuestionsForm from "../../components/Audios/QuestionsForm";
export default {
    name: "QuestionnaireIndex",
    components: {QuestionsForm},
    data() {
        return {
            questions: {},
        }
    },
    methods: {
        async fetchData() {
            await axios.get(route('admin.categories.get_questions', {id: this.$route.params.id})).then((response) => {
                if(response.data.success){
                    this.questions = response.data.questions;
                }
            }).catch(function (error) {
                console.error(error);
            });
        },
    },
    beforeMount(){
        this.fetchData();
    }
}
</script>

<style scoped>

    .titulo{
        color: #a3326d;
        font-weight: bold;
        text-align: center;
        margin: 0rem;
    }

    .edit-btn{
        display: flex;
        justify-content: flex-end;
    }

    .question{
        margin: 20px;
        text-align: justify;
    }

    .questionnaire{
        width: 70%;
        justify-content: center;
        margin: auto;
    }

    .options{
        width: 70%;
        margin: auto;
    }

    .fs13{
        font-size: 13px;
    }

</style>
