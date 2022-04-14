<template>
  <!-- COMMUNITY {{ community }} ================== -->
  <div class="eachCommunity">
    <h1 class="communityTitle">{{ community.title }}</h1>
    <br/>
    <br/>
    <b>{{ community.name }}</b>
    <br/>
    <br/>
    <u>Description :</u>
    <br/>
    <br/>
    {{ community.description }}
    <br/>
    <br/>
     {{ community.image }}
     <br/>
     <br/>
     Created at : {{ createdDate }}
     <br/>
     <br/>
  <button v-if="isJoin === false && !this.userCommunities.filter(e => e.id === this.community.id).length > 0" @click="joinCommunity(), this.isJoin = true">Join</button>
  <button v-if="isJoin === true || this.userCommunities.filter(e => e.id === this.community.id).length > 0" @click="quitCommunity(), this.isJoin = false">Joined</button>

  </div>
</template>
<script>
import axios from 'axios'
import { mapGetters } from 'vuex'

export default {
  props: ['community'],
  name: 'IndexView',
  components: {
  },
  data () {
    return {
      createdDate: this.community.created_at.substring(0, 10),
      isJoin: false,
      user: {},
      userCommunities: []
    }
  },
  computed: {
    ...mapGetters(['getUser'])
  },
  methods: {
    async joinCommunity () {
      await
      axios.post('https://yowlteam.herokuapp.com/api/community_user',
        {
          user_id: this.user.id,
          community_id: this.community.id
        }).then((data) => {
        console.log(data)
      })
        .catch((error) => { console.log(error.response.data) })
    },
    async quitCommunity () {
      await
      axios.delete('https://yowlteam.herokuapp.com/api/community/user/' + this.community.id + '/' + this.user.id)
        .then(response => {
          console.log(response)
        })
    }
  },
  created () {
    this.user = this.getUser
    axios
      .get('https://yowlteam.herokuapp.com/api/communities/user/' + this.user.id)
      .then((response) => {
        // console.log('communities is', response.data)
        this.userCommunities = response.data
      })
      .catch((error) => console.log(error))
  }
}
</script>

<style scoped>
.eachCommunity {
  background-color: antiquewhite;
  /* padding: 10px;
  margin: 20px; */
  border: 3px black;
}
button{
  margin-bottom: 10px;
}
/* .communityTitle{
  height: 50px;
  width: 50px;
} */
</style>
