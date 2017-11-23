
<template>
    <div class='container'>
        <h1>{{category.name}}</h1>
        <div v-for='product in category.products' v-bind:key='product.id'>
            <span>{{product.name}}</span>
            <span>{{product.price}}</span>
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'SingleCategory',
    data () {
        return {
            catId: this.$route.params.catId,
            url: '/api/category/read_one.php?id=',
            category: {}
        }
    },
    methods: {
        
    },
    created() {
        axios.get(this.url+this.catId)
            .then(response => this.category = response.data);
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
