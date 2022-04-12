<template>
  I'm the createPost button !
  <div class="divModal" @click="showModal">
    <input class="divModalBar" :readonly="readonly" placeholder="New post ..."/>
    <img class="image" width="30" min-width="10"
                src="../../assets/img.png"
                />
  </div>

  <ModalTemplate v-show="isModalVisible" @close="closeModal">
    <template v-slot:header>Create new post</template>
    <template v-slot:body>
      title :
      <input class="createPostTitle" v-model="newPostTitle" />
      <br />Content :
      <input class="createPostContent" v-model="newPostContent" />
      <div class="container">
      <form enctype="multipart/form-data" novalidate v-if="isInitial || isSaving">
        <h1>Upload images</h1>
        <div class="dropbox">
          <input
            type="file"
            multiple
            :name="uploadFieldName"
            :disabled="isSaving"
            @change="$emit('filesChange', $event.target.name, $event.target.files); fileCount = $event.target.files.length"
            accept="image/*"
            class="input-file"
          />
          <p v-if="isInitial">
            Drag your file(s) here to begin
            <br />or click to browse
          </p>
          <p v-if="isSaving">Uploading {{ fileCount }} files...</p>
        </div>
      </form>
      </div>
    </template>
    <template v-slot:footer>
      <button>Create post</button>
    </template>
  </ModalTemplate>
</template>

<script>
import ModalTemplate from './ModalTemplate.vue'

const STATUS_INITIAL = 0
const STATUS_SAVING = 1
const STATUS_SUCCESS = 2
const STATUS_FAILED = 3
export default {
  name: 'IndexView',
  components: {
    ModalTemplate
  },
  data () {
    return {
      isModalVisible: false,
      uploadedFiles: [],
      uploadError: null,
      currentStatus: null,
      uploadFieldName: 'photos'

    }
  },
  computed: {
    isInitial () {
      return this.currentStatus === STATUS_INITIAL
    },
    isSaving () {
      return this.currentStatus === STATUS_SAVING
    },
    isSuccess () {
      return this.currentStatus === STATUS_SUCCESS
    },
    isFailed () {
      return this.currentStatus === STATUS_FAILED
    }
  },
  methods: {
    showModal () {
      this.isModalVisible = true
    },
    closeModal () {
      this.isModalVisible = false
    },
    reset () {
      // reset form to initial state
      this.currentStatus = 0
      this.uploadedFiles = []
      this.uploadError = null
    }
  },
  mounted () {
    this.reset()
  }
}
</script>

<style>
.divModalBar {
  background-color: hsl(0, 5%, 96%);
  height: 40px;
  width: 60%;
}
.divModalBar:focus {
  outline: none;
}
.divModal {
  cursor: pointer;
  background-color: #dcdcdc;
  width: 60%;
  height: 60px;
}
.modal {
  width: 700px;
}
.dropbox {
    outline: 2px dashed grey; /* the dash box */
    outline-offset: -10px;
    background: lightcyan;
    color: dimgray;
    padding: 10px 10px;
    min-height: 200px; /* minimum height */
    position: relative;
    cursor: pointer;
  }
  .input-file {
    opacity: 0; /* invisible but it's there! */
    width: 100%;
    height: 200px;
    position: absolute;
    cursor: pointer;
  }
  .dropbox:hover {
    background: lightblue; /* when mouse over to the drop zone, change color */
  }
  .dropbox p {
    font-size: 1.2em;
    text-align: center;
    padding: 50px 0;
  }
</style>
