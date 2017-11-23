<template>
    <div class='container'>
        <h1>Home</h1>
        <!-- <div v-for="product in products" v-bind:key='product.id'>
            <h2>{{product.name}}</h2>
        </div> -->
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'HomePage',
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
