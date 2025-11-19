<template>
    <v-container class="px-3 pt-5">
        <v-row class="pt-5 justify-content-center">
            <v-col cols="2" class="py-2" v-for="(education, index) in educational" :key="index">
                <strong class="text-violet px-2" style="font-size: 15px">{{ education.name }}</strong>
                <EducationalLevelsForm :data-update="education" @reload="reload"/>
                <v-card class="p-4 h-95">
                    <p class="my-2" v-for="(level, i) in education.levels" :key="i">{{ level.name }}</p>
                </v-card>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>

import EducationalLevelsForm from "./EducationalLevelsForm";
export default {
    name: "EducationalLevelsMain",
    components:{EducationalLevelsForm},
    data() {
        return {
            educational: [],
        }
    },
    created(){
        this.reload();
    },
    methods: {
        reload(){
            axios.get(route('admin.settings_educational_levels.get_educational_level')).then(response => {
                this.educational = response.data.educational;
            });
        }
    }
}
</script>

<style scoped>

</style>
