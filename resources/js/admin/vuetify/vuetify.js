import '@mdi/font/css/materialdesignicons.css'
import Vue from 'vue';
import Vuetify from 'vuetify';
import 'vuetify/dist/vuetify.min.css';

Vue.use(Vuetify);

// ****** Global Icons ******  //
Vue.component("update-icon", {
    template: `<img src="/assets/icon/ic_edit.png" alt="update icon">`
});

// ****** Dashboard Icons ****** //
Vue.component("dashboard-icon", {
    template: `<img src="/assets/icon/ic_dashboard.svg" alt="dashboard icon">`
});

Vue.component("dashboard-active-icon", {
    template: `<img src="/assets/icon/ic_dashboard_color.svg" alt="dashboard active icon">`
});


// ****** Customers Icons ****** //
Vue.component("customers-icon", {
    template: `<img src="/assets/icon/ic_users.svg" alt="customers icon">`
});

Vue.component("customers-active-icon", {
    template: `<img src="/assets/icon/userscolor.svg" alt="customers active icon">`
});

Vue.component("customer-progress-icon", {
    template: `<img src="/assets/icon/ic_customer_progress.svg" alt="customer progress">`
});

// ****** Programs Icons ****** //
Vue.component("programs-icon", {
    template: `<img src="/assets/icon/ic_programs.svg" alt="programs icon">`
});

Vue.component("programs-active-icon", {
    template: `<img src="/assets/icon/ic_programs_color.svg" alt="customers icon">`
});

const opts = {
    icons: {
        iconfont: 'mdi',
        values: {
            // ****** Global Icons ******  //
            updateIcon: {
                component: "update-icon"
            },

            // ****** Dashboard Icons ******  //
            dashboardIcon: {
              component: "dashboard-icon"
            },

            dashboardActiveIcon: {
              component: "dashboard-active-icon"
            },

            // ****** Customers Icons ******  //
            customersIcon: {
                component: "customers-icon"
            },
            customersActiveIcon: {
                component: "customers-active-icon"
            },
            customerProgress: {
                component: "customer-progress-icon"
            },

            // ****** Programs Icons ******  //
            programsIcon: {
                component: "programs-icon"
            },
            programsActiveIcon: {
                component: "programs-active-icon"
            }
        }
    },
};

export default new Vuetify(opts);
