<template>
    <v-container class="px-3 pt-0">
        <div class="pt-3 text-right">
            <UsersForm :profiles="profiles"/>
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
                <template v-slot:name-slot="{data}">
                    {{data.name}} {{data.last_name}} {{data.second_last_name}}
                </template>
                <template v-slot:profile-slot="{data}">
                    {{data.role.name}}
                </template>
                <template v-slot:action-slot="{data}">
                    <UsersForm :isUpdate="true" :dataUpdate="data" :profiles="profiles"/>
                </template>
            </SatoriTable>
        </v-row>
    </v-container>
</template>

<script>
import UsersForm from "./UsersForm";
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";
export default {
    name: "UsersMain",
    components:{SatoriTable, UsersForm},
    mixins: [MixinSatoriTable],
    data: () =>
        ({
            columns: [
                {
                    label: "Nombre",
                    name: "name",
                    style: "",
                    filter: {type: "simple"},
                    slot_name: "name-slot"
                },
                {
                    label: "Correo electrónico",
                    name: "email",
                    style: "",
                    filter: {type: "simple"}
                },
                {
                    label: "Perfil",
                    name: "role",
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
            URL_STATUS: route('admin.users.status', {id: 'FAKE_ID'}),
        }),
    methods: {
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;
            axios.get(route('admin.users.index_content'), {params: params}).then((response) => {
                this.isLoading = false;
                this.rows = response.data.data;
                this.total_rows = response.data.count;
                this.profiles = response.data.roles;
                this.$set(this.columns[2].filter, 'items', this.profiles);
            }).catch(function (error) {
                console.error(error);
            });
        },
    }
}
</script>

<style scoped>

</style>
