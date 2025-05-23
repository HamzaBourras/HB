package com.example.gestion_depenses.controllers;

import com.example.gestion_depenses.models.Recommendation;
import com.example.gestion_depenses.services.RecommendationService;
import javafx.fxml.FXML;
import javafx.scene.control.Label;
import javafx.scene.layout.VBox;

import java.util.List;

public class RecommendationController {

    @FXML
    private VBox recommendationContainer;

    @FXML
    private Label recommendationLabel;

    private RecommendationService recommendationService;

    public RecommendationController() {
        this.recommendationService = new RecommendationService();
    }

    @FXML
    public void initialize() {
        displayRecommendations();
    }

    private void displayRecommendations() {
        List<Recommendation> recommendations = recommendationService.getRecommendations();
        if (recommendations.isEmpty()) {
            recommendationLabel.setText("No recommendations available.");
        } else {
            StringBuilder recommendationsText = new StringBuilder("Budget Recommendations:\n");
            for (Recommendation recommendation : recommendations) {
                recommendationsText.append("- ").append(recommendation.getAdvice()).append("\n");
            }
            recommendationLabel.setText(recommendationsText.toString());
        }
    }
}