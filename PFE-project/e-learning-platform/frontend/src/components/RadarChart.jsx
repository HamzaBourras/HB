/* eslint-disable no-unused-vars */
/* eslint-disable react/prop-types */
import { useState } from "react";
import Chart from "react-apexcharts";

const RadarChart = ({ data}) => {
    const [chartData, setChartData] = useState({
        options: {
            chart: {
                id: "basic-radar",
                toolbar: {
                    show: true,
                    offsetX: 10,
                    offsetY: 30,
                }
            },
            xaxis: {
                categories: data.map(tab => tab.quizName),
                labels: {
                    style: {
                        fontSize: "15px",
                        
                    }
                }

            },
            yaxis: {
                show: false,
                labels: {
                    style: {
                        fontSize: "11px",
                        fontFamily: 'Arial',
                    },
                }
            },
            plotOptions: {
                radar: {
                    polygons: {
                        strokeColor: '#e8e8e8',
                        fill: {
                            colors: ['#f8f8f8', '#fff']
                        }
                    }
                }
            },
            dataLabels: {
                enabled: true,
                background: {
                    enabled: true,
                    borderRadius: 2,
                }
            }
        },
        series: [
            {
                name: "Grades",
                data: data.map(grade => grade.noteTotale)
            }
        ],
        fill: {
            opacity: 0.5,
            colors: []
        },
        markers: {
            size: 10,
            hover: {
                size: 100
            }
        }
    });

    return (
        <div className="">
            <Chart
                options={chartData.options}
                series={chartData.series}
                type="radar"
                width={500}
                height={500}
            />
        </div>
    );
};

export default RadarChart;
