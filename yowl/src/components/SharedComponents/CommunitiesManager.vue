<template>
    <!-- This is from Communities Manager -->
    <div class="communitiesManager">
    <EachCommunity class="eachCommunity" v-for="community in communities" :key="community.id" :community="community" />
  </div>
</template>

<script>
import EachCommunity from './EachCommunity.vue'
import axios from 'axios'

export default {
  props: [],
  data () {
    return {
      communities: []
    }
  },
  name: 'communitiesView',
  components: {
    EachCommunity
  },
  created () {
    axios.get('https://yowlteam.herokuapp.com/api/communities')
      .then((response) => {
        console.log('communities is', response.data)
        console.log('test', response.data)
        this.communities = response.data
      })
      .catch(error => console.log(error))
  }
}
</script>
<style scoped>

</style>
