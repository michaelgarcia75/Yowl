<template>
    <AdminNavButtons></AdminNavButtons>
    This is from Comments Manager
    <AdminEachComment></AdminEachComment>
</template>

<script>
import AdminEachComment from './AdminEachComment.vue'
import AdminNavButtons from '@/components/AdminComponents/AdminNavButtons.vue'
export default {
  data () {
    return {
    }
  },
  components: {
    AdminEachComment,
    AdminNavButtons
  }
}
</script>
