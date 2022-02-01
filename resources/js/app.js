import Vue from 'vue'
import { createInertiaApp, Link } from '@inertiajs/inertia-vue'

Vue.prototype.$route = route;
Vue.component("Link", Link);

createInertiaApp({
  resolve: name => require(`./Pages/${name}`),
  setup({ el, App, props, plugin }) {
    Vue.use(plugin)

    new Vue({
      render: h => h(App, props),
    }).$mount(el)
  },
})