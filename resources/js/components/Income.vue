<template>
    <div class="card-text">
        <!-- 日付 -->
        <div class="form-outline mb-4 text-left">
            <label class="form-label" for="payment_date">日付</label>
            <p v-if="messages.paymentDate.length">
                <ul class="text-danger">
                    <li v-for="(message, key) in messages.paymentDate" :key="key">{{ message }}</li>
                </ul>
            </p>
            <input v-model="paymentDate" type="date" id="payment_date" class="form-control" />
        </div>

        <!-- メモ -->
        <div class="form-outline mb-4 text-left">
            <label class="form-label" for="memo">メモ</label>
            <p v-if="messages.memo.length">
                <ul class="text-danger">
                    <li v-for="(message, key) in messages.memo" :key="key">{{ message }}</li>
                </ul>
            </p>
            <input v-model="memo" id="memo" class="form-control" />
        </div>

        <!-- 収入額 -->
        <div class="form-outline mb-4 text-left">
            <label class="form-label" for="expense">収入額</label>
            <p v-if="messages.amount.length">
                <ul class="text-danger">
                    <li v-for="(message, key) in messages.amount" :key="key">{{ message }}</li>
                </ul>
            </p>
            <input v-model="amount" type="number" id="expense" class="form-control" />
        </div>

        <!-- カテゴリー -->
        <div class="form-outline mb-4 text-left">
            <label class="form-label" for="expense">カテゴリー</label>
            <p v-if="messages.categoryId.length">
                <ul class="text-danger">
                    <li v-for="(message, key) in messages.categoryId" :key="key">{{ message }}</li>
                </ul>
            </p>
        </div>
        <div class="sample-form">
            <div class="categories" v-for="category in incomeCategoryList" :key="category.id">
                <input v-model="categoryId" :id="category.id" type="radio" :value="category.id">
                <label :for="category.id"><img :src="imgPath + '/' + category.img" width="60" height="60"></label>
                <p>{{ category.name }}</p>
            </div>
        </div>

        <button @click="submit" type="button" class="btn btn-primary btn-block mb-4">収入を登録する</button>
    </div>
</template>

<script>
import moment from 'moment'
export default {
    props: {
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
            paymentDate: '',
            memo: '',
            amount: '',
            categoryId: '',
            type: '2',
            messages: {
                paymentDate: [],
                memo: [],
                amount: [],
                categoryId: [],
                type: [],
                other: [],
            }
        }
    },
    mounted: function() {
        this.paymentDate = moment(new Date).format('YYYY-MM-DD');
    },
    methods: {
        async submit() {
            console.log('submit');
            Object.keys(this.messages).forEach((key) => {
                // エラーメッセージはリセット
                this.messages[key] = [];
            });

            let params = new URLSearchParams();
            params.append('payment_date', this.paymentDate);
            params.append('memo', this.memo);
            params.append('amount', this.amount);
            params.append('category_id', this.categoryId);
            params.append('type', this.type);

            await axios.post(this.storePath, params)
            .then(function(res) {
                console.log(res.data);
                let response = res.data;
                if (response.status == 'ng') {
                    // エラー時
                    let errors = response.content.errors;
                    Object.keys(errors).forEach((key) => {
                        // エラーメッセージ格納
                        let camelKey = this.fSnakeToCamel(key);
                        this.messages[camelKey] = errors[key];
                    });
                } else {
                    // 成功時
                    alert('登録しました');
                    this.resetAll();
                }
            }.bind(this))
            .catch(function(error) {
                if (error.response) {
                    console.log(error.response.data);
                    console.log(error.response.status);      // 例：400
                    console.log(error.response.statusText);  // Bad Request
                    console.log(error.response.headers);
                } else if (error.request) {
                    console.log(error.request);
                } else {
                    console.log('Error', error.message);
                }
                console.log(error.config);
                alert('処理に失敗しました');
            }.bind(this))
        },
        // 値を初期値に戻す
        resetAll() {
            this.payementDate = '';
            this.memo = '';
            this.amount = '';
            this.categoryId = '';
            this.type = '2';
            Object.keys(this.messages).forEach((key) => {
                this.messages[key] = [];
            });
        }
    }
}
</script>

<style>

</style>