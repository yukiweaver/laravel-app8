<template>
    <div>
        <p>Hello world</p>
        <p>{{ monthlyStartDate }}</p>
    </div>
</template>

<script>
export default {
    props: {
        monthlyStartDate: {
            type: Number,
            default: 1,
        }
    }
}
</script>

<style>

</style>