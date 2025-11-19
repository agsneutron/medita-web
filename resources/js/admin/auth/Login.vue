<template>
    <v-app class="bg-login">
        <LoginMain/>
    </v-app>
</template>

<script>
import LoginMain from "./components/LoginMain";
export default {
    name: "Login",
    components:{LoginMain}
}
</script>
