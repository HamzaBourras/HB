/* eslint-disable no-unused-vars */
/* eslint-disable react/prop-types */
/* eslint-disable react/prop-types */
// BarChart.js
import { Chart as ChartJS } from 'chart.js/auto';
import { Bar } from 'react-chartjs-2';

const BarChart = ({ data, labels, colors }) => {

    const datasets = labels.map((label, index) => ({
        label: label,
        backgroundColor: colors[index],
        borderColor: colors[index].replace(/[^,]+(?=\))/, '1'),
        borderWidth: 1,
        
        data: Object.values(data).map((professor) => professor[label] || 0),
    }));

    const chartData = {
        labels: Object.keys(data),
        datasets: datasets
    };

    const chartOptions = {
        scales: {
            x: {
                stacked: true,
            },
            y: {
                stacked: true,
            },
        },
    };

    return (
        <div className='my-2'>
            <Bar data={chartData} options={chartOptions} />
        </div>
    );
};

export default BarChart;
