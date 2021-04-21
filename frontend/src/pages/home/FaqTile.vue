<template>
  <div :class="{'faq-wrapper': true, 'answer-hidden': !open }">
    <div class="question" @click="open = !open">
      <span class="text">{{ question }}</span>
      <div class="img-wrapper">
        <img src="@/assets/images/arrow-down-sign-to-navigate.svg"/>
      </div>
    </div>
    <div class="answer" ref="answer">
      <span class="text">{{ answer }}</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "FaqTile",
  props: {
    question: String,
    answer: String,
  },
  data() {
    return {
      open: true,
    }
  },
  mounted() {
    console.log(this.$refs.answer)
    this.$refs.answer.style.setProperty("--height", `${this.$refs.answer.clientHeight}px`)
    this.open = false;
  }
}
</script>

<style lang="scss" scoped>
  .faq-wrapper {
    width: 30rem;
  }

  .question {
    display: inline-flex;
    padding: .5rem;
    width: 100%;
    border: rgba(black, .1) 1px solid;
    border-radius: .25rem;
    box-shadow: 2px 2px 4px rgba(black, .1);
    align-items: center;
    cursor: pointer;

    .text {
      margin-left: 1rem;
    }

  }

  .answer-hidden {

    .answer {
      // TODO closing animation
      display: none;
    }

    .img-wrapper img {
      transform: rotateX(0deg);
    }
  }

  .answer {
    display: inline-flex;
    width: 100%;
    transition: max-height .2s ease;
    max-height: 999rem;
    box-sizing: content-box;
    padding: .5rem;

    .text {
      display: inline;
      margin: 1rem;
      position: static;
    }
  }

  .img-wrapper {
    display: inline-flex;
    justify-content: end;
    flex-grow: 1;
    img {
      height: 16px;
      padding: .5rem;
      transition: all .2s ease;
      transform: rotateX(180deg);
    }
  }
</style>