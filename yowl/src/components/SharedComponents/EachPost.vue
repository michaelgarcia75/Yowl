<template>
  <div class="eachPost">
    <p>{{community.name}} Posted by USERNAME {{moment(date).fromNow()}}</p>
    <h1>{{ post.title }}</h1>
    <br />
    {{ post.content }}
    <br />
    <br />
    <VoteButtons :post="post" />
  </div>
</template>

<script>
import moment from 'moment'
import axios from 'axios'
import VoteButtons from '@/components/SharedComponents/VoteButtons.vue'

export default {
  props: ['post'],
  name: 'IndexView',
  components: {
    VoteButtons
  },
  data () {
    return {
      community: [],
      date: this.post.created_at
    }
  },
  created () {
    this.moment = moment
    axios.get('https://yowlteam.herokuapp.com/api/communities/' + this.post.community_id)
      .then((response) => {
        this.community = response.data
      })
      .catch(error => console.log(error))
  }
}
</script>

<style scoped>
.eachPost {
  background-color: antiquewhite;
  padding: 10px;
  margin: 20px;
}
</style>
