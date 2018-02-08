
<template>
    <div>
        <div v-if='this.$session.exists()' class='cart-page'>
            <router-link class="cart-back" to='/products'><span class='arr'>↑</span></router-link>
            <h1 class='align-center'>Cart ({{this.items.length}})</h1>
            <div class="cart-container">
                <div class='cart-item' v-for="(item,index) in items" :class='"wrapper-"+item.size.class'>
                    <div class="item-image">
                        <div class='item-preview recto-preview' :class='item.size.class'>
                            <div class="inner-preview" :style="{backgroundImage: 'url(' + item.recto +')'}"></div>
                        </div>
                        <div v-if='item.verso' class='item-preview verso-preview' :class='item.size.class'>
                            <div class="inner-preview" :style="{backgroundImage: 'url(' + item.verso +')'}"></div>
                        </div>
                    </div>
                    <div class='item-details'>
                        <h2>{{item.name}}</h2>
                        <div class='item-subtitle'>Paper:</div>
                        <div>{{item.size.txt}}</div>
                        <div>{{item.type.txt}}</div>
                        <div>{{item.weight.txt}}</div>
                        <h3 class='price'>{{(Math.floor(Math.random()*(50-5+1)+5)) + 0.99}}</h3>
                        <span class='remove' @click='removeItem(index)'>Remove from cart</span>
                    </div>
                    
                </div>
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
            items: null
        }
    },
    methods: {
        putArticle(){
            return this.$global._data.cart;
        },
        removeItem(i){
            console.log('click');
            
            this.items.splice(i, 1);
            this.$global._data.cart.splice(i, 1);
        }
    },
    components: {
		Login
	},
    created() {
        console.log(this.$global);
        this.items = this.$global._data.cart;
    },
    mounted(){
        
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
