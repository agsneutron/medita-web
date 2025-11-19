<template>
    <v-container class="px-3 pt-0">
        <div class="pt-3 text-right"></div>
        <v-row>
            <SatoriTable
                :rows="rows"
                :total_rows="total_rows"
                :is_loading="isLoading"
                :page_size="queryParams.per_page"
                :toggle_button="true"
                :update_status_url="this.URL_STATUS"
                @on-change-query="onChangeQuery"
                :columns="columns">
                <template v-slot:name-slot="{data}">
                    {{data.name}} {{data.last_name}} {{data.second_last_name}}
                </template>
                <template v-slot:status-slot="{data}">
                    {{data.active ? 'Activo' : 'Inactivo'}}
                </template>
                <template v-slot:category-slot="{data}">
                    {{(data.type_client) ? data.type_client.name : 'Usuario general'}}
                </template>
                <template v-slot:code-slot="{data}">
                    {{(data.code) ? data.code : '----------'}}
                </template>
                <template v-slot:action-slot="{data}">
                    <CodeForm :data-update="data"/>
                    <v-btn icon :disabled="!data.code" :to="{name:'income_institutions', params:{id: data.id}}" :class="data.code ? '' : 'opacity-5'">
                        <v-img contain src="/assets/icon/ic_out.svg" max-height="20"/>
                    </v-btn>
                    <v-btn icon :to="{name: routePayments(!data.code), params: {id: data.id}}">
                        <v-img contain src="/assets/icon/ic_shopbag.svg" max-height="20"/>
                    </v-btn>
                </template>
            </SatoriTable>
        </v-row>
    </v-container>
</template>

<script>
import CodeForm from "./CodeForm";
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";
export default {
    name: "IncomeMain",
    components:{SatoriTable, CodeForm},
    mixins: [MixinSatoriTable],
    data: () =>
        ({
            columns: [
                {
                    label: "Nombre del cliente/Institución",
                    name: "name",
                    style: "",
                    filter: {type: "simple"},
                    slot_name: "name-slot"
                },
                {
                    label: "Estado",
                    name: "status",
                    style: "",
                    filter: {type: "select"},
                    slot_name: "status-slot"
                },
                {
                    label: "Categoría",
                    name: "category",
                    style: "",
                    filter: {type: "select"},
                    slot_name: "category-slot"
                },
                {
                    label: "Código",
                    name: "code",
                    style: "",
                    filter: {type: "simple"},
                    slot_name: "code-slot"
                },
                {
                    label: "",
                    name: "actions",
                    slot_name: "action-slot",
                }
            ],
            status: [],
            categories: [],
            URL_STATUS: route('admin.income.status', {id: 'FAKE_ID', type:'FAKE_TYPE'}),
        }),
    methods: {
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;
            axios.get(route('admin.income.index_content'), {params: params}).then((response) => {
                this.isLoading = false;
                this.rows = response.data.data;
                this.total_rows = response.data.count;
                this.status = response.data.status;
                this.categories = response.data.categories;
                this.$set(this.columns[1].filter, 'items', this.status);
                this.$set(this.columns[2].filter, 'items', this.categories);
            }).catch(function (error) {
                console.error(error);
            });
        },
        routePayments(value){
            return value ? 'income_payments_clients' : 'income_payments_institutions';
        }
    }
}
</script>

<style scoped>

</style>
