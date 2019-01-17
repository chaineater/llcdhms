import Vue from 'vue'
import { library } from '@fortawesome/fontawesome-svg-core'
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'

// import { } from '@fortawesome/free-regular-svg-icons'

import {
  faUser, faLock, faSignOutAlt, faCog, faStethoscope,
  faTh, faWheelchair, faFlask, faHistory, faMedkit, faHome,
  faSearch, faCircle, faBell, faBars, faUsers, faExclamationTriangle,
  faShoppingCart, faSkullCrossbones, faPlus
} from '@fortawesome/free-solid-svg-icons'

import {
  faGithub
} from '@fortawesome/free-brands-svg-icons'

library.add(
  faUser, faLock, faSignOutAlt, faCog, faGithub, faStethoscope,
  faTh, faWheelchair, faFlask, faHistory, faMedkit, faHome,
  faSearch, faCircle, faBell, faBars, faUsers, faExclamationTriangle,
  faShoppingCart, faSkullCrossbones, faPlus
)

Vue.component('fa', FontAwesomeIcon)
