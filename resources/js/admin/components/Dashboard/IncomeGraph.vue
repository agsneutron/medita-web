<template>
    <v-card
        class="mt-4 mx-auto stackSheet"
        max-width="100%"
    >
        <v-card-title class="d-flex justify-content-center">
            <h6 class="fw-bold" style="color: #FF6D00">
                Ingresos
            </h6>
        </v-card-title>

        <v-sparkline
            :labels="labels"
            :value="value"
            :auto-draw-duration="4000"
            auto-draw
            color="#62457F"
            label-size="4"
            line-width=".5"
            padding="16"
            smooth="10"
            stroke-linecap="round"
        ></v-sparkline>

        <v-sparkline
            :value="value2"
            :auto-draw-duration="4000"
            auto-draw
            class="stackSpark"
            color="#A3326D"
            label-size="4"
            line-width=".5"
            padding="16"
            smooth
            stroke-linecap="round"
        ></v-sparkline>

        <v-divider light></v-divider>

        <v-card-text class="pt-0">
            <v-row>
                <v-col cols="12" class="d-flex justify-content-center">
                    <h6 class="fw-bold mx-5" style="color: #62457F">
                        <v-icon class="mx-5" color="#62457F" small>mdi-checkbox-blank-circle</v-icon>
                        Recognitions program
                    </h6>
                    <h6 class="fw-bold mx-5" style="color: #A3326D">
                        <v-icon class="mx-5" color="#A3326D" small>mdi-checkbox-blank-circle</v-icon>
                        Work and wellness, Lifefullness Health
                    </h6>
                </v-col>
            </v-row>
        </v-card-text>
    </v-card>
</template>

<script>
export default {
    name: "IncomeGraph",
    data: () => ({
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
        value: [],
        value2: [],
    }),

    created() {
      this.getIncomes();
    },

    methods: {
        async getIncomes() {
            try {
                const {data} = await axios.get(route('admin.dashboard.get_incomes'));
                this.value = Object.values(data.recognitionIncomes);
                this.value2 = Object.values(data.wwlfIncomes);
            } catch (e) {
                this.alert(
                    'error',
                    'Error',
                    `Favor de contactar al administrador ${e}`
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

<style lang="css" scoped>
.stackSheet {
    position: relative;
}

.stackSpark {
    position: absolute;
    top: 0;
    left: 0;
}
</style>
