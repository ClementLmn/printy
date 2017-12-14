<template>
    <div class='home'>
        <div class='home-top'>
            <div class='txt-top container'>
                <h1>Quality prints for your design.</h1>
                <router-link class='link-arrow white' to='/products'>See our products<span></span></router-link>
            </div>
            <div class='video-container'>
                <video autoplay loop id="video-background" muted plays-inline>
                    <source src="/static/printy.mp4" type="video/mp4">
                </video>
            </div>
        </div>
        <h2>Home</h2>
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
