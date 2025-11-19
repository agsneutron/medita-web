<template>
    <v-row class="mb-2">
        <v-col cols="7" class="centrar mb-2" style="margin-right: 0rem">
            <v-btn icon v-if="$route.meta.parent!=='#'" :to="{name: $route.meta.parent}" style="margin: 0px 10px;">
                <v-icon class="text-violet mdi-36px">
                    mdi-chevron-left
                </v-icon>
            </v-btn>
            <h2 class="header-title m-0"> {{$route.meta.parent === '#' ? $route.meta.title : getSubtitle }} </h2>
            <div
                v-if="$route.meta.title === 'DASHBOARD'"
                style="margin-left: 8rem;"
            >
                <span class="fs-5" style="color: lightgray;">
                    {{this.date}}
                </span>
            </div>
        </v-col>
        <v-col cols="5" class="centrar p-0" style="justify-content: end">
            <div style="    display: flex; align-items: center; ">
                <v-btn icon :to="{name: 'settings'}"style="margin-right: 2rem">
                    <v-img contain src="/assets/icon/ic_settings.svg" max-height="20"/>
                </v-btn>

            <img class="logo" src="/assets/image/lifefullness-logo.png">

            <template>
                <v-expansion-panels flat>
                    <v-expansion-panel>
                        <v-expansion-panel-header style="width: auto">
                            {{name}}
                        </v-expansion-panel-header>
                        <v-expansion-panel-content style="position: absolute; margin-left: 2rem">
                            <v-btn class="btn logout-btn" @click="confirmDialog()">
                                <span class="ml-2 mr-1">Cerrar sesión</span>
                                <v-icon class="text-purple mr-2">
                                    mdi-exit-to-app
                                </v-icon>
                            </v-btn>
                        </v-expansion-panel-content>
                    </v-expansion-panel>
                </v-expansion-panels>
            </template>
            </div>
        </v-col>
    </v-row>
</template>

<script>
export default {
    name: "Header",
    props: {
    },
    data() {
        return {
            name: '',
            subtitle: '',
            date: '',
        }
    },
    methods: {
        getDate(){
            let today = new Date();
            let options = { weekday: 'short', year: 'numeric', month: 'long', day: 'numeric' };
            this.date = today.toLocaleString('es-MX', options);
        },
        async getUser() {
            try {
                const {data} = await axios.post(route('admin.getAuthUser'));
                if (data.success) {
                    this.name = data.user.name+' '+data.user.last_name+' '+data.user.second_last_name;
                }
            } catch (error) {
                this.alert('error', 'Error', 'Favor de contactar al administrador');
            }
        },
        async logout() {
            await axios.get(route('admin.logout'));
            window.location.href = "/";
        },
        confirmDialog: function () {
            this.$swal({
                html: `
                    <h4 class="text-white bg-purple py-3" style="border-top-left-radius: 5px; border-top-right-radius: 5px;"><strong>Cerrar sesión</strong></h4>
                    <p class="text-purple mt-5"> ¿Estás seguro de que deseas cerrar sesión?</p>
                `,
                customClass:{
                    htmlContainer:'m-0',
                    cancelButton:'mx-5',
                    confirmButton:'mx-5'
                },
                showConfirmButton: true,
                showCancelButton: true,
                cancelButtonColor: '#573c72',
                confirmButtonColor: '#573c72',
                cancelButtonText: 'Cancelar',
                confirmButtonText: 'Aceptar',
                reverseButtons: true
            }).then((result) => {
                if (result.isConfirmed) {
                    this.logout();
                }
            });
        },
    },
    computed:{
        getSubtitle(){
            switch (this.$route.meta.parent)
            {
                case 'institutions':
                    axios.get(route('admin.institutions.get_institution', {id: this.$route.params.id})).then(response => {
                        if (response.data.success) this.subtitle = this.$route.meta.title + response.data.institution.name;
                    });
                    break;
                case 'categories':
                     axios.get(route('admin.categories.get_category', {id: this.$route.params.id})).then(response => {
                        if (response.data.success)  this.subtitle = response.data.category.name.toUpperCase() + this.$route.meta.title;
                     });
                     break;
                case 'phases':
                    if(this.$route.meta.title === ' - CUESTIONARIO'){
                        axios.get(route('admin.categories.get_category', {id: this.$route.params.id})).then(response => {
                            if (response.data.success)  this.subtitle = response.data.category.name.toUpperCase() + this.$route.meta.title;
                        });
                        break;
                    }
                    if(this.$route.meta.title === ' - MANUAL'){
                        axios.get(route('admin.categories.get_phase', {id: this.$route.params.id_phase})).then(response => {
                            if (response.data.success)  {
                                this.subtitle = response.data.category.name.toUpperCase() +" / "+
                                    response.data.phase.name.toUpperCase() +' '+
                                    this.$route.meta.title;
                            }
                        });
                        break;
                    }
                    if(this.$route.meta.title === ' - AFIRMACIONES'){
                        axios.get(route('admin.categories.get_phase', {id: this.$route.params.id_phase})).then(response => {
                            if (response.data.success)  {
                                this.subtitle = response.data.category.name.toUpperCase() +" / "+
                                                response.data.phase.name.toUpperCase() +' '+
                                                this.$route.meta.title;
                            }

                        });
                        break;
                    }
                     axios.get(route('admin.categories.get_phase', {id: this.$route.params.id_phase})).then(response => {
                        if (response.data.success)  this.subtitle = response.data.category.name.toUpperCase() +" / "+response.data.phase.name.toUpperCase();
                     });
                     break;
                case 'income':
                    if (this.$route.meta.subpage === 'payments_clients') {
                        axios.get(route('admin.clients.get_client', {id: this.$route.params.id})).then(response => {
                            if (response.data.success) this.subtitle = this.$route.meta.title + response.data.client.full_name;
                        });
                    }else if (this.$route.meta.subpage === 'payments_institutions') {
                    axios.get(route('admin.institutions.get_institution', {id: this.$route.params.id})).then(response => {
                        if (response.data.success) this.subtitle = this.$route.meta.title + response.data.institution.type_client.name;
                    });
                    }else{
                        axios.get(route('admin.institutions.get_institution', {id: this.$route.params.id})).then(response => {
                            if (response.data.success) this.subtitle = this.$route.meta.title + response.data.institution.name;
                        });
                    }
                    break;

                case 'reports':
                    this.subtitle = this.$route.meta.title;
                    break;

                case 'settings':
                    this.subtitle = this.$route.meta.title;
                    break;
                default: this.subtitle='...';
                break;
            }
            return this.subtitle;
        }
    },
    mounted() {
       this.getUser();
       this.getDate();
    },

}
</script>

<style scoped>

    .header-title{
        color: #a3326d;
        font-weight: bold;
    }

    .dialog-header{
        background-color: #573c72;
        color: white;
        font-weight: bold;
    }

    .dialog-text{
        color: #573c72;
        font-weight: bold;
    }

    .centrar{
        align-items: center;
        display: flex;
    }

    .p-0{
        padding: 0;
    }

    .logout-btn{
        text-transform: initial;
        background-color: white !important;
    }

    .logo{
        box-shadow: 0px 0px 4px lightgray;
        border-radius: 50%;
        width: 40px;
        height: 35px;
        margin-right: 4px;
        padding: 4px;
    }

</style>
