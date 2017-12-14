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
                        <span>Catalog</span>
                    </router-link>
                </li>
                <li>
                    <router-link class="nav-link" to='/cart'>
                        <span>Cart</span>
                    </router-link>
                </li>
                <li>
                    <router-link class="nav-link" to='/account'>
                        <span>Account</span>
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
