<template>
    <v-card class="pb-5">

        <div class="pt-3 pr-3 text-right">
            <AudiosForm :isUpdate="false" :restrictions="restrictions"/>
        </div>
        <SatoriTable
            ref="table"
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
                <AudiosForm  :isUpdate="true" :data-update="data" :restrictions="restrictions"/>
                <EvaluationList :id-audio="data.id" :evaluations="data.evaluations"/>
            </template>
        </SatoriTable>
    </v-card>
</template>

<script>
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";
import EvaluationList from "../../components/Audios/EvaluationList";
import AudiosForm from "../../components/Audios/AudiosForm";
export default {
    name: "AudiosIndex",
    components: {SatoriTable, AudiosForm, EvaluationList},
    mixins: [MixinSatoriTable],
    data() {
        return {
            title:'',
            columns: [
                {
                    label: "",
                    name: "url_image",
                    style: "",
                    slot_name: "img-slot"
                },
                {
                    label: "No.",
                    name: "number",
                    style: "",
                    filter: {type: "simple"},
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
            URL_STATUS: route('admin.categories.audio_status', {id: 'FAKE_ID'}),
            restrictions: [],
            programs: [],
            evaluations: {}
        }
    },
    methods: {
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;
            await axios.get(route('admin.categories.audios_content', {id: this.$route.params.id_phase}), {params: params}).then((response) => {
                this.isLoading = false;
                this.rows = response.data.data;
                this.total_rows = response.data.count;
                this.restrictions = response.data.restrictions;
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



</style>

