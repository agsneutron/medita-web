<template>
    <div>
        <v-container class="px-3 pt-0">
            <v-row>
                <SatoriTable
                    :rows="rows"
                    :total_rows="total_rows"
                    :is_loading="isLoading"
                    :page_size="queryParams.per_page"
                    :toggle_button="false"
                    @on-change-query="onChangeQuery"
                    :columns="columns">
                    <template v-slot:category-slot="{data}">
                        {{ data.audio !== null ? data.audio.phase.category.name : data.phase.category.name}}
                    </template>
                    <template v-slot:audio-slot="{data}">
                        {{ data.audio !== null ? data.audio.name : data.phase.name}}
                    </template>
                    <template v-slot:price-slot="{data}">
                        {{ formatter.format(data.price) }}
                    </template>
                    <template v-slot:date-slot="{data}">
                        {{ data.date_format }}
                    </template>
                </SatoriTable>
            </v-row>
        </v-container>
    </div>
</template>

<script>
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";

export default {
    name: "IncomePaymentsClientsMain",
    components: {SatoriTable},
    mixins: [MixinSatoriTable],
    data: () =>
        ({
            title: '',
            columns: [
                {
                    label: "Categoría",
                    name: "category",
                    style: "",
                    filter: {type: "simple"},
                    slot_name: 'category-slot'
                },
                {
                    label: "Nombre del elemento",
                    name: "audio",
                    style: "",
                    filter: {type: "simple"},
                    slot_name: 'audio-slot'
                },
                {
                    label: "Monto de pago",
                    name: "price",
                    style: "",
                    filter: {type: "simple"},
                    slot_name: 'price-slot'
                },
                {
                    label: "Forma de pago",
                    name: "payment_method",
                    style: "",
                    filter: {type: "simple"}
                },
                {
                    label: "Fecha de aportación",
                    name: "date",
                    style: "",
                    filter: {type: "date"},
                    slot_name: 'date-slot'
                },
            ],
        }),
    methods: {
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;
            axios.get(route('admin.income_payments_clients.index_content', {id: this.$route.params.id}), {params: params}).then((response) => {
                this.isLoading = false;
                this.rows = response.data.data;
                this.total_rows = response.data.count;
            }).catch(function (error) {
                console.error(error);
            });
        },
    }
}
</script>

<style scoped>

</style>
