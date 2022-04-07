<template>
  <nav class="NavBar">
    <router-link to="/">
      <img alt="Vue logo" src="./assets/logo.png">
    </router-link>
    <SearchBar/>
    <CategoriesFilter/>
    <router-link to="/admin">Admin</router-link> |
    <DropDownMenu menu-title="Menu">
      <section class="option">
        <span class="desc">Online status // OPTION</span>
      </section>
      <section class="option">
        <router-link to="/dashboard">Profil</router-link>
      </section>
      <section class="option">
          <CreateCommunityModal>CreateCommuintyModal</CreateCommunityModal>
      <section class="option">
        <button>Log Out</button>
      </section>
      <section class="option">
        <span class="desc">Dark mode // OPTION</span>
      </section>
      </section>
    </DropDownMenu>
  </nav>
  <router-view/>
</template>

<script>

import SearchBar from '@/components/SharedComponents/SearchBar.vue'
import CategoriesFilter from '@/components/SharedComponents/CategoriesFilter.vue'
import DropDownMenu from '@/components/SharedComponents/DropDownMenu.vue'
import CreateCommunityModal from '@/components/SharedComponents/CreateCommunityModal.vue'

export default {
  data () {
  },
  components: {
    SearchBar,
    CategoriesFilter,
    DropDownMenu,
    CreateCommunityModal
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
