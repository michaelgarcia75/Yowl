<template>
  <tr>
    <td>{{commentId}}</td>
    <td>{{commentContent}}</td>
    <td>{{commentUserId}}</td>
    <td>{{commentPostId}} </td>
    <td>
        <button class='button'>Delete</button>
        <button class='button'>Pass</button>
    </td>
  </tr>
    <!-- <AdminPostModal></AdminPostModal> -->
</template>

<script>
// import AdminPostModal from './AdminPostModal.vue'
export default {
  props: ['comment'],
  data () {
    return {
      commentId: this.comment.id,
      commentContent: this.comment.content,
      commentUserId: this.comment.user_id,
      commentPostId: this.comment.post_id
    }
  },
  // components: {
  //   AdminPostModal
  // }
  methods: {
  }
}
</script>
