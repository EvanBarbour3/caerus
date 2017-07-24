<template>
    <div v-if="tablePagination && tablePagination.last_page > 1">
        <div>
            <a @click="loadPage(1)"
               :class="css.linkClass"
               :disabled="isOnFirstPage">
                <i v-if="css.icons.first != ''" :class="[css.icons.first]"></i>
                <span v-else>&nbsp;First</span>
            </a>
            <a @click="loadPage('prev')"
               :class="css.linkClass"
               :disabled="isOnFirstPage">
                <i v-if="css.icons.prev != ''" :class="[css.icons.prev]"></i>
                <span v-else>&nbsp;Prev</span>
            </a>
            <template v-if="notEnoughPages">
                <template v-for="n in totalPage">
                    <a @click="loadPage(n)"
                       :class="[css.pageClass, isCurrentPage(n) ? css.activeClass : '']"
                       v-html="n">
                    </a>
                </template>
            </template>
            <template v-else>
                <template v-for="n in windowSize">
                    <a @click="loadPage(windowStart+n-1)"
                       :class="[css.pageClass, isCurrentPage(windowStart+n-1) ? css.activeClass : '']"
                       v-html="windowStart+n-1">
                    </a>
                </template>
            </template>
            <a @click="loadPage('next')"
               :class="css.linkClass"
               :disabled="isOnLastPage">
                <i v-if="css.icons.next != ''" :class="[css.icons.next]"></i>
                <span v-else>Next&nbsp;</span>
            </a>
            <a @click="loadPage(totalPage)"
               :class="css.linkClass"
               :disabled="isOnLastPage">
                <i v-if="css.icons.last != ''" :class="[css.icons.last]"></i>
                <span v-else>Last</span>
            </a>
        </div>
    </div>
</template>

<script>
    import DefaultPagination from 'vuetable-2/src/components/VuetablePagination.vue'

    export default {
        mixins: [DefaultPagination],
        props: {
            css: {
                type: Object,
                default: function() {
                    return {
                        pageClass: 'pagination-link',
                        icons: {
                            first: '', // fa fa-angle-double-left
                            prev: '', // fa fa-angle-left
                            next: 'fa fa-angle-right',
                            last: 'fa fa-angle-double-right',
                        },
                        activeClass: 'is-current',
                        linkClass: 'pagination-link',
                    }
                }
            }
        }
    }
</script>
