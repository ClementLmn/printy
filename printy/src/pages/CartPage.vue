
<template>
    <div>
        <div v-if='this.$session.exists()' class='container'>
            <h1>Cart</h1>
            <div v-for="product in products" v-bind:key='product.id'>
                <h2>{{product.name}}</h2>
            </div>
        </div>
        <Login v-else />
    </div>
</template>

<script>
import axios from 'axios'
import Login from '@/components/Login'
export default {
    name: 'CartPage',
    data () {
        return {
            url: '/api/product/read.php',
            products: []
        }
    },
    components: {
		Login
	},
    created() {
        axios.get(this.url)
        .then(response => this.products = response.data)
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
