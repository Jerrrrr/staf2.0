 // console.log(graficJS_HD);
 //  console.log(graficJS_VD);

 //console.log(graficJsData);
  var dom = document.getElementById("chart");
  var myChart = echarts.init(dom);
  var app = {};
  option = null;
  // color = #1ABB9C
  option = {
      title: {
          text: 'Kinderen per dag'
      },
      tooltip : {
          trigger: 'axis',
          axisPointer: {
              type: 'cross',
              label: {
                  backgroundColor: '#73879C'
              }
          }
      },
      legend: {
          data:['Kinderen Totaal', 'Kinderen Volle Dag', 'Kinderen Halve dag']
      },
      toolbox: {
          feature: {
              saveAsImage: {}
          }
      },
      grid: {
          left: '3%',
          right: '4%',
          bottom: '5%',
          containLabel: true
      },
      xAxis : [
          {
              type : 'category',
              boundaryGap : false,
              data : ['W1 Dag 1', 'W1 Dag 2','W1 Dag 3','W1 Dag 4','W1 Dag 5',
                      'W2 Dag 1', 'W2 Dag 2','W2 Dag 3','W2 Dag 4','W2 Dag 5',
                      'W3 Dag 1', 'W3 Dag 2','W3 Dag 3','W3 Dag 4','W3 Dag 5',
                      'W4 Dag 1', 'W4 Dag 2','W4 Dag 3','W4 Dag 4','W4 Dag 5',
                      'W5 Dag 1', 'W5 Dag 2','W5 Dag 3','W5 Dag 4','W5 Dag 5']

          }
      ],
      yAxis : [
          {
              type : 'value',
			  max: 300
          }
      ],
      series : [
        {
            name:'Kinderen Totaal',
            type:'line',
            label: {
                normal: {
                    show: true,
                    position: 'top'
                }
            },
            itemStyle: {
                 normal: {
                     color: 'rgba(26, 187, 156, 0.5)',
                     lineStyle: {        // 系列级个性化折线样式
                         width: 2,
                     }
                 }
            },
            areaStyle: {normal: {}},
            data:graficJS
        },
        {
           name:'Kinderen Volle Dag',
           type:'line',
           areaStyle: {normal: {}},
           itemStyle: {
                normal: {
                    color: 'rgba(26, 187, 156, 0.5)',
                    lineStyle: {        // 系列级个性化折线样式
                        width: 2,
                    }
                }
           },
           data: graficJS_VD
       },
       {
           name:'Kinderen Halve dag',
           type:'line',
           areaStyle: {normal: {}},
           itemStyle: {
                normal: {
                    color: 'rgba(26, 187, 156, 0.5)',
                    lineStyle: {        // 系列级个性化折线样式
                        width: 2,
                    }
                }
           },
           data: graficJS_HD
       }
      ]
  };
  ;
  if (option && typeof option === "object") {
      myChart.setOption(option, true);
  }
