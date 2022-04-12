<template>
  <div class="community">
    <CreatePostButton/>
    <PostManager/>
  </div>
  <router-view/>
  <template>
  <section>
      <button
        v-if="isLoggedIn"
        @click="showForm = !showForm"
        class="button is-primary">
        Toggle Form
      </button>
      <form
        v-if="showForm && isLoggedIn"
        @submit.prevent="onCreatePost()">
          <b-field label="Title">
              <b-input
                v-model="post.title"
                required>
              </b-input>
          </b-field>
          <b-field label="Description">
              <b-input type="textarea"
                  v-model="post.description"></b-input>
          </b-field>
          <b-field label="URL">
              <b-input v-model="post.URL"
                  type="url"></b-input>
          </b-field>
          <button class="button is-success">Add Post</button>
      </form>
      <form class="search-form">
          <b-field label="Search">
              <b-input v-model="searchTerm"></b-input>
          </b-field>
      </form>
      <div class="posts columns is-multiline is-4">
          <div class="column is-4"
              v-for="(post, index) in filteredPosts"
              :key="post.id">
              <div class="card">
                  <div class="card-image"
                      v-if="isImage(post.URL)">
                      <figure class="image">
                          <img :src="post.URL"
                              alt="Placeholder image">
                      </figure>
                  </div>
                  <div class="card-content">
                      <div class="media">
                          <div class="media-left">
                              <figure class="image is-48x48">
                                  <img :src="loadedUsersById[post.user_id].image"
                                      alt="Placeholder image">
                              </figure>
                          </div>
                          <div class="media-content">
                              <p class="title is-4"
                                  v-if="!post.URL">{{post.title}}</p>
                              <p class="title is-4"
                                  v-if="post.URL">
                                  <a :href="post.URL"
                                      target="_blank">{{post.title}}</a>
                              </p>
                              <p class="subtitle is-6">{{loadedUsersById[post.user_id].name}}</p>
                          </div>
                      </div>
                      <div class="content">
                          {{post.description}}
                          <br>
                          <time>{{getCreated(index)}}</time>
                          <br>
                          <button
                            @click="deletePost(post.id)"
                            v-if="user && user.id == post.user_id"
                            class="button is-danger">
                            Delete Post
                          </button>
                          <!-- <router-link
                            :to="{
                              name: 'post',
                              params: {
                                name: $route.params.name,
                                post_id: post.id
                              }
                            }"
                            class="button is-primary">View Post</router-link> -->
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </section>
</template>

<script>
// @ is an alias to /src
import CreatePostButton from '@/components/SharedComponents/CreatePostButton.vue'
import PostManager from '@/components/SharedComponents/PostManager.vue'

export default {
  name: 'AdminView',
  components: {
    CreatePostButton,
    PostManager
  }
}
</script>
