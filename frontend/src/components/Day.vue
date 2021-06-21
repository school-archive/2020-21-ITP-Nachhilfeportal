<template>
  <div>
<!--Time-->
    <table v-if="time ==='true'">
      <thead class="shadow-sm text-center"> placeholder </thead>
      <tbody v-for="i in 12" :key="i">
      <tr>
        <td class="text-center">{{ i+6 }}:00</td>
      </tr>
      <tr>
        <td class="text-center">{{ i+6 }}:30</td>
      </tr>
      </tbody>
    </table>

<!--User Data-->
    <table v-else>
      <thead class="shadow-sm text-center">{{ day }}</thead>
      <tbody v-for="i in 24" :key="i">
      <tr>
        <td :class="{rot : background(i, true)}">
          <button @click="delete_entry" v-if="settings_page ==='true' && background(i, false)">x</button>
        </td>
      </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "Day",
  props: {
    day: String,
    time: String,
    user_input: Array,
    settings_page: String
  },
  methods: {
    background(i, bg) {
      let bool = false
      if(this.user_input) {
        let time = (Math.ceil(i/2)+6)*100
        time+= (i%2===0) ? 30 : 0

        this.user_input.forEach(t => {
          if(bg) {
            if(time >= this.timestringToNumber(t.time_from) && time <= this.timestringToNumber(t.time_to)) {
              bool = true
            }
          } else {
            if(time === this.timestringToNumber(t.time_from)) {
              bool = true
            }
          }
        })
      }
      return bool
    },
    timestringToNumber(str) {
      let array = str.split(':')
      return parseInt(array[0])*100 + parseInt(array[1])
    },
    delete_entry() {
      console.log('yolo')
    }
  }
}
</script>

<style lang="scss" scoped>
  @use "src/assets/styles/colors";

  .rot {
    background-color: colors.$primary;
  }

  thead th {
    text-align: center;
    width: 100%;
    font-size: 1rem;
    font-weight: bold;
    color: rgba(0, 0, 0, 0.9);
    padding: 1rem;
  }

  thead {
    /*z-index: 2;*/
    background: white;
    border-bottom: 2px solid #ddd;
  }

  table {
    background: #fff;
    width: 100%;
    height: 100%;
    border-collapse: collapse;
    table-layout: fixed;
  }

  .headcol {
    /*width: 60px;*/
    font-size: 0.875rem;
    font-weight: 500;
    color: rgba(0, 0, 0, 0.5);
    padding: 0.25rem 0;
    text-align: center;
    border: 0;
    /*position: relative;*/
    /*top: -12px;*/
    border-bottom: 1px solid transparent;
  }

  tr:nth-child(odd) td:not(.headcol) {
    border-bottom: 1px solid #e8e8e8;
  }

  tr:nth-child(even) td:not(.headcol) {
    border-bottom: 1px solid #eee;
  }

  tr td {
    border-right: 1px solid #eee;
    /*padding: 0;*/
  }

  tbody tr td {
    /*position: relative;*/
    vertical-align: top;
    height: 40px;
    padding: 0.25rem 0.25rem 0 0.25rem;
    width: auto;
  }
</style>