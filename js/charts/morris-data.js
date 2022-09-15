$(function() {var Donutdata=[];
$.each(GenSrvRpt,function(k,i){Donutdata.push({y: i.ServiceTitle,a: i.NoOfBnfMales ,b: i.NoOfBnfFemales});
	
	});
	



    Morris.Bar({
        element: 'morris-bar-chart',
        data: Donutdata,
        xkey: ['y'],
        ykeys: ['a', 'b'],
        labels: ['الذكور', 'الإناث'],
        hideHover: 'auto',
        resize: true
    });
    /*Exp Cat */
	var ActBnfData=[];
	$.each(actBnfRpt,function(k,i){ActBnfData.push({"Ativity":i.Title,
        "NOOfBnf": i.NoOfBeneficiaries});});
	var ExpCatchart = AmCharts.makeChart("ExpCatchartdiv", {
    "theme": "light",
    "type": "serial",
    "dataProvider": ActBnfData,
    "valueAxes": [{
        "title": ""
    }],
    "graphs": [{
        "balloonText": "عدد المسجيلن في: [[category]]:[[value]]",
        "fillAlphas": 1,
        "lineAlpha": 0.2,
        "title": "NOOfBnf",
        "type": "column",
        "valueField": "NOOfBnf"
    }],
    "depth3D": 20,
    "angle": 30,
    "rotate": true,
    "categoryField": "Ativity",
    "categoryAxis": {
        "gridPosition": "start",
        "fillAlpha": 0.05,
        "position": "right"
    },
    "export": {
    	"enabled": true
     }
});
});

