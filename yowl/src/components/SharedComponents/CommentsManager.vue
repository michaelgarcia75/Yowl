<template>
<button v-if="isOpen" @click="isOn=true, isOpen=false">Show Comments</button>
<button v-if="isOn" @click="isOn=false, isOpen=true">Hide Comments</button>
  <div class="commentManager" v-if="isOn">
    <EachComment  v-for="comment in commentsFiltered" :key="comment.id" :comment="comment" />
  </div>
</template>

<script setup>
import { ref } from 'vue'
import EachComment from '@/components/SharedComponents/EachComment.vue'

const isOn = ref(false)
const isOpen = ref(true)

</script>
<script>

export default {
  props: ['commentsFiltered'],
  name: 'IndexView',
  components: {
    EachComment
  },
  methods: {
  }
}
</script>

<style>
.commentManager {
  background-color: aquamarine;
  width: 100%;
}
</style>
