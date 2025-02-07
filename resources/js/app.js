import Vue from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue'
import { BootstrapVue, IconsPlugin } from 'bootstrap-vue'

// Import Bootstrap an BootstrapVue CSS files (order is important)
import 'bootstrap/dist/css/bootstrap.css'
import 'bootstrap-vue/dist/bootstrap-vue.css'

// Make BootstrapVue available throughout your project
Vue.use(BootstrapVue)
// Optionally install the BootstrapVue icon components plugin
Vue.use(IconsPlugin)

Vue.prototype.$route = route;
Vue.component("Link", Link);

import Layout from './Layout/header'

createInertiaApp({
  resolve: name => {
    const page = require(`./Pages/${name}`).default
    if(name != "login"){
      page.layout = page.layout || Layout
    }
    return page
  },
  setup({ el, App, props, plugin }) {
    Vue.use(plugin)

    new Vue({
      render: h => h(App, props),
    }).$mount(el)
  },
})