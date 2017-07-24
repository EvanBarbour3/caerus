<template>
    <div class="is-right"
         v-html="paginationInfo">
    </div>
</template>

<script>
    import DefaultPaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo.vue'

    export default {
        mixins: [DefaultPaginationInfo]
    }
</script>
