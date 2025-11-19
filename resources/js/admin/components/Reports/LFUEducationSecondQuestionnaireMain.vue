<template>
    <v-container class="px-3 pt-0">
        <v-row class="pt-3 pr-3">
            <v-col cols="4" class="pt-3 pr-3 text-left">
                <p class="text-violet my-2"><b>Nivel Educativo:</b></p>
                <v-select
                    v-model="educationalLevel"
                    :items="educationalLevels"
                    @change="fetchData"
                    color="#62457F"
                    dense
                    outlined
                    required
                    item-text="name"
                    item-value="id">
                </v-select>
            </v-col>
            <v-col cols="8" class="pt-3 pr-3 text-right">
                <a @click="excelExport" class="btn" style="text-decoration: none" >
                    <v-img contain src="/assets/icon/excel.png" max-height="30"/>
                </a>
            </v-col>
        </v-row>
        <SatoriTable
            @on-change-query="onChangeQuery"
            :columns="columns"
            :is_loading="isLoading"
            :page_size="queryParams.per_page"
            :rows="rows"
            :toggle_button="false"
            :total_rows="total_rows"
        >

            <template v-slot:institution-slot="{data}">
                {{data.institution.name}}
            </template>

            <template v-slot:action-slot="{data}">
                <AnswersList :client-name="data.name+' '+data.last_name+' '+data.second_last_name" :answers="data.client_question"/>
            </template>

        </SatoriTable>
    </v-container>
</template>

<script>
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";
import AnswersList from "./AnswersList";

export default {
    name: "LFUEducationSecondQuestionnaireMain",
    components: {SatoriTable, AnswersList},
    mixins: [MixinSatoriTable],
    data: () => ({
        educationalLevel: 1,
        educationalLevels: null,
        columns: [{
            label: "Nombre de la escuela",
            name: "institution",
            style: "",
            filter: {type: "simple"},
            slot_name: "institution-slot"
        },
            {
                label: "Nombre",
                name: "name",
                style: "",
                filter: {type: "simple"}
            },
            {
                label: "Apellido Paterno",
                name: "last_name",
                style: "",
                filter: {type: "simple"}
            },
            {
                label: "Apellido Materno",
                name: "second_last_name",
                style: "",
                filter: {type: "simple"}
            },
            {
                label: "Correo",
                name: "email",
                style: "",
                filter: {type: "simple"}
            },
            {
                label: "Nivel escolar",
                name: "educational_level.name",
                style: "",
                filter: {type: "select"}
            },
            {
                label: "",
                name: "actions",
                slot_name: "action-slot",
            }
        ],
        status: ['Activo', 'Inactivo'],
        since: null,
        until: null,
        menu: false,
        menu2: false,
    }),
    beforeMount(){
        this.getEducationalLevels();
    },
    methods: {
        async getEducationalLevels(){
            const {data} = await axios.get(route('admin.reports.get_educational_levels'));
            this.educationalLevels = data.data;
        },
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;
            params['educational_level'] = this.educationalLevel;

            try {
                const {data} = await axios.get(route('admin.reports.lfu_second_questionnaire'), {params});
                this.isLoading = false;
                this.rows = data.data;
                this.total_rows = data.count;
                this.$set(this.columns[5].filter, 'items', this.educationalLevels);
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
        excelExport(preventSpinner = false){
            let params = this.prepareParams(preventSpinner);
            params['educational_level'] = this.educationalLevel;
            axios.get(route('admin.reports.export_lfuEducationSecondQuestionnaire'), {
                params,
                // If you forget this, your download will be corrupt.
                responseType: 'blob'
            }).then((response) => {
                // Let's create a link in the document that we'll
                // programmatically 'click'.
                const link = document.createElement('a');

                // Tell the browser to associate the response data to
                // the URL of the link we created above.
                link.href = window.URL.createObjectURL(
                    new Blob([response.data])
                );

                // Tell the browser to download, not render, the file.
                link.setAttribute('download', 'ReporteLFUEducationSegundoCuestionario.xlsx');

                // Place the link in the DOM.
                document.body.appendChild(link);

                // Make the magic happen!
                link.click();
            }); // Please catch me!
        }
    }
}
</script>

<style scoped>

</style>
