<template>
    <v-app>
        <v-row style="max-height: 100vh">
            <v-col cols="2">
                <Sidebar/>
            </v-col>
            <v-col cols="10" class="px-3rem">
                <Header></Header>
                <router-view></router-view>
                <Footer/>
            </v-col>
        </v-row>
    </v-app>
</template>

<script>
import Sidebar from "../commons/Sidebar";
import Header from "../commons/Header";
import Footer from "../commons/Footer";


export default {
    name: "App",
    components: {Footer, Sidebar, Header},
}
</script>

<style scoped>
.ListItemClass {
    color: #f5f5f5;
}

.SelectedTile:hover {
    border-radius: 4px;
    background: #455A64
}

.SelectedTile-active {
    border-radius: 4px;
    background: rgba(10, 204, 117, 0.19)
}

</style>
