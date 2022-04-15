<template>
  <nav class="NavBar">
    <router-link to="/">
      <img id="logo" alt="Vue logo" src="./assets/logo.png">
    </router-link>
    <p id="titleYowl">YOWL</p>
    <SearchBar @getPostBySearch="getPostBySearch"/>
    <CategoriesFilter :filterAll="filterAll" :categories="categories" @getPostByCategoryFilter="getPostByCategoryFilter"/>

    <router-link class="adminLink" v-if="isLoggedIn && user.is_admin === 1" to="/admin">Admin</router-link>
    <router-link class="loginLink" v-if="!isLoggedIn" to="/login">Login</router-link>
    <router-link class="registerLink" v-if="!isLoggedIn" to="/register">Register</router-link>

    <DropDownMenu menu-title="Menu">
      <section class="option">
        <span v-if="isLoggedIn" class="desc">Logged as <b>{{user.pseudo}}</b> </span>
      </section>
      <section v-if="isLoggedIn" class="option">
        <router-link to="/dashboard">Profil</router-link>
      </section>
      <section v-if="isLoggedIn" class="option">
      </section>
      <section v-if="isLoggedIn" class="option">
        <a @click="logout()" >Log Out</a>
      </section>
      <section class="option">
        <span class="desc"></span>
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
import { mapState, mapGetters, mapMutations } from 'vuex'

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
      searchContent: 'big',
      filterAll: true,
      loggedUser: {}
    }
  },
  components: {
    SearchBar,
    CategoriesFilter,
    DropDownMenu
  },
  computed: {
    ...mapState(['user']),
    ...mapGetters(['isLoggedIn', 'getToken', 'getUser'])
  },
  // watch: {
  //   user (newUser, oldUser) {
  //     this.user = newUser
  //   }
  // },
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
      console.log('searchResult', this.searchResult)
      if (this.searchResult.length === 0 && !this.searchContent) {
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
    // getUserLogin () {
    //   this.user = this.getUser
    //   console.log('user is', this.user)
    // },
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
        .catch((error) => console.log(error.response.data))
    }
  },
  created () {
    this.getPostBySearch()
    // this.user = this.getUser
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
  background: linear-gradient(to left top, antiquewhite, bisque)
}
#titleYowl{
  padding: 0;
  width: fit-content;
  position: absolute;
  font-weight: bolder;
  font-family: Franklin Gothic Medium;
  font-size: 70px;
  margin-left: 20%;
  margin-top: 8px;
  background: -webkit-linear-gradient(#29f29b, #15c8cb, #01a0f9);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
#logo{
  position: absolute;
  margin-left: -28%;
  margin-top: -1%;
}
#app {
  font-family: Avenir, Helvetica, Arial, sans-serif;
  -webkit-font-smoothing: antialiased;
  -moz-osx-font-smoothing: grayscale;
  text-align: center;
  color: #2c3e50;
}
body{
  margin:0px;
}

nav {
  padding: 30px;
  height: 100px;
}

nav a {
  font-weight: bold;
  color: #2c3e50;
  cursor: pointer;
  text-decoration: underline;
}

.option{
  margin-left: -50%;
}
.links{
  margin-top: -2%;
  position: absolute;
  margin-left: 85%;
}
.loginLink{
  margin-left: 5px;
  margin-right: 5px;
}
.registerLink{
  margin-right: -85%;
}
.adminLink:hover {
  color: #29f29b;
}
.loginLink:hover {
  color: #15c8cb;
}
.registerLink:hover {
  color: #01a0f9;
}
</style>
