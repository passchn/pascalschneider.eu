// This is the main.js file. Import global CSS and scripts here.
// The Client API can be used here. Learn more: gridsome.org/docs/client-api

// Layouts 
import DefaultLayout from '~/layouts/Default.vue'
import Article from '~/layouts/Article.vue'
import Full from '~/layouts/Full.vue'

// Bootstrap
import BootstrapVue from 'bootstrap-vue'
//import 'bootstrap/dist/css/bootstrap.css'
//import 'bootstrap-vue/dist/bootstrap-vue.css'
import '~/assets/styles.scss'

// Font Awesome
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome'
import { config, library } from '@fortawesome/fontawesome-svg-core'
import { faGithub, faTwitter } from '@fortawesome/free-brands-svg-icons'
import { faUserGraduate, faTools, faPhotoVideo, faCode, faMapMarkerAlt } from '@fortawesome/free-solid-svg-icons'
import '@fortawesome/fontawesome-svg-core/styles.css'
config.autoAddCss = false;
library.add(faUserGraduate, faTools, faPhotoVideo, faCode, faTwitter, faGithub, faMapMarkerAlt)

export default function (Vue, { router, head, isClient }) {
  // Set default layout as a global component
  Vue.component('Layout', DefaultLayout)
  Vue.component('Article', Article)
  Vue.component('Full', Full)
  Vue.use(BootstrapVue)
  Vue.component('fa', FontAwesomeIcon)
}

/* if (null === localStorage.getItem('lang')) {
  let de = navigator.languages.filter(l => {
    return l.indexOf('de') >= 0
  }).length
  if (de > 0) {
    localStorage.setItem('lang', 'DE')
  } else {
    localStorage.setItem('lang', 'EN')
  }
} */