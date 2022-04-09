<template>
        <img class="image" width="12" min-width="10" @click="this.$parent.$parent.$emit('upvote', post.id)" src="../../assets/up-arrow.png" />
        <p>{{post.upvotes}}</p>
        <img class="image" width="12" min-width="10" @click="$emit('downvote', post.id)" src="../../assets/down-arrow.png" />
</template>
<script>
export default {
  props: ['post']
}
</script>
