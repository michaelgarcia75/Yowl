<template>
  <nav>
    <router-link to="/admin">DashBoard</router-link> |
    <router-link to="/admin/Users">Users</router-link> |
    <router-link to="/admin/Posts">Posts</router-link> |
    <router-link to="/admin/Comments">Comments</router-link> |
    <router-link to="/admin/Communities">Communities</router-link> |
    <router-link to="/admin/Categories">Categories</router-link>
  </nav>
  <div class="admin">
    <AdminData/>
  </div>
  <router-view/>
</template>

<script>
// @ is an alias to /src
import AdminData from '@/components/AdminData.vue'

export default {
  name: 'AdminView',
  components: {
    AdminData
  }
}
</script>
