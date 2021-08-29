<template>
    <table class="table">
        <thead>
            <tr>
                <th>合計</th>
                <th>{{ totalExpenseAmount }}円</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="expense in expenses" :key="expense.id">
                <td>{{ expense.name }}</td>
                <td>{{ expense.total_amount }}円</td>
            </tr>
        </tbody>
    </table>
</template>

<script>
export default {
    props: {
        initialExpenses: {
            type: Array,
            default: [],
        },
    },
    data() {
        return {
            //
        }
    },
    computed: {
        expenses() {
            return this.initialExpenses;
        },
        /**
         * 合計を算出
         */
        totalExpenseAmount() {
            console.log(this.expenses);
            if (this.expenses.length) {
                let totalExpenseAmount = 0;
                for(let val of this.expenses) {
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