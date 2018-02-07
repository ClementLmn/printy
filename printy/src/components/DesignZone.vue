<template>
    <div class="your-design">
        <h2>Your design</h2>
        <div class="uploads">
            <div class="zone rect">Recto</div>
            <div v-if='verso' class="zone vers">Verso</div>
        </div>
    </div>
</template>

<script>
export default {
    name: 'DesignZone',
    props: ['verso'],
    components: {

    },
    data () {
        return {
        
        }
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
