<template>
    <div>
        <div class="btn-group btn-group-toggle" data-toggle="buttons">
            <label class="btn btn-secondary active">
                <input type="radio" name="options" id="option1" autocomplete="off" checked> 支出
            </label>
            <label class="btn btn-secondary">
                <input type="radio" name="options" id="option2" autocomplete="off"> 収入
            </label>
        </div>
        <component 
        :is="currentView"
        :expense-category-list="expenseCategoryList"
        :income-category-list="incomeCategoryList"
        :img-path="imgPath"
        :store-path="storePath"
        ></component>
    </div>
</template>

<script>
import Expense from './Expense';
import Income from './Income';
export default {
    components: {
        Expense,
        Income,
    },
    props: {
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
    data() {
        return {
            currentView: 'expense',
        }
    }
}
</script>

<style>

</style>