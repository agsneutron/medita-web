import Vue from 'vue';
import VueRouter from 'vue-router';
import DashboardIndex from "../pages/Dashboard/DashboardIndex";
import UsersIndex from "../pages/Users/UsersIndex";
import CustomersIndex from "../pages/Customers/CustomersIndex";
import InstitutionsIndex from "../pages/Institutions/InstitutionsIndex";
import CategoriesIndex from "../pages/Audio/CategoriesIndex";
import InstructiveIndex from "../pages/Audio/InstructiveIndex";
import ManualIndex from "../pages/Audio/ManualIndex";
import PhasesIndex from "../pages/Audio/PhasesIndex";
import QuestionnaireIndex from "../pages/Audio/QuestionnaireIndex";
import AudiosIndex from "../pages/Audio/AudiosIndex";
import ProgramsIndex from "../pages/Programs/ProgramsIndex";
import IncomeIndex from "../pages/Income/IncomeIndex";
import ReportsIndex from "../pages/Reports/ReportsIndex";
import SettingsIndex from "../pages/Settings/SettingsIndex";
import InstitutionsClientsIndex from "../pages/Institutions/InstitutionsClientsIndex";
import IncomeInstitutionsIndex from "../pages/Income/IncomeInstitutionsIndex";
import IncomePaymentsInstitutionsIndex from "../pages/Income/IncomePaymentsInstitutionsIndex";
import IncomePaymentsClientsIndex from "../pages/Income/IncomePaymentsClientsIndex";
import ActiveClientsIndex from "../pages/Reports/ActiveClientsIndex";
import LFUEducationFirstQuestionnaireIndex from "../pages/Reports/LFUEducationFirstQuestionnaireIndex";
import LFUEducationSecondQuestionnaireIndex from "../pages/Reports/LFUEducationSecondQuestionnaireIndex";
import LFUEducationIndex from "../pages/Reports/LFUEducationIndex";
import GeneralUsersIndex from "../pages/Reports/GeneralUsersIndex";
import IncomeStatisticsMain from "../components/Reports/IncomeStatisticsMain";
import NewsIndex from "../pages/Settings/NewsIndex";
import EducationalLevelsIndex from "../pages/Settings/EducationalLevelsIndex";
import TermsIndex from "../pages/Settings/TermsIndex";
import PrivacyIndex from "../pages/Settings/PrivacyIndex";
import PhaseManualIndex from "../pages/Audio/PhaseManualIndex";
import PhaseInstructiveIndex from "../pages/Audio/PhaseInstructiveIndex";

Vue.use(VueRouter);

const prefix = '/admin';

let routes = [
    {
        path: prefix + '/dashboard',
        component: DashboardIndex,
        name: 'dashboard',
        meta: {
            subpage: '#',
            title: 'DASHBOARD',
            parent: '#'
        },
    },
    {
        path: prefix + '/users',
        component: UsersIndex,
        name: 'users',
        meta: {
            subpage: '#',
            title: 'USUARIOS',
            parent: '#'
        },
    },
    {
        path: prefix + '/customers',
        component: CustomersIndex,
        name: 'customers',
        meta: {
            subpage: '#',
            title: 'CLIENTES',
            parent: '#'
        },
    },
    {
        path: prefix + '/institutions',
        component: InstitutionsIndex,
        name: 'institutions',
        meta: {
            subpage: '#',
            title: 'INSTITUCIONES',
            parent: '#'
        },
    },
    {
        path: prefix + '/clients-institutions/:id',
        component: InstitutionsClientsIndex,
        name: 'institutions_clients',
        meta: {
            subpage: '#',
            title: 'CLIENTES - ',
            parent: 'institutions'
        },
    },
    {
        path: prefix + '/categories',
        component: CategoriesIndex,
        name: 'categories',
        meta: {
            subpage: '#',
            title: 'CATEGORÍAS',
            parent: '#'
        },
    },
    {
        path: prefix + '/category/:id/instructive',
        component: InstructiveIndex,
        name: 'instructive',
        meta: {
            subpage: '#',
            title: ' - INSTRUCTIVO',
            parent: 'categories'
        },
    },
    {
        path: prefix + '/category/:id/manual',
        component: ManualIndex,
        name: 'manual',
        meta: {
            subpage: '#',
            title: ' - MANUAL',
            parent: 'categories'
        },
    },
    {
        path: prefix + '/category/:id/phases',
        component: PhasesIndex,
        name: 'phases',
        meta: {
            subpage: '#',
            title: '',
            parent: 'categories'
        },
    },
    {
        path: prefix + '/category/:id/questionnaire',
        component: QuestionnaireIndex,
        name: 'questionnaire',
        meta: {
            subpage: '#',
            title: ' - CUESTIONARIO',
            parent: 'phases'
        },
    },
    {
        path: prefix + '/category/:id/phase/:id_phase/manual',
        component: PhaseManualIndex,
        name: 'phase_manual',
        meta: {
            subpage: '#',
            title: ' - MANUAL',
            parent: 'phases'
        },
    },
    {
        path: prefix + '/category/:id/phase/:id_phase/instructive',
        component: PhaseInstructiveIndex,
        name: 'phase_instructive',
        meta: {
            subpage: '#',
            title: ' - AFIRMACIONES',
            parent: 'phases'
        },
    },
    {
        path: prefix + '/category/:id/phase/:id_phase/audios',
        component: AudiosIndex,
        name: 'audios',
        meta: {
            subpage: '#',
            title: '',
            parent: 'phases'
        },
    },
    {
        path: prefix + '/programs',
        component: ProgramsIndex,
        name: 'programs',
        meta: {
            subpage: '#',
            title: 'PROGRAMAS',
            parent: '#'
        },
    },
    {
        path: prefix + '/income',
        component: IncomeIndex,
        name: 'income',
        meta: {
            subpage: '#',
            title: 'ACCESOS Y PAGOS',
            parent: '#'
        },
    },
    {
        path: prefix + '/income-institutions/:id',
        component: IncomeInstitutionsIndex,
        name: 'income_institutions',
        meta: {
            subpage: '#',
            title: 'ACCESOS - ',
            parent: 'income'
        },
    },
    {
        path: prefix + '/income-payments-institutions/:id',
        component: IncomePaymentsInstitutionsIndex,
        name: 'income_payments_institutions',
        meta: {
            subpage: 'payments_institutions',
            title: 'PAGOS - ',
            parent: 'income'
        },
    },
    {
        path: prefix + '/income-payments-clients/:id',
        component: IncomePaymentsClientsIndex,
        name: 'income_payments_clients',
        meta: {
            subpage: 'payments_clients',
            title: 'APORTACIONES - ',
            parent: 'income'
        },
    },
    {
        path: prefix + '/reports',
        component: ReportsIndex,
        name: 'reports',
        meta: {
            subpage: '#',
            title: 'REPORTES',
            parent: '#'
        },
    },
    {
        path: prefix + '/reports-active-clients',
        component: ActiveClientsIndex,
        name: 'reports_active_clients',
        meta: {
            subpage: 'reports',
            title: 'CLIENTES ACTIVOS',
            parent: 'reports'
        }
    },
    {
        path: prefix + '/reports-income-statistics',
        component: IncomeStatisticsMain,
        name: 'reports_income_statistics',
        meta: {
            subpage: 'reports',
            title: 'ESTADÍSTICA DE INGRESO',
            parent: 'reports'
        }
    },
    {
        path: prefix + '/reports-lfu-first-questionnaire',
        component: LFUEducationFirstQuestionnaireIndex,
        name: 'reports_lfu_first_questionnaire',
        meta: {
            subpage: 'reports',
            title: 'LFU Education Primer Cuestionario',
            parent: 'reports'
        }
    },
    {
        path: prefix + '/reports-lfu-second-questionnaire',
        component: LFUEducationSecondQuestionnaireIndex,
        name: 'reports_lfu_second_questionnaire',
        meta: {
            subpage: 'reports',
            title: 'LFU Education Segundo Cuestionario',
            parent: 'reports'
        }
    },
    {
        path: prefix + '/reports-lfu-education',
        component: LFUEducationIndex,
        name: 'reports_lfu_education',
        meta: {
            subpage: 'reports',
            title: 'LFU Education',
            parent: 'reports'
        }
    },
    {
        path: prefix + '/reports-general-users',
        component: GeneralUsersIndex,
        name: 'reports_general_users',
        meta: {
            subpage: 'reports',
            title: 'Usuarios en general',
            parent: 'reports'
        }
    },
    {
        path: prefix + '/settings',
        component: SettingsIndex,
        name: 'settings',
        meta: {
            subpage: '#',
            title: 'CONFIGURACIÓN',
            parent: '#'
        },
    },
    {
        path: prefix + '/settings-news',
        component: NewsIndex,
        name: 'news',
        meta: {
            subpage: '#',
            title: 'CONFIGURACIÓN',
            parent: 'settings'
        },
    },
    {
        path: prefix + '/settings-terms',
        component: TermsIndex,
        name: 'terms',
        meta: {
            subpage: '#',
            title: 'TÉRMINOS Y CONDICIONES',
            parent: 'settings'
        },
    },
    {
        path: prefix + '/settings-privacy',
        component: PrivacyIndex,
        name: 'privacy',
        meta: {
            subpage: '#',
            title: 'POLÍTICAS DE PRIVACIDAD',
            parent: 'settings'
        },
    },
    {
        path: prefix + '/settings-educational-levels',
        component: EducationalLevelsIndex,
        name: 'educational_levels',
        meta: {
            subpage: '#',
            title: 'NIVEL Y GRADO DE ESTUDIOS',
            parent: 'settings'
        },
    },
];


export default new VueRouter({
    mode: 'history',
    routes: routes,
});
