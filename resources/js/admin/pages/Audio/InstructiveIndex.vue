<template>
    <v-card class="pb-5">
        <div class="pt-3 pr-3 text-right">
            <InstructiveForm :data-update="this.instructive"/>
        </div>
        <br>
        <div class="instructive">
            <iframe :src="this.instructive"
                    style="width: 84%; height: 650px;"/>
        </div>
    </v-card>
</template>

<script>
import InstructiveForm from "../../components/Audios/InstructiveForm";
export default {
    name: "InstructiveIndex",
    components: {InstructiveForm},
    data() {
        return {
            instructive: ''
        }
    },
    methods: {
        async fetchData() {
            await axios.get(route('admin.categories.get_instructive', {id: this.$route.params.id})).then((response) => {
                if(response.data.success){
                    this.instructive = response.data.instructive;
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
    .instructive {
        margin: 20px;
        text-align: center;
    }
</style>
