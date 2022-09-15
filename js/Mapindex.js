var RegAllCases=0,RegNone=0,RegInternal=0,RegExternal=0,RegRecived=0,RegPending=0,RegAll=0,RegMale=0,RegFemale=0;
//$.each(JsRegMapData,function(k,i){regions.push({"region_name": i.Province_title, "region_code": i.Province_id,"population": i.NoOfReg,"label":i.Province_title});});
console.log(regions);
$.each(RegAllAttachment,function(k,i){
	RegAllCases=i.Allcases,RegAll=i.allchilds,RegNone=i.noneed,RegInternal=i.internal,RegExternal=i.external,RegRecived=i.recived,RegPending=i.pending,RegMale=i.male,RegFemale=i.female;
      
	});
	


var temp_array= regions.map(function(item){
    return item.population;
});
var highest_value = Math.max.apply(Math, temp_array);

$(function() {

    for(i = 0; i < regions.length; i++) {

        $('#'+ regions[i].region_code)
        .css({'fill': 'rgba(11, 104, 170,' + regions[i].population/highest_value +')'})
        .data('region', regions[i]).attr('title',regions[i].Province_title);
		
    }

    $('.map g').mouseover(function (e) {
        var region_data=$(this).data('region');
        $('<div class="info_panel">'+
            region_data.region_name + '<br>' +
          	'عدد المسجلين: ' + region_data.population +
          	'</div>'
         )
        .appendTo('body');
    })
    .mouseleave(function () {
        $('.info_panel').remove();
    })
    .mousemove(function(e) {
        var mouseX = e.pageX, //X coordinates of mouse
            mouseY = e.pageY; //Y coordinates of mouse

        $('.info_panel').css({
            top: mouseY-50,
            left: mouseX - ($('.info_panel').width()/2)
        });
    });

});

/*Docunt Chart */
/*var QlfData=[];
$.each(JsRegDcount,function(k,i){QlfData.push({ "المؤهل": i.Qualification_title, "العدد": i.NoOfReg});});*/
var chartData = [ {
  "country": "قيد الانتظار",
  "visits": RegPending,
  "color": "#FF9E01"
}, {
  "country": "مستلمة",
  "visits": RegRecived,
  "color": "#F8FF01"
}, {
  "country": "احالة داخلية",
  "visits": RegInternal,
  "color": "#B0DE09"
}, {
  "country": "احالة خارجية",
  "visits": RegExternal,
  "color": "#04D215"
}, {
  "country": "لا يحتاج لعناية",
  "visits": RegNone,
  "color": "#0D8ECF"
}];
var chart = AmCharts.makeChart( "chartdiv", {
  "type": "pie",
  "theme": "light",
  "titles": [ {
    "text": "",
    "size": 10
  } ],
  "dataProvider":chartData,
  "valueField": "visits",
  "titleField": "country",
  "startEffect": "elastic",
  "startDuration": 2,
  "labelRadius": 15,
  "innerRadius": "50%",
  "depth3D": 2,
  "balloonText": "[[title]]<br><span style='font-size:14px'><b>[[value]]</b> ([[percents]]%)</span>",
  "angle": 15,
  "export": {
    "enabled": true
  }
} );
/*Gender Chart */
var chart = AmCharts.makeChart("Regchartdiv",
{
    "type": "serial",
    "theme": "light",
    "dataProvider": [ {
        "name": "ذكور",
        "points": RegMale,
        "color": "#FEC514",
        "bullet": "https://www.amcharts.com/lib/images/faces/C02.png"
    }, {
        "name": "إناث",
        "points": RegFemale,
        "color": "#DB4C3C",
        "bullet": "https://www.amcharts.com/lib/images/faces/D02.png"
    }],
    "valueAxes": [{
        "maximum": RegAll,
        "minimum": 0,
        "axisAlpha": 0,
        "dashLength": 4,
        "position": "left"
    }],
    "startDuration": 1,
    "graphs": [{
        "balloonText": "<span style='font-size:13px;'>[[category]]: <b>[[value]]</b></span>",
        "bulletOffset": 10,
        "bulletSize": 52,
        "colorField": "color",
        "cornerRadiusTop": 8,
        "customBulletField": "bullet",
        "fillAlphas": 0.8,
        "lineAlpha": 0,
        "type": "column",
        "valueField": "points"
    }],
    "marginTop": 8,
    "marginRight": 0,
    "marginLeft": 0,
    "marginBottom": 0,
    "autoMargins": true,
    "categoryField": "name",
    "categoryAxis": {
        "axisAlpha": 0,
        "gridAlpha": 0,
        "inside": true,
        "tickLength": 0
    },
    "export": {
    	"enabled": true
     }
});
/*Canvas */
//RegAllCases=0,RegNone=0,RegInternal=0,RegExternal=0,RegRecived=0,RegPending=0



var chart = AmCharts.makeChart( "Canvaschartdiv", {
  "theme": "light",
  "type": "serial",
  "dataProvider": chartData,
  "categoryField": "country",
  "depth3D": 20,
  "angle": 30,

  "categoryAxis": {
    "labelRotation": 90,
    "gridPosition": "start"
  },

  "valueAxes": [ {
    "title": "Visitors"
  } ],

  "graphs": [ {
    "valueField": "visits",
    "colorField": "color",
    "type": "column",
    "lineAlpha": 0.1,
    "fillAlphas": 1
  } ],

  "chartCursor": {
    "cursorAlpha": 0,
    "zoomable": false,
    "categoryBalloonEnabled": false
  },

  "export": {
    "enabled": true
  }
} ); 

/*WheelChart gauge */
var Wheelchart = AmCharts.makeChart("Wheelchartdiv", {
  "theme": "light",
  "type": "gauge",
  "axes": [{
    "topTextFontSize": 20,
    "topTextYOffset": 70,
    "axisColor": "#31d6ea",
    "axisThickness": 1,
    "endValue": RegAll,
    "gridInside": true,
    "inside": true,
    "radius": "50%",
    "valueInterval": (RegAll/1).toFixed(0),
    "tickColor": "#67b7dc",
    "startAngle": -90,
    "endAngle": 90,
    "unit": "",
    "bandOutlineAlpha": 0,
    "bands": [{
      "color": "#0080ff",
      "endValue": RegAll,
      "innerRadius": "105%",
      "radius": "170%",
      "gradientRatio": [0.5, 0, -0.5],
      "startValue": 0
    }, {
      "color": "#3cd3a3",
      "endValue": 0,
      "innerRadius": "105%",
      "radius": "170%",
      "gradientRatio": [0.5, 0, -0.5],
      "startValue": 0
    }]
  }],
  "arrows": [{
    "alpha": 1,
    "innerRadius": "35%",
    "nailRadius": 0,
    "radius": "170%"
  }]
});
setInterval(randomValue, 2000);

// set random value
function randomValue() {
  var value = RegMale;
  Wheelchart.arrows[0].setValue(value);
  Wheelchart.axes[0].setTopText(RegAll );
  // adjust darker band to new value
  Wheelchart.axes[0].bands[1].setEndValue(value);
}

/*BarChart */
/*var regDatechart=[];

$.each(JsRegDate,function(k,i){regDatechart.push({"date":i.Created_date ,"value":i.count});});*/
//console.log(JsRegDate);
//console.log(regDatechart);
var chart = AmCharts.makeChart("RegDateschartdiv", {
    "type": "serial",
    "theme": "light",
    "marginRight": 40,
    "marginLeft": 40,
    "autoMarginOffset": 20,
    "mouseWheelZoomEnabled":true,
    "dataDateFormat": "YYYY-MM-DD",
    "valueAxes": [{
        "id": "v1",
        "axisAlpha": 0,
        "position": "left",
        "ignoreAxisWidth":true
    }],
    "balloon": {
        "borderThickness": 1,
        "shadowAlpha": 0
    },
    "graphs": [{
        "id": "g1",
        "balloon":{
          "drop":true,
          "adjustBorderColor":false,
          "color":"#ffffff"
        },
        "bullet": "round",
        "bulletBorderAlpha": 1,
        "bulletColor": "#FFFFFF",
        "bulletSize": 5,
        "hideBulletsCount": 50,
        "lineThickness": 2,
        "title": "red line",
        "useLineColorForBulletBorder": true,
        "valueField": "count",
        "balloonText": "<span style='font-size:18px;'>[[count]]</span>"
    }],
    "chartScrollbar": {
        "graph": "g1",
        "oppositeAxis":false,
        "offset":30,
        "scrollbarHeight": 80,
        "backgroundAlpha": 0,
        "selectedBackgroundAlpha": 0.1,
        "selectedBackgroundColor": "#888888",
        "graphFillAlpha": 0,
        "graphLineAlpha": 0.5,
        "selectedGraphFillAlpha": 0,
        "selectedGraphLineAlpha": 1,
        "autoGridCount":true,
        "color":"#AAAAAA"
    },
    "chartCursor": {
        "pan": true,
        "valueLineEnabled": true,
        "valueLineBalloonEnabled": true,
        "cursorAlpha":1,
        "cursorColor":"#258cbb",
        "limitToGraph":"g1",
        "valueLineAlpha":0.2,
        "valueZoomable":true
    },
    "valueScrollbar":{
      "oppositeAxis":false,
      "offset":50,
      "scrollbarHeight":10
    },
    "categoryField": "Created_date",
    "categoryAxis": {
        "parseDates": true,
        "dashLength": 1,
        "minorGridEnabled": true
    },
    "export": {
        "enabled": true
    },
    "dataProvider": JsRegDate
});

chart.addListener("rendered", zoomChart, {passive: true});

zoomChart();

function zoomChart() {
    chart.zoomToIndexes(chart.dataProvider.length - 40, chart.dataProvider.length - 1);
}