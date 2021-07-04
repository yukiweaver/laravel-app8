<template>
    <div>
        <div>
            <span class="btn btn-primary">←</span>
            <div id="border" class="border" style="padding:10px;">{{ baseMonth }}</div>
            <span class="btn btn-primary">→</span>
        </div>
        <br>
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
    </div>
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
            baseDateInstance: '',
            baseMonth: '',
        }
    },
    methods: {
        /**
         * カレンダーに表示する最初の日付データを返す
         */
        getStartDate() {
            let date = moment(this.baseDateInstance);
            const youbiNum = date.day();
            return date.subtract(youbiNum, 'days');
        },
        /**
         * カレンダーに表示する最後の日付データを返す
         */
        getEndDate() {
            let date = moment(this.baseDateInstance);
            date.add(1, 'months').subtract(1, 'days');
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
        let today = moment();
        let date = moment().date(this.monthlyStartDate); // 今月の基準日
        if (today.isBefore(date, 'day')) {
            // 今月の基準日より前なら先月分
            this.baseDateInstance = moment().subtract(1, 'months').date(this.monthlyStartDate);
        } else {
            // 今月の基準日以降なら今月分
            this.baseDateInstance = moment().date(this.monthlyStartDate);
        }
        this.baseMonth = this.baseDateInstance.format('YYYY年MM月');
    },
    computed: {
        calendars() {
            return this.getCalendar();
        }
    }
}
</script>

<style>
#border {
    padding:10px;
    width:50%;
    text-align:center;
    display:inline-block;
}


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
    background-color:#FFF9FF;
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

.inactive {
    background-color: #bec4c4 !important;
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