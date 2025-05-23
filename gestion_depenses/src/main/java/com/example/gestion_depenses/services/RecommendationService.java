package com.example.gestion_depenses.services;

import com.example.gestion_depenses.models.Recommendation;
import com.example.gestion_depenses.models.Transaction;

import java.util.List;
import java.util.Map;
import java.util.stream.Collectors;

public class RecommendationService {

    public Recommendation generateRecommendations(List<Transaction> transactions, double budget) {
        Map<String, Double> categoryTotals = transactions.stream()
                .collect(Collectors.groupingBy(Transaction::getCategory,
                        Collectors.summingDouble(Transaction::getAmount)));

        StringBuilder advice = new StringBuilder("Recommendations:\n");

        for (Map.Entry<String, Double> entry : categoryTotals.entrySet()) {
            String category = entry.getKey();
            double totalSpent = entry.getValue();
            double percentageOfBudget = (totalSpent / budget) * 100;

            if (percentageOfBudget > 80) {
                advice.append("Consider reducing spending in ").append(category).append(". You have spent ")
                        .append(String.format("%.2f", totalSpent)).append(" which is ")
                        .append(String.format("%.2f", percentageOfBudget)).append("% of your budget.\n");
            } else if (percentageOfBudget > 50) {
                advice.append("You are spending a moderate amount in ").append(category).append(". Total spent: ")
                        .append(String.format("%.2f", totalSpent)).append(" (").append(String.format("%.2f", percentageOfBudget))
                        .append("% of your budget).\n");
            }
        }

        return new Recommendation(advice.toString());
    }

    public List<Recommendation> getRecommendations() {
        return null;
    }
}