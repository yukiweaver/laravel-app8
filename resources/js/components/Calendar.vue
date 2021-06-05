<template>
    <!-- <div style="max-width:900px;border-top:5px solid red;">
        <div v-for="(week, index) in calendars" :key="index" style="display:flex;border-left:5px solid green">
            <div v-for="(day, index) in week" :key="index" style="
            flex:1;min-height:125px;
            border-right:5px solid blue;
            border-bottom:5px solid blue
            ">
                {{ day.date }}
            </div>
        </div>
    </div> -->
    <!-- <table>
        <tr>
            <th>日</th>
            <th>月</th>
            <th>火</th>
            <th>水</th>
            <th>木</th>
            <th>金</th>
            <th>土</th>
        </tr>
        <tr v-for="(week, index) in calendars" :key="index">
            <td v-for="(day, index) in week" :key="index">{{ day.date }}</td>
        </tr>
    </table> -->
    <table class="osare-table col5t">
        <thead>
            <tr>
                <th class="youbi">日</th>
                <th class="youbi">月</th>
                <th class="youbi">火</th>
                <th class="youbi">水</th>
                <th class="youbi">木</th>
                <th class="youbi">金</th>
                <th class="youbi">土</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="(week, index) in calendars" :key="index">
                <td class="days" v-for="(day, index) in week" :key="index">
                    {{ day.date }}
                </td>
            </tr>
        </tbody>
    </table>
</template>

<script>
import moment from 'moment'
export default {
    props: {
        monthlyStartDate: {
            type: Number,
            default: 1,
        }
    },
    data() {
        return {
            //
        }
    },
    methods: {
        /**
         * カレンダーに表示する最初の日付データを返す
         */
        getStartDate() {
            let date = moment().date(this.monthlyStartDate);
            const youbiNum = date.day();
            return date.subtract(youbiNum, 'days');
        },
        /**
         * カレンダーに表示する最後の日付データを返す
         */
        getEndDate() {
            let date = moment().date(this.monthlyStartDate).add(1, 'months').subtract(1, 'days');
            const youbiNum = date.day();
            return date.add(6 - youbiNum, 'days');
        },
        /**
         * カレンダーで表示する日付を配列で返す
         */
        getCalendar() {
            let startDate = this.getStartDate();
            let endDate = this.getEndDate();

            // カレンダー表示に必要な行数
            const weekNumber = Math.ceil(endDate.diff(startDate, 'days') / 7);

            let calendars = [];
            for (let week = 0; week < weekNumber; week++) {
                let weekRow = [];
                for (let day = 0; day < 7; day++) {
                    weekRow.push({
                        date: startDate.get('date'),
                    });
                    startDate.add(1, 'days');
                }
                calendars.push(weekRow);
            }

            return calendars;
        },
    },
    mounted() {
        console.log(this.getStartDate());
        console.log(this.getEndDate());
        console.log(this.getCalendar());
    },
    computed: {
        calendars() {
            return this.getCalendar();
        }
    }
}
</script>

<style>
.osare-table {
    width:100%;
    table-layout: fixed;
    border: none !important;
    border-collapse: separate;
    border-spacing: 7px 0px;
}
 
.osare-table th {
    border: none !important;
}
 
.osare-table tbody td {
    border: none !important;
    background-color:#FFF9FF !important;
    border-bottom: solid 2px #f9f9f9 !important;
}
 
/* ヘッダー */
.osare-table thead th {
    font-weight: bold;
    border-radius: 10px 10px 0px 0px;
}

/* フッター（比較表と色つけたとき用） */
.osare-table tfoot td {
    border-radius: 0 0 10px 10px;
}
 
 
/* ボディ項目 */
.osare-table tbody th {
    background:#f2f5fc;
    font-weight: bold;
    border-bottom: solid 2px #f9f9f9 !important;
    line-height:4.5em;
}
 
/* フッター項目 */
.osare-table tfoot th {
    background:none;
    line-height:3em;
    font-weight: bold;
}


 
/* ボディデータ */
.osare-table tbody td {
    text-align:center;
}
 
/* ヘッダー行　１列ごとの色変え */
.osare-table thead th:nth-child(1)  {
    background: #FFB2D8;
}
.osare-table thead th:nth-child(2)  {
    background: #C4FF89;
}
.osare-table thead th:nth-child(3)  {
    background: #FFBCFF;
}
.osare-table thead th:nth-child(4)  {
    background:#81d4fa;
}
.osare-table thead th:nth-child(5)  {
    background: #FFE4C4;
}
.osare-table thead th:nth-child(6)  {
    background: #FFFFB2;
}
.osare-table thead th:nth-child(7)  {
    background: #FFDAB9;
}
 
/* 最終行のボーダーをなくす */
.osare-table tbody tr:last-child th,
.osare-table tbody tr:last-child td {
    border-bottom:none !important;
}

.youbi {
    padding: 10px;
}
.days {
    padding: 15px;
}

/* スマホ調整 */
@media (max-width: 767px) {
    .osare-table thead th,
    .osare-table tbody th {
        padding:0;
    }
    .osare-table tfoot td {
        padding:0;
        font-size:0.9em;
    }
    .osare-table tfoot td:nth-child(2) {
        font-size:1.2em;
    }
  
}

/*（共通）　項目の多いテーブルの幅を調整*/
@media (max-width: 767px) {
    .col5t th,
    .col5t td{
        font-size:1.0em;
        padding: 10px 0px;
    }
}
</style>