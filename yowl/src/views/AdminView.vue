<template>
  <AdminNavButtons></AdminNavButtons>
  <div class="admin">
    <AdminData/>
    <!-- <AdminUsersManager/> -->
  </div>
  <router-view/>
</template>

<script>
// @ is an alias to /src
import AdminNavButtons from '@/components/AdminComponents/AdminNavButtons.vue'
import AdminData from '@/components/AdminComponents/AdminData.vue'
// import AdminUsersManager from '@/components/AdminComponents/AdminUsersManager.vue'

export default {
  name: 'AdminView',
  components: {
    AdminData,
    AdminNavButtons
    // AdminUsersManager
  }
}
</script>
