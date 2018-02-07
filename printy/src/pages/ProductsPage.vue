
<template>
    <div class='container products-page'>
        <h1>All our products</h1>
        <div class='product-list-wrapper' v-if="category.products.length > 0" v-for="(category, index) in categories" v-bind:key='category.id'>
            <span v-show='actual[index] !== 0' v-on:click='toLeft(index)' class='to-left'></span>
            <div class='product-list'>
                <div class='list-intro product-slide'>
                    <h2>{{category.name}}</h2>
                    <p>{{category.description}}</p>
                    <router-link class='arrow-link' :to="{ name: 'SingleCategory', params: { catId: category.id }}" >See all <span class='arr'>⟶</span></router-link>
                </div>
                
                <div class='product-slide product-item' v-for="product in category.products" v-bind:key='product.id'>
                    <router-link :to="{ name: 'SingleProduct', params: { productId: product.id }}">
                        <div class='wrp-prd-img'>
                            <div class='product-image' :style="{backgroundImage: 'url(' + product.image_path +')'}"></div>
                        </div>
                        <span class='prd-arr'>⟶</span>
                        <h3>{{product.name}}</h3>
                    </router-link>
                </div>
            </div>
            <span v-show='actual[index] != limits[index]' v-on:click='toRight(index)' class='to-right'></span>
        </div>
        
       
    </div>
</template>

<script>
import axios from 'axios'
import TweenMax from 'gsap'

export default {
    name: 'ProductsPage',
    data () {
        return {
            url: '/api/category/read.php',
            categories: [],
            limits: [],
            actual: []
        }
    },
    methods: {
        initData(response){
            this.categories = response.data;
            this.categories.forEach((element, index) => {
                if(element.products.length){

                    this.actual.splice(index, 1, 0);
                    this.limits.splice(index, 1, Math.floor((element.products.length+1)/3));
                }
            });
            
        },
        toLeft(i){
            console.log(this.actual[i]);

            this.actual.splice(i, 1, this.actual[i]-1);
            const prdSld = this.$el.querySelectorAll('.product-list-wrapper')[i].querySelectorAll('.product-slide');
            if(window.innerWidth > 1100){
                TweenMax.staggerTo(prdSld, 0.8, {x: "+=960px"}, -0.05);
            }else{
                TweenMax.staggerTo(prdSld, 0.8, {x: "+=580px"}, -0.05);
            }
        },
        toRight(i){
            console.log(this.actual[i]);
            
            this.actual.splice(i, 1, this.actual[i]+1);
            
            
            const prdSld = this.$el.querySelectorAll('.product-list-wrapper')[i].querySelectorAll('.product-slide');
            if(window.innerWidth > 1100){
                TweenMax.staggerTo(prdSld, 0.8, {x: "-=960px"}, 0.05);
            }else{
                TweenMax.staggerTo(prdSld, 0.8, {x: "-=580px"}, 0.05);
            }
        }    
    },
    created() {
        axios.get(this.url)
        .then(response => this.initData(response));
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
