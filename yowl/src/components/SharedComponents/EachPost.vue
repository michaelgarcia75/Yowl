<template>
    I'm each post
    <VoteButtons/>
</template>

<script>
// @ is an alias to /src
import VoteButtons from '@/components/SharedComponents/VoteButtons.vue'

export default {
  name: 'IndexView',
  components: {
    VoteButtons
  }
}
</script>
