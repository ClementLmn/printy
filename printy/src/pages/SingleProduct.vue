
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
                <h1>{{product.name}}</h1>
                <div class="product-info">
                    <a href="#">Best sellers</a>,
                    <a href="#">Goodies</a>,
                    <a href="#">New product</a>
                </div>
                <div class="descr">
                    <h2>Description</h2>
                    <p>
                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Atque rem, nobis quas vel ratione rerum accusantium, voluptatum iusto sint, error ipsum nihil excepturi nam voluptate quisquam pariatur nisi eum sit. Lorem, ipsum dolor sit amet consectetur adipisicing elit. Cum odit dolor facilis ipsa quaerat reprehenderit quisquam nam deleniti, nisi, repellendus voluptatibus porro doloribus dolores hic nostrum illo, tempore dicta? Aperiam?
                    </p>
                </div>
                <div class="paper">
                    <h2>Paper</h2>
                    <PaperType :productId='product.id'></PaperType>
                    <PaperThickness></PaperThickness>
                    <PaperSizing :productId='product.id'></PaperSizing>
                </div>
                <div class="your-design">
                    <h2>Your design</h2>
                    <div class="uploads">
                        <div class="rect"></div>
                        <div class="vers"></div>
                    </div>
                </div>
                <button class="order">order</button>
            </div>
        </div>
        
    </div>
</template>

<script>
import TweenMax from 'gsap'
import axios from 'axios'

import PaperType from '@/components/PaperType'
import PaperThickness from '@/components/PaperThickness'
import PaperSizing from '@/components/PaperSizing'

export default {
    name: 'SingleProduct',
    components: {
        PaperThickness,
        PaperType,
        PaperSizing  
    },
    data () {
        return {
            productId: this.$route.params.productId,
            url: '/api/product/read_one.php?id=',
            product: {},
            currentImg: 0,
            nextImg : null,
            img: null
        }
    },
    methods: {
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
