<template>
    <AdminNavButtons></AdminNavButtons>
    This is from Categories Manager
    <AdminEachCategory></AdminEachCategory>
</template>

<script>
import AdminEachCategory from './AdminEachCategory.vue'
import AdminNavButtons from '@/components/AdminComponents/AdminNavButtons.vue'
export default {
  data () {
    return {
    }
  },
  components: {
    AdminEachCategory,
    AdminNavButtons
  }
}
</script>
