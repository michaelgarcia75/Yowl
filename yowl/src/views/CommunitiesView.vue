<template>
  <div class="communities">
    <CommunitiesManager/>
    <CategoriesFilter></CategoriesFilter>
  </div>
  <router-view/>
</template>

<script>
// @ is an alias to /src
import CommunitiesManager from '@/components/SharedComponents/CommunitiesManager.vue'
import CategoriesFilter from '@/components/SharedComponents/CategoriesFilter.vue'

export default {
  name: 'AdminView',
  components: {
    CommunitiesManager,
    CategoriesFilter
  }
}
</script>
