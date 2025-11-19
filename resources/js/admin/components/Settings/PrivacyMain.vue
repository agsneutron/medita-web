<template>
    <div class="p-4">
        <div class="text-right">
            <PrivacyForm :data-update="privacy" @reload="reload"/>
        </div>
        <p class="m-5" v-html="privacy.content"/>
    </div>
</template>

<script>
import PrivacyForm from "./PrivacyForm";
export default {
    name: "PrivacyMain",
    components: {PrivacyForm},
    data: () =>
        ({
            privacy: null
        }),
    created(){
        this.reload();
    },
    methods: {
        reload(){
            axios.get(route('admin.settings_privacy.get_privacy')).then(response => {
                this.privacy = response.data.privacy;
            });
        }
    }
}
</script>

<style scoped>

</style>
