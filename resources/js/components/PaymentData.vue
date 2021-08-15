<template>
    <div>
        <table id="total-payment" class="table table-bordered table-striped table-condensed">
            <thead>
                <tr>
                    <th>収入</th>
                    <th>支出</th>
                    <th>合計</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>{{ totalPaymentInfo.total_income }}円</td>
                    <td>{{ totalPaymentInfo.total_expense }}円</td>
                    <td>{{ totalPaymentInfo.remaining_amount }}円</td>
                </tr>
            </tbody>
        </table>
        <table class="table">

            <tbody v-for="(items, index) in payments" :key="index">
                <tr>
                    <th>{{ index }}</th>
                </tr>
                <tr v-for="item in items" :key="item.id">
                    <td>{{ getCategoryName(categories, item.category_id) }}</td>
                    <td>{{ item.memo }}</td>
                    <td>{{ item.amount }}円</td>
                    <td>
                        <button type="buttton" class="btn btn-sm btn-primary" data-toggle="modal" :data-target="'#' + 'exampleModal' + item.id">編集</button>
                    </td>
                </tr>
            </tbody>
        </table>

        <!-- Modal -->
        <template v-for="items in payments">
            <div v-for="item in items" :key="item.id" class="modal fade" :id="'exampleModal' + item.id" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">編集</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <payment
                            :expense-category-list="expenseCategoryList"
                            :income-category-list="incomeCategoryList"
                            :img-path="imgPath"
                            :update-path="updatePath"
                            :show-path="showPath"
                            :initial-payment-date="item.payment_date"
                            :initial-memo="(item.memo) ? item.memo : ''"
                            :initial-amount="item.amount"
                            :initial-category-id="item.category_id"
                            :initial-payment-type="item.type"
                            :initial-payment-id="item.id"
                            >
                            </payment>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
import Payment from './Payment.vue';
export default {
    components: {
        Payment,
    },
    props: {
        initialPayments: {
            type: Object,
            default: [],
        },
        categories: {
            type: Array,
            default: [],
        },
        expenseCategoryList: {
            type: Array,
            default: [],
            required: true
        },
        incomeCategoryList: {
            type: Array,
            default: [],
            required: true
        },
        imgPath: {
            type: String,
            default: '',
            required: true
        },
        updatePath: {
            type: String,
            default: '',
        },
        showPath: {
            type: String,
            default: '',
        },
    },
    data() {
        return {
            //
        }
    },
    methods: {
        getCategoryName(categories, categoryId) {
            return this.getCategoryNameById(categories, categoryId);
        }
    },
    computed: {
        // data()にpropsからの値を代入すると初回以外値が更新されないため、computedを使用
        payments() {
            return this.initialPayments;
        },
        /**
         * 収入、支出、残りの額を算出
         */
        totalPaymentInfo() {
            let totalIncome = 0;
            let totalExpense = 0;
            for(let paymentDate in this.payments) {
                this.payments[paymentDate].forEach(function(v, i) {
                    if (v.type == 1) {
                        totalExpense += v.amount;
                    } else if (v.type == 2) {
                        totalIncome += v.amount;
                    }
                });
            }
            return {
                'total_income': totalIncome,
                'total_expense': totalExpense,
                'remaining_amount': totalIncome - totalExpense
            };
        }
    },
}
</script>

<style>
    #total-payment {
        margin-top: 15px;
    }
</style>