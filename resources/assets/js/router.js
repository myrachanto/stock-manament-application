import Vue from 'vue'
import VueRouter from 'vue-router'

Vue.use(VueRouter)

const router = new VueRouter({

    routes:[
    {path: '/', component: require('./views/dashboard/index.vue')},
    {path: '/customer', component: require('./views/customer/index.vue')},
    {path: '/supplier', component: require('./views/supplier/index.vue')},
    {path: '/employee', component: require('./views/employee/index.vue')},
    {path: '/product', component: require('./views/product/index.vue')},

    
    {path: '/customer/invoice/create', component: require('./views/customer/form.vue')},
    {path: '/customer/invoice/:id', component: require('./views/customer/show.vue')},
    {path: '/customer/invoice', component: require('./views/customer/invoice.vue')},

    
    {path: '/supplier/invoice/create', component: require('./views/supplier/form.vue')},
    {path: '/supplier/invoice/:id', component: require('./views/supplier/show.vue')},
    {path: '/supplier/invoice', component: require('./views/supplier/invoice.vue')}

    ]
})

export default router