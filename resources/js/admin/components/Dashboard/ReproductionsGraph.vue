<template>
    <v-card
        class="mx-auto d-flex flex-column"
        height="370" width="100%"
    >
        <v-card-title>
            <h6 class="fw-bold" style="color: #FF6D00">
                Reproducciones
            </h6>
        </v-card-title>

        <v-card-text>
            <v-row>
                <v-col cols="12" class="px-6 my-0 d-flex justify-content-between">
                    <h6 class="fw-bolder m-0">Recognitions program</h6>
                    <h6 class="fw-bolder m-0" style="color: #A3326D">
                        {{ this.hours.recognition }} hrs
                    </h6>
                </v-col>
                <v-col cols="12">
                    <template>
                        <v-progress-linear
                            background-color="#fff"
                            color="#64FFDA"
                            height="10" rounded
                            style="border: 1px solid #64FFDA"
                            :value="this.percentage.recognition"
                        >

                        </v-progress-linear>
                    </template>
                </v-col>
                <v-col cols="12" class="px-6 d-flex justify-content-between">
                    <h6 class="fw-bolder m-0">Música de alta tecnologia</h6>
                    <h6 class="fw-bolder m-0" style="color: #A3326D">
                        {{ this.hours.music }} hrs
                    </h6>
                </v-col>
                <v-col cols="12">
                    <template>
                        <v-progress-linear
                            background-color="#fff"
                            color="#C0CA33"
                            height="10" rounded
                            style="border: 1px solid #C0CA33"
                            :value="this.percentage.music"
                        >

                        </v-progress-linear>
                    </template>
                </v-col>
                <v-col cols="12" class="px-6 d-flex justify-content-between">
                    <h6 class="fw-bolder m-0">Biblioteca de meditaciones</h6>
                    <h6 class="fw-bolder m-0" style="color: #A3326D">
                        {{ this.hours.meditations }} hrs
                    </h6>
                </v-col>
                <v-col cols="12">
                    <template>
                        <v-progress-linear
                            background-color="#fff"
                            color="#BF360C"
                            height="10" rounded
                            style="border: 1px solid #BF360C"
                            :value="this.percentage.meditations"
                        >
                        </v-progress-linear>
                    </template>
                </v-col>
                <v-col cols="12" class="d-flex justify-content-end">
                    <div class="d-flex flex-column mr-3">
                        <h6 class="fs-5">Meta mensual</h6>
                        <h6 class="fw-bold fs-6 align-self-center" style="color: #FF6D00">
                            {{ reproductionGoal }} HRS
                        </h6>
                    </div>
                    <div class="flex-shrink-1">
                        <DashboardForm label="Tiempo de reproducción"/>
                    </div>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>
</template>

<script>
import DashboardForm from "./DashboardForm";

export default {
    name: "ReproductionsGraph",
    components: {DashboardForm},
    props: {
        reproductionGoal: {
            type: Number,
            required: true,
        }
    },

    data: () => ({
        hours: {
            recognition: null,
            music: null,
            meditations: null,
        },

        percentage: {
            recognition: null,
            music: null,
            meditations: null,
        },
    }),

    created() {
        this.getReproductions();
    },

    methods: {
        async getReproductions() {
            try {
                const {data} = await axios.get(route('admin.dashboard.get_reproductions'));
                this.hours.recognition = (data.recognitionReproduction / 3600).toFixed(2);
                this.percentage.recognition = (this.hours.recognition / this.reproductionGoal) * 100;

                this.hours.music = (data.musicReproduction / 3600).toFixed(2);
                this.percentage.music = (this.hours.music / this.reproductionGoal) * 100;
                
                this.hours.meditations = (data.meditationReproduction / 3600).toFixed(2);
                this.percentage.meditations = (this.hours.meditations / this.reproductionGoal) * 100;
            } catch (e) {
                this.alert(
                    'error',
                    'Error',
                    `Favor de contactar al administrador o soporte (${e})`
                );
            }
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
