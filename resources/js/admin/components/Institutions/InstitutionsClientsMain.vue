<template>
    <div>
    <v-container class="px-3 pt-0">

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
                <template v-slot:age-slot="{data}">
                    {{data.age}} años
                </template>
                <template v-slot:gender-slot="{data}">
                    {{data.gender.name}}
                </template>
                <template v-slot:action-slot="{data}">
                    <CustomerProgress :data-update="data"/>
                </template>
            </SatoriTable>
        </v-row>
    </v-container>
    </div>
</template>

<script>
import CustomerProgress from "../Customers/CustomerProgress";
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";
export default {
    name: "InstitutionsClientsMain",
    components:{SatoriTable, CustomerProgress},
    mixins: [MixinSatoriTable],
    data: () =>
        ({
            title: '',
            columns: [
                {
                    label: "Nombre",
                    name: "name",
                    style: "",
                    filter: {type: "simple"},
                    slot_name: 'name-slot'
                },
                {
                    label: "Correo electrónico",
                    name: "email",
                    style: "",
                    filter: {type: "simple"}
                },
                {
                    label: "Edad",
                    name: "age",
                    style: "",
                    filter: {type: "simple"},
                    slot_name: "age-slot",
                },
                {
                    label: "Sexo",
                    name: "gender",
                    style: "",
                    filter: {type: "select"},
                    slot_name: "gender-slot",
                },
                {
                    label: "",
                    name: "actions",
                    slot_name: "action-slot",
                }
            ],
            genders: [],
            URL_STATUS: route('admin.clients.status', {id: 'FAKE_ID'}),
        }),
    methods: {
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;
            axios.get(route('admin.clients_institutions.index_content', {id: this.$route.params.id}), {params: params}).then((response) => {
                this.isLoading = false;
                this.rows = response.data.data;
                this.total_rows = response.data.count;
                this.genders = response.data.genders;
                this.$set(this.columns[3].filter, 'items', this.genders);
            }).catch(function (error) {
                console.error(error);
            });
        },
    }
}
</script>

<style scoped>
</style>
