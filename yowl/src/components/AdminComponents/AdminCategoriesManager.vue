<template>
  <AdminNavButtons></AdminNavButtons>
  <button class='button' @click="ShowAddCategoryForm()" v-if="addCategoryForm === false">Add New</button>
    <form class="addCategory" @submit.prevent v-else>
      <input class='input' v-model='newCategoryName' placeholder='Enter category name...' />
      <button class='button' @click='addCategory()'>Confirm</button>
      <button class='button' @click="CancelAddCatgoryForm()">X</button>
    </form>
  <table id="firstTable">
    <thead>
      <tr>
        <th>ID</th>
        <th>Category</th>
        <th>Community amount</th>
        <th>actions</th>
      </tr>
    </thead>
    <tbody>
      <!-- <div
        v-for='user in users'
        :key='user.id'
      > -->
        <AdminEachCategory v-for='category in categories' :key='category.id' :category="category"
        @deleteCategory='deleteCategory'
        @passCategory='passCategory'
        @updateCategory='updateCategory' :categoryName='categoryName'
        ></AdminEachCategory>
      <!-- </div> -->
    </tbody>
  </table>
</template>

<script>
import axios from 'axios'
import AdminEachCategory from './AdminEachCategory.vue'
import AdminNavButtons from '@/components/AdminComponents/AdminNavButtons.vue'
export default {
  data () {
    return {
      categories: [],
      addCategoryForm: false,
      newCategoryName: ''
    }
  },
  components: {
    AdminEachCategory,
    AdminNavButtons
  },
  methods: {
    deleteCategory (categoryId) {
      axios.delete('https://yowlteam.herokuapp.com/api/categories/' + categoryId)
        .then((response) => {
          this.categories = [...this.categories.filter((element) => element.id !== categoryId)]
        })
    },
    updateCategory (categoryId, categoryName) {
      axios.put('https://yowlteam.herokuapp.com/api/categories/' + categoryId,
        {
          name: categoryName
        })
      this.categoryName = categoryName
    },
    ShowAddCategoryForm () {
      this.addCategoryForm = true
    },
    CancelAddCatgoryForm () {
      this.addCategoryForm = false
      this.newCategoryName = ''
    },
    addCategory () {
      axios.post('https://yowlteam.herokuapp.com/api/categories',
        {
          name: this.newCategoryName
        })
        .then((response) => {
          axios.get('https://yowlteam.herokuapp.com/api/categories')
            .then((response) => {
              // console.log('posts is', response.data)
              this.categories = response.data
              // console.log('AFTERRRRRR posts is', this.posts)
            })
            .catch(error => console.log(error))
          // this.categoryName = this.newCategoryName
        })
      this.addCategoryForm = false
      this.newCategoryName = ''
    }
  },
  created () {
    axios.get('https://yowlteam.herokuapp.com/api/categories')
      .then((response) => {
        // console.log('posts is', response.data)
        this.categories = response.data
        // console.log('AFTERRRRRR posts is', this.posts)
      })
      .catch(error => console.log(error))
  }
}
</script>
