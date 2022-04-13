<template>
    <AdminNavButtons></AdminNavButtons>
  <table id="firstTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Community</th>
        <th>belongs to</th>
        <th>Post amount</th>
        <th>Member amount</th>
        <th>actions</th>
      </tr>
    </thead>
    <tbody>
      <!-- <div
        v-for='user in users'
        :key='user.id'
      > -->
        <AdminEachCommunity v-for='community in communities' :key='community.id' :community="community"
        @deleteCommunity='deleteCommunity'
        @passCommunity='passCommunity'
        ></AdminEachCommunity>
      <!-- </div> -->
    </tbody>
  </table>
</template>

<script>
import axios from 'axios'
import AdminEachCommunity from './AdminEachCommunity.vue'
import AdminNavButtons from '@/components/AdminComponents/AdminNavButtons.vue'
export default {
  data () {
    return {
      communities: []
    }
  },
  components: {
    AdminEachCommunity,
    AdminNavButtons
  },
  methods: {
    deleteCommunity (communityId) {
      axios.delete('https://yowlteam.herokuapp.com/api/communities/' + communityId)
        .then((response) => {
          this.communities = [...this.communities.filter((element) => element.id !== communityId)]
        })
    },
    passCommunity (communityId) {
      // console.log('in delete post function ', postId)
      axios.put('https://yowlteam.herokuapp.com/api/communities/' + communityId,
        {
          is_reported: 0
        })
        .then((response) => {
          this.communities = [...this.communities.filter((element) => element.id !== communityId)]
          // console.log('AFTERRRRRR posts is', this.posts)
        })
        .catch(error => console.log(error))
    }
  },
  created () {
    axios.get('https://yowlteam.herokuapp.com/api/communities')
      .then((response) => {
        // console.log('posts is', response.data)
        this.communities = response.data
        this.communities = [...this.communities.filter((element) => element.is_reported !== 0)]
        // console.log('AFTERRRRRR posts is', this.posts)
      })
      .catch(error => console.log(error))
  }
}
</script>
