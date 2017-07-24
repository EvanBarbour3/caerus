<template>
    <grid-table
            :tableFields="fields"
            :gridFilterComponentName="gridFilterComponentName"
            :apiUrl="apiUrl"
    ></grid-table>
</template>

<script>
    import GridTable from '../layout/GridTable'
    import FilterBar from '../layout/GridTableFilter'
    Vue.component('filter-bar', FilterBar)
    export default {
        components: {
            GridTable
        },
        data () {
            return {
                gridFilterComponentName: 'filter-bar',
                apiUrl: '/api/orders',
                fields: [
                    {
                        name: 'user',
                        title: 'User'
                    },
                    {
                        name: 'description',
                        title: 'Description'
                    },
//                    {
//                        name: 'active',
//                        title: 'Active',
//                        dataClass: 'has-text-centered',
//                        callback: this.loanIsActive
//                    },
//                    {
//                        name: '__component:loan-actions',
//                        title: 'Actions',
//                        filterable: false
//                    }
                ],
            }
        },
        methods: {
            loanIsActive (value) {
                return value == 0 ?
                        '<span class="icon is-small"><i class="fa fa-times" aria-hidden="true"></i></span>' :
                        '<span class="icon is-small"><i class="fa fa-times" aria-hidden="true"></i></span>'
            }
        }
    }
</script>