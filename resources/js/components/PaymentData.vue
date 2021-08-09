<template>
    <div>
        <table class="table">

            <tbody v-for="(items, index) in initialPayments" :key="index">
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
        <template v-for="items in initialPayments">
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
                            :store-path="storePath"
                            :initial-payment-date="item.payment_date"
                            :initial-memo="item.memo"
                            :initial-amount="item.amount"
                            :initial-category-id="item.category_id"
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
        storePath: {
            type: String,
            default: '',
            required: true
        }
    },
    methods: {
        getCategoryName(categories, categoryId) {
            return this.getCategoryNameById(categories, categoryId);
        }
    }
}
</script>

<style>
    
</style>