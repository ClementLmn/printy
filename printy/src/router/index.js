import Vue from 'vue'
import Router from 'vue-router'
import HomePage from '@/pages/HomePage'
import ProductsPage from '@/pages/ProductsPage'
import CartPage from '@/pages/CartPage'
import AccountPage from '@/pages/AccountPage'
import SingleProduct from '@/pages/SingleProduct'
import SingleCategory from '@/pages/SingleCategory'

Vue.use(Router)

export default new Router({
    mode: 'history',
    routes: [
        {
            path: '/',
            name: 'HomePage',
            component: HomePage
        },
        {
            path: '/products',
            name: 'ProductsPage',
            component: ProductsPage
        },
        {
            path: '/account',
            name: 'AccountPage',
            component: AccountPage
        },
        {
            path: '/cart',
            name: 'CartPage',
            component: CartPage
        },
        {
            path: '/product/:productId',
            name: 'SingleProduct',
            component: SingleProduct
        },
        {
            path: '/category/:catId',
            name: 'SingleCategory',
            component: SingleCategory
        }
    ]
})
