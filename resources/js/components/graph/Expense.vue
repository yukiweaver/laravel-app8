<template>
    <div>
        <div class="period">
            <span @click="clickPreviousMonth()" class="btn btn-sm btn-primary">←</span>
            <div id="border" class="border" style="padding:10px;">
                {{ baseMonthStr }}<br>
                （{{ baseStartDateStr }} 〜 {{ baseEndDateStr }}）
            </div>
            <span @click="clickNextMonth()" class="btn btn-sm btn-primary">→</span>
        </div>
        <div class="expense-chart">
            <expense-chart
            :initial-expenses="expenses"
            :category-colors="categoryColors"
            >
            </expense-chart>
        </div>
        <div class="expense-data">
            <expense-data
            :initial-expenses="expenses"
            ></expense-data>
        </div>
    </div>
</template>

<script>
import moment from 'moment';
import ExpenseChart from './ExpenseChart.vue';
import ExpenseData from './ExpenseData.vue';
export default {
    components: { 
        ExpenseChart,
        ExpenseData,
    },
    props: {
        initialBaseDateInfo: {
            type: Object,
            default: {},
        },
        initialExpenses: {
            type: Array,
            default: [],
        },
        categoryColors: {
            type: Object,
            default: {},
        },
        graphPath: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            date: moment(),
            baseDate: this.initialBaseDateInfo.base_date,
            baseStartDate: this.initialBaseDateInfo.start_date,
            baseEndDate: this.initialBaseDateInfo.end_date,
            expenses: this.initialExpenses,
        }
    },
    computed: {
        baseDateInstance() {
            return moment(this.baseDate, 'YYYY-MM-DD');
        },
        baseStartDateInstance() {
            return moment(this.baseStartDate, 'YYYY-MM-DD');
        },
        baseEndDateInstance() {
            return moment(this.baseEndDate, 'YYYY-MM-DD');
        },
        baseMonthStr() {
            return this.baseDateInstance.format('YYYY年MM月');
        },
        baseStartDateStr() {
            return this.baseStartDateInstance.format('MM月DD日');
        },
        baseEndDateStr() {
            return this.baseEndDateInstance.format('MM月DD日');
        }
    },
    methods: {
        /**
         * 前の月データを表示
         */
        clickPreviousMonth() {
            this.date.subtract(1, 'month');
            let previosDate = this.date.clone();
            let params = {
                year: previosDate.get('year'),
                month: previosDate.get('month') + 1,
                day: previosDate.get('date'),
            };

            this.requestGet(this.graphPath, params)
            .then(res => {
                console.log('click previos success');
                this.setData(res.data.content);
            })
            .catch(error => {
                console.error('request error URL: ' + this.graphPath);
            })
        },
        /**
         * 次の月データを表示
         */
        clickNextMonth() {
            this.date.add(1, 'month');
            let nextDate = this.date.clone();
            let params = {
                year: nextDate.get('year'),
                month: nextDate.get('month') + 1,
                day: nextDate.get('date'),
            };

            this.requestGet(this.graphPath, params)
            .then(res => {
                console.log('click next success');
                this.setData(res.data.content);
            })
            .catch(error => {
                console.error('request error URL: ' + this.graphPath);
            })
        },
        setData(data) {
            this.baseDate = data.base_date_info.base_date;
            this.baseStartDate = data.base_date_info.start_date;
            this.baseEndDate = data.base_date_info.end_date;
            this.expenses = data.expenses;
        },
    }
}
</script>

<style>
    .period {
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .expense-data {
        margin-top: 10px;
        margin-bottom: 10px;
    }
    .expense-chart {
        margin-top: 20px;
        margin-bottom: 20px;
    }
</style>