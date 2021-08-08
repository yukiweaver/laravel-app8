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
                        <button class="btn btn-sm btn-primary">編集</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: {
        initialPayments: {
            type: Object,
            default: [],
        },
        categories: {
            type: Array,
            default: [],
        },
    },
    methods: {
        getCategoryName(categories, categoryId) {
            return this.getCategoryNameById(categories, categoryId);
        }
    }
}
</script>

<style>
    p {
        margin: 16px 0px;
    }
</style>