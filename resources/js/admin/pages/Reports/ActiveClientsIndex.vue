<template>
    <v-card class="pb-5">
        <ActiveClientsMain/>
    </v-card>
</template>

<script>
import ActiveClientsMain from "../../components/Reports/ActiveClientsMain";

export default {
    name: "ActiveClientsIndex",
    components: {ActiveClientsMain}
}
</script>
