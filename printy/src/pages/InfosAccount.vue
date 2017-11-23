
<template>
    <div class='container'>
        <h1>Your informationx</h1>
        <h2>Hello {{ user.fname +' '+ user.lname}}</h2>
        <span v-on:click='logout'>Logout</span>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'InfosAccount',
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
