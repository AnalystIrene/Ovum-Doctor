function drawLineGraph(elementid, chartid, width, height, x_axis_records, y_axis_records, data, biggest, smallest){
    canvas = document.getElementById(chartid);

    heights_of_elements = [];

    size_of_periods = []

    highest = 44;
    lowest = height - 40;

    difference = highest - lowest;

    for(let i = 0; i < data.length; i++){
        heights_of_elements[i] = ((difference/(biggest - smallest)) * (biggest - data[i])) + lowest
    }

    canvas.width = width;
    canvas.height = height;
    canvas.className = "myChart";
    //canvas.style.backgroundColor = 'red';

    const ctx = canvas.getContext("2d");

    max_number = 0;

    ctx.strokeStyle = "black";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(40,15);
    ctx.lineTo(40, height - 40);
    ctx.stroke();

    ctx.strokeStyle = "black";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(40, height - 40);
    ctx.lineTo(width - 20, height - 40);
    ctx.stroke();

    ctx.font ="bold 12px Arial";
    ctx.fillText("Cycle dates", (width/2) - 40, height - 10);

    for(let i = 0; i < x_axis_records.length; i++){

        ctx.strokeStyle = "black";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(60 + ((width - 40)/6) * i, (height - 40) - 3);
        ctx.lineTo(60 + ((width - 40)/6) * i,(height - 40) + 3);
        ctx.stroke();
    
        ctx.font ="bold 10px Arial";
        ctx.fillText(x_axis_records[i], 40 + ((width - 40)/6) * i, height - 25);
    }

    for(let a = y_axis_records.length - 1; a >= 0; a--){
        ctx.strokeStyle = "black";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(37, 44 + (a * (((height - 30)/(y_axis_records.length)))));
        ctx.lineTo(43, 44 + (a * (((height - 30)/(y_axis_records.length)))));
        ctx.stroke();
    
        ctx.font ="bold 10px Arial";
        ctx.fillText(y_axis_records[(y_axis_records.length - 1) - a], 24, 48 + a * ((height - 30)/y_axis_records.length));
    }

    for(let b = 0; b < heights_of_elements.length - 1; b++){
        ctx.strokeStyle = "black";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(60 + ((width - 40)/6) * b, 44 + (lowest - heights_of_elements[b]));
        ctx.lineTo(60 + ((width - 40)/6) * (b + 1), 44 + (lowest - heights_of_elements[b + 1]));
        ctx.stroke();
    }

}

function drawBarGraph(elementid, chartid, width, height, x_axis_records, y_axis_records, data, biggest, smallest, symptoms_for_month){
    const canvas = document.getElementById(chartid);
    colors = ['red', 'blue', 'black', 'violet', 'yellow', 'green']

    heights_of_elements= [];

    size_of_blues = (60 + ((width - 40)/6) * 2) - (60 + ((width - 40)/6))

    highest = 44;
    lowest = height - 40;

    difference = highest - lowest;

    for(let i = 0; i < symptoms_for_month.length; i++){

        heights_of_elements[i] = [];

        for(let d = 0; d < symptoms_for_month[i].length; d++){

            //console.log(symptoms_for_month[i][d])

            heights_of_elements[i].push(((difference/(biggest - smallest)) * (biggest - Object.values(symptoms_for_month[i][d])[0])) + lowest);
        }
        
    }

    //console.log(symptoms_for_month[0].length)

    //console.log(heights_of_elements);

    canvas.width = width;
    canvas.height = height;
    canvas.className = "myChart";
    //canvas.style.backgroundColor = 'red';

    const ctx = canvas.getContext("2d");

    max_number = 0;

    ctx.strokeStyle = "black";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(40,15);
    ctx.lineTo(40, height - 40);
    ctx.stroke();

    ctx.strokeStyle = "black";
    ctx.lineWidth = 2;
    ctx.beginPath();
    ctx.moveTo(40, height - 40);
    ctx.lineTo(width - 20, height - 40);
    ctx.stroke();

    ctx.font ="bold 12px Arial";
    ctx.fillText("Cycle dates", (width/2) - 40, height - 10);

    for(let i = 0; i < x_axis_records.length; i++){

        ctx.strokeStyle = "black";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(60 + ((width - 40)/6) * i, (height - 40) - 3);
        ctx.lineTo(60 + ((width - 40)/6) * i,(height - 40) + 3);
        ctx.stroke();
    
        ctx.font ="bold 10px Arial";
        ctx.fillText(x_axis_records[i], 40 + ((width - 40)/6) * i, height - 25);
    }

    for(let a = y_axis_records.length - 1; a >= 0; a--){
        ctx.strokeStyle = "black";
        ctx.lineWidth = 2;
        ctx.beginPath();
        ctx.moveTo(37, 34 + (a * (((height - 30)/(y_axis_records.length)))));
        ctx.lineTo(43, 34 + (a * (((height - 30)/(y_axis_records.length)))));
        ctx.stroke();
    
        ctx.font ="bold 10px Arial";
        ctx.fillText(y_axis_records[(y_axis_records.length - 1) - a], 24, 38 + a * ((height - 30)/y_axis_records.length));
    }

    for(let b = 0; b < heights_of_elements.length; b++){

        startingx = 60 + (((width - 40)/6)) * b;
        startingy = 40 + (lowest - heights_of_elements[b][0]);
        widthForRect = (60 + ((width - 40)/6) * (b + 1)) - (60 + (((width - 40)/6)) * b);
        heightForRect = 260 - (40 + (lowest - heights_of_elements[b]));

        //console.log(startingx);
        //console.log(startingy);
        

        for(let c = 0; c < heights_of_elements[b].length; c++){
            length_of_bar = (size_of_blues/heights_of_elements[b].length) - 1
            //console.log(startingx + (length_of_bar) * c)
            //console.log(40 + (lowest - heights_of_elements[b][c]))

            ctx.fillStyle = getcolor(symptoms_for_month[b][c])
            ctx.fillRect(startingx + (length_of_bar) * c, (40 - Object.values(symptoms_for_month[b][c])[0] + 3) + (lowest - heights_of_elements[b][c]), length_of_bar, (260 - 3 + Object.values(symptoms_for_month[b][c])[0]) - (40 + (lowest - heights_of_elements[b][c])))
        }

        //ctx.fillStyle = colors[b]
        //ctx.fillRect(60 + ((width - 40)/6) * b, 40 + (lowest - heights_of_elements[b]), (60 + ((width - 40)/6) * (b + 1)) - (60 + ((width - 40)/6) * b), 260 - (40 + (lowest - heights_of_elements[b])))
    }

}

listOfSymptoms = ["Symptom 1", "Symptom 2", "Symptom 3", "Symptom 4", "Symptom 5", "Symptom 6", "Symptom 7", "Symptom 8", "Symptom 9", "Symptom 10"];

function getcolor(symptom){

    listOfColors = ["red", "yellow", "blue", "black", "brown", "cyan", "green", "purple", "violet", "aqua"]

    sympt = Object.keys(symptom)

    console.log(sympt)

    for(let i = 0; i < listOfSymptoms.length; i++){
        if(sympt == listOfSymptoms[i]){
            return listOfColors[i];
        }
    }

}

drawLineGraph('avg_cycle_duration', 'avg_cy_dur', 500, 300, ['15th Nov', '9th Dec', '4th Jan', '21st Jan', '18th Feb', '15st Mar'], ["10", "15","20", "25", "30"], [26, 28 ,27, 28, 30, 29], 30, 10);
drawLineGraph('avg_cycle_duration2', 'avg_cy_dur2', 500, 300, ['15th Nov', '9th Dec', '4th Jan', '21st Jan', '18th Feb', '15st Mar'], ["2", "4","6", "8", "10"], [ 4, 6 ,4, 5, 7, 10], 10, 2);
drawBarGraph('avg_cycle_duration3', 'avg_cy_dur3', 500, 300, ['15th Nov', '9th Dec', '4th Jan', '21st Jan', '18th Feb', '15st Mar'], ["0", "2","4", "6", "8", "10"], [ 4, 6 ,4, 5, 7, 10], 10, 0, [[{'Symptom 1': 6},{'Symptom 6': 8},{'Symptom 2': 4}, {'Symptom 4': 3}], [{'Symptom 5': 8},{'Symptom 3': 2}, {'Symptom 6': 4}], [{'Symptom 4': 4},{'Symptom 8': 8}, {'Symptom 2': 3}], [{'Symptom 8': 8},{'Symptom 4': 6}, {'Symptom 2': 4}], [{'Symptom 5': 8},{'Symptom 7': 3}, {'Symptom 1': 5}, {'Symptom 3': 2}]]);