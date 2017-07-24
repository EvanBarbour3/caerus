<template>
    <div ref="filterTemplate">
        <template v-if="filtersAdded">
            <div class="level">
                <div class="level-left">
                    <template v-for="n, key in filtersAdded">
                        <div class="level-item">
                            <span class="tag is-primary">
                            {{ n.title }}: {{n.filterValue}}
                            <button class="delete is-small" @click="removeFilter(n.name, key)"></button>
                        </span>
                        </div>
                    </template>
                </div>
            </div>
        </template>
        <template v-if="filtersRemaining">
            <div class="level">
                <div class="level-left">
                    <div class="level-item">
                        <div class="field">
                            <p class="control">
                            <span class="select">
                                <select ref="filterSelect" v-model="filterName" required>
                                    <option hidden disabled selected value="">Filter option</option>
                                    <template v-for="n, key in filtersRemaining">
                                        <option :value="n.name"
                                                v-html="n.name"
                                        ></option>
                                    </template>
                                </select>
                            </span>
                            </p>
                        </div>
                    </div>
                    <div class="level-item">
                        <div class="field">
                            <p class="control">
                                <input class="input" type="text" v-model="filterValue" @keyup.enter="addFilter" ref="filterValue">
                            </p>
                        </div>
                    </div>
                    <div class="level-item">
                        <div class="field">
                            <p class="control">
                                <button class="button is-primary" type="button" @click="addFilter">Add filter</button>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </template>
    </div>
</template>

<script>
    export default {
        data () {
            return {
                filtersRemaining: [],
                filtersAdded: {},
                filterName: '',
                filterValue: ''
            }
        },
        props: {
            filters: {
                type: Array,
                default() {
                    return []
                }
            },
        },
        mounted () {
            this.filtersRemaining = Array.from(this.filters)
        },
        methods: {
            addFilter () {
                // Get the filter index which is passed into the component, from the selected filter in the drop down
                let addIndex = this.filters.map((el) => el.name).indexOf(this.filterName)
                this.$set(this.filtersAdded, addIndex, this.filters[addIndex])
                this.$set(this.filtersAdded[addIndex], 'filterValue', this.filterValue)
                let removeIndex = this.filtersRemaining.map((el) => el.name).indexOf(this.filterName)
                this.$delete(this.filtersRemaining, removeIndex)
                this.$events.fire('filter-set', this.filtersAdded)
                this.filterInputRefresh()
            },
            removeFilter (filterName, key) {
                // Get the index of the filter which was passed into the component originally
                let givenFilterIndex = this.filters.map((el) => el.name).indexOf(filterName)
                // Remove, from the list of currently added filters, the filter which is being removed
                this.$delete(this.filtersAdded, key)
                // Remove the 'filterValue' on the original given filter index (Due to JavaScript referencing)
                this.$delete(this.filters[givenFilterIndex], 'filterValue')
                // Populate remaining filters list again
                this.filtersRemaining.push(this.filters[givenFilterIndex])
                // Fire event so other components can handle changes
                this.$events.fire('filter-remove', filterName)
                // Refresh the inputs
                this.filterInputRefresh()
            },
            filterInputRefresh () {
                // Set the dropdown filter back to default
                this.filterName = ''
                // set the input filter back to default
                this.filterValue = ''
            }
        }
    }
</script>