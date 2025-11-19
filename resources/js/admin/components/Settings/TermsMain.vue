<template>
    <div class="p-4">
        <div class="text-right">
            <TermsForm :data-update="terms" @reload="reload"/>
        </div>
        <p class="m-5" v-html="terms.content"/>
    </div>
</template>

<script>
import TermsForm from "./TermsForm";
export default {
    name: "TermsMain",
    components: {TermsForm},
    data: () =>
        ({
            terms: null
        }),
    created(){
        this.reload();
    },
    methods: {
        reload(){
            axios.get(route('admin.settings_terms.get_terms')).then(response => {
                this.terms = response.data.terms;
            });
        }
    }
}
</script>

<style scoped>

</style>
