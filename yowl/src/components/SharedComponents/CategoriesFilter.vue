<template>
  <div>
    <DropDownMenu class="filterButton" menu-title="Filter by category">
      <section v-if="filterAll === true" class="option">
        <button class="allCategories" @click="$emit('getPostByCategoryFilter', null)">All categories</button>
      </section>
      <div v-for="category in categories" :key="category.id">
        <section class="option">
          <button class="categories"  @click="$emit('getPostByCategoryFilter', category.id)">{{ category.name }}</button>
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
  props: ['categories', 'filterAll'],
  data () {
    return {
    }
  }
}
</script>

<style scoped>
.filterButton{
  margin-left: 44%;
}
button.categories{
  background-color: white;
  border-radius: 3px;
  border-color: #29f29b;
  cursor: pointer;
  margin-left: 12px;
}
button.allCategories{
  background-color: white;
  border-radius: 3px;
  border-color: #15c8cb;
  cursor: pointer;
  margin-left: 12px;
}
</style>
