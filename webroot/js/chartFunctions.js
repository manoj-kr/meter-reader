let mockData = [{
    "_id": {
        "year": 2019,
        "month": 3,
        "day": 8,
        "hour": 17,
        "minutes": 32,
        "week": 9
    },
    "count": 15
}, {
    "_id": {
        "year": 2019,
        "month": 3,
        "day": 8,
        "hour": 17,
        "minutes": 30,
        "week": 9
    },
    "count": 10
}, {
    "_id": {
        "year": 2019,
        "month": 3,
        "day": 8,
        "hour": 17,
        "minutes": 31,
        "week": 9
    },
    "count": 26
}];
loadData();
setInterval(function(){
    loadData();
}, 60000);

function formatData(data, type){
    if(data.length === 0){
        return {labels: [], dataset: []};
    }
    let returnData = [];
    let labels = [];
    switch(type){
        case 'yearly':
            for(let i = 0; i < data.length; i++){
                if(returnData.labels === undefined){
                    returnData.labels = [];
                }
                if(returnData.dataset === undefined){
                    returnData.dataset = [];
                }
                if(returnData.labels.indexOf(data[i]._id.year) === -1){
                    returnData.labels.push(data[i]._id.year);
                    returnData.dataset.push(data[i].count / 320);
                }else{
                    returnData.dataset[returnData.dataset.length - 1] += data[i].count / 320;
                }
            }
            return returnData;
        case 'monthly': 
            for(let i = 0; i < data.length; i++){
                if(returnData.labels === undefined){
                    returnData.labels = [];
                }
                if(returnData.dataset === undefined){
                    returnData.dataset = [];
                }
                if(returnData.labels.indexOf(data[i]._id.month) === -1){
                    returnData.labels.push(data[i]._id.month);
                    returnData.dataset.push(data[i].count / 320);
                }else{
                    returnData.dataset[returnData.dataset.length - 1] += data[i].count / 320;
                }
            }
            return returnData;
        case 'daywise': 
                for(let i = 0; i < data.length; i++){
                    if(returnData.labels === undefined){
                        returnData.labels = [];
                    }
                    if(returnData.dataset === undefined){
                        returnData.dataset = [];
                    }
                    if(returnData.labels.indexOf(data[i]._id.day) === -1){
                        returnData.labels.push(data[i]._id.day);
                        returnData.dataset.push(data[i].count / 320);
                    }else{
                        returnData.dataset[returnData.dataset.length - 1] += data[i].count / 320;
                    }
                }
                return returnData;
    }
}

function numRandom(){
    return (Math.random() * 20) + 1;
}
function loadData(){
    let startDate = $('#datepicker1').val();
    let endDate = $('#datepicker2').val();
    let url = 'http://3.0.148.82:3000/units';
    let params  = [];
    if(startDate){
        params.push('start='+startDate);
    }
    if(endDate){
        params.push('end='+endDate);
    }
    const queryParams = params.join('&');
    console.log("queryParams", queryParams);
    if(queryParams !== ''){
        url += '?' + queryParams; 
    }
    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'JSON',
        beforeSend: function(){
            $('.progress').fadeIn();
        },
        success: function(res){
            $('.progress').fadeIn();
            $('#amount').html(res.amount.toFixed(2));
            $('#units').html(res.units.toFixed(2));
            let data = formatData(res.data, 'monthly');
            var ctx = document.getElementById("myChart").getContext('2d');
            let config = {
                type: 'line',
                data: {
                labels: data.labels,
                    datasets: [{
                        label: '# of Units',
                        data: data.dataset,
                        backgroundColor: [
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderColor: [
                            'rgba(255,99,132,1)',
                            'rgba(54, 162, 235, 1)',
                            'rgba(255, 206, 86, 1)',
                            'rgba(75, 192, 192, 1)',
                            'rgba(153, 102, 255, 1)',
                            'rgba(255, 159, 64, 1)',
                            'rgba(255, 99, 132, 0.2)',
                            'rgba(54, 162, 235, 0.2)',
                            'rgba(255, 206, 86, 0.2)',
                            'rgba(75, 192, 192, 0.2)',
                            'rgba(153, 102, 255, 0.2)',
                            'rgba(255, 159, 64, 0.2)'
                        ],
                        borderWidth: 1
                    }]
                }    
            }
            let myChart = new Chart(ctx, config);
            myChart.update();
        },
        complete: function(){
            $('.progress').fadeOut();
        },
        error: function(){
            console.log('There was some error while requesting')
        }
    });
}
