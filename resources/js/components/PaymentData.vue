<template>
    <div>
        <table class="table">
            <!-- ここのループでエラー、どうするか -->
            <p v-for="(items, index) in payments" :key="index">{{ index }}</p>
            <tr v-for="item in items" :key="item.id">
                <td>{{ item.category_id }}</td>
                <td>{{ item.memo }}</td>
                <td>{{ item.amount }}円</td>
                <td>
                    <button class="btn btn-sm btn-primary">編集</button>
                </td>
            </tr>

            <p>07/16</p>
            <tr>
                <td>食費</td>
                <td>ここにメモああああああああああああ</td>
                <td>1000円</td>
                <td>
                    <button class="btn btn-sm btn-primary">編集</button>
                </td>
            </tr>
            <tr>
                <td>衣服</td>
                <td></td>
                <td>1500円</td>
                <td>
                    <button class="btn btn-sm btn-primary">編集</button>
                </td>
            </tr>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        payments: {
            type: Object,
            default: [],
        }
    }
}
</script>

<style>
    p {
        margin: 16px 0px;
    }
</style>