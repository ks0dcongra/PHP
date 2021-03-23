import Vue from 'vue'
import Router from 'vue-router'
import Map from './components/Map.vue'
import Favorites from './components/Favorites.vue'
import Popular from './components/Popular.vue'
import Member from './components/Member.vue'
import Spotpage from './components/Spotpage.vue'
import Login from './components/Login.vue'


Vue.use(Router)

function getAbsolutePath () {
  let path = location.pathname
  return path.substring(0, path.lastIndexOf('/') + 1)
 }

const router = new Router({
  mode: 'history',
  base: getAbsolutePath(),
  routes: [
    {
      path: '/',
      name: 'map',
      component: Map
    },
    {
      path: '/favorites',
      name: 'favorites',
      component: Favorites
    },
    {
      path: '/popular',
      name: 'popular',
      component: Popular
    },
    {
      path: '/member',
      name: 'member',
      component: Member
    },
    {
      path: '/spot',
      name: 'spot',
      component: Spotpage
    },
    {
      path: '/login',
      name: 'login',
      component: Login
    },
    {
      path: '*',
      redirect: '/',
    }
  ],
})

router.beforeEach((to, from, next) => {
  // react to route changes...
  // don't forget to call next()
  //console.log(to, from)
  
  next()
})

export default router
