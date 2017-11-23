
<template>
    <div class='container'>
        <h1>{{product.name}}</h1>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'SingleProduct',
    data () {
        return {
            productId: this.$route.params.productId,
            url: '/api/product/read_one.php?id=',
            product: {}
        }
    },
    methods: {
        
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
