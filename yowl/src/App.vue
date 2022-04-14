<template>
  <nav class="NavBar">
    <router-link to="/">
      <img alt="Vue logo" src="./assets/logo.png">
    </router-link>
    <SearchBar @getPostBySearch="getPostBySearch"/>
    <CategoriesFilter :filterAll="filterAll" :categories="categories" @getPostByCategoryFilter="getPostByCategoryFilter"/>
    <router-link to="/admin">Admin</router-link> |
    <router-link v-if="!isLoggedIn" to="/login">Login</router-link>
    <router-link v-if="!isLoggedIn" to="/register">Register</router-link>
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
      <section v-if="isLoggedIn" class="option">
        <button @click="logout" >Log Out</button>
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
import CreateCommunityModal from '@/components/SharedComponents/CreateCommunityModal.vue'
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
      filterAll: true
    }
  },
  components: {
    SearchBar,
    CategoriesFilter,
    DropDownMenu,
    CreateCommunityModal
  },
  computed: {
    ...mapGetters(['isLoggedIn', 'getToken'])
  },
  methods: {
    ...mapMutations(['setUser', 'setToken']),
    getPostBySearch (searchContent) {
      console.log('A')
      this.searchContent = searchContent
      if (this.categoryId === 0) {
        console.log('A1')

        // console.log('POST BY SEARCH 1', searchContent)
        axios.get('https://yowlteam.herokuapp.com/api/posts/filter?text=' + searchContent)
          .then((response) => {
            this.searchResult = [...response.data]
            this.postsFiltered = [...response.data]
            // console.log('my searchResult is', response.data)
          })
      } else {
        console.log('A2')
        // console.log('POST BY SEARCH 2 "', searchContent, '" AND', this.categoryId)
        axios.get('https://yowlteam.herokuapp.com/api/posts/filter?text=' + searchContent + '&category=' + this.categoryId)
          .then((response) => {
            this.postsFiltered = [...response.data]
          })
      }
    },
    // /!\ situation when you enter searchContent and filterContent at the same time is missing !!!
    getPostByCategoryFilter (categoryId = null) {
      console.log('B')
      if (this.searchContent === '') {
        console.log('B1')
        if (categoryId === null) {
          console.log('B1a')
          // console.log('POST BY FILTER ALL')
          axios.get('https://yowlteam.herokuapp.com/api/posts')
            .then((response) => {
              this.posts = response.data
              this.postsFiltered = response.data
            })
            .catch(error => console.log(error))
        } else {
          console.log('B1b')
          // console.log('I am in get post by filter categoryId is ', this.searchResult)
          axios.get('https://yowlteam.herokuapp.com/api/posts/filter?category=' + categoryId)
            .then((response) => {
              this.categoryId = categoryId
              this.postsFiltered = [...response.data]
              // console.log('my category name is', categoryId)
            })
        }
      } else {
        console.log('B2')
        if (categoryId === null) {
          console.log('B2a')
          this.getPostBySearch(this.searchContent)
        } else {
          console.log('B2b')
          axios.get('https://yowlteam.herokuapp.com/api/posts/filter?text=' + this.searchContent + '&category=' + categoryId)
            .then((response) => {
              this.postsFiltered = [...response.data]
              console.log(response.data)
            })
        }
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
    },
    logout () {
      const instance = axios.create({
        baseURL: 'https://yowlteam.herokuapp.com/api'
      })

      instance.defaults.headers.common.Authorization = `Bearer ${this.getToken}`
      instance.post('/auth/logout')
        .then((response) => {
          console.log(response)
          this.setToken('')
          this.setUser({})
          sessionStorage.clear()
          this.$router.push('/')
        })
        .catch((error) => console.log(error))
      // const config = {
      //   headers: {
      //     Authorization: `Bearer ${this.getToken}`
      //   }
      // }
      // axios.post('https://yowlteam.herokuapp.com/api/auth/logout', config)
      //   .then((response) => {
      //     console.log(response)
      //     this.setToken('')
      //     this.setUser({})
      //     sessionStorage.clear()
      //     this.$router.push('/')
      //   })
      //   .catch((error) => console.log(error))
    }
    // getPostBySearchAndCategoryFilter (searchContent, categoryId) {
    //   axios.get('https://yowlteam.herokuapp.com/api/posts/filter?text=' + searchContent)
    //     .then((response) => {
    //       this.searchResult = [...response.data]
    //     })
    //   console.log('I am in get pot by search AND filter', searchContent, categoryId)
    //   axios.get('https://yowlteam.herokuapp.com/api/posts/filter?' + searchContent)
    //     .then((response) => {
    //       this.searchResult = [...response.data]
    //     })
    //   axios.get('https://yowlteam.herokuapp.com/api/posts/filter?' + categoryId)
    //     .then((response) => {
    //       this.filterResult = [...response.data]
    //     })
    //   for (let i = 0; i < this.searchResult.length; i++) {
    //     for (let j = 0; j < this.filterResult.length; j++) {
    //       if (this.searchResult[i] === this.filterResult[j]) {
    //         this.searchAndFilterResult.push(this.searchResult[i])
    //       }
    //     }
    //   }
    // }
  },
  created () {
    this.getPostBySearch()
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
