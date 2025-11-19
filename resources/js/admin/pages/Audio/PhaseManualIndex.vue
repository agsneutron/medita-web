<template>
    <v-card class="pb-5">
        <div class="pt-3 pr-3 text-right">
            <PhaseManualForm :data-update="this.manual"/>
        </div>
        <br>
        <div class="manual">
            <iframe :src="this.manual"
                    style="width: 84%; height: 650px;"/>
        </div>
    </v-card>
</template>

<script>
import PhaseManualForm from "../../components/Audios/PhaseManualForm";
export default {
    name: "ManualIndex",
    components: {PhaseManualForm},
    data() {
        return {
            manual: '',
            phase_id: this.$route.params.id_phase
        }
    },
    methods: {
        async fetchData() {
            await axios.get(route('admin.categories.get_phase_manual', {id: this.phase_id})).then((response) => {
                if(response.data.success){
                    this.manual = response.data.manual;
                }
            }).catch(function (error) {
                console.error(error);
            });
        },
    },
    beforeMount(){
        this.fetchData();
    }
}
</script>

<style scoped>
    .manual {
        margin: 20px;
        text-align: center;
    }
</style>

