<template>
    <!-- <input v-model.lazy="searchContent" @keyup.enter="$emit(getPostBySearch)" placeholder="Search ..."> -->
    <button @click="$emit('getPostBySearch')">Click here</button>
    <!-- <p v-for="research in searchResult" :key="research.id">ma recherche est : {{ research }}</p> -->
</template>

<script>
export default {
  props: ['searchResult'],
  data () {
    return {
      searchContent: '',
      research: ''
    }
  }
}
</script>
