<template>
    <input class="searchBar" v-model="searchContent" @keyup.enter="$emit('getPostBySearch', searchContent)" placeholder="Search ...">
    <!-- <button @click="$emit('getPostBySearch')">Click here</button> -->
    <!-- <p v-for="research in searchResult" :key="research.id">ma recherche est : {{ research }}</p> -->
</template>

<script>
export default {
  props: [''],
  data () {
    return {
      searchContent: '',
      research: ''
    }
  }
}
</script>

<style>
.searchBar{
  width: 300px;
  height: 25px;
  border: solid 2px #01a0f9;
  border-radius: 3%;
}
</style>
