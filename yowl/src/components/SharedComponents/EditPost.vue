<template>
<div class="popUp">
    <div class='popUpInner'>
        <h1>
            <input class='input' v-model='postTitle' />
        </h1>
        <textarea class='editPost' v-model='postContent' />
        <button class="ConfirmUpdatedPost" @click="$emit('UpdatePost', postId, postTitle, postContent); TogglePopUp('buttonTrigger')">Confirm</button>
        <button class="closeEditPost" @click="TogglePopUp('buttonTrigger')">X</button>
    </div>
</div>
</template>

<script>
export default {
  props: ['post', 'TogglePopUp', 'postNewTitle', 'postNewContent'],
  data () {
    return ({
      postId: this.post.id,
      postTitle: this.postNewTitle,
      postContent: this.postNewContent
    })
  }
}
</script>

<style>
.popUp {
    position:fixed;
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    z-index: 99;
    background-color: rgba(0, 0, 0, 0.2);
    display: flex;
    align-items: center;
    justify-content: center;
}
.popUpInner {
    background: #fff;
    padding: 32px;
}

.editPost{
  width: 100%;
  height: 100px;
  background-color: transparent;
}
</style>
