<template>
    <grid-table
            :tableFields="fields"
            :gridFilterComponentName="gridFilterComponentName"
            :detailRowComponent="detailRowComponent"
            :apiUrl="apiUrl"
    ></grid-table>
</template>

<script>
    import GridTable from '../layout/GridTable'
    import FilterBar from '../layout/GridTableFilter'
    import DetailRow from './IndexDetail'

    Vue.component('detail-row', DetailRow)
    Vue.component('filter-bar', FilterBar)
    export default {
        components: {
            GridTable
        },
        data () {
            return {
                detailRowComponent: 'detail-row',
                gridFilterComponentName: 'filter-bar',
                apiUrl: '/api/orders',
                fields: [
                    {
                        name: 'id',
                    },
                    {
                        name: 'user',
                    },
                    {
                        name: 'description',
                    },
                    {
                        name: 'total_amount',
                        title: 'Total Amount',
                        callback: this.displayAmount,
                        filterable: false
                    }
                ],
            }
        },
        methods: {
            displayAmount (value) {
                return '£' + (value / 100).toFixed(2);
            }
        }
    }
</script>