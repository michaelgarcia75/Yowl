<template>
  <tr>
    <td>{{communityId}}</td>
    <td>{{communityName}}</td>
    <td>{{communityCategoryId}}</td>
    <td>{{postsOfOneCommunity.length}} </td>
    <td>{{usersOfOneCommunity.length}} </td>
    <td>
        <button class='buttonDelete' @click="$emit('deleteCommunity', communityId)">Delete</button>
        <button class='buttonEdit' @click="$emit('passCommunity', communityId)">Pass</button>
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
      communityCategoryId: this.community.category_id,
      communities: [],
      postsOfOneCommunity: [],
      usersOfOneCommunity: []
    }
  },
  // components: {
  //   AdminPostModal
  // }
  methods: {
    getUsersByCommunity (communityId) {
      axios.get('https://yowlteam.herokuapp.com/api/users/community/' + communityId)
        .then((response) => {
          this.usersOfOneCommunity = response.data
        })
        .catch(error => console.log(error))
    },
    getPostsByCommunity (communityId) {
      axios.get('https://yowlteam.herokuapp.com/api/posts/community/' + communityId)
        .then((response) => {
          this.postsOfOneCommunity = response.data
        })
        .catch(error => console.log(error))
    },
    getCategoryName (categoryId) {
      // console.log('this user id is ', userId)
      axios.get('https://yowlteam.herokuapp.com/api/categories')
        .then((response) => {
          this.categories = response.data
          const category = this.categories.filter((category) => category.id === categoryId)
          const categoryName = category[0].name
          this.communityCategoryId = categoryName
        })
        .catch(error => console.log(error))
    }
  },
  created () {
    this.getUsersByCommunity(this.communityId)
    this.getPostsByCommunity(this.communityId)
    this.getCategoryName(this.communityCategoryId)
  }
}
</script>

<style>
#firstTable{
  margin-left: auto;
  margin-right: auto;
}
.buttonEdit{
  background-color: white;
  border-radius: 3px;
  border-color: blue;
  margin-left: 3px;
}
.buttonDelete{
  background-color: white;
  border-radius: 3px;
  border-color: red;
}
</style>
