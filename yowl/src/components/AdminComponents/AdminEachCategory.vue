<template>
    <tr v-if="categoryEditForm === false">
        <td>{{categoryId}}</td>
        <td>{{categoryName}}</td>
        <td>{{communityAmount}} </td>
        <td>
            <button class='button' @click="ChangeCategoryEditForm()">Edit</button>
            <button v-if="communityAmount === 0" class='button' @click="$emit('deleteCategory', categoryId)">Delete</button>
        </td>
    </tr>
    <tr v-else>
        <td>{{categoryId}}</td>
        <td>
            <input class='input' v-model='categoryName' />
        </td>
        <td>{{communityOfOneCategory.length}} </td>
        <td>
            <button class='button' @click="$emit('updateCategory', categoryId, categoryName); ChangeCategoryEditForm()">Confirm</button>
            <button class='button' @click="CloseCategoryEditForm()">X</button>
        </td>
    </tr>
</template>

<script>
import axios from 'axios'
// import AdminPostModal from './AdminPostModal.vue'
export default {
  props: ['category'],
  data () {
    return {
      categoryEditForm: false,
      categoryId: this.category.id,
      categoryName: this.category.name,
      communityOfOneCategory: [],
      communities: [],
      communityAmount: 0
    }
  },
  methods: {
    getCommunitiesByCategory (categoryId) {
      axios.get('https://yowlteam.herokuapp.com/api/communities')
        .then((response) => {
        //   console.log('posts is', response.data)
          this.communities = response.data
          //   console.log('this posts is', this.posts)
          this.communityOfOneCategory = [...this.communities.filter((element) => element.category_id === categoryId)]
          this.communityAmount = this.communityOfOneCategory.length
        //   console.log('AFTERRRRRR posts is', this.postsOfOneCategory)
        })
        .catch(error => console.log(error))
    },
    ChangeCategoryEditForm () {
      this.categoryEditForm = !this.categoryEditForm
    },
    CloseCategoryEditForm () {
      // console.log('in close')
      // console.log('user naem is ', this.user.pseudo, 'user email is ', this.user.email, 'user role is ', this.userNewRole)
      this.categoryEditForm = !this.categoryEditForm
      this.categoryName = this.category.name
    }
  },
  created () {
    this.getCommunitiesByCategory(this.categoryId)
  }
}
</script>
