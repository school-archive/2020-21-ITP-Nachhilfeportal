<template>
  <div>
    <div class="calendar">
      <div class="outer">
        <table>
          <thead>
            <tr>
              <th class="headcol"></th>
              <th>Mo</th>
              <th>Di</th>
              <th>Mi</th>
              <th>Do</th>
              <th>Fr</th>
              <th>Sa</th>
              <th>So</th>
            </tr>
          </thead>
        </table>
        <div class="wrap">
          <table class="offset">

            <tbody>
                <td class="headcol">7:00</td>
              <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol">8:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol">9:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol">10:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol">11:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol">12:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol">13:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol">14:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol">15:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol">16:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol">17:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol">18:00</td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
              <tr>
                <td class="headcol"></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
                <td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</template>
<style lang="scss" scoped>
@use "src/assets/styles/colors";

.outer {
  position:relative;
}

.calendar {
  margin: 0 auto;
  max-width: 1000px;
  min-width: 250px;
  border-radius: 8px 8px 0px 0px;
  box-shadow: 0px 30px 50px rgba(0, 0, 0, 0.2) ,0px 3px 7px rgba(0, 0, 0, 0.1);
  margin-top: 8px;
  margin-bottom: 30px;
}
.wrap {

  overflow-x: hidden;
  overflow-y: scroll;
  max-width: 1000px;
  height: 500px;
}

thead {
  box-shadow: 0px 2px 3px rgba(0, 0, 0, 0.2);
}

thead th {
  text-align: center;
  width: 100%;

}

header h1 {
  font-size: 1.25rem;
  text-align: center;
  font-weight: normal;

}
tbody {
  position: relative;
  top: 50px;
}
table {
  background: #fff;
  width: 100%;
  height: 100%;
  border-collapse: collapse;
  table-layout: fixed;
}

.headcol {
  width: 60px;
  font-size: 0.875rem;
  font-weight: 500;
  color: rgba(0, 0, 0, 0.5);
  padding: 0.25rem 0;
  text-align: center;
  border: 0;
  position: relative;
  top: -12px;
  border-bottom: 1px solid transparent;
}

thead th {
  font-size: 1rem;
  font-weight: bold;
  color: rgba(0, 0, 0, 0.9);
  padding: 1rem;
}

thead {
  z-index: 2;
  background: white;
  border-bottom: 2px solid #ddd;

}

tr, tr td {
  height: 20px;
}
td {
  text-align: center;
}
tr:nth-child(odd) td:not(.headcol) {
  border-bottom: 1px solid #e8e8e8;
}

tr:nth-child(even) td:not(.headcol) {
  border-bottom: 1px solid #eee;
}

tr td {
  border-right: 1px solid #eee;
  padding: 0;
}

tbody tr td {
  position: relative;
  vertical-align: top;
  height: 40px;
  padding: 0.25rem 0.25rem 0 0.25rem;
  width: auto;

}

.checkbox {
  display: none;
}

.checkbox + label {
  border: 0;
  outline: 0;
  width: 100px;
  heigth: 100px;
  background: white;
  color: transparent;
  display:block;
  display: none;
}

.checkbox:checked + label {
  border: 0;
  outline: 0;
  width: 100%;
  heigth: 100%;
  background: colors.$primary;
  color: transparent;
  display: inline-block;
}

.event {
  background-color: colors.$secondary;
  color: white;
  border-radius: 2px;
  text-align: left;
  font-size: 0.875rem;
  z-index: 2;
  padding: 0.5rem;
  overflow-x: hidden;
  transition: all 0.2s;
  cursor: pointer;
}

.event:hover {
  box-shadow: 0px 10px 20px rgba(0, 0, 0, 0.2);
  background: colors.$secondary;
}

.event.double {
  height: 200%;
}

button.secondary {
  border: 1px solid rgba(0, 0, 0, 0.1);
  background: white;
  padding: 0.5rem 0.75rem;
  font-size: 14px;
  border-radius: 2px;
  color: rgba(0, 0, 0, 0.5);
  box-shadow: 0px 1px 2px rgba(0, 0, 0, 0.1);
  cursor: pointer;
  font-weight: 500;
}

button.secondary:hover {
  background: #fafafa;
}
button.secondary:active {
  box-shadow: none;
}
button.secondary:focus {
  outline: 0;
}


.icon {
  font-size: 1.5rem;
  margin: 0 1rem;
  text-align: center;
  cursor: pointer;
  vertical-align: middle;
  position: relative;
  top: -2px;
}

.icon:hover {
  color: red;
}



</style>