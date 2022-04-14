<template>
  <div>
    <DropDownMenu :menuTitle="menuTitle">
      <div v-for="community in userCommunities" :key="community.id">
        <section class="option">
          <span @click="selectCommunity(community.name, community.id), $emit('getPostBycommunityFilter', communityId)">{{ community.name }}</span>
        </section>
      </div>
    </DropDownMenu>

  </div>
</template>
<script>
import axios from 'axios'
import DropDownMenu from '@/components/SharedComponents/DropDownMenu.vue'
// IMPORT STATE MAPGETTERS

export default {
  components: {
    DropDownMenu
  },
  props: [],
  data () {
    return {
      menuTitle: 'Filter by community',
      userCommunities: [],
      userId: 11,
      communityId: 0
    }
  },
  //   COMPUTED CF APP.VUE
  methods: {
    selectCommunity (communityName, communityId) {
      this.menuTitle = communityName
      this.communityId = communityId
    }
  },
  created () {
    // this.user = getUser()
    axios.get('https://yowlteam.herokuapp.com/api/communities/user/' + this.userId)
      .then((response) => {
        console.log('communities is', response.data)
        this.userCommunities = response.data
      })
      .catch(error => console.log(error))
  }
}
</script>
