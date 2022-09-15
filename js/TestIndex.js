var NoOfValuedService=0,NoOfPhyscServices=0,NoOfEchnServices=0;
$.each(ServiceCats,function(k,i){
	if(i.Service_cat==380)
		NoOfValuedService +=i.NoOfSrv;
	 else if(i.Service_cat==381)
	   NoOfPhyscServices +=i.NoOfSrv;
   else
	    NoOfEchnServices +=i.NoOfSrv;
});

var chart = AmCharts.makeChart("ServiceChart",
{
    "type": "serial",
    "theme": "light",
    "dataProvider": [{
        "name": "مساعدات طبية",
        "points": NoOfValuedService,
        "color": "#7F8DA9",
       
    }, {
        "name": "دعم نفسي اجتماعي",
        "points": NoOfPhyscServices,
        "color": "#FEC514"
       
    }, { 
        "name": "دعم نفسي إقتصادي",
        "points": NoOfEchnServices,
        "color": "#DB4C3C"
       
    }, ],
    "valueAxes": [{
        "maximum": 1000,
        "minimum": 0,
        "axisAlpha": 0,
        "dashLength": 3,
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
    "marginTop": 10,
    "marginRight": 0,
    "marginLeft": 20,
    "marginBottom": 10,
    "autoMargins": false,
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