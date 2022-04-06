<template>
  <AdminNavButtons></AdminNavButtons>
  <div class="admin">
    <AdminData/>
  </div>
  <router-view/>
</template>

<script>
// @ is an alias to /src
import AdminData from '@/components/AdminComponents/AdminData.vue'
import AdminNavButtons from '@/components/AdminComponents/AdminNavButtons.vue'

export default {
  name: 'AdminView',
  components: {
    AdminData,
    AdminNavButtons
  }
}
</script>
