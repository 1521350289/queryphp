import http from '@/utils/http'
import {validateAlphaDash} from '@/utils/validate'
import Vue from 'vue'

import search from './../search/index'

export default {
    components: {
        search,
    },
    data() {
        return {
            columns: [
                {
                    type: 'selection',
                    width: 40,
                    align: 'center',
                    className: 'table-selection',
                },
                {
                    type: 'index',
                    width: 20,
                    align: 'center',
                    className: 'table-index',
                },
                {
                    title: '名字',
                    key: 'name',
                },
                {
                    title: '标识符',
                    key: 'identity',
                },
                {
                    title: '状态',
                    key: 'status_enum',
                    width: 120,
                    render: (h, params) => {
                        const row = params.row
                        return (
                            <tag
                                type="dot"
                                color={
                                    row.status === '1' ? 'green' : 'default'
                                }>
                                {row.status_enum}
                            </tag>
                        )
                    },
                },
                {
                    title: '操作',
                    key: 'action',
                    width: 120,
                    align: 'right',
                    render: (h, params) => {
                        return (
                            <dropdown
                                placement="bottom-end"
                                style="textAlign: left;"
                                on-on-click={name => this[name](params)}>
                                <a href="javascript:void(0)">
                                    <icon type="more" />
                                </a>
                                <dropdownMenu slot="list">
                                    <dropdownItem name="edit">
                                        <icon type="edit" /> {__('编辑')}
                                    </dropdownItem>
                                    <dropdownItem name="remove">
                                        <icon type="trash-b" /> {__('删除')}
                                    </dropdownItem>
                                </dropdownMenu>
                            </dropdown>
                        )
                    },
                },
            ],
            total: 0,
            page: 1,
            pageSize: 10,
            data: [],
            tableHeight: 'auto',
            loadingTable: true,
            dataBackup: null,
            formItem: {
                id: null,
                name: '',
                identity: '',
                status: true,
            },
            minForm: false,
            rules: {
                name: [
                    {
                        required: true,
                        message: __('请输入角色名字'),
                    },
                ],
                identity: [
                    {
                        required: true,
                        message: __('请输入角色标识符'),
                    },
                ],
            },
            loading: false,
            selectedData: [],
        }
    },
    methods: {
        getDataFromSearch(data) {
            this.data = data.data
            this.total = data.page.total_record
            this.loadingTable = false
        },
        edit(params) {
            let row = params.row
            this.minForm = true
            this.formItem.id = row.id

            let data = {}
            Object.keys(this.formItem).forEach(item => (data[item] = row[item]))
            data.status = data.status == '1' ? true : false
            this.formItem = data
        },
        add: function() {
            this.minForm = true
            this.formItem.id = ''
        },
        remove(params) {
            this.$Modal.confirm({
                title: __('提示'),
                content: __('确认删除该角色?'),
                onOk: () => {
                    this.apiDelete('role', params.row.id).then(res => {
                        utils.success(res.message)

                        this.data.splice(params.index, 1)
                    })
                },
                onCancel: () => {},
            })
        },
        status(nodeData, status) {
            this.apiPut('structure/enable', nodeData.id, {
                status: status,
            }).then(res => {
                this.$set(nodeData, 'status', status)
                utils.success(res.message)
            })
        },
        statusMany(type) {
            let selected = this.selectedData

            if (!selected.length) {
                utils.warning(__('请勾选数据'))
                return
            }

            let data = {
                ids: selected,
                status: type,
            }

            this.apiPost('role/status', data).then(res => {
                this.data.forEach((item, index) => {
                    if (selected.includes(item.id)) {
                        this.$set(this.data[index], 'status', type)
                        this.$set(
                            this.data[index],
                            'status_enum',
                            type === '1' ? __('启用') : __('禁用')
                        )
                    }
                })

                utils.success(res.message)
            })
        },
        onSelectionChange(data) {
            let ids = []

            data.forEach(item => ids.push(item.id))

            this.selectedData = ids
        },
        init: function() {
            this.apiGet('role').then(res => {
                this.data = res.data
                this.total = res.page.total_record
                this.loadingTable = false
            })
        },
        handleSubmit(form) {
            this.$refs[form].validate(pass => {
                if (pass) {
                    this.loading = !this.loading
                    if (!this.formItem.id) {
                        this.saveResource(form)
                    } else {
                        this.updateResource(form)
                    }
                }
            })
        },
        saveResource(form) {
            var formData = this.formItem
            formData.status = formData.status ? '1' : '0'

            this.apiPost('role', formData).then(
                res => {
                    const addNode = {
                        name: res.name,
                        identity: res.identity,
                        id: res.id,
                        status: res.status,
                        status_enum: res.status_enum,
                    }

                    this.data.unshift(addNode)

                    this.loading = !this.loading
                    this.cancelMinForm(form)

                    utils.success(res.message)
                },
                res => {
                    this.loading = !this.loading
                }
            )
        },
        updateResource(form) {
            var formData = this.formItem
            formData.status = formData.status ? '1' : '0'

            this.apiPut('role', this.formItem.id, formData).then(
                res => {
                    this.data.forEach((item, index) => {
                        if (item.id === this.formItem.id) {
                            this.$set(this.data, index, res)
                        }
                    })

                    this.loading = !this.loading
                    this.cancelMinForm(form)

                    utils.success(res.message)
                },
                res => {
                    this.loading = !this.loading
                }
            )
        },
        handleReset(form) {
            this.$refs[form].resetFields()
        },
        changePage(page) {
            this.page = page
            this.$refs.search.search(page, this.pageSize)
        },
        changePageSize(pageSize) {
            this.pageSize = pageSize
            this.$refs.search.search(this.page, pageSize)
        },
        cancelMinForm: function(form) {
            this.minForm = false
            this.handleReset(form)
        },
    },
    computed: {},
    created: function() {
        this.init()
    },
    mounted: function() {},
    activated: function() {
        if (utils.needRefresh(this)) {
            this.init()
        }
    },
    mixins: [http],
}
