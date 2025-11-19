<template>
    <v-container class="px-3 pt-0">
        <div class="pt-3 text-right">
            <InstitutionsForm :profiles="profiles" :client_types="client_types"/>
        </div>
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
                <template v-slot:client-type-slot="{data}">
                    {{data.type_client.name}}
                </template>
                <template v-slot:profile-slot="{data}">
                    {{data.program.name}}
                </template>
                <template v-slot:action-slot="{data}">
                    <InstitutionsForm :isUpdate="true" :dataUpdate="data" :profiles="profiles" :client_types="client_types"/>
                    <v-btn icon :to="{name: 'institutions_clients', params:{id: data.id}}">
                        <v-img contain src="/assets/icon/ic_users_color.svg" max-height="20"/>
                    </v-btn>
                </template>
            </SatoriTable>
        </v-row>
    </v-container>
</template>

<script>
import InstitutionsForm from "./InstitutionsForm";
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";
export default {
    name: "InstitutionsMain",
    components:{SatoriTable, InstitutionsForm},
    mixins: [MixinSatoriTable],
    data: () =>
        ({
            columns: [
                {
                    label: "Nombre",
                    name: "name",
                    style: "",
                    filter: {type: "simple"},
                },
                {
                    label: "Contacto",
                    name: "contact",
                    style: "",
                    filter: {type: "simple"}
                },
                {
                    label: "Correo",
                    name: "contact_email",
                    style: "",
                    filter: {type: "simple"}
                },
                {
                    label: "Tipo de cliente",
                    name: "client_type",
                    style: "",
                    filter: {type: "select"},
                    slot_name: "client-type-slot"
                },
                {
                    label: "Perfil",
                    name: "program",
                    style: "",
                    filter: {type: "select"},
                    slot_name: "profile-slot"
                },
                {
                    label: "",
                    name: "actions",
                    slot_name: "action-slot",
                }
            ],
            profiles: [],
            client_types: [],
            URL_STATUS: route('admin.institutions.status', {id: 'FAKE_ID'}),
        }),
    methods: {
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;
            axios.get(route('admin.institutions.index_content'), {params: params}).then((response) => {
                this.isLoading = false;
                this.rows = response.data.data;
                this.total_rows = response.data.count;
                this.client_types = response.data.client_types;
                this.profiles = response.data.profiles;
                this.$set(this.columns[3].filter, 'items', this.client_types);
                this.$set(this.columns[4].filter, 'items', this.profiles);
            }).catch(function (error) {
                console.error(error);
            });
        },
    }
}
</script>

<style scoped>

</style>
