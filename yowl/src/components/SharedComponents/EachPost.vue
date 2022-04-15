<template>
  <div class="eachPost">
    <p v-if="communities.length !== 0">{{community.name}} Posted by {{postUser.pseudo}} {{moment(date).fromNow()}}</p>
    <br />
    <h1>{{ postNewTitle }}</h1>
    <br />
    <div class="postContent">{{ postNewContent }}</div>
    <br />
    <br />
    <VoteButtons :post="post" />
    <button class="hover" @click="() => TogglePopUp('buttonTrigger')" v-if="userID === this.post.user_id">Edit Post</button>
    <button class="hover" @click="this.$emit('deletePost', postId)" v-if="userID === this.post.user_id">Delete Post</button>
    <button class="hover" id="reportButton" @click="ReportPost(postId)" v-if="PostIsReported === 0 && userID !== this.post.user_id">Report this post</button>
    <CommentsManager v-if="commentsFiltered.length !== 0" :commentsFiltered="commentsFiltered" :postId="postId" :users="users"/>
    <EditPost
      v-if="popupTrigger.buttonTrigger"
      :TogglePopUp="() => TogglePopUp('buttonTrigger')"
      @UpdatePost="UpdatePost"
      :post="post"
      :postNewTitle="postNewTitle" :postNewContent="postNewContent"
    >
    </EditPost>
  </div>
</template>

<script>
import moment from 'moment'
import axios from 'axios'
import VoteButtons from '@/components/SharedComponents/VoteButtons.vue'
import CommentsManager from '@/components/SharedComponents/CommentsManager.vue'
import { ref } from 'vue'
import EditPost from '@/components/SharedComponents/EditPost.vue'

export default {
  props: ['post', 'user', 'NewPostReported', 'comments', 'users', 'communities'],
  name: 'IndexView',
  components: {
    VoteButtons,
    CommentsManager,
    EditPost
  },
  setup () {
    const popupTrigger = ref({
      buttonTrigger: false
    })
    const TogglePopUp = (trigger) => {
      popupTrigger.value[trigger] = !popupTrigger.value[trigger]
    }
    return {
      popupTrigger,
      TogglePopUp
    }
  },
  data () {
    return {
      editPostForm: false,
      commentsFiltered: [],
      community: {},
      date: this.post.created_at,
      postId: this.post.id,
      postNewTitle: this.post.title,
      postNewContent: this.post.content,
      userID: this.user.id,
      userNAME: this.user.pseudo,
      PostIsReported: this.post.is_reported,
      postUser: {}
    }
  },
  methods: {
    debug () {
      console.log('this post ID is ', this.postId, 'post is report is ', this.PostIsReported)
    },
    UpdatePost (postId, postTitle, postContent) {
      console.log('I am in post manager update post function')
      axios.put('https://yowlteam.herokuapp.com/api/posts/' + postId,
        {
          title: postTitle,
          content: postContent
        })
        .then((response) => {
          console.log('response is ', response)
          this.postNewTitle = postTitle
          this.postNewContent = postContent
        })
    },
    ReportPost (postId) {
      console.log('in report post post id is ', postId)
      axios.put('https://yowlteam.herokuapp.com/api/posts/' + postId,
        {
          is_reported: 1
        })
        .then((response) => {
          this.PostIsReported = 1
        })
    }
  },
  created () {
    this.moment = moment
    this.commentsFiltered = this.comments.filter(comment => comment.post_id === this.post.id)
    this.postUser = this.users.filter(user => user.id === this.post.user_id)
    const communityArray = this.communities.filter(community => community.id === this.post.community_id)
    this.community = communityArray.find(obj => { return obj.id === this.post.community_id })
    // console.log('C: ', this.community)
  }
}
</script>

<style scoped>
.eachPost {
  background-color: antiquewhite;
  padding: 10px;
  margin: 20px;
  border: solid 2px #15c8cb;
  border-radius: 3px;
  width: 50%;
}

.editPost{
  width: 100%;
  height: 100px;
  margin-top: 20px;
  background-color: transparent;
  border: none;
}
.eachPost p{
  position: relative;
  float: left;
  margin-top: -8px;
  font-size: 15px;
  margin-bottom: 5px;
}
.eachPost h1{
  position: relative;
  float: left;
  margin-top: -8px;
  font-size: 20px;
  margin-bottom: 5px;
}
.postContent{
  font-size: 15px;
  width: 100%;
  text-align: center;
}
</style>
