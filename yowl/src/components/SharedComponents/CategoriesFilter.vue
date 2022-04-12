<template>
  <div>
    <DropDownMenu menu-title="Filter by category">
      <!-- <section class="option"> -->
        <!-- <button @click="$emit('getPostByCategoryFilter', null)">All categories</button> -->
      <!-- </section> -->
      <div v-for="category in categories" :key="category.id">
        <section class="option">
          <button @click="$emit('getPostByCategoryFilter', category.id)">{{ category.name }}</button>
        </section>
      </div>
    </DropDownMenu>
  </div>
</template>
<script>
import DropDownMenu from '@/components/SharedComponents/DropDownMenu.vue'

export default {
  components: {
    DropDownMenu
  },
  props: ['categories'],
  data () {
    return {
    }
  }
}
</script>
