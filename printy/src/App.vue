<template>
    <div id="app">
        <img src="./assets/logo.png">
        <h1>test</h1>
        <div v-for="product in products" v-bind:key='product.id'>
            <h2>{{product.name}}</h2>
        </div>
        <router-view/>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'app',
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

<style>
@import './styles/main.scss';
#app {
    font-family: 'Avenir', Helvetica, Arial, sans-serif;
    -webkit-font-smoothing: antialiased;
    -moz-osx-font-smoothing: grayscale;
    text-align: center;
    color: #2c3e50;
    margin-top: 60px;
}
</style>
