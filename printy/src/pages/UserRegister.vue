
<template>
    <div class='container'>
        <h1>Créer un compte</h1>
        <form v-on:submit.prevent="onSubmit">
            <fieldset>
                <input name="fname" type="text" v-validate="'required|alpha'" placeholder="fname" v-model="fname">
                <span v-if="errors.has('fname')">
                    {{ errors.first('fname') }}
                </span>
            </fieldset>

            <fieldset>
                <input name="lname" type="text" v-validate="'required|alpha'" placeholder="lname" v-model="lname">
                <span v-if="errors.has('lname')">
                    {{ errors.first('lname') }}
                </span>
            </fieldset>

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
            {{errorsPhp.message}}
        </div>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    name: 'UserRegister',
    data () {
        return {
            url: '/api/user/create.php',
            errorsPhp: [],
            fname: '',
            lname: '',
            mail: '',
            pwd: '',
        }
    },
    methods: {
        onSubmit: function(){
            console.log('click')
            console.log(this.pwd, this.fname, this.lname, this.mail)
             axios.post(this.url, {
                pwd: this.pwd,
                fname: this.fname,
                lname: this.lname,
                mail: this.mail
            })
            .then(response => {this.errorsPhp.push(response.data)})
            .catch(e => {
                this.errorsPhp.push(e);
            })
        }
    },
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
</style>
