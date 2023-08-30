import { createRouter, createWebHistory } from "vue-router";
import Invoice from "../components/invoices/Index.vue";
import CreateInvoice from "../components/invoices/Create.vue";
import NotFound from "../components/NotFound.vue";

const routes = [
    {
        path: "/",
        component: Invoice,
    },
    {
        path: "/invoice/new",
        component: CreateInvoice,
    },
    {
        path: "/:pathMatch(.*)*",
        component: NotFound,
    },
];

const router = createRouter({
    history: createWebHistory(),
    routes,
});

export default router;
