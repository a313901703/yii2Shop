const item = {
    date: '2016-05-02',
    name: '王小虎',
    address: '上海市普陀区金沙江路 1518 弄'
};
new Vue({
    el: '#site-index',
    data: function() {
        return { 
            visible: false,
        }
    },
    computed: {
        // 计算属性的 getter
        tableData: function () {
            return Array(20).fill(item)
            // `this` 指向 vm 实例
            //return this.message.split('').reverse().join('')
        }
    }
})
