<template>
  <tr>
    <td>{{communityId}}</td>
    <td>{{communityName}}</td>
    <td>{{communityUserId}}</td>
    <td>{{postsOfOneCommunity.length}} </td>
    <td>
        <button class='button'>Delete</button>
        <button class='button'>Pass</button>
    </td>
  </tr>
</template>

<script>
import axios from 'axios'
// import AdminPostModal from './AdminPostModal.vue'
export default {
  props: ['community'],
  data () {
    return {
      communityId: this.community.id,
      communityName: this.community.name,
      communityUserId: this.community.user_id,
      postsOfOneCommunity: []
    }
  },
  // components: {
  //   AdminPostModal
  // }
  methods: {
    getUsersByCommunity (communityId) {
      axios.get('https://yowlteam.herokuapp.com/api/users/community/' + communityId)
        .then((response) => {
          this.postsOfOneCommunity = response.data
        })
        .catch(error => console.log(error))
    }
  },
  created () {
    this.getUsersByCommunity(this.communityId)
  }
}
</script>
