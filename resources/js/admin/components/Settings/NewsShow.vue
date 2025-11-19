<template>
    <v-dialog max-height="90vh" max-width="575" v-model="dialog">
        <v-btn class="btn-close" icon @click="goBack">
            <v-icon class="text-white">
                mdi-window-close
            </v-icon>
        </v-btn>
        <template v-slot:activator="{ on, attrs }">
            <v-btn icon @click="updateData(dataUpdate)"
                   v-on="on"
                   v-bind="attrs">
                <v-img contain src="/assets/icon/ic_eye_color.svg" max-height="20"/>
            </v-btn>
        </template>
        <v-card class="invisible-scrollbar">
            <v-card-title class="d-flex justify-content-center bg-purple py-5">
                <div/>
                <div class="d-flex text-white text-center py-0 mb-0">
                    <v-img contain src="/assets/icon/ic_user.svg" max-height="30"/>
                    <div class="mx-2">Noticias</div>
                </div>
            </v-card-title>
            <v-card-text>
                <v-container class="px-3rem">
                    <v-row justify="center">
                        <v-col cols="12" class="py-0">
                            <p class="text-violet my-2"><b>Título:</b></p>
                            <p class="my-2">{{dataUpdate.title}}</p>
                        </v-col>
                        <v-col cols="12" class="py-0 d-flex justify-content-center">
                            <v-img contain :src="dataUpdate.url_image" max-width="250" max-height="250"/>
                        </v-col>
                        <v-col cols="12" class="py-0">
                            <p class="text-violet my-2"><b>Cuerpo de texto</b></p>
                            <div class="h-30vh p-2 mostly-customized-scrollbar" v-html="dataUpdate.content"></div>
                        </v-col>
                    </v-row>
                </v-container>
            </v-card-text>
        </v-card>
    </v-dialog>
</template>

<script>
import {bus} from "../../app";
import vue2Dropzone from 'vue2-dropzone';

export default {
    name: "NewsShow",
    components:{vue2Dropzone},
    props: {
        dataUpdate: {
            type: Object,
            required: false
        },
    },
    data() {
        return {
            dialog: false,
        }
    },
    methods: {
        goBack() {
            this.dialog = false;
        },
    }
}
</script>

<style scoped>

</style>
