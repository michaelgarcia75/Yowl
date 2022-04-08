<template>
<div>
    <DropDownMenu menu-title="Filter by category">
        <div v-for="category in categories" :key="category.id">
          <section class="option">
          <button @click="$emit('getPostByCategoryFilter', categoryId)" >{{category.name}}</button>
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
      SearchResult: [],
      categoryId: this.category.id
    }
  }
}
</script>
