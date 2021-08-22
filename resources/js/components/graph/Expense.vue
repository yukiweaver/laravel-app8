<template>
    <div>
        <div class="period">
            <span class="btn btn-sm btn-primary">←</span>
            <div id="border" class="border" style="padding:10px;">
                {{ baseMonthStr }}<br>
                （{{ baseStartDateStr }} 〜 {{ baseEndDateStr }}）
            </div>
            <span class="btn btn-sm btn-primary">→</span>
        </div>
        <div class="expense-chart">
            <expense-chart
            :expenses="expenses"
            :category-colors="categoryColors"
            >
            </expense-chart>
        </div>
    </div>
</template>

<script>
import moment from 'moment'
import ExpenseChart from './ExpenseChart.vue';
export default {
    components: { ExpenseChart },
    props: {
        initialBaseDateInfo: {
            type: Object,
            default: {},
        },
        expenses: {
            type: Array,
            default: [],
        },
        categoryColors: {
            type: Object,
            default: {},
        },
    },
    data() {
        return {
            //
        }
    },
    computed: {
        baseDateInstance() {
            return moment(this.initialBaseDateInfo.base_date, 'YYYY-MM-DD');
        },
        baseStartDate() {
            return moment(this.initialBaseDateInfo.start_date, 'YYYY-MM-DD');
        },
        baseEndDate() {
            return moment(this.initialBaseDateInfo.end_date, 'YYYY-MM-DD');
        },
        baseMonthStr() {
            return this.baseDateInstance.format('YYYY年MM月');
        },
        baseStartDateStr() {
            return this.baseStartDate.format('MM月DD日');
        },
        baseEndDateStr() {
            return this.baseEndDate.format('MM月DD日');
        }
    }
}
</script>

<style>
    .period {
        margin-top: 10px;
        margin-bottom: 10px;
    }
</style>