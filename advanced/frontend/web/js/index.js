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
    myChart.setOption(option, true);
    //window.onresize = myChart.resize;
    if (option && typeof option === "object") {
        
    }
    
});
