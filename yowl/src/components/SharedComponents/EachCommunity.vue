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
  </div>
</template>
<script>

export default {
  props: ['community'],
  name: 'IndexView',
  components: {
  },
  data () {
    return {
      createdDate: this.community.created_at.substring(0, 10)
    }
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
/* .communityTitle{
  height: 50px;
  width: 50px;
} */
</style>
