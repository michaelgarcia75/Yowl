<template>
    <AdminNavButtons></AdminNavButtons>
    This is from User Manager
    <AdminEachUser></AdminEachUser>
</template>

<script>
import AdminEachUser from './AdminEachUser.vue'
import AdminNavButtons from '@/components/AdminComponents/AdminNavButtons.vue'
export default {
  data () {
    return {
    }
  },
  components: {
    AdminEachUser,
    AdminNavButtons
  }
}
</script>
