<template>
    <v-container class="px-3 pt-0">
        <SatoriTable
            @on-change-query="onChangeQuery"
            :columns="columns"
            :is_loading="isLoading"
            :page_size="queryParams.per_page"
            :rows="rows"
            :toggle_button="true"
            :total_rows="total_rows"
            :update_status_url="this.URL_STATUS"
        >
            <template v-slot:categories-slot="{data}">
                <div class="d-flex flex-column">
                    <span
                        v-for="(categories, indexCategories) in data.categories" :key="indexCategories"
                        class="my-1"
                    >
                        {{ categories.name }}
                    </span>
                </div>
            </template>

            <template v-slot:action-slot="{data}">
                <ProgramsForm :data-update="data"/>
            </template>
        </SatoriTable>
    </v-container>
</template>

<script>
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";
import ProgramsForm from "./ProgramsForm";

export default {
    name: "ProgramsMain",
    components: {ProgramsForm, SatoriTable},
    mixins: [MixinSatoriTable],
    data: () => ({
        columns: [{
            label: "Nombre del programa",
            name: "name",
            style: "",
            filter: {type: "simple"}
        }, {
            label: "Material de acceso",
            name: "categories",
            style: "",
            filter: {type: "simple"},
            slot_name: "categories-slot"
        }, {
            label: "",
            name: "actions",
            slot_name: "action-slot"
        }],

        URL_STATUS: route('admin.programs.status', {id: 'FAKE_ID'}),
    }),

    methods: {
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;

            try {
                const {data} = await axios.get(route('admin.programs.index_content'), {params});
                this.isLoading = false;
                this.rows = data.data;
                this.total_rows = data.count;
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
