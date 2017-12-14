
<template>
    <div class='container'>
        <h1>Se connecter</h1>
        <form v-on:submit.prevent="onSubmit">
            <fieldset>
                <input name="mail" type="text" v-validate="'required|email'" placeholder="mail" v-model="mail">
                <span v-if="errors.has('mail')">
                    {{ errors.first('mail') }}
                </span>
            </fieldset>

            <fieldset>
                <input name="pwd" type="password" v-validate="'required'" placeholder="pwd" v-model="pwd">
                <span v-if="errors.has('pwd')">
                    {{ errors.first('pwd') }}
                </span>
            </fieldset>
            <button :disabled="errors.any()" type="submit">GO</button>
        </form>
        <div>
            {{errorsPhp}}
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'Login',
    data () {
        return {
            url: '/api/user/read_one.php?mail=',
            errorsPhp: '',
            mail: '',
            pwd: '',
            user: ''
        }
    },
    methods: {
        onSubmit: function(){
             axios.get(this.url+this.mail)
            .then(response => {
                this.user = response.data
                if (this.user.id && this.user.pwd == this.pwd){
                    this.$session.start()
                    this.$session.set('id', this.user.mail)
                    this.$router.go({
                        path: this.$router.path,
                        query: {
                            t: + new Date()
                        }
                    })
                }else{ 
                    this.errorsPhp = 'Bad mail & password combinaison'
                }
            })
            .catch(e => {
                console.log(e);
            })
        }
    },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
