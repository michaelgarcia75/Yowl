<template>
    <AdminNavButtons></AdminNavButtons>
    This is from Communities Manager
    <AdminEachCommunity></AdminEachCommunity>
</template>

<script>
import AdminEachCommunity from './AdminEachCommunity.vue'
import AdminNavButtons from '@/components/AdminComponents/AdminNavButtons.vue'
export default {
  data () {
    return {
    }
  },
  components: {
    AdminEachCommunity,
    AdminNavButtons
  }
}
</script>
