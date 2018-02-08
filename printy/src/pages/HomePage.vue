<template>
    <div>
        <HeaderTop></HeaderTop>
        <div class='home'>
            <div class='home-top'>
                <div class='txt-top container'>
                    <h1>Quality prints for your design.</h1>
                    <p class='baseline'>Ask for our testing box and receive paper samples for a better comparaison of our products. Search for the reference number in each sample. If you order some prints you'll get a discount of the price of the testing box !</p>
                    <router-link class='arrow-link white' to='/products'>See our products<span class='arr'>⟶</span></router-link>
                </div>
                <div class='video-container'>
                    <video autoplay loop id="video-background" muted plays-inline>
                        <source src="/static/printy.mp4" type="video/mp4">
                    </video>
                </div>
            </div>
        </div>
    </div>
    
</template>

<script>
import axios from 'axios'
import HeaderTop from '@/components/HeaderTop'

export default {
    name: 'HomePage',
    components: {
		HeaderTop
	},
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
