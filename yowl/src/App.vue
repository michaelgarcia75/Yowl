<template>
  <nav class="NavBar">
    <router-link to="/">
      <img alt="Vue logo" src="./assets/logo.png">
    </router-link>
    <SearchBar @getPostBySearch="getPostBySearch"/>
    <CategoriesFilter :filterAll="filterAll" :categories="categories" @getPostByCategoryFilter="getPostByCategoryFilter"/>
    <router-link  to="/admin">Admin</router-link>
    <router-link v-if="!isLoggedIn" to="/login">Login</router-link>
    <router-link v-if="!isLoggedIn" to="/register">Register</router-link>
    <DropDownMenu menu-title="Menu">
      <section class="option">
        <span v-if="isLoggedIn" class="desc">Logged as {{user.pseudo}} </span>
      </section>
      <section v-if="isLoggedIn" class="option">
        <router-link to="/dashboard">Profil</router-link>
      </section>
      <section v-if="isLoggedIn" class="option">
      </section>
      <section v-if="isLoggedIn" class="option">
        <a @click="logout(), user={}" >Log Out</a>
      </section>
      <section class="option">
        <span class="desc">Dark mode // OPTION</span>
      </section>
    </DropDownMenu>

  </nav>
  <router-view :postsFiltered="postsFiltered" :searchContent="searchContent"/>
</template>

<script>
import axios from 'axios'
import SearchBar from '@/components/SharedComponents/SearchBar.vue'
import CategoriesFilter from '@/components/SharedComponents/CategoriesFilter.vue'
import DropDownMenu from '@/components/SharedComponents/DropDownMenu.vue'
import { mapGetters, mapMutations } from 'vuex'

export default {
  data () {
    return {
      searchResult: [],
      filterResult: [],
      searchAndFilterResult: [],
      posts: [],
      categories: [],
      communities: [],
      postsFiltered: this.posts,
      categoryId: 0,
      searchContent: '',
      filterAll: true,
      user: {}
    }
  },
  components: {
    SearchBar,
    CategoriesFilter,
    DropDownMenu
  },
  computed: {
    ...mapGetters(['isLoggedIn', 'getToken', 'getUser'])
  },
  methods: {
    ...mapMutations(['setUser', 'setToken']),
    getPostBySearch (searchContent) {
      this.searchContent = searchContent
      if (this.categoryId === 0) {
        axios.get('https://yowlteam.herokuapp.com/api/posts/filter?text=' + searchContent)
          .then((response) => {
            this.searchResult = [...response.data]
            this.postsFiltered = [...response.data]
          })
      } else {
        axios.get('https://yowlteam.herokuapp.com/api/posts/filter?text=' + searchContent + '&category=' + this.categoryId)
          .then((response) => {
            this.postsFiltered = [...response.data]
          })
      }
    },
    getPostByCategoryFilter (categoryId = null) {
      if (this.searchContent === '') {
        if (categoryId === null) {
          axios.get('https://yowlteam.herokuapp.com/api/posts')
            .then((response) => {
              this.posts = response.data
              this.postsFiltered = response.data
            })
            .catch(error => console.log(error))
        } else {
          axios.get('https://yowlteam.herokuapp.com/api/posts/filter?category=' + categoryId)
            .then((response) => {
              this.categoryId = categoryId
              this.postsFiltered = [...response.data]
            })
        }
      } else {
        if (categoryId === null) {
          this.getPostBySearch(this.searchContent)
        } else {
          axios.get('https://yowlteam.herokuapp.com/api/posts/filter?text=' + this.searchContent + '&category=' + categoryId)
            .then((response) => {
              this.postsFiltered = [...response.data]
            })
        }
      }
    },
    getPostBySearchAndCategoryFilter (searchContent, categoryId) {
      axios.get('https://yowlteam.herokuapp.com/api/posts/filter?text=' + searchContent)
    },

    logout () {
      const instance = axios.create({
        baseURL: 'https://yowlteam.herokuapp.com/api'
      })

      instance.defaults.headers.common.Authorization = `Bearer ${this.getToken}`
      instance.post('/auth/logout')
        .then((response) => {
          this.setToken('')
          this.setUser({})
          localStorage.clear()
          this.$router.push('/')
        })
        .catch((error) => console.log(error))
    }
  },
  created () {
    this.getPostBySearch()
    this.user = this.getUser
    axios.get('https://yowlteam.herokuapp.com/api/posts')
      .then((response) => {
        this.posts = response.data
        this.postsFiltered = response.data
      })
      .catch(error => console.log(error))
    axios.get('https://yowlteam.herokuapp.com/api/categories')
      .then((response) => {
        this.categories = response.data
      })
      .catch(error => console.log(error))
    axios.get('https://yowlteam.herokuapp.com/api/communities')
      .then((response) => {
        this.communities = response.data
      })
      .catch(error => console.log(error))
  }
}

</script>

<style>
.NavBar {
  background-color: bisque;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}

nav {
  padding: 30px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
  cursor: pointer;
  text-decoration: underline;
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
