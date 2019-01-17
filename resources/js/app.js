import Vue from 'vue'
import store from '~/store'
import router from '~/router'
import i18n from '~/plugins/i18n'
import App from '~/components/App'

import '~/plugins'
import '~/components'
import _ from 'lodash'
import Vuetable from 'vuetable-2'


Vue.component('vuetable', Vuetable)

Vue.prototype._ = _

Vue.config.productionTip = false

/* eslint-disable no-new */
new Vue({
  i18n,
  store,
  router,
  ...App
})
