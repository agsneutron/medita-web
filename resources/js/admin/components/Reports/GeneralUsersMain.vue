<template>
    <v-container class="px-3 pt-0">
        <div class="pt-3 pr-3 text-right">
            <a @click="excelExport" class="btn" style="text-decoration: none" >
                <v-img contain src="/assets/icon/excel.png" max-height="30"/>
            </a>
        </div>
        <SatoriTable
            @on-change-query="onChangeQuery"
            :columns="columns"
            :is_loading="isLoading"
            :page_size="queryParams.per_page"
            :rows="rows"
            :toggle_button="false"
            :total_rows="total_rows"
        >
            <template v-slot:status-slot="{data}">
                <div style="width: 4rem">
                    {{ data.active === true ? 'Activo' : 'Inactivo' }}
                </div>
            </template>

            <template v-slot:gender-slot="{data}">
                <div style="width: 12rem">
                    {{ data.gender.name }}
                </div>
            </template>
            <template v-slot:progress-slot="{data}">
                <div style="width: 12rem">
                    {{ getProgress(data) }}%
                </div>
            </template>

            <template v-slot:payments-slot="{data}">
                <div style="width: 12rem">
                    {{ data.payments.length }}
                </div>
            </template>

            <template v-slot:phase-slot="{data}">
                <div style="width: 12rem">
                    {{ data.client_phase && data.client_phase.length > 0 ? getPhases(data.client_phase) : "NO" }}
                </div>
            </template>
        </SatoriTable>
    </v-container>
</template>

<script>
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";

export default {
    name: "GeneralUsersMain",
    components: {SatoriTable},
    mixins: [MixinSatoriTable],
    data: () => ({
        columns: [
            {
                label: "Nombre",
                name: "name",
                style: "",
                filter: {type: "simple", th_style: "min-width: 192px"},
            },
            {
                label: "Apellido Paterno",
                name: "last_name",
                style: "",
                filter: {type: "simple", th_style: "min-width: 192px"},
            },
            {
                label: "Apellido Materno",
                name: "second_last_name",
                style: "",
                filter: {type: "simple", th_style: "min-width: 192px"},
            },
            {
                label: "Correo",
                name: "email",
                style: "",
                filter: {type: "simple", th_style: "min-width: 192px"},
            },
            {
                label: "Edad",
                name: "age",
                style: "",
                filter: {type: "simple", th_style: "min-width: 140px"},
            },
            {
                label: "Género",
                name: "gender",
                style: "",
                filter: {type: "select", th_style: "min-width: 192px"},
                slot_name: "gender-slot"
            },
            {
                label: "Progreso",
                name: "",
                style: "",
                filter: {type: "simple-disabled", th_style: "min-width: 140px"},
                slot_name: "progress-slot"
            },
            // {
            //     label: "Promedio de respuestas",
            //     name: "",
            //     style: "",
            //     filter: {type: "simple", th_style: "min-width: 192px"},
            // },
            {
                label: "Número de compras",
                name: "payments_count",
                style: "",
                filter: {type: "simple", th_style: "min-width: 192px"},
                slot_name: "payments-slot"
            },
            {
                label: "Recognitions program",
                name: "phase",
                style: "",
                filter: {type: "select", th_style: "min-width: 192px"},
                slot_name: "phase-slot"
            }
        ],
        genders: null,
        phases: null
    }),

    methods: {
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;

            try {
                const {data} = await axios.get(route('admin.reports.general_users'), {params});
                this.isLoading = false;
                this.rows = data.data;
                this.total_rows = data.count;
                this.genders = data.genders;
                this.phases = data.phases;
                this.$set(this.columns[5].filter, 'items', this.genders);
                this.$set(this.columns[8].filter, 'items', this.phases);
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
        },
        getPhases(data){
            let phases = "";
            data.forEach(client_phase => {
                phases += client_phase.phase.name+" "
            });
            return phases;
        },
        getProgress(data){
            let total = 0;
            let count = 0;
            let total_count = 0;

            data.client_audio.forEach(audio => {
                if (audio.completed && audio.audio !== null)
                    if (audio.audio.phase !== null) {
                       count++;
                    }
            });
            data.program.categories.forEach(category => {
                category.phases.forEach(phase => {
                    phase.audio.forEach(audio => {
                        total_count++;
                    });
                });
            });
            if (total_count !== 0) total = parseInt(((count * 100) / total_count).toFixed(0));
            return total;
        },
        excelExport(preventSpinner = false){
            let params = this.prepareParams(preventSpinner);
            params['educational_level'] = this.educationalLevel;
            axios.get(route('admin.reports.export_general_users'), {
                params,
                responseType: 'blob'
            }).then((response) => {
                const link = document.createElement('a');
                link.href = window.URL.createObjectURL(
                    new Blob([response.data])
                );
                link.setAttribute('download', 'ReporteUsariosGenerales.xlsx');
                document.body.appendChild(link);
                link.click();
            });
        }
    }
}
</script>

<style scoped>

</style>
