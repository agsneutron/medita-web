<template>
    <v-container class="px-3 pt-0">
        <div class="pt-3 text-right">
            <CustomersForm
                :genders="genders"
                :programs="programs"
                :institutions="institutions"
                :educational-levels="educationalLevels"
                :levels="levels"
            />
        </div>
        <SatoriTable
            @on-change-query="onChangeQuery"
            :columns="columns"
            :is_loading="isLoading"
            :page_size="queryParams.per_page"
            :rows="rows"
            :toggle_button="true"
            :total_rows="total_rows"
            :update_status_url="this.URL_STATUS"
        >
            <template v-slot:name-slot="{data}">
                <div style="width: 12rem">
                    {{ data.full_name }}
                </div>
            </template>

            <template v-slot:age-slot="{data}">
                <div style="width: 8rem">
                    {{ data.age }} años
                </div>
            </template>

            <template v-slot:gender-slot="{data}">
                <div style="width: 8rem">
                    {{ data.gender.name }}
                </div>
            </template>

            <template v-slot:program-slot="{data}">
                <div style="width: 12rem">
                    {{ data.program.name }}
                </div>
            </template>

            <template v-slot:action-slot="{data}">
                <CustomersForm
                    :is-update="true"
                    :data-update="data"
                    :genders="genders"
                    :programs="programs"
                    :institutions="institutions"
                    :educational-levels="educationalLevels"
                    :levels="levels"
                />
                <CustomerProgress :data-update="data"/>
            </template>
        </SatoriTable>
    </v-container>
</template>

<script>
import SatoriTable from "../../../commons/data-table/vuetify-satori-table";
import MixinSatoriTable from "../../../commons/data-table/mixins/MixinSatoriTable";
import CustomerProgress from "./CustomerProgress";
import CustomersForm from "./CustomersForm";

export default {
    name: "CustomersMain",
    components: {CustomersForm, CustomerProgress, SatoriTable},
    mixins: [MixinSatoriTable],
    data: () => ({
        columns: [{
            label: "Nombre",
            name: "name",
            style: "",
            filter: {type: "simple"},
            slot_name: "name-slot"
        }, {
            label: "Correo electrónico",
            name: "email",
            style: "",
            filter: {type: "simple"}
        }, {
            label: "Edad",
            name: "age",
            style: "",
            filter: {type: "simple"},
            slot_name: "age-slot"
        }, {
            label: "Sexo",
            name: "gender",
            style: "",
            filter: {type: "select"},
            slot_name: "gender-slot"
        }, {
            label: "Perfil usuario",
            name: "Programs",
            style: "",
            filter: {type: "simple"},
            slot_name: "program-slot"
        }, {
            label: "",
            name: "actions",
            slot_name: "action-slot"
        }],

        URL_STATUS: route('admin.clients.status', {id: 'FAKE_ID'}),
        genders: [],
        programs: [],
        institutions: [],
        educationalLevels: [],
        levels: []
    }),

    methods: {
        async fetchData(preventSpinner = false) {
            let params = this.prepareParams(preventSpinner);
            this.queryParams.page = 0;
            this.page = 0;

            try {
                const {data} = await axios.get(route('admin.clients.index_content'), {params});
                this.isLoading = false;
                this.rows = data.data;
                this.total_rows = data.count;

                this.genders = data.genders;
                this.programs = data.programs;
                this.institutions = data.institutions;
                this.educationalLevels = data.educational_levels;
                this.levels = data.levels;

                this.$set(this.columns[3].filter, 'items', this.genders);
            } catch (e) {
                this.alert(
                    'error',
                    'Error',
                    `Favor de contactar al administrador o soporte (${e})`
                );
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
