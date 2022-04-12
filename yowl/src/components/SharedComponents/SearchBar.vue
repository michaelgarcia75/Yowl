<template>
    <input v-model="searchContent" @keyup.enter="$emit('getPostBySearch', searchContent)" placeholder="Search ...">
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
