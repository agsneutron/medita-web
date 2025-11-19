<template>
    <v-dialog max-height="90vh" max-width="500" v-model="dialog">
        <v-btn class="btn-close" icon @click="goBack">
            <v-icon class="text-white">
                mdi-window-close
            </v-icon>
        </v-btn>
        <template v-slot:activator="{ on, attrs }">
            <v-btn icon
                   v-on="on"
                   v-bind="attrs">
                <v-img contain src="/assets/icon/ic_star.svg" max-height="20"/>
            </v-btn>
        </template>
        <v-card class="invisible-scrollbar">
            <v-card-title class="d-flex justify-content-center bg-purple py-5">
                <div/>
                <div class="d-flex text-white text-center py-0 mb-0">
                    <v-img contain src="/assets/icon/ic_white_star.svg" max-height="30"/>
                    <div class="mx-2"> Evaluaciones </div>
                </div>
            </v-card-title>
            <v-card-text>
                <h1 v-if="evaluations.length===0" style="margin: 4rem 0rem; text-align: center;"> Aún no hay reseñas sobre este audio </h1>
                <div v-else v-for="item in this.evaluations">
                    <v-row>
                        <v-col cols="2">
                            <v-img contain src="/assets/icon/ic_user_violet.svg" max-height="35"/>
                        </v-col>
                        <v-col cols="5">
                            <h6 class="username"> {{ item.client.full_name }} </h6>
                        </v-col>
                        <v-col cols="5">
                            <h6 class="time"> {{ getDays(item.updated_at) }} </h6>
                        </v-col>
                    </v-row>
                    <v-row style="margin: 0px">
                        <v-col class="col offset-2 col-6 stars" v-html="showScore(item.score)">

                        </v-col>
                    </v-row>
                    <v-row style="margin: 0px">
                        <v-col class="col col-12" >
                            <p class="resenia">
                                {{ item.description }}
                            </p>
                            <div style="padding: 5px 15px;">
                                <hr class="divider">
                            </div>
                        </v-col>
                    </v-row>


                </div>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
export default {
    name: "EvaluationList",
    props: {
        IdAudio:{
            type: Number,
            required: true
        },
        evaluations:{
            type: Array,
            required: true
        }
    },
    data() {
        return {
            dialog: false,
            isLoading: false,
        }
    },
    // php artisan make:seeder CategoriesContentSeeder
    // php artisan db:seed --class=CategoriesContentSeeder
    watch: {
    },
    methods: {
        goBack() {
            this.dialog = false;
        },
        showScore(score){
            switch (score){
                case 1:
                    return "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_yellow_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_star.svg'>";
                    break;
                case 2:
                    return "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_yellow_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_yellow_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_star.svg'>";
                    break;
                case 3:
                    return "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_yellow_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_yellow_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_yellow_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_star.svg'>";
                    break;
                case 4:
                    return "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_yellow_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_yellow_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_yellow_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_yellow_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_star.svg'>";
                    break;
                case 5:
                    return "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_yellow_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_yellow_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_yellow_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_yellow_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_yellow_star.svg'>";
                    break;
                default:
                    return "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_star.svg'>" +
                           "<img style='max-width: 15px; margin: 0px 1px;'  src='/assets/icon/ic_star.svg'>";
                    break;

            }
        },
        getDays(date){
            let date1 = Date.now();
            let date2 = new Date(date);
            let diffTime = Math.abs(date2 - date1);
            let diffDays = Math.ceil(diffTime / (1000 * 60 * 60 * 24));
            let message = "Hace "+ diffDays + " días";
            if(diffDays<=1) message = "Hace "+ diffDays + " día";
            return message ;
        }
    },
    mounted(){

    }
}
</script>

<style scoped>
    .username{
        color: #a3326d;
    }
    .time{
        color: dimgray;
    }
    .stars{
        display: flex;
        padding: 0;
    }
    .star{
        max-width: 15px;
        margin: 0px 1px;
    }
    .resenia{
        margin: 0px;
        text-align: justify;
        padding: 5px 20px;
    }
    .divider{
        color: #573c72;
        border: solid #573c72 1px;
        opacity: .5;
        margin: .5rem 0;
    }
</style>


