
<template>
    <div class='container'>
        <h1>Tout nos produits</h1>
        <div class='product-list-wrapper' v-for="category in categories" v-bind:key='category.id'>
            <div class='product-list'>
                <div class='list-intro'>
                    <h2>{{category.name}}</h2>
                    <router-link to='/'>Voir tout</router-link>
                </div>
                <!-- <div class='product-item' v-if='product.category_id === category.id' v-for="product in products" v-bind:key='product.id'>
                    <div class='product-image' :style="{backgroundImage: 'url(' + product.image_path +')'}"></div>
                    <h3>{{product.name}}</h3>
                    <span>{{product.price}}</span>
                </div> -->
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
            products: [],
            categories: []
        }
    },
    methods: {
        
    },
    created() {
        axios.get('/api/category/read.php')
        .then(response => this.categories = console.log(response.data));
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
