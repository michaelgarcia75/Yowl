<template>
  <nav class="NavBar">
    <router-link to="/">
      <img alt="Vue logo" src="./assets/logo.png">
    </router-link>
    <SearchBar @getPostBySearch="getPostBySearch"/>
    <CategoriesFilter :categories="categories" @getPostByCategoryFilter="getPostByCategoryFilter"/>
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
        MY SEARCH RESULT IS {{searchResult}}<br>
        MY FILTER RESULT IS {{filterResult}}<br>
        MY SEARCH-FILTER RESULT IS {{searchAndFilterResult}}<br>
        <!-- MY postsFiltered IS {{postsFiltered}}<br> -->

  </nav>
  <router-view :postsFiltered="postsFiltered"/>
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
      communities: [],
      postsFiltered: this.posts
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
      if (this.filterResult.length === 0) {
        console.log('I am in get post by search, searchContent is ', searchContent)
        axios.get('https://yowlteam.herokuapp.com/api/posts/filter?text=' + searchContent)
          .then((response) => {
            this.searchResult = [...response.data]
            this.postsFiltered = [...response.data]
            console.log('my searchResult is', response.data)
          })
      } else {
        this.getPostBySearchAndCategoryFilter(searchContent, this.filterResult[0])
      }
    },
    // /!\ situation when you enter searchContent and filterContent at the same time is missing !!!
    getPostByCategoryFilter (categoryId = null) {
      // if (this.searchResult == null) {
      if (categoryId === null) {
        axios.get('https://yowlteam.herokuapp.com/api/posts')
          .then((response) => {
            this.posts = response.data
            this.postsFiltered = response.data
          })
          .catch(error => console.log(error))
      } else {
        console.log('I am in get post by filter categoryId is ', this.searchResult)
        axios.get('https://yowlteam.herokuapp.com/api/posts/filter?category=' + categoryId)
          .then((response) => {
            this.filterResult = [...response.data]
            this.postsFiltered = [...response.data]
            console.log('my category name is', categoryId)
          })
      }
      // } else {
      // this.getPostBySearchAndCategoryFilter(this.searchResult, categoryId)
    },
    getPostBySearchAndCategoryFilter (searchContent, categoryId) {
      axios.get('https://yowlteam.herokuapp.com/api/posts/filter?text=' + searchContent)
        .then((response) => {
          this.searchResult = [...response.data]
        })
      console.log('I am in get pot by search AND filter', searchContent, categoryId)
      axios.get('https://yowlteam.herokuapp.com/api/posts/filter?' + searchContent)
        .then((response) => {
          this.searchResult = [...response.data]
        })
      axios.get('https://yowlteam.herokuapp.com/api/posts/filter?' + categoryId)
        .then((response) => {
          this.filterResult = [...response.data]
        })
      for (let i = 0; i < this.searchResult.length; i++) {
        for (let j = 0; j < this.filterResult.length; j++) {
          if (this.searchResult[i] === this.filterResult[j]) {
            this.searchAndFilterResult.push(this.searchResult[i])
          }
        }
      }
    }
  },
  created () {
    this.getPostBySearch()
    // },
    // mouted () {
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
}

nav a.router-link-exact-active {
  color: #42b983;
}
</style>
