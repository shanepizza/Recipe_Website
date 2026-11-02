const ctx = document.getElementById('pie-chart-canvas').getContext('2d');

const portions = [
    {label: 'Carbs', goal: 50, reached: 30, faded: '#E9AAB8', vibrant: '#FF6384'  },
    {label: 'Protein', goal: 30, reached: 20, faded: '#A9CFE5', vibrant: '#36A2EB'  },
    {label: 'Fat', goal: 20, reached: 10, faded: '#EBD99C', vibrant: '#FFCE56'  }
]



const pieChart = new Chart(ctx, {
    type: 'pie',
    plugins: [{
        id: 'reachedPortions',

        afterDatasetsDraw(chart) {
            const context = chart.ctx;
            context.save();

            chart.getDatasetMeta(0).data.forEach((arc, index) => {
                if (!chart.getDataVisibility(index) || arc.circumference <= 0) {
                    return;
                }
                
                
                const { x, y, innerRadius, outerRadius, startAngle, endAngle } = arc;
                const portion = portions[index];
                const reachedAngle = startAngle + (endAngle - startAngle) * (portion.reached / portion.goal);
                const middleAngle = (startAngle + endAngle) / 2;
                const offset = (arc.options.offset || 0) /4;

                const radiusOffset =
                    offset * (1 - Math.sin(Math.min(Math.PI, arc.circumference)));

                const drawRadius = outerRadius + radiusOffset;

                const drawX = x + Math.cos(middleAngle) * offset;
                const drawY = y + Math.sin(middleAngle) * offset;

                context.beginPath();
                context.arc(drawX, drawY, drawRadius-1, startAngle, reachedAngle);
                context.lineTo(drawX, drawY);
                context.closePath();
                context.fillStyle = portion.vibrant;
                context.fill();




            });

            context.restore();
        }
        
   
       
    }],
    data: {
        labels: [
            ...portions.map(p => p.label)
        ],
        datasets: [{
            data: portions.map(p => p.goal),
            backgroundColor: portions.map(p => p.faded),
            hoverBackgroundColor: portions.map(p => p.faded),
            hoverOffset: 20,
            borderWidth: 2
            
        }]
    },
    options: {
        responsive: true,
        radius: '100%',
        plugins: {
            legend: {
                position: 'top',
            },
            tooltip: {
                callbacks: {
                    label(context) {
                        const portion = portions[context.dataIndex];
                        return `${portion.label}: ${portion.reached} of ${portion.goal} reached`;
                    }
                }
            }
        }
    }
});