<template>
    <v-container class="px-3 pt-0">
        <v-row class="pt-3 pl-5 d-flex align-items-center">
            <v-col cols="3">
                <p class="text-violet my-2 fw-bold">Desde</p>
                <v-menu
                    ref="menu"
                    v-model="menu"
                    :close-on-content-click="false"
                    :return-value.sync="since"
                    transition="scale-transition"
                    offset-y
                    min-width="auto"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                            v-model="since"
                            prepend-inner-icon="mdi-calendar"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                            color="#A3326D"
                            dense
                            outlined
                        ></v-text-field>
                    </template>
                    <v-date-picker
                        v-model="since"
                        no-title
                        scrollable
                        locale="es-MX"
                        color="#A3326D"
                        header-color="#A3326D"
                    >
                        <v-spacer></v-spacer>
                        <v-btn
                            text
                            color="#A3326D"
                            @click="menu = false"
                        >
                            Cancelar
                        </v-btn>
                        <v-btn
                            text
                            color="#A3326D"
                            @click="$refs.menu.save(since)"
                        >
                            Aceptar
                        </v-btn>
                    </v-date-picker>
                </v-menu>
            </v-col>
            <v-col cols="3">
                <p class="text-violet my-2 fw-bold">Hasta</p>
                <v-menu
                    ref="menu2"
                    v-model="menu2"
                    :close-on-content-click="false"
                    :return-value.sync="until"
                    transition="scale-transition"
                    offset-y
                    min-width="auto"
                >
                    <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                            v-model="until"
                            prepend-inner-icon="mdi-calendar"
                            readonly
                            v-bind="attrs"
                            v-on="on"
                            color="#A3326D"
                            dense
                            outlined
                        ></v-text-field>
                    </template>
                    <v-date-picker
                        v-model="until"
                        no-title
                        scrollable
                        locale="es-MX"
                        color="#A3326D"
                        header-color="#A3326D"
                    >
                        <v-spacer></v-spacer>
                        <v-btn
                            text
                            color="#A3326D"
                            @click="menu2 = false"
                        >
                            Cancelar
                        </v-btn>
                        <v-btn
                            text
                            color="#A3326D"
                            @click="$refs.menu2.save(until)"
                        >
                            Aceptar
                        </v-btn>
                    </v-date-picker>
                </v-menu>
            </v-col>
            <v-col cols="3">
                <v-btn @click="filterByDays" color="#A3326D" dark>
                    Filtrar
                </v-btn>
            </v-col>
        </v-row>
        <SatoriTable
            @on-change-query="onChangeQuery"
            :columns="columns"
            :is_loading="isLoading"
            :page_size="queryParams.per_page"
            :rows="rows"
            :toggle_button="false"
            :total_rows="total_rows"
        >
            <template v-slot:name-slot="{data}">
                <div style="width: 12rem">
                    {{ data.name }} {{ data.last_name }} {{ data.second_last_name }}
                </div>
            </template>

            <template v-slot:status-slot="{data}">
                <div style="width: 4rem">
                    {{ data.active === true ? 'Activo' : 'Inactivo' }}
                </div>
            </template>
        </SatoriTable>
    </v-container>
</template>

<script>
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";

export default {
    name: "ActiveClientsMain",
    components: {SatoriTable},
    mixins: [MixinSatoriTable],
    data: () => ({
        columns: [{
            label: "Nombre del cliente / institución",
            name: "name",
            style: "",
            filter: {type: "simple"},
            slot_name: "name-slot"
        }, {
            label: "Fecha de registro",
            name: "date",
            style: "",
            filter: {type: "date"}
        }, {
            label: "Estado",
            name: "status",
            style: "",
            filter: {type: "select"},
            slot_name: "status-slot"
        }],
        status: ['Activo', 'Inactivo'],
        since: null,
        until: null,
        menu: false,
        menu2: false,
    }),

    methods: {
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;

            try {
                const {data} = await axios.get(route('admin.reports_active_clients.index_content'), {params});
                this.isLoading = false;
                this.rows = data.data;
                this.total_rows = data.count;
                this.$set(this.columns[2].filter, 'items', this.status);
            } catch (e) {
                this.alert(
                    'error',
                    'Error',
                    `Favor de contactar al administrador o soporte (${e})`
                );
            }
        },

        async filterByDays(preventSpinner = false) {
            if (this.since !== null && this.until !== null) {
                let params = this.prepareParams(preventSpinner);
                this.queryParams.page = 0;
                this.page = 0;
                params['since'] = this.since;
                params['until'] = this.until;

                try {
                    const {data} = await axios.get(route('admin.reports_active_clients.filter_content'), {params});
                    this.isLoading = false;
                    this.rows = data.data;
                    this.total_rows = data.count;
                    this.$set(this.columns[2].filter, 'items', this.status);

                } catch (e) {
                    this.alert(
                        'error',
                        'Error',
                        `Favor de contactar al administrador o soporte (${e})`
                    );
                }

            } else {
                this.alert('warning', 'Fechas inválidas', 'No olvide ingresar ambas fechas para buscar');
            }
        },

        alert(icon, title, text) {
            this.$swal({
                icon,
                title: `<span class="text-violet">` + title + `</span>`,
                text,
                iconColor: '#62457F',
                showConfirmButton: false,
                timer: 2000,
            });
        }
    }
}
</script>
