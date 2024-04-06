/* eslint-disable react/prop-types */
/* eslint-disable no-unused-vars */
import { Chart as ChartJS } from 'chart.js/auto';
import { PolarArea } from 'react-chartjs-2';

const PolarChart = ({ labels, data, colors }) => {
    const chartData = {
        labels: labels,
        datasets: [
            {
                data: data,
                backgroundColor: colors.map(color => color.replace(/[^,]+(?=\))/, '0.6')),
                borderColor: colors.map(color => color.replace(/[^,]+(?=\))/, '1')),
                borderWidth: 1,
            },
        ],
    };

    const chartOptions = {
        cutout: '70%',
        plugins: {
            legend: {
                position: 'bottom',
            },
        },
    };

    return (
        <div className='xs:sm:size-56 md:lg:size-80'>
            <PolarArea data={chartData} options={chartOptions} />
        </div>
    );
};

export default PolarChart;