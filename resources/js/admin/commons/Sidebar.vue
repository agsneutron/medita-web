<template>
    <v-navigation-drawer
        app
        class="d-flex flex-column align-items-center justify-content-between"
        color="#62457F" dark
        permanent width="16.6667vw"
    >
        <v-img
            class="my-5"
            contain
            max-height="70"
            src="/assets/logo/logo-sidebar.svg"
        >
        </v-img>

        <v-list flat>
            <div v-for="(link, i) in links" :key="i" class="my-4">
                <v-list-item
                    v-if="!link.subLinks"
                    :key="link.title"
                    :to="{name: link.to}"
                >
                    <template v-slot:default="{active,toggle}">
                        <div v-if="active" :class="active ? 'active-tab' : ''">
                            <v-list-item-icon>
                                <v-icon v-if="link.activeIcon !== 'false'" v-text="link.activeIcon"></v-icon>
                                <v-img v-else contain max-height="20" :src="link.activeImage" content-class="w-100"/>
                            </v-list-item-icon>

                            <v-list-item-content>
                                <v-list-item-title class="text-uppercase" v-text="link.title"></v-list-item-title>
                            </v-list-item-content>
                        </div>

                        <div v-else :class="active ? 'active-tab' : 'disabled-tab'">
                            <v-list-item-icon>
                                <v-icon v-if="link.icon !== 'false'" v-text="link.icon"></v-icon>
                                <v-img v-else contain max-height="20" :src="link.image" content-class="w-100"/>
                            </v-list-item-icon>

                            <v-list-item-content>
                                <v-list-item-title class="text-uppercase" v-text="link.title"></v-list-item-title>
                            </v-list-item-content>
                        </div>
                    </template>

                </v-list-item>

                <v-list-group
                    v-else
                    :key="link.title"
                    :prepend-icon="link.icon"
                    color="#FFF"
                >

                    <template v-slot:activator>
                        <v-list-item-content>
                            <v-list-item-title class="text-uppercase" v-text="link.title"></v-list-item-title>
                        </v-list-item-content>
                    </template>

                    <v-list-item
                        v-for="sublink in link.subLinks"
                        :to="{name: sublink.to}"
                        :key="sublink.title"
                    >
                        <template v-slot:default="{active,toggle}">
                            <div v-if="active" :class="active ? 'active-tab' : ''">
                                <v-list-item-icon>
                                    <v-icon v-if="sublink.activeIcon !== 'false'" v-text="sublink.activeIcon"></v-icon>
                                    <v-img v-else contain max-height="20" :src="sublink.activeImage"
                                           content-class="w-100"/>
                                </v-list-item-icon>

                                <v-list-item-content>
                                    <v-list-item-title class="text-uppercase" v-text="sublink.title"></v-list-item-title>
                                </v-list-item-content>
                            </div>

                            <div v-else :class="active ? 'active-tab' : 'disabled-tab'">
                                <v-list-item-icon>
                                    <v-icon v-if="sublink.icon !== 'false'" v-text="sublink.icon"></v-icon>
                                    <v-img v-else contain max-height="20" :src="sublink.image" content-class="w-100"/>
                                </v-list-item-icon>

                                <v-list-item-content>
                                    <v-list-item-title class="text-uppercase" v-text="sublink.title"></v-list-item-title>
                                </v-list-item-content>
                            </div>
                        </template>
                    </v-list-item>

                </v-list-group>
            </div>

        </v-list>
    </v-navigation-drawer>
</template>

<script>
export default {
    name: "Sidebar",
    mounted() {
        var css = `
    .v-list__group__header {
      background-color: red;
    }
    .v-list__group__header:hover {
      background-color: blue !important;
    }
    `;
        var style = document.createElement("style");
        if (style.styleSheet) {
            style.styleSheet.cssText = css;
        } else {
            style.appendChild(document.createTextNode(css));
        }
        document.getElementsByTagName("body")[0].appendChild(style);
    },

    data() {
        return {
            active: null,
            links: [
                {
                    to: 'dashboard',
                    icon: '$vuetify.icons.dashboardIcon',
                    activeIcon: '$vuetify.icons.dashboardActiveIcon',
                    image: '',
                    activeImage: '',
                    title: 'Dashboard',
                },
                {
                    to: 'users',
                    icon: 'false',
                    activeIcon: 'false',
                    image: '/assets/icon/ic_user.svg',
                    activeImage: '/assets/icon/ic_user_color.svg',
                    title: 'Usuarios',
                },
                {
                    icon: '$vuetify.icons.customersIcon',
                    title: 'Clientes',
                    subLinks: [
                        {
                            to: 'customers',
                            icon: '$vuetify.icons.customersIcon',
                            activeIcon: '$vuetify.icons.customersActiveIcon',
                            title: 'Clientes',
                        },
                        {
                            to: 'institutions',
                            icon: 'false',
                            activeIcon: 'false',
                            image: '/assets/icon/ic_institution.svg',
                            activeImage: '/assets/icon/ic_institution_color.svg',
                            title: 'Instituciones',
                        }
                    ]
                },
                {
                    to: 'categories',
                    icon: 'false',
                    activeIcon: 'false',
                    image: '/assets/icon/ic_white_headphones.png',
                    activeImage: '/assets/icon/ic_headphones.svg',
                    title: 'Categorías',
                },
                {
                    to: 'programs',
                    icon: '$vuetify.icons.programsIcon',
                    activeIcon: '$vuetify.icons.programsActiveIcon',
                    image: '',
                    activeImage: '',
                    title: 'Programas',
                },
                {
                    to: 'income',
                    icon: 'false',
                    activeIcon: 'false',
                    image: '/assets/icon/ic_income.svg',
                    activeImage: '/assets/icon/ic_income_color.svg',
                    title: 'Accesos y pagos',
                },
                {
                    to: 'reports',
                    icon: 'false',
                    activeIcon: 'false',
                    image: '/assets/icon/ic_reports.svg',
                    activeImage: '/assets/icon/ic_reports_color.svg',
                    title: 'Reportes',
                },
            ],
        }
    },
}
</script>

<style scoped>
.active-tab {
    display: flex;
    align-items: center;
    background-color: #FFFFFF;
    border-radius: 60px 0 0 60px;
    color: #A3326D;
    justify-content: space-evenly;
    right: 0;
    padding-left: 30px;
    position: absolute;
    width: 100%;

}

.disabled-tab {
    display: flex;
    align-items: center;
    color: #FFFFFF;
    justify-content: space-evenly;
    position: initial;
    width: 100%;
}

.active-tab::before {
    z-index: -24;
    content: "";
    position: absolute;
    top: -40px;
    right: 0;
    height: 40px;
    width: 40px;
    border-bottom-right-radius: 50%;
    background: transparent;
    box-shadow: 0 20px 0 0 #ffffff;
}

.active-tab::after {
    z-index: -24;
    content: "";
    position: absolute;
    top: 52px;
    right: 0;
    height: 40px;
    width: 40px;
    border-top-right-radius: 50%;
    background: transparent;
    box-shadow: 0 -20px 0 0 #ffffff;
}

.active-tab + div:first-child {
    margin-left: 40px;
}


.v-list-item[aria-expanded="true"] {
    opacity: 0.5;
}

.top__list > div:first-child {
    background: black;
}

.top__list.v-list-group--active {
    border-radius: 0 40px 40px 0;
    color: #A3326D;
    justify-content: space-evenly;
    left: 0;
    width: 100%;
}

.v-list-item {
    position: initial;
}

::v-deep ::-webkit-scrollbar {
    width: 0;
    background: transparent;
}

</style>
