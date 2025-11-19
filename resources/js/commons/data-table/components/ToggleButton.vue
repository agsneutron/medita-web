<template>
<div class="d-flex align-items-center">

    <v-icon v-if="isLoading" class="text-violet mdi-spin mdi-36px">
        mdi-loading
    </v-icon>

    <v-img v-else-if="dataActive"
           v-on:click="onToggle"
           contain max-height="20"
           class=" text-violet cursor-pointer mdi-36px"
           content-class="w-30px"
           src="/assets/icon/slidercolor.png"
    />

    <v-img v-else-if="!dataActive"
           v-on:click="onToggle"
           contain max-height="20"
           class=" text-violet cursor-pointer mdi-36px"
           content-class="w-30px"
           src="/assets/icon/slidergray.png"
    />
</div>

</template>


<script>
import {bus} from "../../../admin/app"
export default {
    name: "ToggleButton",
    props: {
        dataUpdateUrl: {
            required: true,
            type: String,
        },
        entityId: {
            required: true,
        },
        type: {
            required: false,
        },
        active: {
            required: true,
        },
        title: {
            type: String,
            default: '',
        }
    },

    data: () => ({
        isLoading: false,
        dataActive: false,
    }),

    mounted() {
        this.dataActive = this.active;
    },

    methods: {
        onToggle() {
            this.isLoading = true;
            this.$swal.fire({
                icon:'info',
                iconColor:'#62457F',
                title: `<h4 class='text-center text-violet'> ${this.active ? `Desactivar ${this.title}` : `Activar ${this.title}`} </h4>`,
                text:`¿Estás seguro que deseas ${this.active ? 'desactivar' : 'activar'}?`,
                confirmButtonColor: '#62457F',
                confirmButtonText: 'Aceptar',
                showCancelButton: true,
                cancelButtonColor: '#62457F',
                cancelButtonText: "Cancelar",
                reverseButtons: true,
                width: 400
            }).then((result) => {
                if (result.isConfirmed) {
                    let url = this.dataUpdateUrl.replace('FAKE_ID', this.entityId);
                    url = url.replace('FAKE_TYPE', this.type);
                    axios.get(url).then((response) => {
                        this.isLoading = false;
                        if (response.data.success) {
                            this.dataActive = !this.dataActive;
                            this.$swal.fire({
                                icon:'success',
                                iconColor:'#62457F',
                                title: `¡Éxito!`,
                                showConfirmButton: false,
                                width: 400
                            })
                            bus.$emit('reload-grid');
                        }
                    });
                } else {
                    this.isLoading = false
                }
            })

        },
    }
}
</script>


<style lang="scss" scoped>

</style>
