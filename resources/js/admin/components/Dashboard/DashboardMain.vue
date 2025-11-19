<template>
    <v-container>
        <v-row>
            <v-col cols="3">
                <ProgressCircular
                    title="Usuarios registrados"
                    :users="users.users"
                    :users-goal="goals.users"
                    :users-progress="users.percentage"
                />
            </v-col>
            <v-col cols="3">
                <ProgressCircular
                    title="Ventas mensuales"
                    :format-goal="goals.formatSalesGoal"
                    :sales="payments.payments"
                    :sales-progress="payments.percentage"
                />
            </v-col>
            <v-col cols="6">
                <ReproductionsGraph :reproduction-goal="goals.reproduction"/>
            </v-col>
        </v-row>
        <v-row>
            <v-col cols="12">
                <IncomeGraph/>
            </v-col>
        </v-row>
    </v-container>
</template>

<script>
import ProgressCircular from "./ProgressCircular.vue";
import ReproductionsGraph from "./ReproductionsGraph.vue";
import IncomeGraph from "./IncomeGraph.vue";

export default {
    name: "DashboardMain",
    components: {IncomeGraph, ReproductionsGraph, ProgressCircular},
    data: () => ({
        goals: {
            users: null,
            sales: null,
            reproduction: null,
            formatSalesGoal: null,
        },


        users: {
            users: null,
            percentage: null,
        },

        payments: {
            payments: null,
            percentage: null,
        },
    }),

    created() {
        this.getAllInfo();
    },

    methods: {
        async getGoals() {
            try {
                const {data} = await axios.get(route('admin.dashboard.get_goals'));
                this.goals.users = data.registeredUsersGoal.goal;
                this.goals.sales = data.saleGoal.goal;
                this.goals.reproduction = data.reproductionGoal.goal
                this.goals.formatSalesGoal = data.saleGoal.format_goal;
            } catch (e) {
                this.alert(
                    'error',
                    'Error',
                    `Favor de contactar al administrador o soporte (${e})`
                );
            }
        },

        async getUsers() {
            try {
                const {data} = await axios.get(route('admin.dashboard.get_users'));
                this.users.users = data.users;
                this.users.percentage = (this.users.users / this.goals.users) * 100;
                if (this.users.percentage > 100) {
                    this.users.percentage = 100;
                }
            } catch (e) {
                this.alert(
                    'error',
                    'Error',
                    `Favor de contactar al administrador o soporte (${e})`
                );
            }
        },

        async getSales() {
            try {
                const {data} = await axios.get(route('admin.dashboard.get_sales'));
                const payment = data.payments.toFixed(2);
                this.payments.percentage = (payment / this.goals.sales) * 100;
                if (this.payments.percentage > 100) {
                    this.payments.percentage = 100;
                }
                this.payments.payments = Intl.NumberFormat('es-MX', { style: "currency", currency:"MXN" }).format(payment)
            } catch (e) {
                this.alert(
                    'error',
                    'Error',
                    `Favor de contactar al administrador o soporte (${e})`
                );
            }
        },

        async getAllInfo() {
            await this.getGoals();
            await this.getUsers();
            await this.getSales();
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
