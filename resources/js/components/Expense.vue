<template>
    <div class="card-text">
        <!-- 日付 -->
        <div class="form-outline mb-4 text-left">
            <label class="form-label" for="payment_date">日付</label>
            <input type="date" id="payment_date" class="form-control" />
        </div>

        <!-- メモ -->
        <div class="form-outline mb-4 text-left">
            <label class="form-label" for="memo">メモ</label>
            <input type="email" id="memo" class="form-control" />
        </div>

        <!-- 支出額 -->
        <div class="form-outline mb-4 text-left">
            <label class="form-label" for="expense">支出額</label>
            <input type="number" id="expense" class="form-control" />
        </div>

        <!-- カテゴリー -->
        <div class="form-outline mb-4 text-left">
            <label class="form-label" for="expense">カテゴリー</label>
        </div>
        <div class="sample-form">
            <div class="categories" v-for="category in categoryList" :key="category.id">
                <input :id="category.id" type="radio" :value="category.id" name="category_id">
                <label :for="category.id"><img :src="imgPath + '/' + category.img" width="60" height="60"></label>
                <p>{{ category.name }}</p>
            </div>
        </div>

        <button type="submit" class="btn btn-primary btn-block mb-4">支出を登録する</button>
    </div>
</template>

<script>
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
    }
}
</script>

<style>

</style>