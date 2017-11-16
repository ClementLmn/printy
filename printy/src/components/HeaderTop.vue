<template>
    <header class='header'>
        <div class="container inner-header">
            <router-link to='/'>
                <div class='logo-wrapper'>
                    <Logo></Logo>
                </div>
            </router-link>
            <ul class="nav">
                <li>
                    <router-link class="nav-link" to='/products'>
                        <svg class='icon icon-grid'><use xlink:href='#icon-grid'></use></svg>
                    </router-link>
                </li>
                <li>
                    <router-link class="nav-link" to='/cart'>
                        <svg class='icon icon-cart'><use xlink:href='#icon-cart'></use></svg>
                    </router-link>
                </li>
                <li>
                    <router-link class="nav-link" to='/account'>
                        <svg class='icon icon-user'><use xlink:href='#icon-user'></use></svg>
                    </router-link>
                </li>
            </ul>

        </div>
        
        
    </header>
</template>

<script>
import Logo from '@/components/Logo';
export default {
    name: 'HeaderTop',
    components: {
        Logo
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
