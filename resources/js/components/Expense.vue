<template>
    <div class="card-text">
        <!-- 日付 -->
        <div class="form-outline mb-4 text-left">
            <label class="form-label" for="payment_date">日付</label>
            <input v-model="paymentDate" type="date" id="payment_date" class="form-control" />
        </div>

        <!-- メモ -->
        <div class="form-outline mb-4 text-left">
            <label class="form-label" for="memo">メモ</label>
            <input v-model="memo" id="memo" class="form-control" />
        </div>

        <!-- 支出額 -->
        <div class="form-outline mb-4 text-left">
            <label class="form-label" for="expense">支出額</label>
            <input v-model="amount" type="number" id="expense" class="form-control" />
            <input name="type" value="1" type="hidden">
        </div>

        <!-- カテゴリー -->
        <div class="form-outline mb-4 text-left">
            <label class="form-label" for="expense">カテゴリー</label>
        </div>
        <div class="sample-form">
            <div class="categories" v-for="category in categoryList" :key="category.id">
                <input v-model="categoryId" :id="category.id" type="radio" :value="category.id">
                <label :for="category.id"><img :src="imgPath + '/' + category.img" width="60" height="60"></label>
                <p>{{ category.name }}</p>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block mb-4">支出を登録する</button>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    props: {
        categoryList: {
            type: Array,
            default: [],
            required: true
        },
        imgPath: {
            type: String,
            default: '',
            required: true
        }
    },
    data() {
        return {
            paymentDate: '',
            memo: '',
            amount: '',
            categoryId: '',
        }
    },
    mounted: function() {
        this.paymentDate = moment(new Date).format('YYYY-MM-DD');
    }
}
</script>

<style>

</style>