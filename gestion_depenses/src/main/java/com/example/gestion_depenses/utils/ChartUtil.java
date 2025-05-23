package com.example.gestion_depenses.utils;

import javafx.scene.chart.BarChart;
import javafx.scene.chart.LineChart;
import javafx.scene.chart.PieChart;
import javafx.scene.chart.XYChart;

import java.util.Map;

public class ChartUtil {

    public static PieChart createPieChart(Map<String, Double> data) {
        PieChart pieChart = new PieChart();
        for (Map.Entry<String, Double> entry : data.entrySet()) {
            pieChart.getData().add(new PieChart.Data(entry.getKey(), entry.getValue()));
        }
        return pieChart;
    }

    public static BarChart<String, Number> createBarChart(Map<String, Double> data) {
        BarChart<String, Number> barChart = new BarChart<>(new javafx.scene.chart.CategoryAxis(), new javafx.scene.chart.NumberAxis());
        XYChart.Series<String, Number> series = new XYChart.Series<>();
        for (Map.Entry<String, Double> entry : data.entrySet()) {
            series.getData().add(new XYChart.Data<>(entry.getKey(), entry.getValue()));
        }
        barChart.getData().add(series);
        return barChart;
    }

    public static LineChart<String, Number> createLineChart(Map<String, Double> data) {
        LineChart<String, Number> lineChart = new LineChart<>(new javafx.scene.chart.CategoryAxis(), new javafx.scene.chart.NumberAxis());
        XYChart.Series<String, Number> series = new XYChart.Series<>();
        for (Map.Entry<String, Double> entry : data.entrySet()) {
            series.getData().add(new XYChart.Data<>(entry.getKey(), entry.getValue()));
        }
        lineChart.getData().add(series);
        return lineChart;
    }
}