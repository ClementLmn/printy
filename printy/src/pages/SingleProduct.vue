
<template>
    <div class='single-product'>
        <div class="image-pane">
            <img src="/static/1.jpeg" alt="">
            <img src="/static/2.jpeg" alt="">
            <img src="/static/3.jpeg" alt="">
            <img src="/static/4.jpeg" alt="">
        </div>
        <div class="product-pane">
            <div class='single-container'>
                <router-link class="back" to='/products'><span class='arr'>←</span>Back</router-link>
                <h1>{{product.name}}</h1>
                <div class="product-info">
                    <a href="#">Best sellers</a>,
                    <a href="#">Goodies</a>,
                    <a href="#">New product</a>
                </div>
                <div class="descr">
                    <p>
                        {{product.description}}
                    </p>
                </div>
                <div class="paper">
                    <h2>Paper</h2>
                    <PaperType @update='updateType' v-if="product.id" :productId='product.id'></PaperType>
                    <PaperThickness @update='updateThick'></PaperThickness>
                    <PaperSizing @update='updateSizing' v-if="product.id" :productId='product.id'></PaperSizing>
                </div>
                <DesignZone @update='updateRecto' @updateV='updateVerso' v-if="product.id" :productId='product.id'></DesignZone>

                <button @click='addToCart()' class="order">Add to cart</button>
            </div>
        </div>
        
    </div>
</template>

<script>
import TweenMax from 'gsap'
import axios from 'axios'

import PaperType from '@/components/PaperType'
import DesignZone from '@/components/DesignZone'
import PaperThickness from '@/components/PaperThickness'
import PaperSizing from '@/components/PaperSizing'

export default {
    name: 'SingleProduct',
    components: {
        PaperThickness,
        DesignZone,
        PaperType,
        PaperSizing,
    },
    data () {
        return {
            productId: this.$route.params.productId,
            url: '/api/product/read_one.php?id=',
            product: {},
            currentImg: 0,
            nextImg : null,
            img: null,
            paperType: null,
            paperSize: null,
            paperWeight: null,
            recto: null,
            verso: null
        }
    },
    methods: {
        addToCart(){
            const order = {
                id: this.product.id,
                name: this.product.name,
                type: this.paperType,
                weight: this.paperWeight,
                size: this.paperSize,
                recto: this.recto,
                verso: this.verso
            };
            this.$global._data.cart.push(order);
            console.log(this.$global._data.cart);
            
        },
        updateSizing(size){
            this.paperSize = size;
        },
        updateType(size){
            this.paperType = size;
        },
        updateThick(size){
            this.paperWeight = size;
        },
        updateRecto(img){
            this.recto = img;
        },
        updateVerso(img){
            this.verso = img;
        },
        imgSlide(i){
            const nb = i >= this.img.length ? 0 : i;
            this.nextImg = nb >= this.img.length - 1 ? this.img[0] : this.img[nb+1];
            TweenMax.to(this.nextImg, 1.2, {opacity: 1});
            TweenMax.to(this.img[nb], 1.2, {opacity: 0});
            TweenMax.delayedCall(6, this.imgSlide, [nb+1]);
        }
    },
    mounted(){
        this.img = this.$el.querySelectorAll('.image-pane img');
        this.imgSlide(this.currentImg);
        
    },
    created() {
        axios.get(this.url+this.productId)
        .then(response => this.product = response.data);
        
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
