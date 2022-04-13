<template>
    <AdminNavButtons></AdminNavButtons>
  <table id="firstTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Community</th>
        <th>Initiator</th>
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
