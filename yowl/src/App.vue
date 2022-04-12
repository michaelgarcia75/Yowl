<template>
  <nav class="NavBar">
    <router-link to="/">
      <img alt="Vue logo" src="./assets/logo.png">
    </router-link>
    <SearchBar @getPostBySearch="getPostBySearch" :SearchResult="SearchResult" :filterResult="filterResult"/>
    <CategoriesFilter :categories="categories" :SearchResult="SearchResult" :filterResult="filterResult" @getPostByCategoryFilter="getPostByCategoryFilter"/>
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
  <router-view :searchResult="searchResult" :filterResult="filterResult" :searchAndFilterResult="searchAndFilterResult"/>
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
    getPostBySearch (searchContent) {
      if (this.filterResult == null) {
        console.log('I am in get post by search, searchContent is ', searchContent)
        axios.get('https://yowlteam.herokuapp.com/api/posts/filter?' + searchContent)
          .then((response) => {
            this.searchResult = [...response.data]
            console.log('my searchContent is', searchContent)
          })
      } else {
        console.log('I am in get pot by search AND filter after search function, filterResult was, ', this.filterResult)
        this.getPostBySearchAndCategoryFilter(searchContent, this.filterResult[0])
      }
    },
    // /!\ situation when you enter searchContent and filterContent at the same time is missing !!!
    getPostByCategoryFilter (categoryId) {
      if (this.searchResult == null) {
        console.log('I am in get pot by search AND filter after filter function, searchResult was, ', this.searchResult)
        axios.get('https://yowlteam.herokuapp.com/api/posts/filter?text=' + categoryId)
          .then((response) => {
            this.filterResult = [...response.data]
            console.log('my category name is', categoryId)
          })
      } else {
        this.getPostBySearchAndCategoryFilter(this.searchResult, categoryId)
      }
    },
    getPostBySearchAndCategoryFilter (searchContent, categoryId) {
      axios.get('https://yowlteam.herokuapp.com/api/posts/filter?text=' + searchContent)
      //   .then((response) => {
      //     this.searchResult = [...response.data]
      //   })
      // console.log('I am in get pot by search AND filter', searchContent, categoryId)
      // axios.get('https://yowlteam.herokuapp.com/api/posts/filter?' + searchContent)
      //   .then((response) => {
      //     this.searchResult = [...response.data]
      //   })
      // axios.get('https://yowlteam.herokuapp.com/api/posts/filter?' + categoryId)
      //   .then((response) => {
      //     this.filterResult = [...response.data]
      //   })
      // for (let i = 0; i < this.searchResult.length; i++) {
      //   for (let j = 0; j < this.filterResult.length; j++) {
      //     if (this.searchResult[i] === this.filterResult[j]) {
      //       this.searchAndFilterResult.push(this.searchResult[i])
      //     }
      //   }
      // }
    }
  },
  created () {
    this.getPostBySearch()
    // },
    // mouted () {
    axios.get('https://yowlteam.herokuapp.com/api/posts')
      .then((response) => {
        // console.log('posts is', response.data)
        this.posts = response.data
      })
      .catch(error => console.log(error))
    axios.get('https://yowlteam.herokuapp.com/api/categories')
      .then((response) => {
        // console.log('categories is', response.data)
        this.categories = response.data
      })
      .catch(error => console.log(error))
    axios.get('https://yowlteam.herokuapp.com/api/communities')
      .then((response) => {
        // console.log('communities is', response.data)
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
