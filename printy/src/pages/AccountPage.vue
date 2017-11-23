
<template>
    <div class='container'>
        <h1>Account</h1>
        <h2>Hello {{ user.fname +' '+ user.lname}}</h2>
        <div>
            <router-link to="/account/infos">See my informations</router-link>
        </div>
        <div>
            <router-link to="/account/orders">See my orders</router-link>
            
        </div>
        <button v-on:click='logout'>Logout</button>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'AccountPage',
    data () {
        return {
            url: '/api/user/read_one.php?mail=',
            user: ''
        }
    },
    methods: {
        logout: function(){
            this.$session.destroy()
            this.$router.push('/')
        }
    },
    beforeCreate: function () {
        if (!this.$session.exists()) {
            this.$router.push('/login')
        }
    },
    created() {
        if (this.$session.exists()) {
            console.log(this.$session.get('id'));
            axios.get(this.url+this.$session.get('id'))
            .then(response => this.user = response.data)
        }
        
    }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
