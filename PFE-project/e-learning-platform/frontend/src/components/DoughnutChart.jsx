/* eslint-disable react/prop-types */
/* eslint-disable no-unused-vars */
import { Chart as ChartJS } from 'chart.js/auto';
import { Pie } from 'react-chartjs-2';

const DoughnutChart = ({ labels, data, colors }) => {
    const chartData = {
        labels: labels,
        datasets: [
            {
                data: data,
                backgroundColor: colors.map(color => color.replace(/[^,]+(?=\))/, '0.3')),
                borderColor: colors.map(color => color.replace(/[^,]+(?=\))/, '0.6')),
                borderWidth: 1,
            },
        ],
    };

    const chartOptions = {
        // cutout: '70%',
        plugins: {
            legend: {
                position: 'top', // or 'bottom', 'left', 'right'
                align: 'start', // This aligns legend items to the start (left for horizontal, top for vertical)
                labels: {
                    display: true,
                    usePointStyle: true, // Optional: This uses point style for legend items
                },
            },
        },
    };

    return (
        <div className='xs:sm:size-80 md:lg:size-96'>
            <Pie data={chartData} options={chartOptions} />
        </div>
    );
};

export default DoughnutChart;