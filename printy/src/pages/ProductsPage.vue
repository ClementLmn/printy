
<template>
    <div class='container'>
        <h1>Tout nos produits</h1>
        <div class='product-list'>
            <div v-for="product in products" v-bind:key='product.id'>
                <h3>{{product.name}}</h3>
                <span>{{product.price}}</span>
            </div>
        </div>
       
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'ProductsPage',
    data () {
        return {
            url: '/api/product/read.php',
            products: []
        }
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
