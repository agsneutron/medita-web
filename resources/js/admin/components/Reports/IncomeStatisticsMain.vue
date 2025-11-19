<template>
    <v-container class="px-3 pt-0">
        <SatoriTable
            @on-change-query="onChangeQuery"
            :columns="columns"
            :is_loading="isLoading"
            :page_size="queryParams.per_page"
            :rows="rows"
            :total_rows="total_rows"
        >
        </SatoriTable>
    </v-container>
</template>

<script>
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";

export default {
    name: "IncomeStatisticsMain",
    components: {SatoriTable},
    mixins: [MixinSatoriTable],
    data: () => ({
        columns: [{
            label: "",
            name: "space",
            style: "width: 20%"
        },{
            label: "Característica",
            name: "name",
            style: "width: 40%",
        }, {
            label: "",
            name: "count",
            style: ""
        }]
    }),

    methods: {
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;

            try {
                const {data} = await axios.get(route('admin.reports_income_statistics.index_content'), {params});
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
