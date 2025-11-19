<template>
    <v-dialog v-model="dialog" max-width="500" persistent>
        <v-btn class="btn-close mt-5 mr-5" icon @click="goBack">
            <v-icon class="text-white">
                mdi-window-close
            </v-icon>
        </v-btn>
        <template v-slot:activator="{ on, attrs }">
            <v-btn icon dark v-bind="attrs" v-on="on" @click="updateData(dataUpdate)">
                <v-icon>$vuetify.icons.customerProgress</v-icon>
            </v-btn>
        </template>
        <v-card>
            <v-card-title class="d-flex justify-content-center bg-purple py-5">
                <div class="d-flex text-white text-center py-0 mb-0">
                    <v-icon>$vuetify.icons.customersIcon</v-icon>
                    <div class="mx-2">Progreso del cliente</div>
                </div>
            </v-card-title>
            <v-card-text class="d-flex justify-content-center mt-5">
                <vue-ellipse-progress
                    animation="default 2000 600"
                    :progress="total"
                    thickness="25%"
                    emptyThickness="25%"
                    :color="gradient"
                    reverse
                >
                    <div class="d-flex justify-content-center align-items-center">
                        <h6 class="fs-3" style="color: #1A202C">
                            {{ total }}%
                        </h6>
                    </div>
                </vue-ellipse-progress>
            </v-card-text>
            <v-card-text>
                <v-row>
                    <v-col
                        cols="12"
                        class="d-flex justify-content-center"
                        style="color: #1A202C"
                    >
                        <h6 class="fs-5 fw-bold">Avance global</h6>
                    </v-col>
                    <v-col
                        cols="6"
                        class="text-end"
                        style="color: #1A202C"
                    >
                        <h6 class="fs-5 fw-bold">Tiempo total:</h6>
                    </v-col>
                    <v-col cols="6" style="color: #1A202C">
                        <h6 class="fs-5 fw-bold">{{ secondsToString(min) }}</h6>
                    </v-col>
                    <v-col
                        cols="6"
                        class="text-end"
                        style="color: #1A202C"
                    >
                        <h6 class="fs-5 fw-bold">Meditaciones:</h6>
                    </v-col>
                    <v-col cols="6" style="color: #1A202C">
                        <h6 class="fs-5 fw-bold">{{ count }}/{{ total_count }}</h6>
                    </v-col>
                    <v-col
                        cols="6"
                        class="d-flex justify-content-end align-items-center"
                        style="color: #1A202C"
                    >
                        <h6 class="fs-5 fw-bold">Evaluaciones:</h6>
                    </v-col>
                    <v-col cols="6">
                        <v-rating
                            background-color="warning lighten-1"
                            color="warning"
                            empty-icon="mdi-star-outline"
                            full-icon="mdi-star"
                            half-icon="mdi-starHalf-full"
                            hover
                            readonly
                            length="5"
                            size="20"
                            :value="star"
                        ></v-rating>
                    </v-col>
                </v-row>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import {VueEllipseProgress} from "vue-ellipse-progress";

export default {
    name: "CustomerProgress",
    components: {VueEllipseProgress},
    props: {
        dataUpdate: {
            type: Object,
            required: false
        },
    },
    data: () => ({
        dialog: false,
        count: 0,
        total_count: 0,
        min: 0,
        total: 0,
        star: 0,
        MEDITATIONS_GUIDED: 9,
        gradient: {
            radial: false,
            colors: [
                {
                    color: '#38DDFC',
                    offset: "0",
                    opacity: '1',
                },
                {
                    color: '#A53FF1',
                    offset: "100",
                    opacity: '0.6',
                },
            ]
        }
    }),
    methods: {
        goBack() {
            this.dialog = false;
            this.min = 0;
            this.count = 0;
            this.total_count = 0;
            this.star = 0;
        },
        updateData(dataUpdate) {
            dataUpdate.client_audio.forEach(audio => {
                if (audio.completed && audio.audio !== null)
                    if (audio.audio.phase !== null) {
                        this.min += parseFloat(audio.audio.duration);
                        this.count++;
                    }
            });
            dataUpdate.program.categories.forEach(category => {
                if (dataUpdate.educational_level_id !== null){
                    let categories = [this.level(dataUpdate.educational_level_id), this.MEDITATIONS_GUIDED];
                    if (categories.includes(category.id)){
                        category.phases.forEach(phase => {
                            phase.audio.forEach(audio => {
                                this.total_count++;
                            });
                        });
                    }
                } else {
                    category.phases.forEach(phase => {
                        phase.audio.forEach(audio => {
                            this.total_count++;
                        });
                    });
                }
            });
            let score = 0;
            dataUpdate.evaluations.forEach(evaluation => {
                score += evaluation.score;
            });
            this.star = parseInt((score / dataUpdate.evaluations.length))
            if (this.total_count !== 0) this.total = parseInt(((this.count * 100) / this.total_count).toFixed(0));
        },
        level(data){
            let level = 0;
            switch (data) {
                case 1:
                    level = 2;
                    break;
                case 2:
                    level = 3;
                    break;
                case 3:
                    level = 4;
                    break;
                case 4:
                    level = 5;
                    break;
                case 5:
                    level = 6;
                    break;
            }
            return level;
        },
        secondsToString(seconds) {
            let hour = Math.floor(seconds / 3600);
            hour = (hour < 10)? '0' + hour : hour;
            let minute = Math.floor((seconds / 60) % 60);
            minute = (minute < 10)? '0' + minute : minute;
            let second = seconds % 60;
            second = (second < 10)? '0' + second : second;
            let name = 'seg.';
            let time = second + ' ' + name;
            if (minute > 0 ) {
                name = 'min.';
                time = minute + ':' + second + ' ' + name;
            }
            if (hour > 0) {
                name = 'hr.';
                time = hour + ':' + minute + ':' + second + ' ' + name;
            }
            return time;
}
    }
}
</script>
