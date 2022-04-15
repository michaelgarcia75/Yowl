<template>

  <section class="dropDownMenuWrapper">

    <button class="dropDownMenuButton" ref="menu" @click="openClose">{{menuTitle}}</button>

    <div class="iconWrapper">
        <div class="bar1" :class="{ 'bar1--open' : isOpen }" />
        <div class="bar2" :class="{ 'bar2--open' : isOpen }" />
        <div class="bar3" :class="{ 'bar3--open' : isOpen }" />

    </div>

    <section class="dropdownMenu" v-if="isOpen === true">
      <div class="menuArrow"/>
      <slot/>
    </section>

  </section>

</template>

<script>
export default {
  props: ['menuTitle'],
  data () {
    return {
      isOpen: false
    }
  },
  methods: {
    openClose () {
      const closeListerner = (e) => {
        // if (this.catchOutsideClick(e, this.$refs.menu)) {
        //   // window.removeEventListener('click', closeListerner)
        //   this.isOpen = false
        // }
      }
      window.addEventListener('click', closeListerner)
      this.isOpen = !this.isOpen
    }
    // catchOutsideClick (event, dropdown) {
    //   if (dropdown === event.target) {
    //     return false
    //   }
    //   if (this.isOpen && dropdown !== event.target) {
    //     return true
    //   }
  }
}

</script>

<style>
button.dropDownMenuButton{
  background-color: white;
  border-radius: 3px;
  border-color: #01a0f9;
  cursor: pointer;
}
.dropDownMenuWrapper{
  position: absolute;
  margin-top: 1px;
}
.dropdownMenu{
  position: absolute;
}
</style>
