$(function(){
    var dom = document.getElementById("main-chart");
    var myChart = echarts.init(dom);
    var app = {};
    option = null;
    option = {
        
        tooltip: {
            trigger: 'axis'
        },
        legend: {
            //data:['意向','order','成交']
        },
        toolbox: {
            //show: true,
            // feature: {
            //     //magicType: {show: true, type: ['stack', 'tiled']},
            //     saveAsImage: {show: true}
            // }
        },
        xAxis: {
            type: 'category',
            boundaryGap: false,
            data: ['周一','周二','周三','周四','周五','周六','周日']
        },
        yAxis: {
            type: 'value'
        },
        series: [
        {
            name: '成交',
            type: 'line',
            smooth: true,
            data: [10, 12, 21, 54, 260, 830, 710],
            itemStyle: {
                normal: {
                    areaStyle: {type: 'default'},
                    color:'#EEEEEE'
                }
            },
            lineStyle: {normal: {color:'#CCCCCC'}}
        },
        {
            name: 'Order',
            type: 'line',
            smooth: true,
            data: [30, 182, 434, 791, 390, 30, 10],
            itemStyle: {
                normal: {
                    areaStyle: {type: 'default'},
                    color:'rgb(214,237,255)'
                }
            },
            lineStyle: {normal: {color:'#00CCFF'}}
        },
        // {
        //     name: '意向',
        //     type: 'line',
        //     smooth: true,
        //     data: [1320, 1132, 601, 234, 120, 90, 20],
        //     itemStyle: {normal: {areaStyle: {type: 'default'}}},
        // }
        ]
    };
    window.onresize = myChart.resize;
    if (option && typeof option === "object") {
        myChart.setOption(option, true);
    }

    $(function(){
        $.ajax({
            url: '/site/index.html',
            type: 'get',
            dataType: 'json',
            data: {param1:'param1'},
            success: function(data, status) {
                console.log('success')
                console.log(data)
                // console.log(status)
                // if (data.ret_code != 0) {
                //     if (onerror) {
                //         onerror(data);
                //     }
                // }
                // var ret_msg = data.ret_msg;
                //callback(ret_msg, param);
            },
            error: function(xhr, status, msg) {
                console.log('error')
                // console.log(xhr)
                // console.log(status)
                console.log(msg)
                // if (msg.indexOf && msg.indexOf("Invalid JSON") == 0) {
                //    // swal(t_fields.errors_out, t_fields.network_timeout, "error");
                // } else {
                //     //msg && swal(t_fields.errors_out, t_fields.system_errors_out+'('+msg+')', "error");
                // }
            }
        })
    })
});
