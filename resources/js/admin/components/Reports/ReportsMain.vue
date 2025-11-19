<template>
    <v-container class="px-3 pt-0">
        <SatoriTable
            @on-change-query="onChangeQuery"
            :columns="columns"
            :is_loading="isLoading"
            :page_size="queryParams.per_page"
            :rows="rows"
            :toggle_button="false"
            :total_rows="total_rows"
        >
            <template v-slot:action-slot="{data}">
                <v-btn
                    icon
                    :to="{name: data.to}"
                >
                    <v-icon color="#A3326D">mdi-eye</v-icon>
                </v-btn>
            </template>
        </SatoriTable>
    </v-container>
</template>

<script>
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";

export default {
    name: "ReportsMain",
    components: {SatoriTable},
    mixins: [MixinSatoriTable],
    data: () => ({
        columns: [{
            label: "",
            name: "space",
            style: "width: 20%"
        },{
            label: "Nombre del reporte",
            name: "name",
            style: "width: 30%",
        }, {
            label: "",
            name: "actions",
            style: "display: flex!important; justify-content: center !important; align-items: center;",
            slot_name: "action-slot"
        }]
    }),

    methods: {
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.isLoading = false;
            this.rows = [{
                name: "Clientes activos",
                to: "reports_active_clients"
            },
            {
                name: "Estadística emocional",
                to: "reports_income_statistics"
            },
            {
                name: "LFU Primer Cuestionario",
                to: "reports_lfu_first_questionnaire"
            },
            {
                name: "LFU Segundo Cuestionario",
                to: "reports_lfu_second_questionnaire"
            },
            {
                name: "LFU Educacion",
                to: "reports_lfu_education"
            },
            {
                name: "Usuarios Generales",
                to: "reports_general_users"
            }
            ];
            this.total_rows = 1;
        },
    }
}
</script>
