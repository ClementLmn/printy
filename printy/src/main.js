// The Vue build version to load with the `import` command
// (runtime-only or standalone) has been set in webpack.base.conf with an alias.
import Vue from 'vue'
import App from './App'
import router from './router'
import VeeValidate from 'vee-validate'
import VueSession from 'vue-session'

Vue.use(VueSession)
Vue.use(VeeValidate)
Vue.config.productionTip = false

const shared = new Vue({data:{ cart: [] }})

shared.install = function(){
    Object.defineProperty(Vue.prototype, '$global', {
      get () { return shared }
    })
}
Vue.use(shared);


/* eslint-disable no-new */
new Vue({
  el: '#app',
  router,
  template: '<App/>',
  components: { App }
})