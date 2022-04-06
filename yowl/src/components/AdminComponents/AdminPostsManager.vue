<template>
    <AdminNavButtons></AdminNavButtons>
    This is from Post Manager
    <AdminEachPost></AdminEachPost>
</template>

<script>
import AdminEachPost from './AdminEachPost.vue'
import AdminNavButtons from '@/components/AdminComponents/AdminNavButtons.vue'
export default {
  data () {
    return {
    }
  },
  components: {
    AdminEachPost,
    AdminNavButtons
  }
}
</script>
