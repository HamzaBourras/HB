package com.example.gestion_depenses.services;

import com.example.gestion_depenses.models.Budget;
import com.example.gestion_depenses.models.Transaction;

import java.util.List;

public class BudgetService {
    private Budget budget;

    public BudgetService() {
        double monthlyLimit = 0;
        this.budget = new Budget(monthlyLimit);
    }

    public void setMonthlyLimit(double limit) {
        budget.setMonthlyLimit(limit);
    }

    public double getMonthlyLimit() {
        return budget.getMonthlyLimit();
    }

    public double getTotalExpenses(List<Transaction> transactions) {
        return transactions.stream()
                .filter(transaction -> transaction.getType().equals("expense"))
                .mapToDouble(Transaction::getAmount)
                .sum();
    }

    public boolean isBudgetExceeded(List<Transaction> transactions) {
        double totalExpenses = getTotalExpenses(transactions);
        return totalExpenses > budget.getMonthlyLimit();
    }

    public String getBudgetStatus(List<Transaction> transactions) {
        if (isBudgetExceeded(transactions)) {
            return "Budget exceeded!";
        } else {
            return "Budget is within limits.";
        }
    }

    public double getMonthlyBudget() {
        return 0;
    }
}