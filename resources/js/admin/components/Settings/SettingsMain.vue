<template>
    <v-container class="px-3 pt-0">
        <div class="pt-3 text-right">
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
                <template v-slot:action-slot="{data}">
                    <v-btn icon :to="routeSwitch(data.id)">
                        <v-img contain src="/assets/icon/ic_eye_color.svg" max-height="20"/>
                    </v-btn>
                </template>
            </SatoriTable>
        </v-row>
    </v-container>
</template>

<script>
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";
export default {
    name: "SettingsMain",
    components:{SatoriTable},
    mixins: [MixinSatoriTable],
    data: () =>
        ({
            columns: [
                {
                    label: "",
                    name: "space",
                    style: "width: 25%",
                },
                {
                    label: "Nombre de archivo",
                    name: "name",
                    style: "width: 25%",
                    slot_name: "name-slot"
                },
                {
                    label: "",
                    name: "actions",
                    style: "display: flex!important; justify-content: center !important; align-items: center;",
                    slot_name: "action-slot",
                }
            ],
            URL_STATUS: route('admin.settings.status',{id: 'FAKE_ID'})
        }),
    methods: {
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;
            axios.get(route('admin.settings.index_content'), {params: params}).then((response) => {
                this.isLoading = false;
                this.rows = response.data.data;
                this.total_rows = response.data.count;
            }).catch(function (error) {
                console.error(error);
            });
        },
        routeSwitch(data){
            let route = {name:''};
            switch (data){
                case 1:
                    route.name = 'news';
                    break;
                case 2:
                    route.name = 'terms';
                    break;
                case 3:
                    route.name = 'privacy';
                    break;
                case 4:
                    route.name = 'educational_levels';
                    break;
                default: route= {name:''};
                    break;
            }
            return route;
        }
    }
}
</script>

<style scoped>

</style>
