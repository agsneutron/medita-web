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
            <template v-slot:teacher-slot="{data}">
                <div style="width: 4rem">
                    {{ data.teacher === true ? 'SI' : 'NO' }}
                </div>
            </template>

            <template v-slot:institution-slot="{data}">
                <div style="width: 4rem">
                    {{ data.institution.name }}
                </div>
            </template>

            <template v-slot:educational_level-slot="{data}">
                <div style="width: 4rem">
                    {{ data.educational_level.name }}
                </div>
            </template>

            <template v-slot:progress-slot="{data}">
                <div style="width: 12rem">
                    {{ getProgress(data) }}%
                </div>
            </template>

        </SatoriTable>
    </v-container>
</template>

<script>
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";

export default {
    name: "LFUEducationMain",
    components: {SatoriTable},
    mixins: [MixinSatoriTable],
    data: () => ({
        columns: [{
            label: "Nombre de la Escuela",
            name: "institution",
            style: "",
            filter: {type: "simple", th_style: "min-width: 192px"},
            slot_name: "institution-slot"
        },
        {
            label: "Nombre",
            name: "name",
            style: "",
            filter: {type: "simple", th_style: "min-width: 192px"}
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
            label: "Maestro",
            name: "teacher",
            style: "",
            filter: {type: "select", th_style: "min-width: 140px"},
            slot_name: "teacher-slot"
        },
        {
            label: "Nivel escolar",
            name: "educational_level",
            style: "",
            filter: {type: "select", th_style: "min-width: 192px"},
            slot_name: "educational_level-slot"
        },
        {
            label: "Edad",
            name: "age",
            style: "",
            filter: {type: "simple", th_style: "min-width: 140px"},
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
        //     filter: {type: "simple"},
        // }
        ],
        status: ['Activo', 'Inactivo'],
        educationalLevels: null,
        teacher:[{id: 0, name: "NO"}, {id: 1, name: "SI"}]

    }),

    methods: {
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;

            try {
                const {data} = await axios.get(route('admin.reports.lfu_education'), {params});
                this.isLoading = false;
                this.rows = data.data;
                this.total_rows = data.count;
                this.educationalLevels = data.educationalLevels;
                this.$set(this.columns[5].filter, 'items', this.teacher);
                this.$set(this.columns[6].filter, 'items', this.educationalLevels);
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
            axios.get(route('admin.reports.export_lfuEducation'), {
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
                link.setAttribute('download', 'ReporteLFUEducation.xlsx');

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
