<template>
    <v-card
        class="mx-auto"
        height="370"
        max-width="400"
    >
        <v-card-title class="d-flex justify-content-center">
            <h6 class="fw-bold" style="color: #FF6D00">
                {{ title }}
            </h6>
        </v-card-title>

        <v-card-text class="d-flex justify-content-center">
            <vue-ellipse-progress
                v-if="title === 'Usuarios registrados'"
                animation="default 2000 600"
                color="#A3326D"
                emptyThickness="2%"
                :progress="usersProgress"
                thickness="2%"
                :dot="{
                    size : 25,
                    backgroundColor: '#fff',
                    border: 'solid',
                    borderColor: '#62457F',
                    borderWidth: '1px'
                }"
            >
                <div class="d-flex flex-column">
                    <span class="fs-1 fw-bold mb-5" style="color: #62457F">
                        {{ users }}
                    </span>
                    <span class="fw-bold text-uppercase" style="color: #62457F">
                        Registros
                    </span>
                </div>
            </vue-ellipse-progress>

            <vue-ellipse-progress
                v-else
                animation="default 2000 600"
                color="#A3326D"
                emptyThickness="2%"
                :progress="salesProgress"
                thickness="2%"
                :dot="{
                    size : 25,
                    backgroundColor: '#fff',
                    border: 'solid',
                    borderColor: '#62457F',
                    borderWidth: '1px'
                }"
            >
                <div>
                    <span class="fs-4 fw-bold" style="color: #62457F">
                        {{ sales }}
                    </span>
                </div>
            </vue-ellipse-progress>
        </v-card-text>

        <v-card-text class="d-flex mb-5">
            <div class="d-flex flex-column align-items-center flex-fill pl-5">
                <h6 class="fs-6">Meta mensual</h6>
                <h6 v-if="title === 'Usuarios registrados'" class="fw-bold fs-6" style="color: #FF6D00; text-transform: uppercase">
                    {{ usersGoal }} Registros
                </h6>
                <h6 v-else class="fw-bold fs-5" style="color: #FF6D00">
                    {{ formatGoal }}
                </h6>
            </div>
            <div v-if="title === 'Usuarios registrados'" class="flex-shrink-1">
                <DashboardForm label="Usuarios mensuales"/>
            </div>
            <div v-else class="flex-shrink-1">
                <DashboardForm label="Ventas mensuales"/>
            </div>
        </v-card-text>
    </v-card>
</template>

<script>
import DashboardForm from "./DashboardForm";
import {VueEllipseProgress} from "vue-ellipse-progress";

export default {
    name: "ProgressCircular",
    components: {DashboardForm, VueEllipseProgress},
    props: {
        title: {
            type: String,
            required: true,
        },
        users: {
            type: Number,
            required: false,
        },
        usersGoal: {
            type: Number,
            required: false,
        },
        usersProgress: {
            type: Number,
            required: false,
        },
        sales: {
            type: String,
            required: false,
        },
        salesGoal: {
            type: Number,
            required: false
        },
        salesProgress: {
            type: Number,
            required: false,
        },
        formatGoal: {
            type: String,
            required: false,
        }
    },
}
</script>
