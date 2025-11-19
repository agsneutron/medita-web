<template>
    <v-card class="pb-5">
        <!-- Mostrar el boton del cuestionario sólo para la categoria de Lifefullness (ID=2)-->
        <div class="pt-3 pr-3 text-right d-flex" style="justify-content: end;">
            <PhasesForm  :category-id="category_id" />
            <div v-if="this.lifefullnessCategories.includes(category_id)" style="margin-left: 1rem">
                <v-btn
                    :to="{name: 'questionnaire', params: {id: category_id}}"
                    color="#62457F" dark width="12rem">
                    Cuestionario
                </v-btn>
            </div>
        </div>
        <SatoriTable
            :rows="rows"
            :total_rows="total_rows"
            :is_loading="isLoading"
            :page_size="queryParams.per_page"
            :toggle_button="true"
            :update_status_url="this.URL_STATUS"
            @on-change-query="onChangeQuery"
            :columns="columns">

            <template v-slot:img-slot="{data}">
                <img
                    style="max-width: 100px; max-height: 100px; padding: 10px;"
                    :src="data.url_image">
            </template>

            <template v-slot:action-slot="{data}">
                <PhasesForm :isUpdate="true" :dataUpdate="data" :category-id="data.category_id"/>
                <router-link class="ic-contentarchive-position" :to="{name: 'audios', params: {id_phase: data.id, id: category_id}}">
                    <v-img contain src="/assets/icon/ic_filemusic.svg" max-height="20"/>
                </router-link>
                <router-link v-if="categoriasConManualesEnLasFases.includes(data.category_id )"
                             class="ic-contentarchive-position"
                             :to="{name: 'phase_manual', params: {id: data.category_id, id_phase: data.id}}">
                    <v-img contain src="/assets/icon/ic_handbook.svg" max-height="20"/>
                </router-link>
                <router-link v-if="categoriasConIntructivosEnLasFases.includes(data.category_id )"
                             class="ic-contentarchive-position"
                             :to="{name: 'phase_instructive', params: {id: data.category_id, id_phase: data.id}}">
                    <v-img contain src="/assets/icon/ic_intructive.svg" max-height="20"/>
                </router-link>
            </template>
        </SatoriTable>
    </v-card>
</template>

<script>
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";
import PhasesForm from "../../components/Audios/PhasesForm";
export default {
    name: "PhasesIndex",
    components: {SatoriTable, PhasesForm},
    mixins: [MixinSatoriTable],
    data() {
        return {
            categoriasConManualesEnLasFases: [0,1],
            categoriasConIntructivosEnLasFases: [0,1],
            title: '',
            lifefullnessCategories: [2,3,4,5,6],
            columns: [
                {
                    label: "",
                    name: "url_image",
                    style: "",
                    slot_name: "img-slot"
                },
                {
                    label: "Nombre",
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
            URL_STATUS: route('admin.categories.phase_status', {id: 'FAKE_ID'}),
            names:[],
            category_id: this.$route.params.id,

        }
    },
    methods: {
         async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;
            await axios.get(route('admin.categories.category_content',  {id: this.$route.params.id}), {params: params}).then((response) => {
                this.isLoading = false;
                this.rows = response.data.data;
                this.total_rows = response.data.count;
                this.$set(this.columns[2].filter, 'items', this.names);
                this.category_id = Number(response.data.categoryId);
            }).catch(function (error) {
                console.error(error);
            });
        },
    },
    mounted() {
    },
}
</script>

<style scoped>
.ic-contentarchive-position{
    display: flex;
    flex-wrap: wrap;
    align-content: center;
    margin: auto;
}
</style>
