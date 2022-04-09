<template>
  <nav class="NavBar">
    <router-link to="/">
      <img alt="Vue logo" src="./assets/logo.png">
    </router-link>
    <SearchBar @getPostBySearch="getPostBySearch" :SearchResult="SearchResult"/>
    <CategoriesFilter :categories="categories" :filterResult="filterResult"/>
    <router-link to="/admin">Admin</router-link> |
    <DropDownMenu menu-title="Menu">
      <section class="option">
        <span class="desc">Online status // OPTION</span>
      </section>
      <section class="option">
        <router-link to="/dashboard">Profil</router-link>
      </section>
      <section class="option">
          <CreateCommunityModal>CreateCommunityModal</CreateCommunityModal>
      </section>
      <section class="option">
        <button>Log Out</button>
      </section>
      <section class="option">
        <span class="desc">Dark mode // OPTION</span>
      </section>
    </DropDownMenu>
  </nav>
  <router-view/>
</template>

<script>
import axios from 'axios'
import SearchBar from '@/components/SharedComponents/SearchBar.vue'
import CategoriesFilter from '@/components/SharedComponents/CategoriesFilter.vue'
import DropDownMenu from '@/components/SharedComponents/DropDownMenu.vue'
import CreateCommunityModal from '@/components/SharedComponents/CreateCommunityModal.vue'

export default {
  data () {
    return {
      searchResult: [],
      filterResult: [],
      searchAndFilterResult: [],
      posts: [],
      categories: [],
      communities: []
    }
  },
  components: {
    SearchBar,
    CategoriesFilter,
    DropDownMenu,
    CreateCommunityModal
  },
  methods: {
    getPostBySearch (/* searchContent */) {
      axios.get('https://yowlteam.hero  kuapp.com/api/posts' /* + searchContent */)
        .then((response) => {
          this.searchResult = [...response.data]
        })
    },
    getPostByCategoryFilter (categoryId) {
      axios.get('https://yowlteam.herokuapp.com/api/posts' /* + categoryId */)
        .then((response) => {
          this.filterResult = [...response.data]
        })
    }
  },
  created () {
    this.getPostBySearch()
    // },
    // mouted () {
    console.log('HELLO WORLD')
    axios.get('https://yowlteam.herokuapp.com/api/posts')
      .then((response) => {
        console.log('posts is', response.data)
        this.posts = response.data
      })
      .catch(error => console.log(error))
    axios.get('https://yowlteam.herokuapp.com/api/categories')
      .then((response) => {
        console.log('categories is', response.data)
        this.categories = response.data
      })
      .catch(error => console.log(error))
    axios.get('https://yowlteam.herokuapp.com/api/communities')
      .then((response) => {
        console.log('communities is', response.data)
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
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
