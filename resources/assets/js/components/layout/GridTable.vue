<template>
    <div>
        <template v-if="useGridFilterComponent">
            <component :is="gridFilterComponentName"
                :filters="filterableFields"
            ></component>
            <br/>
        </template>
        <vuetable ref="tableComponent"
              :api-url="apiUrl"
              :fields="tableFields"
              :per-page="perPage"
              :detail-row-component="detailRowComponentName"
              :append-params="additionalQueryParameters"
              :css="css"
              pagination-path=""
              @vuetable:cell-clicked="onCellClicked"
              @vuetable:pagination-data="onPaginationData"
        ></vuetable>
        <div class="level">
            <vuetable-pagination ref="paginationComponent"
                @vuetable-pagination:change-page="onChangePage"
            ></vuetable-pagination>
            <vuetable-pagination-info
                ref="paginationInfoComponent"
            ></vuetable-pagination-info>
        </div>
    </div>
</template>

<script>
    import Vuetable from 'vuetable-2/src/components/Vuetable'
    import VueEvents from 'vue-events'
    import VuetablePagination from './pagination/Pagination' // <-- Custom
    import VuetablePaginationInfo from './pagination/PaginationInfo' // <-- Custom
    Vue.use(VueEvents)
    export default {
        components: {
            Vuetable,
            VuetablePagination,
            VuetablePaginationInfo,
        },
        data: function() {
            return {
                additionalQueryParameters: {
                    api_token: window.Laravel.api_token
                },
                defaultQueryParameters: {
                    api_token: window.Laravel.api_token
                }
            }
        },
        props: {
            tableFields: {
                type: Array,
                default: function() {
                    return []
                }
            },
            detailRowComponentName: {
                type: String,
                default: ''
            },
            gridFilterComponentName: {
                type: String,
                default: ''
            },
            apiUrl: {
                type: String,
                default: ''
            },
            perPage: {
                type: Number,
                default: 15
            },
            css: {
                type: Object,
                default () {
                    return {
                        tableClass: 'table is-bordered is-striped is-narrow'
                    }
                }
            }
        },
        mounted () {
            this.$events.$on('filter-set', eventData => this.onFilterAdd(eventData))
            this.$events.$on('filter-remove', eventData => this.onFilterRemove(eventData))
        },
        computed: {
            useGridFilterComponent () {
                return this.detailRowComponent !== ''
            },
            filterableFields: function () {
                return this.tableFields.filter(item => {
                    return (
                            item.hasOwnProperty('filterable')
                                    ? (item.filterable)
                                    : true
                    )
                })
            }
        },
        methods: {
            onPaginationData (paginationData) {
                this.$refs.paginationComponent.setPaginationData(paginationData)
                this.$refs.paginationInfoComponent.setPaginationData(paginationData)
            },
            onChangePage (page) {
                this.$refs.tableComponent.changePage(page)
            },
            onCellClicked (data, field, event) {
                this.$refs.tableComponent.toggleDetailRow(data.id)
            },
            onFilterAdd (eventData) {
                // Format the filters correct to be put into 'additionalQueryParameters'
                let filters = {}
                Object.keys(eventData).forEach(function(key) {
                    filters[eventData[key].name] = eventData[key].filterValue
                });
                // Add the filters with the default query parameters
                this.additionalQueryParameters = Object.assign(this.defaultQueryParameters, filters)
                this.filterRefresh()
            },
            onFilterRemove (removedFilter) {
                // Remove the filter from 'additionalQueryParameters'
                this.$delete(this.additionalQueryParameters, removedFilter)
                this.filterRefresh()
            },
            filterRefresh() {
                Vue.nextTick(() => this.$refs.tableComponent.refresh())
            }
        }
    }
</script>