<template>
    <div>
        <div class="btn-group btn-group-toggle" ref="payment" data-toggle="buttons">
            <label @click="handleClick" class="btn btn-info active" data-id="expense">
                <input type="radio" name="options" autocomplete="off" checked> 支出
            </label>
            <label @click="handleClick" class="btn btn-info" data-id="save-amount">
                <input type="radio" name="options" autocomplete="off"> 貯金額
            </label>
        </div>
        <component
        :is="currentView"
        :initial-base-date-info="initialBaseDateInfo"
        :initial-expenses="initialExpenses"
        :category-colors="categoryColors"
        :save-amounts="saveAmounts"
        :graph-path="graphPath"
        ></component>
    </div>
</template>

<script>
import Expense from './Expense.vue'
import SaveAmount from './SaveAmount.vue'
export default {
    components: {
        Expense,
        SaveAmount,
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
        saveAmounts: {
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
            currentView: 'expense',
        }
    },
    methods: {
        handleClick(e) {
            this.currentView = e.currentTarget.getAttribute('data-id');
        }
    }
}
</script>

<style>

</style>