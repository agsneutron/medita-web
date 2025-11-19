<template>
    <v-card class="pb-5">
        <SatoriTable
            :rows="rows"
            :total_rows="total_rows"
            :is_loading="isLoading"
            :page_size="queryParams.per_page"
            :toggle_button="false"
            @on-change-query="onChangeQuery"
            :columns="columns">

            <template v-slot:img-slot="{data}">
                <img
                    style="max-width: 100px; max-height: 100px; padding: 10px;"
                    :src="data.url_image">
            </template>

            <template v-slot:action-slot="{data}">
                <CategoriesForm :isUpdate="true" :dataUpdate="data" />
                <router-link class="ic-contentarchive-position" :to="{name: 'phases', params: {id: data.id}}">
                    <v-img contain src="/assets/icon/ic_contentarchive.svg" max-height="20"/>
                </router-link>

                <router-link class="ic-contentarchive-position"
                             :to="{name: 'instructive', params: {id: data.id}}"
                             :is="data.url_instructive===null ? 'span' : 'router-link'"
                             :class="data.url_instructive===null ? 'opacity50' : ''" >
                    <v-img contain src="/assets/icon/ic_intructive.svg" max-height="20"/>
                </router-link>

                <router-link class="ic-contentarchive-position"
                             :to="{name: 'manual', params: {id: data.id}}"
                             :is="data.url_manual===null ? 'span' : 'router-link'"
                             :class="data.url_manual===null ? 'opacity50' : ''" >
                    <v-img contain src="/assets/icon/ic_handbook.svg" max-height="20"/>
                </router-link>
            </template>
        </SatoriTable>
    </v-card>
</template>

<script>
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";
import CategoriesForm from "../../components/Audios/CategoriesForm";
export default {
    name: "CategoriesIndex",
    components: {SatoriTable, CategoriesForm},
    mixins: [MixinSatoriTable],
    data() {
        return {
            columns: [
                {
                    label: "",
                    name: "url_image",
                    style: "",
                    slot_name: "img-slot"
                },
                {
                    label: "Nombre de la categoría",
                    name: "name",
                    style: "",
                    filter: {type: "simple"},
                },
                {
                    label: "Descripción",
                    name: "description",
                    style: "",
                    filter: {type: "simple"},
                },
                {
                    label: "",
                    name: "actions",
                    slot_name: "action-slot",
                }
            ],
            names: []
        }
    },
    methods: {
         fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;
            axios.get(route('admin.categories.index_content'), {params}).then((response) => {
                this.isLoading = false;
                this.rows = response.data.data;
                this.total_rows = response.data.count;
                this.$set(this.columns[2].filter, 'items', this.names);
            }).catch(function (error) {
                console.error(error);
            });
        },
    },
    mounted(){
    }
}
</script>

<style scoped>
    .ic-contentarchive-position{
        display: flex;
        flex-wrap: wrap;
        align-content: center;
        margin-left: auto;
    }
    .opacity50{
        opacity: 50%;
    }
</style>
