<template>
    <v-card class="pb-5">
        <div class="pt-3 pr-3 text-right">
            <PhaseInstructiveForm :data-update="this.information"/>
        </div>
        <br>
        <div class="informacion" v-html="information"/>
    </v-card>
</template>

<script>
import PhaseInstructiveForm from "../../components/Audios/PhaseInstructiveForm";
export default {
    name: "InstructiveIndex",
    components: {PhaseInstructiveForm},
    data() {
        return {
            information: '',
            phase_id: this.$route.params.id_phase
        }
    },
    methods: {
        async fetchData() {
            await axios.get(route('admin.categories.get_phase_affirmations', {id: this.phase_id})).then((response) => {
                if(response.data.success){
                    this.information = response.data.affirmations;
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
    .informacion{
        margin: 20px;
        text-align: justify;
        white-space: pre-line;
    }
</style>
