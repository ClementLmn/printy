
<template>
    <div class='container'>
        <h1>Tout nos produits</h1>
        <div class='product-list-wrapper' v-if="category.products.length > 0" v-for="category in categories" v-bind:key='category.id'>
            <div class='product-list'>
                <div class='list-intro'>
                    <h2>{{category.name}}</h2>
                    <p>{{category.description}}</p>
                    <router-link :to="{ name: 'SingleCategory', params: { catId: category.id }}" >Voir tout</router-link>
                </div>
                
                <div class='product-item' v-for="product in category.products" v-bind:key='product.id'>
                    <router-link :to="{ name: 'SingleProduct', params: { productId: product.id }}">
                        <div class='product-image' :style="{backgroundImage: 'url(' + product.image_path +')'}"></div>
                        <h3>{{product.name}}</h3>
                        <span>{{product.price}}</span>
                    </router-link>
                </div>
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
            url: '/api/category/read.php',
            categories: []
        }
    },
    methods: {
        
    },
    created() {
        axios.get(this.url)
        .then(response => this.categories = response.data);
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
