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

        <button @click="submit" type="button" class="btn btn-primary btn-block mb-4">支出を登録する</button>
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
        },
        storePath: {
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
            type: '1',
        }
    },
    mounted: function() {
        this.paymentDate = moment(new Date).format('YYYY-MM-DD');
    },
    methods: {
        async submit() {
            console.log('submit');

            let params = new URLSearchParams();
            params.append('payment_date', this.paymentDate);
            params.append('memo', this.memo);
            params.append('amount', this.amount);
            params.append('category_id', this.categoryId);
            params.append('type', this.type);

            await axios.post(this.storePath, params)
            .then(function(response) {
                console.log(response.data);
            }.bind(this))
            .catch(function(error) {
                if (error.response) {
                    // The request was made and the server responded with a status code
                    // that falls out of the range of 2xx
                    console.log(error.response.data);
                    console.log(error.response.status);      // 例：400
                    console.log(error.response.statusText);  // Bad Request
                    console.log(error.response.headers);
                } else if (error.request) {
                    // The request was made but no response was received
                    // `error.request` is an instance of XMLHttpRequest in the browser and an instance of
                    // http.ClientRequest in node.js
                    console.log(error.request);
                } else {
                    // Something happened in setting up the request that triggered an Error
                    console.log('Error', error.message);
                }
                console.log(error.config);
            }.bind(this))
        }
    }
}
</script>

<style>

</style>