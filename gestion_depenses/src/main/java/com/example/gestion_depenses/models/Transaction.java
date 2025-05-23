package com.example.gestion_depenses.models;

import java.time.LocalDate;

public class Transaction {
    private double amount;
    private String type; // "income" or "expense"
    private String category; // e.g., "rent", "food", "transport"
    private LocalDate date;
    private String comment;

    public Transaction(double amount, String type, String category, LocalDate date, String comment) {
        this.amount = amount;
        this.type = type;
        this.category = category;
        this.date = date;
        this.comment = comment;
    }

    public double getAmount() {
        return amount;
    }

    public void setAmount(double amount) {
        this.amount = amount;
    }

    public String getType() {
        return type;
    }

    public void setType(String type) {
        this.type = type;
    }

    public String getCategory() {
        return category;
    }

    public void setCategory(String category) {
        this.category = category;
    }

    public LocalDate getDate() {
        return date;
    }

    public void setDate(LocalDate date) {
        this.date = date;
    }

    public String getComment() {
        return comment;
    }

    public void setComment(String comment) {
        this.comment = comment;
    }
}