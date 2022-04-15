-<template>
    <div class="dashboard">
        <UserSettings/>
        <div class="postLinks">
          <p>POSTS</p>
          <p>COMMENTS</p>
          <p>UPVOTES</p>
        </div>
         <PostManager :postsFiltered="postsFiltered" @deletePost="deletePost" :user="user"
         @ReportPost="ReportPost"/>
                 <!--<UpVotedPostsManager/> -->

    </div>
</template>

<script>
// @ is an alias to /src
import axios from 'axios'
import UserSettings from '@/components/SpecialComponents/UserSettings.vue'
import PostManager from '@/components/SharedComponents/PostManager.vue'
import { mapGetters } from 'vuex'
// import UpVotedPostsManager from '@/components/SharedComponents/UpVotedPostsManager.vue'

export default {
  name: 'AdminView',
  components: {
    UserSettings,
    PostManager
    // UpVotedPostsManager
  },
  data () {
    return {
      postsFiltered: [],
      user: {},
      userId: 1
    }
  },
  computed: {
    ...mapGetters(['isLoggedIn', 'getUser'])
  },
  methods: {
    deletePost (postId) {
      axios.delete('https://yowlteam.herokuapp.com/api/posts/' + postId)
        .then((response) => {
          axios.get('https://yowlteam.herokuapp.com/api/posts/user/' + this.userId)
            .then((response) => {
            // console.log('posts is', response.data)
              this.postsFiltered = response.data
            // console.log('post filtered is', this.postsFiltered)
            })
            .catch(error => console.log(error))
        })
    },
    ReportPost (postId) {
      axios.put('https://yowlteam.herokuapp.com/api/posts/' + postId,
        {
          is_reported: 1
        })
      // .then((response) => {
      //   axios.get('https://yowlteam.herokuapp.com/api/posts/user/' + this.userId)
      //     .then((response) => {
      //     // console.log('posts is', response.data)
      //       this.postsFiltered = response.data
      //     // console.log('post filtered is', this.postsFiltered)
      //     })
      //     .catch(error => console.log(error))
      // })
    }
  },
  created () {
    this.user = this.getUser
    this.userId = this.user.id
    axios.get('https://yowlteam.herokuapp.com/api/posts/user/' + this.userId)
      .then((response) => {
        // console.log('posts is', response.data)
        this.postsFiltered = response.data
        // console.log('post filtered is', this.postsFiltered)
      })
      .catch(error => console.log(error))
  }
}
</script>

<style scoped>
.postLinks{
  display: flex;
  flex-direction: row;
  flex-wrap: wrap;

}
.postLinks p{
  margin-right: 13px;
  font-size: 25px;
  cursor: pointer;
}
.postLinks p:hover{
  text-decoration: underline;
  color: rgb(14, 164, 233);

}
.dashboard{
  margin-left: 25%;
}

</style>
