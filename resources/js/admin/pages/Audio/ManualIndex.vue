<template>
    <v-card class="pb-5">
        <div class="pt-3 pr-3 text-right">
            <ManualForm :data-update="this.manual"/>
        </div>
        <br>
        <div class="manual">
            <iframe :src="this.manual"
                    style="width: 84%; height: 650px;"/>
        </div>
    </v-card>
</template>

<script>
import ManualForm from "../../components/Audios/ManualForm";
export default {
    name: "ManualIndex",
    components: {ManualForm},
    data() {
        return {
            manual: '',
        }
    },
    methods: {
        async fetchData() {
            await axios.get(route('admin.categories.get_manual', {id: this.$route.params.id})).then((response) => {
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

