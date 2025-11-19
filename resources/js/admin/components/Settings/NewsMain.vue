<template>
    <v-container class="px-3 pt-0">
        <v-row>
            <v-col cols="6" offset="3" class="text-center">
                <h1 class="text-violet">Noticias</h1>
            </v-col>
            <v-col cols="3" class="text-right">
                <NewsForm/>
            </v-col>
        </v-row>
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
                <template v-slot:image-slot="{data}">
                    <div class="d-flex py-2 h-100px w-100px m-auto">
                        <v-img contain :src="data.url_image"/>
                    </div>
                </template>
                <template v-slot:action-slot="{data}">
                    <NewsShow :data-update="data"/>
                    <NewsForm :is-update="true" :data-update="data"/>
                </template>
            </SatoriTable>
        </v-row>
    </v-container>
</template>

<script>
import NewsForm from "./NewsForm";
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";
import NewsShow from "./NewsShow";
export default {
    name: "NewsMain",
    components:{NewsShow, SatoriTable, NewsForm},
    mixins: [MixinSatoriTable],
    data: () =>
        ({
            columns: [
                {
                    label: "",
                    name: "empty",
                    style: "width: 5%",
                },
                {
                    label: "",
                    name: "image",
                    style: "",
                    slot_name: "image-slot",
                },
                {
                    label: "Título",
                    name: "title",
                    style: "width: 40%",
                    slot_name: "name-slot"
                },
                {
                    label: "",
                    name: "actions",
                    style: "",
                    slot_name: "action-slot",
                },
                {
                    label: "",
                    name: "empty",
                    style: "width: 25%",
                },
            ],
            URL_STATUS: route('admin.settings_news.status',{id: 'FAKE_ID'})
        }),
    methods: {
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;
            axios.get(route('admin.settings_news.index_content'), {params: params}).then((response) => {
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
