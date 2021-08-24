<template>
    <table class="table">
        <thead>
            <tr>
                <th>合計</th>
                <th>{{ totalExpenseAmount }}円</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="expense in expenseData" :key="expense.id">
                <td>{{ expense.name }}</td>
                <td>{{ expense.total_amount }}円</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        expenses: {
            type: Array,
            default: [],
        },
    },
    data() {
        return {
            expenseData: this.expenses,
        }
    },
    computed: {
        // expenseData() {
        //     return this.expenses;
        // },
        /**
         * 合計を算出
         */
        totalExpenseAmount() {
            console.log(this.expenseData);
            if (this.expenseData.length) {
                let totalExpenseAmount = 0;
                for(let val of this.expenseData) {
                    totalExpenseAmount += val.total_amount;
                }

                return totalExpenseAmount;
            }
        }
    }
}
</script>

<style>

</style>